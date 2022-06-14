<?php

namespace App\Console\Commands;

use App\Services\FeedImportService;
use Illuminate\Console\Command;

class GenerateFeedUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'feed:generate-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate feed user.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $feedImportService = new FeedImportService();

            $user = $feedImportService->generateFeedUser();

            $this->info('Feed import user has been created successfully.');
            $this->table(['id', 'name', 'email'], [
                [
                    $user->id,
                    $user->name,
                    $user->email,
                ]
            ]);
            
            return 0;
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            return $th->getCode();
        }
    }
}
