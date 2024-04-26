<?php
namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasksPaginated($perPage)
    {
        return $this->taskRepository->getAllTasksPaginated($perPage);
    }

    public function getAll()
    {
        return $this->taskRepository->getAll();
    }

    public function getAllExcept($id)
    {
        return $this->taskRepository->getAllExcept($id);
    }

    public function create($data)
    {
        return $this->taskRepository->create($data);
    }
    public function update($id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }
}
