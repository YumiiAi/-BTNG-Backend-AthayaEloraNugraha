<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();

        return response()->json([
            'message' => 'Daftar Element berhasil diambil',
            'data' => TaskResource::collection($tasks),
        ],200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'element' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'description' => 'required|string',
            'rarity' => 'required|string|max:255',
        ]);

        $task = Task::create($validated);

        return response()->json([
            'message' => 'Element berhasil ditambahkan',
            'data' => new TaskResource($task),
        ], 201);
    }

    public function show($id) {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Element tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'message' => 'Detail Element berhasil diambil',
            'data' => new TaskResource($task),
        ], 200);
    }

    public function update(Request $request, $id) {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Element tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'element' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'description' => 'required|string',
            'rarity' => 'required|string|max:255',
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Element berhasil diperbarui',
            'data' => new TaskResource($task),
        ], 200);
    }

    public function destroy($id) {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Element tidak ditemukan',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Element berhasil dihapus',
        ], 200);
    }
}
