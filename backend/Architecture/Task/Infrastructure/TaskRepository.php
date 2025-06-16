<?php

namespace Architecture\Task\Infrastructure;

use App\Models\Task;
use Architecture\Task\Domain\TaskEntity;
use Architecture\User\Infrastructure\Repository\RepositoryInterface;

/**
 * @implements RepositoryInterface<TaskEntity>
 */
class TaskRepository implements RepositoryInterface
{
    /**
     * @param  TaskEntity $task
     * @return TaskEntity
     */
    public function save($task): TaskEntity
    {
        $taskModel = Task::create([
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
            'due_date' => $task->due_date,
            'user_id' => $task->user_id,
        ]);
        $task->id = $taskModel->id;

        return $task;
    }
}
