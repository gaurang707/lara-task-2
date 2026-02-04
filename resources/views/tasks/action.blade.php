<div class="flex gap-4">
    @can('view', $row)
        <a href="{{ route('tasks.show', $row->id) }}"
            class="font-medium text-sky-600 hover:text-sky-700 hover:underline">View</a>
    @endcan

    @can('update', $row)
        <a href="{{ route('tasks.edit', $row->id) }}"
            class="font-medium text-amber-600 hover:text-amber-700 hover:underline">Edit</a>
    @endcan

    @can('delete', $row)
        <form action="{{ route('tasks.destroy', $row->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="font-medium text-red-600 hover:text-red-700 hover:underline">Delete</button>
        </form>
    @endcan
</div>
