<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function getAllTasksPaginated($perPage);

    public function getAll();
    public function getAllExcept($id);

    public function findById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
