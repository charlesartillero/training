<?php

namespace App\DesignPatterns\SpecificationPattern\Specifications;

use App\DesignPatterns\SpecificationPattern\ItemInterface;

class AndSpecification implements Specification
{
    private array $specifications;
    function __construct(Specification ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(ItemInterface $item): bool {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($item)) {
                return false;
            }
        }

        return true;
    }

}
