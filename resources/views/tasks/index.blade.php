<x-app-layout>
    <div class="max-w-4xl mx-auto mt-6">

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <input type="text" name="title" placeholder="Task title" class="border p-2 w-full">
            <input type="date" name="task_date" class="border p-2 mt-2">
            <button class="bg-blue-500 text-white px-4 py-2 mt-2">Add Task</button>
        </form>

        <hr class="my-4">

        @foreach($tasks as $task)
            <div class="flex justify-between items-center">
                <span class="{{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                    {{ $task->title }} ({{ $task->task_date }})
                </span>

                <div class="flex gap-2">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf @method('PATCH')
                        <button>✔</button>
                    </form>

                    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                        @csrf @method('DELETE')
                        <button>❌</button>
                    </form>
                </div>
            </div>
        @endforeach

        {{ $tasks->links() }}
    </div>
</x-app-layout>
