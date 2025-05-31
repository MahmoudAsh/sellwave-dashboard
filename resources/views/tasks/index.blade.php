@extends('layouts.app')

@section('title', 'All Tasks - Task Management App')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Task Management</h1>
            <p class="text-gray-600 mt-1">Organize and track your tasks efficiently</p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">{{ $tasks->total() }} total tasks</span>
        </div>
    </div>
</div>

@if($tasks->count() > 0)
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($tasks as $task)
            <div class="card hover:shadow-xl transition-shadow duration-200 border-l-4 
                        @if($task->isOverdue()) border-red-500 
                        @elseif($task->status === 'completed') border-green-500 
                        @elseif($task->status === 'in_progress') border-blue-500 
                        @else border-yellow-500 @endif">
                
                <!-- Task Header -->
                <div class="flex justify-between items-start mb-3">
                    <h3 class="text-lg font-semibold text-gray-900 truncate flex-1">
                        {{ $task->title }}
                    </h3>
                    <div class="flex items-center space-x-2 ml-2">
                        <!-- Priority Badge -->
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task->priority_color }}">
                            {{ ucfirst($task->priority) }}
                        </span>
                    </div>
                </div>

                <!-- Task Description -->
                @if($task->description)
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                        {{ Str::limit($task->description, 100) }}
                    </p>
                @endif

                <!-- Task Meta Info -->
                <div class="space-y-2 mb-4">
                    <!-- Status -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Status:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task->status_color }}">
                            {{ ucwords(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>

                    <!-- Due Date -->
                    @if($task->due_date)
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">Due:</span>
                            <span class="text-sm {{ $task->isOverdue() ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                {{ $task->due_date->format('M j, Y') }}
                                @if($task->isOverdue())
                                    <span class="text-red-500">⚠️</span>
                                @endif
                            </span>
                        </div>
                    @endif

                    <!-- Created Date -->
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Created:</span>
                        <span class="text-sm text-gray-700">{{ $task->created_at->format('M j, Y') }}</span>
                    </div>
                </div>

                <!-- Task Actions -->
                <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                    <a href="{{ route('tasks.show', $task) }}" 
                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View Details
                    </a>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('tasks.edit', $task) }}" 
                           class="text-gray-600 hover:text-gray-800 text-sm">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 text-sm delete-task"
                                    title="Delete Task">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    @if($tasks->hasPages())
        <div class="mt-8">
            {{ $tasks->links() }}
        </div>
    @endif

@else
    <!-- Empty State -->
    <div class="text-center py-12">
        <div class="max-w-md mx-auto">
            <div class="text-6xl mb-4">📝</div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No tasks yet</h3>
            <p class="text-gray-500 mb-6">Get started by creating your first task to stay organized and productive.</p>
            <a href="{{ route('tasks.create') }}" class="btn-primary">
                ➕ Create Your First Task
            </a>
        </div>
    </div>
@endif
@endsection 