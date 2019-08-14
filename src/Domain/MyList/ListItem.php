<?php

namespace App\Domain\MyList;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ListItem extends Entity
{

    /**
     * @ORM\Column(type="string", name="movie_id")
     * @var string
     */
    private $movie;

    /**
     * @ORM\ManyToOne(targetEntity="MyList", inversedBy="items")
     */
    private $myList;

    /**
     * @param mixed $myList
     */
    public function myList($myList): void
    {
        $this->myList = $myList;
    }

    /** @ORM\Column(type="datetime", name="created_at") */
    private $createdAt;

    /** @ORM\Column(type="datetime", name="removed_at", nullable=True) */
    private $removedAt;


    public function __construct(Movie $movie)
    {
        parent::__construct();

        $this->movie = $movie->id();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getMovie(): string
    {
        return $this->movie;
    }

    /**
     * @return mixed
     */
    public function getMyList()
    {
        return $this->myList;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getRemovedAt()
    {
        return $this->removedAt;
    }

    public function remove(): void
    {
        $this->removedAt = new \DateTime();
    }

    public function wasRemoved(): bool
    {
        if ($this->removedAt) {
            return true;
        }
        return false;
    }

}