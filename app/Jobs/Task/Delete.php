<?php

namespace App\Jobs\Task;

use App\Models\Task;
use Illuminate\Foundation\Bus\Dispatchable;

class Delete
{
    use Dispatchable;

    /**
     * Ищем задачу по ID и удаляем из БД
     */

    public function __construct(
        private int $task_id
    )

    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Загружаем по ID и удаляем задачу по
        $task = Task::destroy($this->task_id);

        return $task;
    }
}
