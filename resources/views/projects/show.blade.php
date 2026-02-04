@section('title', 'View Project')

@push('styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.2/themes/base/jquery-ui.css">
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Project') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
                    <div class="max-w-md mx-auto p-4 bg-white shadow rounded-lg">
                        <h2 class="text-xl font-bold mb-4">Project Details</h2>
                        <div class="space-y-3">
                            <!-- Row 1 -->
                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Project Name</dt>
                                <dd class="flex-1 text-gray-900 font-semibold">{{ $project->name }}</dd>
                            </div>
                            <!-- Row 2 -->
                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Description</dt>
                                <dd class="flex-1 text-gray-700">{{ $project->description }}</dd>
                            </div>
                            <!-- Row 3 -->
                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Deadline</dt>
                                <dd class="flex-1 text-red-600 font-bold">
                                    <div id="_datepicker_deadline"></div>
                                </dd>
                            </div>
                            <div class="flex">
                                <dt class="w-32 font-medium text-gray-500">Created At</dt>
                                <dd class="flex-1 text-red-600 font-bold">{{ $project->created_at }}</dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            var deadlineDate = "{{ $project->deadline->format('Y-m-d') }}";
            $('#_datepicker_deadline').datepicker({
                dateFormat: 'yy-mm-dd',
                defaultDate: deadlineDate,
                beforeShowDay: function(date) {
                    var formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
                    if (formattedDate === deadlineDate) {
                        return [true, "highlight", "Deadline"];
                    } else {
                        return [false, "", "Unavailable"];
                    }
                }
            });
        });
    </script>
</x-app-layout>
