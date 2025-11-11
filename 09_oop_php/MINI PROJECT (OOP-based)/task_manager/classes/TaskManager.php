<?php
require_once "Task.php";

class TaskManager {
    private $file;

    public function __construct($filename = "tasks.txt") {
        $this->file = $filename;
        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    public function getAllTasks() {
        $data = json_decode(file_get_contents($this->file), true);
        $tasks = [];
        foreach ($data as $item) {
            $tasks[] = new Task($item['id'], $item['title'], $item['status']);
        }
        return $tasks;
    }

    public function addTask($title) {
        $tasks = $this->getAllTasks();
        $id = uniqid();
        $newTask = new Task($id, $title);
        $tasks[] = $newTask;
        $this->saveTasks($tasks);
    }

    public function deleteTask($id) {
        $tasks = $this->getAllTasks();
        $tasks = array_filter($tasks, fn($t) => $t->getId() !== $id);
        $this->saveTasks($tasks);
    }

    public function markTaskDone($id) {
        $tasks = $this->getAllTasks();
        foreach ($tasks as $t) {
            if ($t->getId() === $id) {
                $t->markDone();
            }
        }
        $this->saveTasks($tasks);
    }

    private function saveTasks($tasks) {
        $data = array_map(fn($t) => $t->toArray(), $tasks);
        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}
?>
