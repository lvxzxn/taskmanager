<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,concluída,cancelada'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Task::create($validator->validated());

        return back()->with('success', 'Tarefa criada com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,concluída,cancelada'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $task = Task::findOrFail($id);
        $task->update($validator->validated());

        return back()->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return back()->with('error', 'Tarefa não encontrada.');
        }

        $task->delete();

        return redirect()->route('home')->with('success', 'Tarefa excluída com sucesso.');
    }

    public function apiIndex()
    {
        $tasks = Task::all();

        return response()->json([
            'success' => true,
            'data' => $tasks,
            'message' => 'Successfully retrieved tasks.'
        ], 200);
    }

    public function apiShow($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Successfully retrieved task details.'
        ], 200);
    }

    public function apiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,concluída,cancelada' // Adicionando validação para o status
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $task = Task::create($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task created successfully.'
        ], 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pendente,concluída,cancelada' // Adicionando validação para o status
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found.'
            ], 404);
        }

        $task->update($validator->validated());

        return response()->json([
            'success' => true,
            'data' => $task,
            'message' => 'Task updated successfully.'
        ], 200);
    }

    public function apiDestroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found.'
            ], 404);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ], 200);
    }
}
