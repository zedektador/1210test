<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

class AutomaticTaskDeletion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:automatic-task-deletion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete tasks older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Task::whereDate('deleted_at', '<', now()->subDays(30))->forceDelete();
        $this->info('Tasks older than 30 days deleted successfully.');
    }
}
