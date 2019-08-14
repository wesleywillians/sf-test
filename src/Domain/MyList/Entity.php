<?php
declare(strict_types = 1);

namespace App\Domain\MyList;

use Doctrine\ORM\Mapping as ORM;


use Ramsey\Uuid\Uuid;

/**
 * @ORM\MappedSuperclass
 */
class Entity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     * @var string
     */
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function id() : string
    {
        return $this->id;
    }

    public function __toString() : string
    {
        return $this->id();
    }
}