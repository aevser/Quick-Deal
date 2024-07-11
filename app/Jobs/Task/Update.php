<?php

namespace App\Jobs\Task;

use App\Models\Task;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable;

    /**
     * Ищем задачу по ID, обновляем и сохраняем изменения в БД
     */

    public function __construct(
        private int $task_id,
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
        // Загружаем модель по ID
        $task = Task::query()->findOrFail($this->task_id);

        // Обновляем данные и сохраняем в БД
        $task->update([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'deadline' => $this->deadline
        ]);

        return $task;
    }
}
