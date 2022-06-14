<?php

namespace App\Console\Commands;

use App\Services\FeedImportService;
use Illuminate\Console\Command;

class feedImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts from feed endpoint.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $feedImportService = new FeedImportService();
            
            $postsCount = $feedImportService->import();

            $this->info('Feed import has been imported successfully.');
            $this->info($postsCount . ' has been imported.');
            
            return 0;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());

            return $th->getCode();
        }
    }
}
