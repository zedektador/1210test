<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessMediaAttachments implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;
    protected $image;

    public function __construct(Task $task, $image)
    {
        $this->task = $task;
        $this->image = $image;
    }

    public function handle()
    {
        // Logic to process media attachments
        // This could include tasks like resizing images, storing files, etc.
        $imagePath = $this->image->store('task_images', 'public');

        // Add the image path to the task data
        $this->task->image_path = $imagePath;
        $this->task->save();
    }
}
