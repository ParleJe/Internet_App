<?php


class Comment implements JsonSerializable
{
    private int $comment_id;
    private string $content;
    private string $add_date;
    private int $mortal_id;

    public function __construct(array $data = null)
    {
        if($data !=null){
            $this->comment_id = $data['comment_id'];
            $this->content = $data['content'];
            $this->add_date = $data['add_date'];
            $this->mortal_id = $data['mortal_id'];
        }
    }

    public function jsonSerialize()
    {
        return [
          'comment_id' => $this->getCommentId(),
          'content' => $this->getContent(),
          'add_date' => $this->getAddDate(),
          'mortal_id' => $this->getMortalId(),
        ];
    }

    /**
     * @return int
     */
    public function getCommentId(): int
    {
        return $this->comment_id;
    }

    /**
     * @param int $comment_id
     * @return Comment
     */
    public function setCommentId(int $comment_id): Comment
    {
        $this->comment_id = $comment_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Comment
     */
    public function setContent(string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddDate(): string
    {
        return $this->add_date;
    }

    /**
     * @param string $add_date
     * @return Comment
     */
    public function setAddDate(string $add_date): Comment
    {
        $this->add_date = $add_date;
        return $this;
    }

    /**
     * @return int
     */
    public function getMortalId(): int
    {
        return $this->mortal_id;
    }

    /**
     * @param int $mortal_id
     * @return Comment
     */
    public function setMortalId(int $mortal_id): Comment
    {
        $this->mortal_id = $mortal_id;
        return $this;
    }



}