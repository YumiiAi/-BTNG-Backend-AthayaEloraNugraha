<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'title' => 'Tugas Akhir BTNG',
                'description' => 'tugas akhir untuk graduation',
                'is_completed' => true,
            ],
            [
                'title' => 'Menguji API',
                'description' => 'API diuji apakah eror atau tidak',
                'is_completed' => true,
            ],
            [
                'title' => 'Membuat REST API',
                'description' => 'membuat endpoint CRUD',
                'is_completed' => false,
            ],
            [
                'title' => 'Menguji API di Postman',
                'description' => 'Menguji HTTP method',
                'is_completed' => false,
            ],
            [
                'title' => 'Membuat dokumentasi API',
                'description' => 'Mendokumentasikan endpoint API',
                'is_completed' => false,
            ],
        ];

        foreach ($tasks as $task) {
            Task::updateOrCreate(
                ['title' => $task['title']],
                [
                    'description' => $task['description'],
                    'is_completed' => $task['is_completed'],
                ]
            );
        }
    }
}
