<?php

namespace Architecture\Task\Application;

use Architecture\Task\Domain\TaskEntity;
use Architecture\Task\Infrastructure\TaskRepository;

readonly class TaskRegisterUseCase
{
    public function __construct(
        protected TaskRepository $taskRepository
    ) {
    }

    public function execute(array $data): TaskEntity
    {
        $taskEntity = new TaskEntity();
        $taskEntity->hydrate($data);

        $taskEntity->canBeSaved();

        return $this->taskRepository->save($taskEntity);
    }
}
