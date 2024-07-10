<?php

namespace App\Test\Quiz;

class QuestionCollections implements \Countable
{

    protected array $questions;
    protected int $questionNumber = 0;

    function __construct(array $questions = [])
    {
        $this->questions = $questions;
    }

    public function answered() : array {
        return array_filter($this->questions, fn($q) => $q->answered());
    }

    public function correctAnswer(): array
    {
        return array_filter($this->questions, fn($q) => $q->correct());
    }

    public function next() : Question|bool {

        $question = current($this->questions);
        next($this->questions);

        return $question;
    }

    public function add(Question $question): void
    {
        $this->questions[] = $question;
    }

    public function all() : array {
        return $this->questions;
    }


    public function count(): int
    {
        return count($this->questions);
    }
}
