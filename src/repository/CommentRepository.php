<?php

class CommentRepository extends Repository
{
    public function getCommentsByPlannedTripID(int $tripID): ?array {
        $conn = $this->database->getInstance();

        $stmt = $conn->prepare('
        SELECT c.comment_id, c.content, c.add_date, c.mortal_id FROM comment c WHERE planned_trip_id = ?;
        ');

        if ( ! $stmt->execute([ $tripID ]) ) {
            return null;
        }
        return $stmt->fetchAll(parent::FETCH_FLAGS, 'Comment');
}

    //TODO
    public function getAllComments():?array{
        $stmt = $this->database->getInstance()->prepare('
        SELECT * FROM comment;
        ');

        if( $stmt->execute()){
            return $stmt->fetchAll(self::FETCH_FLAGS, 'Comment');
        }
        return [];
    }

    public function addComment(int $userID, string $content, int $tripID): ?Comment
    {
        $conn = $this->database->getInstance();
        $stmt = $conn->prepare('
        INSERT INTO comment (content, add_date, mortal_id, planned_trip_id) 
        VALUES (?,now(),?,?);
        ');

        $stmt->execute([$content, $userID, $tripID]);
        if(is_null($conn->lastInsertId())){
        return null;
        }
        return new Comment(['comment_id' => $conn->lastInsertId(), 'content' => $content, 'mortal_id' => $userID]);
    }

    public function deleteComment(int $commentID): bool {
        $stmt = $this->database->getInstance()->prepare('
        DELETE FROM comment WHERE comment_id = ?;
        ');

        return $stmt->execute([$commentID]);
    }
}