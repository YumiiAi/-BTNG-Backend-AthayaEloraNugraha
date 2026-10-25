<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();

        return response()->json([
            'message' => 'Daftar tugas berhasil diambil',
            'data' => $tasks,
        ],200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'sometimes|boolean',
        ]);

        $task = Task::create($validated);

        return response()->json([
            'message' => 'Tugas berhasil ditambahkan',
            'data' => $task,
        ], 201);
    }

    public function show(string $id) {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Tugas tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'message' => 'Detail tugas berhasil diambil',
            'data' => $task,
        ], 200);
    }

    public function update(Request $request, string $id) {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Tugas tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'is_completed' => 'sometimes|boolean',
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Tugas berhasil diperbarui',
            'data' => $task->fresh(),
        ], 200);
    }

    public function destroy(string $id) {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Tugas tidak ditemukan',
            ], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Tugas berhasil dihapus',
        ], 200);
    }
}
