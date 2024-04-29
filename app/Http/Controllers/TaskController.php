<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        if(\request()->ajax()) return $this->taskService->getDataTables();
        return view('tasks.index', );
    }


    public function create()
    {
        $tasks = $this->taskService->getAllParentTask();
        return view('tasks.create', compact('tasks'));
    }

    public function store(TaskRequest $request)
    {
        $data = array_merge($request->validated(), ['user_id' => Auth::id()]);

        if ($request->hasFile('image')) {
            // Store the uploaded image locally
            $imagePath = $request->file('image')->store('task_images', 'public');

            // Add the image path to the task data
            $data['image_path'] = $imagePath;
        }
        $task = $this->taskService->create($data);


        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403); // Or redirect to a different page
        }

        $tasks = $this->taskService->getAllParentTaskExcept($task?->id );

        return view('tasks.edit', compact('task', 'tasks'));
    }

    public function update(TaskRequest $request, Task $task)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            if ($task->image_path) {
                Storage::disk('public')->delete($task->image_path);
            }
            $imagePath = $request->file('image')->store('task_images', 'public');

            // Add the image path to the task data
            $data['image_path'] = $imagePath;
        }
        $this->taskService->update($task->id, $data);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
