<?php
class Task {
    private $id;
    private $title;
    private $status;

    public function __construct($id, $title, $status = "pending") {
        $this->id = $id;
        $this->title = $title;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getStatus() {
        return $this->status;
    }

    public function markDone() {
        $this->status = "completed";
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status
        ];
    }
}
?>
