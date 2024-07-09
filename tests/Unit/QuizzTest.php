<?php

use App\Test\Quiz\Question;
use App\Test\Quiz\Quiz;

test('it consists of questions', function (){

    $quiz = new Quiz;

    $quiz->addQuestion(
      new Question('What is 2 + 2 ?', 4)
    );

    $this->assertCount(1, $quiz->questions());

});


test('it grades a perfect quiz', function (){

    $quiz = new Quiz;

    $quiz->addQuestion(new Question('What is 2 + 2', 4));
    $quiz->addQuestion(new Question('What is 3 + 3', 6));

    // take the quiz
    $question1 = $quiz->nextQuestion();
    $question1->answer(4);

    $question2 = $quiz->nextQuestion();
    $question2->answer(6);

    // grade the quiz
    $this->assertEquals(100, $quiz->grade());
});

test('it grades a failed quiz', function (){

    $quiz = new Quiz;

    $quiz->addQuestion(
        new Question('What is 2 + 2 ?', 4)
    );

    // take the quiz
    $question = $quiz->firstQuestion();
    $question->answer('asdas');


    // grade the quiz
    $this->assertEquals(0, $quiz->grade());
});

test('it cannot be graded until all questions have been answered', function (){
    $quiz = new Quiz;

    $quiz->addQuestion(
        new Question('What is 2 + 2 ?', 4)
    );

    // take the quiz
    $question = $quiz->firstQuestion();

    $this->expectException(\Exception::class);

    // grade the quiz
    $quiz->grade();


});

test('it correctly tracks the next question in the queue', function (){

    $quiz = new Quiz;

    $quiz->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
    $quiz->addQuestion($question2 = new Question('What is 1 + 1 ?', 2));



    $this->assertEquals($question1, $quiz->nextQuestion());
    $this->assertEquals($question2, $quiz->nextQuestion());

});

test('it return false if there are no remaining next question', function (){

    $quiz = new Quiz;

    $quiz->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
    $quiz->addQuestion($question2 = new Question('What is 1 + 1 ?', 2));




    $this->assertEquals($question1, $quiz->nextQuestion());
    $this->assertEquals($question2, $quiz->nextQuestion());

    $this->assertFalse($quiz->nextQuestion());
});

test('it know if the all questions has been answered', function (){

    $quiz = new Quiz;

    $quiz->addQuestion(new Question('What is 2 + 2 ?', 4));

    $this->assertFalse($quiz->isComplete());

    $quiz->nextQuestion()->answer(4);

    $this->assertTrue($quiz->isComplete());

});

