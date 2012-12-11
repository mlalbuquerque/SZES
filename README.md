# SZES - A Simple ZCE Exam Simulation

SZES is a simple ZCE Exam Simulation. It is based only in PHP and text files.
The questions file (`controllers/questions.php`) has the [questions details](#Questions).
The `data` folder has the [example codes](#Codes) for the questions.
This app was developed for and used at the **2012 PHP Conference**.

### Installation

Download the package and run the following commands in the folder you unzipped it:

    curl http://getcomposer.org/installer | php
    php composer.phar install

It will download the packages that is missing.
Then configure your Server to point to the folder and use it!

### Contributions

You can increase the number of questions in the `controllers/questions.php` file.
Or put new questions files at the `simulations` folder.
Then just change a file in the `simulations` folder for the file `controller/questions.php`.
Remember to put your name as the new simulation developer.

### Simple Doc

![Documentation Image](https://raw.github.com/mlalbuquerque/SZES/master/web/images/doc.png)

1. Question number
2. Question example codes
3. Question description
4. Possible answers (see [questions details](#Questions))
5. "Answer" button - click if you're sure
6. "Review" button - click to review it later (it will save your answer)
7. "Next" and "Previous" questions buttons
8. "Close Exam" button - to close your exam and see the result
9. Exam Summary - what you answer so far. Show all the questions and mark them as blank (B), review (answer and (R)) and answered (shows the answer)
10. Your alias used in the exam simulation

Final results will be at the `results` folder.

### <a name="Questions">Questions Details</a>

You detail the questions inside an array. Each value in the array is a question.
The app will display the questions in the order. Each question is another array with the following indexes:

* **text**: the description of the question
* **options** (optional): the possible answers for the question. If the question is a direct question (those questions where you write the answer), you shouldn't use this index
* **answer**: the right answer (if direct question, an string; if choice, the index in options; if multiple choice, an array with indexes in options)
* **code** (optional): if the question has an example code (true)

The example below (inside `controllers/questions.php` file) displays a **choice question**:

    return array(
        array(
            'text'    => 'Which of the following print statements will output the string “correct”?',
            'answer'  => 1,
            'options' => array(
                'print $a[\'purple\'][4][3];',
                'print $a[\'purple\'][\'hello\'][9];',
                'print $a[2][4][3];',
                'print $a[2][4][9];',
                'print $a[4][\'hello\'][9];'
            ),
            'code'    => true
        )
    );

and returns the following construction:

![Question example](https://raw.github.com/mlalbuquerque/SZES/master/web/images/question-choice.png)

The example below (inside `controllers/questions.php` file) displays a **multiple choice question**:

    return array(
        array(
            'text'    => 'Which two internal PHP interfaces provide functionality which allow you to treat an object like an array? (Choose 2)',
            'answer'  =>  array(1, 2),
            'options' => array(
                'Array', 'ArrayAccess', 'Iterator', 'Iteration', 'ObjectArray'
            )
        )
    );

and returns the following construction:

![Question example](https://raw.github.com/mlalbuquerque/SZES/master/web/images/question-multiple-choice.png)

The example below (inside `controllers/questions.php` file) displays a **direct question**:

    return array(
        array(
            'text'    => 'What the following code will print out?',
            'answer'  => 'b',
            'code'    => true
        )
    );

and returns the following construction:

![Question example](https://raw.github.com/mlalbuquerque/SZES/master/web/images/question-direct.png)

### <a name="Codes">Example Codes</a>

When a question has example codes (`'code' => true`), you have to do only one thing: create a text file (`.txt`) following this rule:
If the index question is 7, then the file name is `question7.txt` and should go in `data` folder. You can put anything you want in the file and it will appear in the question.