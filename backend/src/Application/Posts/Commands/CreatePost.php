<?php

class CreatePost {
  public function __construct(private PostRepositoryInterface $repo){}
  public function execute(array $data){ return $this->repo->store($data); }
}
