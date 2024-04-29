<?php
namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

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

    public function getAllParentTask()
    {
        return $this->taskRepository->getAllParentTask();
    }

    public function getAllParentTaskExcept($id)
    {
        return $this->taskRepository->getAllParentTaskExcept($id);
    }


    public function create($data)
    {
        return $this->taskRepository->create($data);
    }
    public function update($id, array $data)
    {
        return $this->taskRepository->update($id, $data);
    }

    public function getDataTables() {

        $data = $this->taskRepository->getUserTask(Auth::id());
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $editUrl = route('tasks.edit', $row['id']);
                $deleteUrl = route('tasks.destroy', $row['id']);
                $actionBtn = '<a href="'.$editUrl.'" class="edit btn btn-success btn-sm">Edit</a>
                                <form action="'.$deleteUrl.'" method="POST" style="display: inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="delete btn btn-danger btn-sm">Delete</button>
                                </form>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
