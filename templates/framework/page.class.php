<?php
class Page {
    private $title;

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($set_title) {
        $this->title = $set_title;
    }

    public function hasTitle() {
        return isset($this->title);
    }
}