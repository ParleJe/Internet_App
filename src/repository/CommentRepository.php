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
}