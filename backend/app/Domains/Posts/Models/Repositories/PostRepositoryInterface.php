<?php

interface PostRepositoryInterface {
    public function all();
    public function store(array $data);
    public function delete(int $id);
}
