<?php

namespace App\Repositories;

use App\Models\Task;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function getAllTasksPaginated($perPage)
    {
        return Task::paginate($perPage);
    }

    public function getAll()
    {
        return Task::all();
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
    public function getAllExcept($id)
    {
        return Task::whereNotIn('id', [$id])->get();
    }
}
