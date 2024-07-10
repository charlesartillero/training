<?php

namespace Tests;

use App\Test\Quiz\Quiz;

class QuizCase extends TestCase
{
    protected $quiz;

    protected function setUp(): void
    {
        $this->quiz = new Quiz();
    }
}
