<?php
declare(strict_types=1);

namespace App\Domain\MyList;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User extends Entity
{

    public function __construct($id = null)
    {
        parent::__construct($id);
    }
}