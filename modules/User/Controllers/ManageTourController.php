<?php
namespace Modules\User\Controllers;

use Modules\FrontendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tour\Models\Tour;
use Modules\Tour\Models\TourCategory;
use Modules\Location\Models\Location;

class ManageTourController extends FrontendController
{
    public function manageTour(Request $request)
    {
        $this->checkPermission('tour_view');
        $user_id = Auth::id();
        $list_tour = Tour::where("create_user", $user_id)->orderBy('id', 'desc');
        $data = [
            'rows' => $list_tour->paginate(5)
        ];
        return view('User::frontend.manageTour.index', $data);
    }

    public function createTour(Request $request)
    {
        $this->checkPermission('tour_create');
        if (!empty($request->input())) {
            $request->validate([
                'title' => 'required',
            ]);
            $dataRequest = $request->input();
            $dataRequest['status'] = 'draft';
            $row = new Tour($dataRequest);
            if ($row->save()) {
                $row->saveMeta($request);
                $row->saveSEO($request);
                return redirect('user/tour')->with('success', __('Tour created'));
            }
        } else {
            $row = new Tour();
            $row->fill([
                'status' => 'publish'
            ]);
        }
        $data = [
            'row'           => $row,
            'tour_category' => TourCategory::get()->toTree(),
            'tour_location' => Location::get()->toTree(),
        ];
        return view('User::frontend.manageTour.detail', $data);
    }

    public function editTour(Request $request, $id)
    {
        $this->checkPermission('tour_update');
        $user_id = Auth::id();
        $row = Tour::where("create_user", $user_id);
        $row = $row->find($id);
        if (empty($row)) {
            return redirect('user/tour')->with('warning', __('Tour not found!'));
        }
        if (!empty($request->input())) {
            $request->validate([
                'title' => 'required',
            ]);
            $row->fill($request->input());
            if ($row->save()) {
                $row->saveMeta($request);
                $row->saveSEO($request);
                return redirect('user/tour')->with('success', __('Tour updated!'));
            }
        }
        $data = [
            'row'           => $row,
            'tour_category' => TourCategory::get()->toTree(),
            'tour_location' => Location::get()->toTree(),
        ];
        return view('User::frontend.manageTour.detail', $data);
    }

    public function deleteTour($id)
    {
        $this->checkPermission('tour_delete');
        $user_id = Auth::id();
        Tour::where("create_user", $user_id)->where("id", $id)->first()->delete();
        return redirect('user/tour')->with('success', __('Delete tour success!'));
    }
}