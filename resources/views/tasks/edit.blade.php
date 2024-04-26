<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
                {{ __('Tasks') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto p-6 bg-white shadow-md rounded-md">
                    <h2 class="text-xl font-semibold mb-4">Edit Task</h2>
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror" required>
                            @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content" rows="4" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror" required>{{ old('content', $task->content) }}</textarea>
                            @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('status') border-red-500 @enderror" required>
                                <option value="to-do" {{ old('status', $task->status) === 'to-do' ? 'selected' : '' }}>To Do</option>
                                <option value="in-progress" {{ old('status', $task->status) === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="done" {{ old('status', $task->status) === 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                            @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="parent_task" class="block text-sm font-medium text-gray-700">Parent Task</label>
                            <select name="parent_task" id="parent_task" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">None</option>
                                @foreach($tasks as $t)
                                    <option value="{{ $t->id }}" {{ old('parent_task', $task->parent_task) == $t->id ? 'selected' : '' }}>{{ $t->title }}</option>
                                @endforeach
                            </select>
                            @error('parent_task')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Current Image</label>
                            <div class="mt-1 flex items-center">
                                <img src="{{ asset('storage/'.$task->image_path) }}" alt="Current Image" class="h-16 w-16 object-cover rounded-md shadow">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">New Image</label>
                            <input type="file" name="image" id="image" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('image') border-red-500 @enderror">
                            @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
