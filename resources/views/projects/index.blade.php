@section('title', 'Project')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Project') }}
        </h2>
        <span style="float:right;"><a href="{{ route("projects.create")}}" class="font-medium text-sky-600 hover:text-sky-700 hover:underline">Create Project</a></span>        
    </x-slot>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/dataTables.tailwindcss.css') }}">
        <link rel="stylesheet" href="{{ asset('css/dataTables.tailwindcss.css') }}">
    @endpush

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <table id="projects-data-table" class="stripe">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Deadline</th>
                            <th>Create At</th>
                            <th>Action</th>                            
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
                var table = $('#projects-data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    order: [[0, 'desc']],
                    ajax: {
                        url: "{{ route('projects.getdata') }}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    },
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'description',
                            name: 'description',
                            visible:false
                        },
                        {
                            data: 'deadline',
                            name: 'deadline'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endpush

</x-app-layout>
