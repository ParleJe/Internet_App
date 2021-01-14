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
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Comment');
}

    public function addComment(int $userID, string $content, int $tripID): bool
    {
        $conn = $this->database->getInstance();
        $stmt = $conn->prepare('
        INSERT INTO comment (content, add_date, mortal_id, planned_trip_id) 
        VALUES (?,now(),?,?);
        ');

        return $stmt->execute([$content, $userID, $tripID]);
    }

    public function deleteComment(int $commentID): bool {
        $stmt = $this->database->getInstance()->prepare('
        DELETE FROM comment WHERE comment_id = ?;
        ');

        return $stmt->execute([$commentID]);
    }
}