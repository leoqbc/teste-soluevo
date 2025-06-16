<?php

namespace Architecture\Task\Controller;

use App\Models\Task;
use Architecture\Task\Application\TaskRegisterUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController
{
    public function __construct(
        protected TaskRegisterUseCase $taskRegisterUseCase,
    ) {
    }

    public function register(Request $request): JsonResponse
    {
        $validTask = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required|in:pendente,concluida',
            'due_date' => 'required|date_format:Y-m-d H:i:s',
            'user_id' => 'required|exists:users,id'
        ]);

        $user = $this->taskRegisterUseCase->execute($validTask);

        return response()->json([
            'data' => $user
        ], 201);
    }

    public function getAll(Request $request, int $id): JsonResponse
    {
        $tasks = Task::where('user_id', $id)->paginate(10);
        return response()->json($tasks, 200);
    }
}
