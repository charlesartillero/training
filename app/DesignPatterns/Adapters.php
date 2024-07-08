<?php


interface BookInterface {
    public function open();
    public function turningThePage();
}

interface eBookInterface {
    public function turnOn();
    public function turnPage();
}

class Book implements BookInterface{

    public function open(){
        echo "opening the book...";
    }

    public function turningThePage() {
        echo "turning the page...";
    }
}

class eBookAdapter implements BookInterface {

    protected $eBook;

    function __construct(eBookInterface $ebook)
    {
        $this->eBook = $ebook;
    }

    public function open(){
        $this->eBook->turnOn();
    }
    public function turningThePage(){
        $this->eBook->turnPage();
    }
}

class Kindle implements eBookInterface {

    public function turnOn(){
        echo "turning on...";
    }

    public function turnPage(){
        echo "pressing next button...";
    }

}

class Person {

    public function read($book)
    {
        $book->open();
        $book->turningThePage();
    }

}

(new Person)->read(new eBookAdapter(new Kindle()));
