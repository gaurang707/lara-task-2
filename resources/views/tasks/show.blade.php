@section('title', 'View Task')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
                    <div class="max-w-md mx-auto p-4 bg-white shadow rounded-lg">
                        <h2 class="text-xl font-bold mb-4">Task Details</h2>
                        <div class="space-y-3">
                            <!-- Row 1 -->
                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Task</dt>
                                <dd class="flex-1 text-gray-900 font-semibold">{{ $task->title }}</dd>
                            </div>
                            <!-- Row 2 -->
                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Project Name</dt>
                                <dd class="flex-1 text-gray-700">{{ $task->project->name }}</dd>
                            </div>

                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Status</dt>
                                <dd class="flex-1 text-gray-700">{{ $task->status }}</dd>
                            </div>

                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Assignee</dt>
                                <dd class="flex-1 text-gray-700">{{ $task->assignee->name }}</dd>
                            </div>
                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Created At</dt>
                                <dd class="flex-1 text-red-600 font-bold">{{ $task->created_at->format('d M Y H:i') }}</dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</x-app-layout>
