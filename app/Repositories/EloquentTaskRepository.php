<?php

namespace App\Repositories;

use App\Models\Task;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function getAllTasksPaginated($perPage)
    {
        return Task::paginate($perPage);
    }

    public function getUserTask($userId)
    {
        return Task::where('user_id', $userId)->get();
    }

    public function findById($id)
    {
        return Task::find($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
        return Task::destroy($id);
    }
    public function getAllParentTaskExcept($id)
    {
        return Task::whereNotIn('id', [$id])->whereNull('parent_task_id')->get();
    }
    public function getAllParentTask()
    {
        return Task::whereNull('parent_task_id')->get();
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }
}
