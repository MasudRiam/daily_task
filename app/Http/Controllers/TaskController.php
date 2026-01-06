<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
        ->orderBy('task_date', 'asc')
        ->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'task_date' => 'required|date',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'task_date' => $request->task_date,
        ]);

        return back()->with('success', 'Task added!');
    }

    public function update(Task $task)
    {

        $task->update([
            'is_completed' => $task->is_completed,
        ]);

        return back()->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task deleted!');
    }
    
}
