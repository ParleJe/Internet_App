<?php


class CommentController extends AppController
{
    private $repo;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->repo = new CommentRepository();
    }


    public function fetchComments(int $data):void {
            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->repo->getCommentsByPlannedTripID($data));
    }

    public function putComment(int $tripID, string $content):void
    {
        if($this->repo->addComment($tripID, $content, $this->getCurrentLoggedID())){
            header('Content-type: application/json');
            http_response_code(200);
        }
        http_response_code(400);
    }

    public function deleteComment(int $commentID): void
    {

    }

}