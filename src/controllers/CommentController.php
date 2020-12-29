<?php


class CommentController extends AppController
{
    public function ajaxGetComments(): void {
        $repo = new TripRepository();
        $tripID = $_GET['tripID'];
        $loggedIn = $this->getCurrentLoggedID();
        $plannedTrip = $repo->fetchPlannedTripsByTripId((int)$tripID, $loggedIn);
        $repo = new CommentRepository();
        $plannedTripId = (int)$plannedTrip->planned_trip_id;
        $comments = $repo->getCommentsByPlannedTripID($plannedTripId);
        echo json_encode($comments);
    }
}