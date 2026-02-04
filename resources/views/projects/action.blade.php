<div class="flex gap-4">
    <a href="{{ route('projects.show', $row->id) }}"
        class="font-medium text-sky-600 hover:text-sky-700 hover:underline">View</a>
    <a href="{{ route('projects.edit', $row->id) }}"
        class="font-medium text-amber-600 hover:text-amber-700 hover:underline">Edit</a>
    <a href="{{ route('projects.destroy', $row->id) }}"
        class="font-medium text-red-600 hover:text-red-700 hover:underline">Delete</a>
    <a href="{{ route('projects.tasks.index', $row->id) }}"
        class="font-medium text-lightgreen-600 hover:text-lightgreen-700 hover:underline">All Task</a>
</div>
