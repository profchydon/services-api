<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCache extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $name = 'cache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all compiled view files.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cachedViews = storage_path('/framework/cache/');
        $files = glob($cachedViews.'*');
        foreach($files as $file) {
            if(is_file($file)) {
                @unlink($file);
            }
        }
    }
}
