<?php

namespace App\Jobs\Task;

use App\Models\Task;
use Illuminate\Foundation\Bus\Dispatchable;

class Index
{
    use Dispatchable;

    /**
     * Получаем все задачи и фильтруем по статусу и крайнему сроку выполнения
     */

    private string $status;
    private string $deadline;

    public function __construct($status = null, $deadline = null)
    {
        $this->status = $status;
        $this->deadline = $deadline;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $query = Task::query();

        // Фильтруем по статусу
        if ($this->status) {
            $query->where('status', $this->status);
        }

        // Фильтруем по крайнему сроку выполнения
        if ($this->deadline) {
            $query->where('deadline', $this->deadline);
        }

        // Получаем записи
        $task = $query->get();

        return $task;
    }
}
