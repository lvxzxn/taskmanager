<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['apiIndex', 'apiShow']);
    }
    
    public function show($id)
    {
        $userId = Auth::id();
        $task = Task::where('user_id', $userId)->findOrFail($id);
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

        $taskData = $validator->validated();
        $taskData['user_id'] = Auth::id();

        Task::create($taskData);

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

        $userId = Auth::id();
        $task = Task::where('user_id', $userId)->findOrFail($id);
        $task->update($validator->validated());

        return back()->with('success', 'Tarefa atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $userId = Auth::id();
        $task = Task::where('user_id', $userId)->find($id);
    
        if (!$task) {
            return back()->with('error', 'Tarefa não encontrada.');
        }
    
        $task->delete();
    
        return redirect()->route('home')->with('success', 'Tarefa excluída com sucesso.');
    }
    
    public function apiIndex(Request $request)
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

        $taskData = $validator->validated();
        $taskData['user_id'] = $request->input('user_id');

        $task = Task::create($taskData);

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

        $userId = Auth::id();
        $task = Task::where('user_id', $userId)->find($id);

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