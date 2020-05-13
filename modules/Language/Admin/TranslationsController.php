<?php
namespace Modules\Language\Admin;

use function Clue\StreamFilter\fun;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Language\Models\Language;
use Modules\Language\Models\Translation;
use Symfony\Component\Finder\Finder;

class TranslationsController extends AdminController
{
    public function index()
    {
        $this->hasPermission('language_translation');
        $data = [
            'page_title' => __('Translation Manager'),
            'languages'  => Language::paginate(20),
            'total_text' => Translation::where('locale', 'raw')->count()
        ];
        $this->setActiveMenu('admin/module/core/tools');
        return view('Language::translations.index', $data);
    }

    public function detail(Request $request, $id)
    {

        $this->hasPermission('language_translation');
        $lang = Language::find($id);
        if (empty($lang)) {
            abort(404);
        }
        $query = Translation::select([
            'core_translations.*',
            't.string as translate'
        ])->where('core_translations.locale', 'raw');
        if ($request->s) {
            $query->where('core_translations.string', 'like', '%' . $request->s . '%');
        }
        $query->leftJoin('core_translations as t', function ($join) use ($lang) {

            $join->on('t.parent_id', '=', 'core_translations.id');
            $join->where('t.locale', '=', $lang->locale);
        });
        if ($request->type) {
            switch ($request->type) {

                case "not_translated":
                    $query->whereRaw("(t.id is null or IFNULL(t.string,'') = '' )");
                    break;
                case "translated":
                    $query->whereRaw("IFNULL(t.string,'') != '' ");
                    break;
            }
        }
        $origins = $query->orderBy('core_translations.string', 'asc')->paginate(30);
        $origins->appends($request->query());
        $data = [
            'page_title'  => __('Translation Manager'),
            'origins'     => $origins,
            'lang'        => $lang,
            'breadcrumbs' => [
                [
                    'name' => __('Translation Manager'),
                    'url'  => 'admin/module/language/translations'
                ],
                [
                    'name'  => __('Translate for: :name', ['name' => $lang->name]),
                    'class' => 'active'
                ],
            ]
        ];
        $this->setActiveMenu('admin/module/core/tools');
        return view('Language::translations.detail', $data);
    }

    public function store(Request $request, $id)
    {

        $this->hasPermission('language_translation');
        $lang = Language::find($id);
        if (empty($lang)) {
            abort(404);
        }
        $translate = $request->input('translate');
        if (is_array($translate)) {
            foreach ($translate as $item_id => $string) {
                $check = Translation::where('locale', $lang->locale)->where('parent_id', $item_id)->first();
                if ($check) {
                    $check->string = $string;
                    $check->save();
                } else {

                    $check = new Translation();
                    $check->parent_id = $item_id;
                    $check->string = $string;
                    $check->locale = $lang->locale;
                    $check->save();
                }
            }
        }
        return redirect()->back()->with('success', __("Translation saved"));
    }

    public function build($id)
    {
        $this->hasPermission('language_translation');
        $back = url('admin/module/language/translations');

        $lang = Language::find($id);
        if (empty($lang)) {
            abort(404);
        }
        $file = base_path('resources/lang/' . $lang->locale . '.json');
        if (!is_writable(base_path('resources/lang'))) {
            return redirect($back)->with('error', __("Folder: resources/lang is not write-able. Please contact your hosting provider"));
        }
        if (file_exists($file) and !is_writable($file)) {
            return redirect($back)->with('error', __("File: :file_name is not write-able. Please contact your hosting provider", ['file_name' => 'resources/lang/' . $lang->locale . '.json']));
        }
        $query = Translation::select([
            'core_translations.*',
            't.string as origin'
        ])->where('core_translations.locale', $lang->locale)->whereRaw("IFNULL(core_translations.string,'') != '' ");
        $query->join('core_translations as t', function ($join) use ($lang) {

            $join->on('t.id', '=', 'core_translations.parent_id');
            $join->where('t.locale', 'raw');
        });
        $json = [];
        $rows = $query->get();
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $json[$row['origin']] = $row['string'];
            }
        }
        $myfile = fopen($file, "w");
        fwrite($myfile, json_encode($json));
        fclose($myfile);
        $lang->last_build_at = date('Y-m-d H:i:s');
        $lang->save();
        return redirect(url('admin/module/language/translations'))->with('success', __("Re-build language file for: :name success", ['name' => $lang->name]));
    }

    public function loadStrings(){

        $this->hasPermission('language_translation');

        $file = base_path('resources/lang/default.json');
        $back = url('admin/module/language/translations');

        if(!is_file($file)){
            return redirect($back)->with('error', __("Default language source does not exists"));
        }

        $content = file_get_contents($file);
        if(empty($content)){
            return redirect($back)->with('error', __("Default language source empty"));
        }

        $json = \GuzzleHttp\json_decode($content,true);
        if(empty($json)){
            return redirect($back)->with('error', __("Default language source do not have any strings"));
        }

        foreach ($json as $key=>$value){
            Translation::firstOrCreate([
                'locale' => 'raw',
                'string' => $key
            ]);
        }

        return redirect($back)->with('success', __("Loaded :count strings",['count'=>count($json)]));
    }
    public function genDefault(){

        $this->hasPermission('language_translation');
        $back = url('admin/module/language/translations');


        $file = base_path('resources/lang/default.json');
        if (!is_writable(base_path('resources/lang'))) {
            return redirect($back)->with('error', __("Folder: resources/lang is not write-able. Please contact your hosting provider"));
        }
        if (file_exists($file) and !is_writable($file)) {
            return redirect($back)->with('error', __("File: :file_name is not write-able. Please contact your hosting provider", ['file_name' => 'resources/lang/' . $lang->locale . '.json']));
        }
        $query = Translation::select([
            'core_translations.*',
        ])->where('core_translations.locale', 'raw');
        $json = [];
        $rows = $query->get();
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $json[$row['string']] = '';
            }
        }
        $myfile = fopen($file, "w");
        fwrite($myfile, json_encode($json));
        fclose($myfile);

        return redirect($back)->with('success', __("Generate Default JSON Language"));
    }

    public function findTranslations($path = null)
    {
        $path = $path ? : base_path();
        $keys = array();
        $functions = array(
            'trans',
            'trans_choice',
            'Lang::get',
            'Lang::choice',
            'Lang::trans',
            'Lang::transChoice',
            '@lang',
            '@choice',
            'transEditable',
            '__'
        );
        $pattern =                              // See http://regexr.com/392hu
            "[^\w|>]" .                          // Must not have an alphanum or _ or > before real method
            "(" . implode('|', $functions) . ")" .  // Must start with one of the functions
            "\(" .                               // Match opening parenthese
            "[\'\"]" .                           // Match " or '
            "(" .                                // Start a new group to match:
            //            "[a-zA-Z0-9_-]+".               // Must start with group
            "([^\1)]+)+" .                // Be followed by one or more items/keys
            ")" .                                // Close group
            "[\'\"]" .                           // Closing quote
            "[\),]";                            // Close parentheses or new parameter
        // Find all PHP + Twig files in the app folder, except for storage
        $finder = new Finder();
        $finder->in($path)->exclude('storage')->name('*.php')->name('*.twig')->files();
        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($finder as $file) {
            // Search the current file for the pattern
            if (preg_match_all("/$pattern/siU", $file->getContents(), $matches)) {
                // Get all matches
                foreach ($matches[2] as $key) {
                    $keys[] = $key;
                }
            }
        }
        // Remove duplicates
        $keys = array_unique($keys);
        // Add the translations to the database, if not existing.
        foreach ($keys as $key) {
            // Split the group and item
            Translation::firstOrCreate([
                'locale' => 'raw',
                'string' => $key
            ]);
        }
        // Return the number of found translations
        return count($keys);
    }
}