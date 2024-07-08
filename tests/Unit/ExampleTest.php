<?php

use App\DesignPatterns\SpecificationPattern\Item;
use App\DesignPatterns\SpecificationPattern\Specifications\AndSpecification;
use App\DesignPatterns\SpecificationPattern\Specifications\CategorySpecification;
use App\DesignPatterns\SpecificationPattern\Specifications\OrSpecification;
use App\DesignPatterns\SpecificationPattern\Specifications\PriceSpecification;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertTrue;

test('asd', function () {

    $spec1 = new PriceSpecification(10, 20);
    $spec2 = new CategorySpecification("Candy");

    $orSpec = new AndSpecification($spec1, $spec2);

    assertTrue($orSpec->isSatisfiedBy(new Item(10, "Candy")));

});
