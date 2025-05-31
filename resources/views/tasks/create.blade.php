@extends('layouts.app')

@section('title', 'Create New Task - Task Management App')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Create New Task</h1>
        <p class="text-gray-600 mt-1">Add a new task to your to-do list</p>
    </div>

    <div class="card">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Task Title *
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       class="form-input @error('title') border-red-500 @enderror" 
                       placeholder="Enter task title"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="4" 
                          class="form-textarea @error('description') border-red-500 @enderror"
                          placeholder="Enter task description (optional)">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status and Priority Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status *
                    </label>
                    <select id="status" 
                            name="status" 
                            class="form-input @error('status') border-red-500 @enderror" 
                            required>
                        <option value="">Select status</option>
                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Priority -->
                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                        Priority *
                    </label>
                    <select id="priority" 
                            name="priority" 
                            class="form-input @error('priority') border-red-500 @enderror" 
                            required>
                        <option value="">Select priority</option>
                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Due Date -->
            <div class="mb-6">
                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Due Date
                </label>
                <input type="date" 
                       id="due_date" 
                       name="due_date" 
                       value="{{ old('due_date') }}"
                       min="{{ date('Y-m-d') }}"
                       class="form-input @error('due_date') border-red-500 @enderror">
                @error('due_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('tasks.index') }}" 
                   class="text-gray-600 hover:text-gray-800 font-medium">
                    ← Back to Tasks
                </a>
                <div class="flex items-center space-x-3">
                    <button type="reset" class="btn-secondary">
                        Clear Form
                    </button>
                    <button type="submit" class="btn-primary">
                        ✅ Create Task
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection 