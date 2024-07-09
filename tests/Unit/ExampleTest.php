<?php

use App\DesignPatterns\ChainPattern\Doors;
use App\DesignPatterns\ChainPattern\HomeStatus;
use App\DesignPatterns\ChainPattern\Lights;
use App\DesignPatterns\ChainPattern\Locks;
use App\DesignPatterns\SpecificationPattern\Item;
use App\DesignPatterns\SpecificationPattern\Specifications\AndSpecification;
use App\DesignPatterns\SpecificationPattern\Specifications\CategorySpecification;
use App\DesignPatterns\SpecificationPattern\Specifications\OrSpecification;
use App\DesignPatterns\SpecificationPattern\Specifications\PriceSpecification;


test('asd', function () {

    $spec1 = new PriceSpecification(10, 20);
    $spec2 = new CategorySpecification("Candy");

    $orSpec = new AndSpecification($spec1, $spec2);

    $this->assertTrue($orSpec->isSatisfiedBy(new Item(10, "Candy")));
    $this->assertFalse($orSpec->isSatisfiedBy(new Item(2, "Candy1")));

});


test('chain_pattern_test', function (){

    $home = new HomeStatus(true, true, true);

    $locks = new Locks();
    $doors = new Doors();
    $lights = new Lights();

    // chain the objects
    $locks->setSuccessor($doors);
    $doors->setSuccessor($lights);

    // chain: locks -> doors -> lights

    // start the check from locks to lights in the chain objects
    $locks->check($home);

    // assert the doors is next to locks in the chain
    $this->assertEquals($doors, $locks->getSuccessor());

    // assert the lights is the last in the chain and has successor of null
    $this->assertEquals(null, $lights->getSuccessor());

    // assert that last check in the chain (lights) return true
    // meaning all checks passed.
    $this->assertTrue($lights->check($home));

});
