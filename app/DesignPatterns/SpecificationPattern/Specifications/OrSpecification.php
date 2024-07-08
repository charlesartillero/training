<?php

namespace App\DesignPatterns\SpecificationPattern\Specifications;

use App\DesignPatterns\SpecificationPattern\ItemInterface;

class OrSpecification implements Specification
{

    private array $specifications;

    function __construct(Specification ...$specification)
    {
        $this->specifications = $specification;
    }

    public function isSatisfiedBy(ItemInterface $item): bool {

        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($item)) {
                return true;
            }
        }

        return false;

    }
}
