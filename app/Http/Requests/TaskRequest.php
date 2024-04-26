<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $taskId = $this->route('task') ? $this->route('task')->id : null;

        return [
            'title' => [
                'required',
                Rule::unique('tasks')->ignore($taskId),
                'max:100',
            ],
            'content' => 'required',
            'status' => 'required|in:to-do,in-progress,done',
            'image' => 'nullable|image|max:4096', // 4MB limit for image files
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (Auth::id() != $this->task->user_id) {
                $validator->errors()->add('user_id', 'You are not authorized to update this task.');
            }
        });
    }
}
