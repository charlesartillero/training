<?php

interface Observer {
    public function handle();
}

interface Subject {
    public function attach(array $observers);
    public function detach(Observer $observer);
    public function notify();
}


class FileLogger implements Observer {
    public function handle()
    {
        var_dump("File log");
    }
}

class EmailService implements Observer {
    public function handle()
    {
        var_dump("Email Notification");
    }
}


class Register implements Subject {

    protected $observers = [];

    public function attach(array $observers) {

        foreach ($observers as $observer) {
            $this->observers[] = $observer;
        }

    }
    public function detach(Observer $observer) {

    }
    public function notify() {

        foreach ($this->observers as $observer) {
            $observer->handle();
        }

    }

    public function fire() {
        // Register a user
        $this->notify();
    }
}

$register = new Register();

$register->attach([
    new FileLogger(),
    new EmailService()
]);



$register->fire();

