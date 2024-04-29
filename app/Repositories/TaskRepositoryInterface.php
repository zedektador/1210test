<?php

namespace App\Repositories;

use App\Models\User;

interface TaskRepositoryInterface
{
    public function getAllTasksPaginated($perPage);

    public function getAll();
    public function getAllParentTask();
    public function getAllParentTaskExcept($id);

    public function getUserTask($userId);
    public function findById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
