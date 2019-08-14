<?php
declare(strict_types=1);

namespace App\Domain\MyList;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Domain\Core\RootAggregatorInterface;

/**
 * @ORM\Entity()
 */
class MyList extends Entity implements RootAggregatorInterface
{

    /**
     * @ORM\Column(type="string", name="user_id")
     * @var string
     */
    private $user;

    /**
     * @ORM\OneToMany(
     *   targetEntity="ListItem",
     *   mappedBy="myList",
     *   cascade={"PERSIST"}
     * )
     * @var ArrayCollection|items[]
     */
    private $items;

    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
        $this->items = new ArrayCollection();
    }

    public function addToList(ListItem $item): void
    {
        $item->myList($this);
        $this->items[] = $item;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    public function removeFromList(ListItem $item): void
    {
        if ($this->items->contains($item)) {
            $item->remove();
        }
    }

    public function getItems(): array
    {
        $notRemovedItems = new ArrayCollection();
        foreach ($this->items->toArray() as $item) {
            if (!$item->wasRemoved()) {
                $notRemovedItems[] = $item;
            }
        }
        return $notRemovedItems->toArray();
    }




}