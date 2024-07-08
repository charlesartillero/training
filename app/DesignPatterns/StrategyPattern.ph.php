<?php

interface Logger {
    public function log($message);
}

class FileLogger implements Logger {
    public function log($message) {
        echo "$message log to a file. \n";
    }
}

class DatabaseLogger implements Logger {
    public function log($message) {
        echo "$message log to a database. \n";
    }
}

class XWebServerLogger implements Logger {
    public function log($message) {
        echo "$message log to a web service. \n";
    }
}

class App {

    public function logger(Logger $logger, $data) {
        $logger->log($data);
    }

}

(new App())->logger(new FileLogger(), "hello");
