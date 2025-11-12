<?php

namespace Src\Interfaces\Http\Controllers;

class PostController extends Controller {
  public function __construct(private CreatePost $createPost,
                              private PostRepositoryInterface $repo){}

  public function index(){ return $this->repo->all(); }
  public function store(Request $r){ return $this->createPost->execute($r->only(['title','content'])); }
  public function destroy($id){ $this->repo->delete($id); }
}
