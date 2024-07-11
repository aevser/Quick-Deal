<?php

namespace App\Jobs\Task;

use App\Models\Task;
use Illuminate\Foundation\Bus\Dispatchable;

class Create
{
    use Dispatchable;

    /**
     * Создаем задачи и сохраняем в БД
     */
    public function __construct(
        private string $title,
        private string $description,
        private string $status,
        private string $deadline
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Вводим данные и сохраняем в БД
        $task = Task::query()->create([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'deadline' => $this->deadline
        ]);

        return $task;
    }
}
