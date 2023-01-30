<?php

namespace Indianic\CmsPages\Console;

use Illuminate\Console\Command;

/**
 * Class CmsPageesCommand
 *
 * @package Indianic\CmsPages\Console
 */
class CmsPageesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:cms-pages';

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
     */
    public function handle()
    {
        $this->info('Publishing Configuration...');

        $this->call('migrate', [
            '--path' => 'database/migrations/2023_01_19_045711_create_cmspages.php'
        ]);

        $this->info('Publishing Configuration Successfully Completed.');
    }
}
