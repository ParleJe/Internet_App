<?php


use JetBrains\PhpStorm\Pure;

class CommentController extends AppController
{
    private CommentRepository $repo;

    public function __construct()
    {
        parent::__construct();
        $this->repo = new CommentRepository();
    }

    public function putComment(?int $tripID, ?string $content): ?Comment
    {
        if(empty($content) || is_null($tripID)){
            return null; // wrong arguments
        }
        return $this->repo->addComment($tripID, $content, $this->getCurrentLoggedID());
    }

    public function deleteComment(int $commentID): void
    {

    }

}