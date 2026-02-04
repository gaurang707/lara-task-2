@section('title', 'Create Task')

@push('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.2/themes/base/jquery-ui.css">
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Task') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Create New Task</h2>
                    <form action="{{ route('tasks.store') }}" method="POST" class="">
                        @csrf
                        <!-- Project Name -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Task
                                Title</label>
                            <input type="text" id="title" name="title"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2.5 border"
                                placeholder="Enter task title" value="{{ old('title', $task->title) }}">

                            @error('title')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Project Select -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Project
                            </label>
                            <select name="project_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">Select Project</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}"
                                        @if (old('project_id', $task->project_id) == $project->id) selected @endif>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Radio Buttons -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>

                            <div class="flex items-center space-x-6">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="status" value="pending"
                                        class="text-blue-500 focus:ring-blue-400"
                                        @if (old('status', $task->status) == 'pending') checked @endif>
                                    <span>Pending</span>
                                </label>

                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="status" value="completed"
                                        class="text-blue-500 focus:ring-blue-400"
                                        @if (old('status', $task->status) == 'completed') checked @endif>
                                    <span>Completed</span>
                                </label>
                            </div>
                            @error('status')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Assigned User Select -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Assign To
                            </label>
                            <select name="assigned_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @if (old('assigned_id', $task->assigned_id) == $user->id) selected @endif>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_id')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Submit Button -->
                        <button type="submit"
                            class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Update Task') }}
                        </button>

                        <a type="button" href="{{ route('tasks.index') }}"
                            class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Cancel') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            $("#_datepicker_input").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0,
                defaultDate: new Date(),
            });
            $("#datepicker").datepicker("setDate", new Date());
        });
    </script>
</x-app-layout>
