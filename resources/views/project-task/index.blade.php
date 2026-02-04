@section('title', 'Task Manage')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task') }}
        </h2>
        <span style="float:right;"><a href="{{ route('tasks.create') }}"
                class="font-medium text-sky-600 hover:text-sky-700 hover:underline">Create Task</a></span>
    </x-slot>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dataTables.tailwindcss.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dataTables.tailwindcss.css') }}">
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <table id="tasks-data-table" class="stripe">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Project ID</th>
                            <th>Project Name</th>
                            <th>assigned_id</th>
                            <th>Assignee Name</th>
                            <th>Assignee Email</th>
                            <th>Status</th>
                            <th>Create At</th>                            
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/dataTables.js') }}"></script>
        <script src="{{ asset('js/dataTables.tailwindcss.js') }}"></script>
        <script>
            $(function() {
                var table = $('#tasks-data-table').DataTable({
                    processing: true,
                    serverSide: false,
                    order: [
                        [0, 'desc']
                    ],
                    ajax: {                        
                        url: '{{ url('/api/projects/'.$project->id.'/tasks') }}',
                        type: "GET",
                        headers: {
                            'Accept': 'application/json'
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'title',
                            name: 'title'
                        },
                        {
                            data: 'project_id',
                            name: 'project_id',
                            visible: false


                        },
                        {
                            data: 'project_name',
                            name: 'project_name',
                            title: 'Project Name',
                            visible: false
                        },
                        {
                            data: 'assigned_id',
                            name: 'assigned_id',
                            visible: false

                        },
                        {
                            data: 'assignee_name',
                            name: 'assignee.name',
                            title: 'Assignee',
                            visible: true
                        },
                        {
                            data: 'assignee_email',
                            name: 'assignee.email',
                            title: 'Assignee Email'

                        },
                        {
                            data: 'status',
                            name: 'status',
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        }                        
                    ]
                });
            });
        </script>
    @endpush

</x-app-layout>
