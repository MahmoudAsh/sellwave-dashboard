@extends('layouts.app')

@section('title', $task->title . ' - Task Details')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $task->title }}</h1>
                <p class="text-gray-600 mt-1">Task Details</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('tasks.edit', $task) }}" class="btn-primary">
                    ✏️ Edit Task
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="btn-danger"
                            onclick="return confirm('Are you sure you want to delete this task?')">
                        🗑️ Delete Task
                    </button>
                </form>
            </div>
        </div>
        <nav class="mt-4">
            <a href="{{ route('tasks.index') }}" 
               class="text-blue-600 hover:text-blue-800 font-medium">
                ← Back to All Tasks
            </a>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Task Content -->
        <div class="lg:col-span-2">
            <div class="card">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Task Description</h2>
                
                @if($task->description)
                    <div class="prose prose-gray max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $task->description }}</p>
                    </div>
                @else
                    <p class="text-gray-500 italic">No description provided for this task.</p>
                @endif
            </div>
        </div>

        <!-- Task Metadata -->
        <div class="space-y-6">
            <!-- Status & Priority Card -->
            <div class="card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Task Status</h3>
                
                <!-- Status -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Current Status</label>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $task->status_color }}">
                        {{ ucwords(str_replace('_', ' ', $task->status)) }}
                    </span>
                </div>

                <!-- Priority -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Priority Level</label>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $task->priority_color }}">
                        {{ ucfirst($task->priority) }} Priority
                    </span>
                </div>

                <!-- Progress Bar (visual representation) -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Progress</label>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                             style="width: {{ $task->status === 'completed' ? '100' : ($task->status === 'in_progress' ? '50' : '10') }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $task->status === 'completed' ? '100% Complete' : ($task->status === 'in_progress' ? '50% In Progress' : '10% Started') }}
                    </p>
                </div>
            </div>

            <!-- Dates Card -->
            <div class="card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Important Dates</h3>
                
                <!-- Due Date -->
                @if($task->due_date)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Due Date</label>
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-900 font-medium">
                                {{ $task->due_date->format('l, F j, Y') }}
                            </span>
                            @if($task->isOverdue())
                                <span class="text-red-500 text-sm font-semibold">⚠️ Overdue</span>
                            @elseif($task->due_date->isToday())
                                <span class="text-yellow-500 text-sm font-semibold">📅 Due Today</span>
                            @elseif($task->due_date->isTomorrow())
                                <span class="text-blue-500 text-sm font-semibold">⏰ Due Tomorrow</span>
                            @endif
                        </div>
                        @if($task->due_date->isFuture())
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $task->due_date->diffForHumans() }}
                            </p>
                        @endif
                    </div>
                @else
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-600 mb-1">Due Date</label>
                        <span class="text-gray-500 italic">No due date set</span>
                    </div>
                @endif

                <!-- Created Date -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Created</label>
                    <span class="text-gray-900">{{ $task->created_at->format('l, F j, Y') }}</span>
                    <p class="text-sm text-gray-500">{{ $task->created_at->diffForHumans() }}</p>
                </div>

                <!-- Last Updated -->
                @if($task->updated_at->ne($task->created_at))
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Last Updated</label>
                        <span class="text-gray-900">{{ $task->updated_at->format('l, F j, Y') }}</span>
                        <p class="text-sm text-gray-500">{{ $task->updated_at->diffForHumans() }}</p>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                
                @if($task->status !== 'completed')
                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="title" value="{{ $task->title }}">
                        <input type="hidden" name="description" value="{{ $task->description }}">
                        <input type="hidden" name="status" value="completed">
                        <input type="hidden" name="priority" value="{{ $task->priority }}">
                        <input type="hidden" name="due_date" value="{{ $task->due_date?->format('Y-m-d') }}">
                        <button type="submit" class="btn-success w-full">
                            ✅ Mark as Completed
                        </button>
                    </form>
                @endif

                @if($task->status === 'pending')
                    <form action="{{ route('tasks.update', $task) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="title" value="{{ $task->title }}">
                        <input type="hidden" name="description" value="{{ $task->description }}">
                        <input type="hidden" name="status" value="in_progress">
                        <input type="hidden" name="priority" value="{{ $task->priority }}">
                        <input type="hidden" name="due_date" value="{{ $task->due_date?->format('Y-m-d') }}">
                        <button type="submit" class="btn-primary w-full">
                            🚀 Start Working
                        </button>
                    </form>
                @endif

                <a href="{{ route('tasks.edit', $task) }}" class="btn-secondary w-full text-center block">
                    ✏️ Edit Details
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 