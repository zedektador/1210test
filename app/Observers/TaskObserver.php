<?php
namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    public function updating(Task $task)
    {
        if ($task->status === 'done' && $task->parent_task_id !== null) {
            $subtasks = Task::where('parent_task_id', $task->parent_task_id)->get();
            $completedSubtasksCount = $subtasks->where('status', 'done')->count();
            if ($completedSubtasksCount === $subtasks->count()) {
                Task::where('id', $task->parent_task_id)->update(['status' => 'done']);
            }
        }
    }
}
