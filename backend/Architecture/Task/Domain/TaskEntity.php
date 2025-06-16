<?php

namespace Architecture\Task\Domain;

class TaskEntity
{
    public int $id;

    protected(set) public string $title;

    protected(set) public string $description;

    protected(set) public string $status;

    protected(set) public string $due_date;

    protected(set) public int $user_id;

    public function hydrate(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->status = $data['status'];
        $this->due_date = $data['due_date'];
        $this->user_id = $data['user_id'];
    }

    public function canBeSaved(): void
    {
        if ($this->due_date <= date('Y-m-d H:i:s')) {
            throw new \Exception('Due date must be greater than today');
        }
    }
}
