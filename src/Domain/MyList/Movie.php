<?php
declare(strict_types = 1);

namespace App\Domain\MyList;

use App\Domain\Core\DomainException;
use Respect\Validation\Validator as v;


class Movie extends Entity
{
    private $name;

    public function __construct($name)
    {
        parent::__construct();
        $this->name = $name;
        $this->validate();
    }


    public function getName() : string
    {
        return $this->name;
    }

    public function validate() {

        if(!v::NotBlank()->NotEmpty()->validate($this->name)) {
            throw new DomainException("Movie name cannot be blank");
        }
    }
}