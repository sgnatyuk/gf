<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Clear extends Command
{
    protected $signature = 'clear:start';

    protected $description = 'Clear all cache';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');

        try {
            \Artisan::call('ide-helper:generate');
            \Artisan::call('ide-helper:meta');
            \Artisan::call('ide-helper:models');
        } catch (\Exception $e) {
        }

        print 'Cache was cleared.' . PHP_EOL;
    }
}