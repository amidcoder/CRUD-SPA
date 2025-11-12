<?php

use App\Domains\Posts\Models\Post;
use App\Domains\Posts\Repositories\PostRepositoryInterface;

class EloquentPostRepository implements PostRepositoryInterface {
  public function all(){ return Post::all(); }
  public function store(array $data){ return Post::create($data); }
  public function delete(int $id){ Post::destroy($id); }
}
