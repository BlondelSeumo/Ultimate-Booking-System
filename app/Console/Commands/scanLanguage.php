<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Language\Admin\TranslationsController;

class scanLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'language:scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all translation string from source code';

    protected $controller;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TranslationsController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $count = $this->controller->findTranslations();

        $this->info('Scan completed, found '.$count. ' text!');
    }
}
