<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task as Requests;
use App\Jobs\Task as Jobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $deadline = $request->deadline;

        $task = Jobs\Index::dispatchSync($status, $deadline);

        return response()->json(['task' => $task], Response::HTTP_OK);
    } // Загружаем все записи, используя фильтрацию

    public function store(Requests\Create $request)
    {
        Jobs\Create::dispatchSync(
            title: $request->title,
            description: $request->description,
            status: $request->status,
            deadline: $request->deadline
        );

        return response()->json('Задача создана', Response::HTTP_CREATED);
    } // Создание записи в БД

    public function update(Requests\Update $request, $task)
    {
        Jobs\Update::dispatchSync(
            task_id: $task,
            title: $request->title,
            description: $request->description,
            status: $request->status,
            deadline: $request->deadline
        );

        return response()->json('Задача обновлена', Response::HTTP_OK);
    } // Обновление записи в БД

    public function destroy($task)
    {
        Jobs\Delete::dispatchSync($task);

        return response()->json('Задача удалена', Response::HTTP_OK);
    } // Удаление записи из БД
}
