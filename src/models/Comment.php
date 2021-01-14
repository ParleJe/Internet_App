<?php


use JetBrains\PhpStorm\ArrayShape;

class Comment implements JsonSerializable
{
    private ?int $comment_id;
    private ?string $content;
    private ?string $add_date;
    private ?int $mortal_id;
    private ?int $planned_trip_id;

    #[ArrayShape(['comment_id' => "int|null", 'content' => "null|string", 'add_date' => "null|string", 'mortal_id' => "int|null", 'planned_trip_id' => "int|null"])]
    public function __construct(array $data = null)
    {
            $this->comment_id = $data['comment_id'];
            $this->content = $data['content'];
            $this->add_date = $data['add_date'];
            $this->mortal_id = $data['mortal_id'];
    }


    #[ArrayShape(['comment_id' => "int|null", 'content' => "null|string", 'add_date' => "null|string", 'mortal_id' => "int|null", 'planned_trip_id' => "int|null"])]
    public function jsonSerialize(): array
    {
        return [
          'comment_id' => $this->getCommentId(),
          'content' => $this->getContent(),
          'add_date' => $this->getAddDate(),
          'mortal_id' => $this->getMortalId(),
          'planned_trip_id' => $this->getPlannedTripId()
        ];
    }


    public function getPlannedTripId(): ?int
    {
        return $this->planned_trip_id;
    }

    public function setPlannedTripId(?int $planned_trip_id): void
    {
        $this->planned_trip_id = $planned_trip_id;
    }

    public function getCommentId(): ?int
    {
        return $this->comment_id;
    }

    public function setCommentId(int $comment_id): void
    {
        $this->comment_id = $comment_id;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getAddDate(): ?string
    {
        return $this->add_date;
    }

    public function setAddDate(string $add_date)
    {
        $this->add_date = $add_date;
    }

    public function getMortalId(): ?int
    {
        return $this->mortal_id;
    }

    public function setMortalId(int $mortal_id)
    {
        $this->mortal_id = $mortal_id;
    }



}