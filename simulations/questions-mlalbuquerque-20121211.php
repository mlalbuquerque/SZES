<?php
// Original simulation with two more questions!
// By Marcio Albuquerque - 2012

return array(
    array( // 0
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
    ),
    array( // 1
        'text'    => 'Which of the following functions will sort an array in ascending order by value, while preserving key associations?',
        'answer'  =>  1,
        'options' => array(
            'ksort', 'asort', 'usort', 'sort', 'krsort'
        )
    ),
    array( // 2
        'text'    => 'To destroy one variable within a PHP session you should use which method in PHP 5?',
        'answer'  =>  2,
        'options' => array(
            'Use the session_unset() function',
            'Use the session_destroy() function',
            'Unset the variable in $_SESSION using unset()',
            'Unset the variable in $HTTP_SESSION_VARS',
            'Any of the above are acceptable in PHP 5'
        )
    ),
    array( // 3
        'text'    => 'Which two internal PHP interfaces provide functionality which allow you to treat an object like an array? (Choose 2)',
        'answer'  =>  array(1, 2),
        'options' => array(
            'Array', 'ArrayAccess', 'Iterator', 'Iteration', 'ObjectArray'
        )
    ),
    array( // 4
        'text'    => 'What is the output of the following code?',
        'answer'  => 0,
        'options' => array(
            'ConferencePHP',
            'PHP Conference',
            'Conference',
            'PHPConference',
            'Conference PHP'
        ),
        'code'    => true
    ),
    array( // 5
        'text'    => 'When an object is serialized, which method will be called, automatically, providing your object with an opportunity to close any resources or otherwise prepare to be serialized?',
        'answer'  => 3,
        'options' => array(
            '__destroy',
            '__shutdown',
            '__serialize',
            '__sleep',
            '__destruct' 
        )
    ),
    array( // 6
        'text'    => 'What the following code will print out?',
        'answer'  => 'b',
        'code'    => true
    ),
    array( // 7
        'text'    => 'Which of the following is not valid PHP code?',
        'answer'  => 3,
        'options' => array(
            '$_10',
            '${"MyVar"}',
            '&$something',
            '$10_somethings',
            '$a123bc'
        )
    ),
    array( // 8
        'text'    => 'What is displayed when the following script is executed?',
        'answer'  => 0,
        'code'    => true,
        'options' => array(
            'The value is: Dog',
            'The value is: Cat',
            'The value is: Human',
            'The value is: 10',
            'A parse error occurs'
        )
    ),
    array( // 9
        'text'    => 'Which values should be assigned to the variables $a, $b and $c in order for the following script to display the string "Hello, World!"?',
        'answer'  => 3,
        'code'    => true,
        'options' => array(
            'false, true, false',
            'true, true, false',
            'false, true, true',
            'false, false, true',
            'true, true, true'
        )
    ),
    array( // 10
        'text'    => 'What is the best way to iterate through the $myarray array, assuming you want to modify the value of each element as you do?',
        'answer'  => 0,
        'code'    => true,
        'options' => array(
            'Using a "for" loop',
            'Using a "foreach" loop',
            'Using a "while" loop',
            'Using a "do ... while" loop',
            'There is no way to accomplish this goal'
        )
    ),
    array( // 11
        'text'    => 'Considering the following segment of code, what should go in the marked segment to produce the following array output?',
        'answer'  => 2,
        'code'    => true,
        'options' => array(
            'foreach($result as $key => $val)',
            'while($idx *= 2)',
            'for($idx = 1; $idx < STOP_AT; $idx *= 2)',
            'for($idx *= 2; STOP_AT >= $idx; $idx = 0)',
            'while($idx < STOP_AT) do $idx *= 2'
        )
    ),
    array( // 12
        'text'    => 'Under what circumstance is it impossible to assign a default value to a parameter while declaring a function?',
        'answer'  => 2,
        'options' => array(
            'When the parameter is Boolean',
            'When the function is being declared as a member of a class',
            'When the parameter is being declared as passed by reference',
            'When the function contains only one parameter',
            'Never'
        )
    ),
    array( // 13
        'text'    => 'How does the identity operator === compare two values?',
        'answer'  => 1,
        'options' => array(
            'It converts them to a common compatible data type and then compares the resulting values',
            'It returns True only if they are both of the same type and value',
            'If the two values are strings, it performs a lexical comparison',
            'It bases its comparison on the C strcmp function exclusively',
            'It converts both values to strings and compares them'
        )
    ),
    array( // 14
        'text'    => 'In what order will the following script output the contents of the $array array?',
        'answer'  => 0,
        'options' => array(
            'a1, a3, a5, a10, a20',
            'a1, a20, a3, a5, a10',
            'a10, a1, a20, a3, a5',
            'a1, a10, a5, a20, a3',
            'a1, a10, a20, a3, a5'
        ),
        'code'    => true
    ),
    array( // 15
        'text'    => 'Consider the following script. What line of code should be inserted in the marked location in order to display the string "php" when this script is executed?',
        'answer'  => 3,
        'options' => array(
            'echo chr($val);',
            'echo asc($val);',
            'echo substr($alpha, $val, 2);',
            'echo $alpha{$val};',
            'echo $alpha{$val+1}'
        ),
        'code'    => true
    ),
    array( // 16
        'text'    => 'Which of the following PCRE regular expressions best matches the string php|conference?',
        'answer'  => 4,
        'options' => array(
            '.*',
            '...|..........',
            '\d{3}\|\d{10}',
            '[az]{3}\|[az]{10}',
            '[a-z][a-z][a-z]\|\w{10}'
        ) 
    ),
    array( // 17
        'text'    => 'What will be the output of the following script?',
        'answer'  => 1,
        'options' => array(
            '12345', '12245', '22345', '11345', 'Array'
        ),
        'code'    => true
    ),
    array( // 18
        'text'    => 'Which of the strings below will be matched by the following PCRE regular expression? (Choose 2)',
        'answer'  => array(2, 3),
        'options' => array(
            '******123',
            '*****_1234',
            '******1234',
            '_*1234',
            '_*123'
        ),
        'code'    => true
    ),
    array( // 19
        'text'    => 'Which of the following comparisons will return True? (Choose 2)',
        'answer'  => array(1, 4),
        'options' => array(
            '"1top" == "1"',
            '"top" == 0',
            '"top" === 0',
            '"a" == a',
            '123 == "123"'
        )
    ),
    array( // 20
        'text'    => 'What happens if you add a string to an integer using the + operator?',
        'answer'  => 1,
        'options' => array(
            'The interpreter outputs a type mismatch error',
            'The string is converted to a number and added to the integer',
            'The string is discarded and the integer is preserved',
            'The integer and string are concatenated together in a new string',
            'The integer is discarded and the string is preserved'
        )
    ),
    array( // 21
        'text'    => 'If no expiration time is explicitly set for a cookie, what happens to it?',
        'answer'  => 3,
        'options' => array(
            'It expires right away',
            'It never expires',
            'It is not set',
            'It expires at the end of the user’s browser session',
            'It expires only if the script doesn’t create a server-side session'
        )
    ),
    array( // 22
        'text'    => 'Consider the following form and subsequent script. What will the script print out if the user types the word "php" and "great" in the two text boxes respectively?',
        'answer'  => 2,
        'options' => array(
            'Nothing', 'Array', 'A Notice', 'phpgreat', 'greatphp'
        ),
        'code'    => true
    ),
    array( // 23
        'text'    => 'What happens when a form submitted to a PHP script contains two elements with the same name?',
        'answer'  => 2,
        'options' => array(
            'They are combined in an array and stored in the appropriate superglobal array',
            'The value of the second element is added to the value of the first in the appropriate superglobal array',
            'The value of the second element overwrites the value of the first in the appropriate superglobal array',
            'The second element is automatically renamed',
            'PHP outputs a warning'
        )
    ),
    array( // 24
        'text'    => 'Can we use the "default" keyword at any place in a "switch" statement? (Example below)',
        'answer'  => 1,
        'code'    => true,
        'options' => array(
            'No! Only at the end of "switch" statement',
            'Yes! It goes where ever you want!',
            'No! It can be in the middle and the end, but not in the beginning'
        )
    ),
    array( // 25
        'text'    => 'By default, PHP stores session data in...',
        'answer'  => 0,
        'options' => array(
            'The filesystem',
            'A database',
            'Virtual memory',
            'Shared memory',
            'None of the above'
        )  
    ),
    array( // 26
        'text'    => 'Assuming that the client browser is never restarted, how long after the last access will a session “expire” and be subject to garbage collection?',
        'answer'  => 1,
        'options' => array(
            'After exactly 1,440 seconds',
            'After the number of seconds specified in the "session.gc_maxlifetime" INI setting',
            'It will never expire unless it is manually deleted',
            'It will only expire when the browser is restarted',
            'None of the above'
        )  
    ),
    array( // 27
        'text'    => 'Which of the following DBMSs do not have a native PHP extension?',
        'answer'  => 4,
        'options' => array(
            'MySQL',
            'IBM DB/2', 
            'PostgreSQL', 
            'Microsoft SQL Server', 
            'None of the above'
        )
    ),
    array( // 28
        'text'    => 'How is a transaction terminated so that the changes made during its course are discarded? (Choose 2)',
        'answer'  => array(0, 2),
        'options' => array(
            'ROLLBACK TRANSACTION',
            'COMMIT TRANSACTION',
            'By terminating the connection without completing the transaction',
            'UNDO TRANSACTION',
            'DISCARD CHANGES'
        )
    ),
    array( // 29
       'text'    => 'Consider the following database table and query. Which of the indexes below will help speed up the process of executing the query?',
       'answer'  => 2,
       'options' => array(
           'Indexing the ID column',
           'Indexing the NAME and ADDRESS1 columns',
           'Indexing the ID column, and then the NAME and ZIPCODE columns separately',
           'Indexing the ZIPCODE and NAME columns',
           'Indexing the ZIPCODE column with a full-text index'
       ),
       'code'    => true
    ),
    array( // 30
        'text'    => 'Consider the following code snippet. Is this code acceptable from a security standpoint? Assume that the $action and $data variables are designed to be accepted from the user and "register_globals" is enabled.',
        'answer'  => 2,
        'options' => array(
            'Yes, it is secure. It checks for $isAdmin to be True before executing protected operations',
            'No, it is not secure because it doesn’t make sure $action is valid input',
            'No, it is not secure because $isAdmin can be hijacked by exploiting "register_globals"',
            'Yes, it is secure because it validates the user-data $data'
        ),
        'code'    => true
    ),
    array( // 31
        'text'    => 'Is it possible to pass data from PHP to JavaScript?',
        'answer'  => 3,
        'options' => array(
            'No, because PHP is server-side, and JavaScript is client-side.',
            'No, because PHP is a loosely typed language.',
            'Yes, because JavaScript executes before PHP.',
            'Yes, because PHP can generate valid JavaScript.'
        )
    ),
    array( // 32
        'text'    => 'Looking to the code below, what should be placed in the blank spot to run the code?',
        'answer'  => 2,
        'options' => array(
            'use myapp\utils\hello',
            'use utils\hello\Hello',
            'use myapp\utils\hello\Hello',
            'use utils\hello',
            'use myapp\utils\hello\Hello::world'
        ),
        'code'    => true
        
    ),
    array( // 33
        'text'    => 'What happens when I execute the following code?',
        'answer'  => 3,
        'options' => array(
            'It will print "3"',
            'It will print "error"',
            'It will print "7"',
            'It will give an Fatal Error'
        ),
        'code'    => true
    ),
    array( // 34
        'text'    => 'Is it possible to pass data from JavaScript to PHP?',
        'answer'  => 0,
        'options' => array(
            'Yes, but not without sending another HTTP request.',
            'Yes, because PHP executes before JavaScript.',
            'No, because JavaScript is server-side, and PHP is client-side.',
            'No, because JavaScript executes before PHP.'
        )
    ),
    array( // 35
        'text'    => 'Which types of form elements can be excluded from the HTTP request?',
        'answer'  => 3,
        'options' => array(
            'text, radio and checkbox',
            'text, submit and hidden',
            'submit and hidden',
            'radio and checkbox'
        )
    ),
    array( // 36
        'text'    => 'Which question will replace markup such as img=/smiley.png with <img src=”/smiley.png”>?',
        'answer'  => 1,
        'options' => array(
            'print preg_replace("/img=(\w+)/", \'&lt;img src="\1"&gt;\', $text);',
            'print preg_replace("/img=(\S+)/", \'&lt;img src="\1"&gt;\', $text);',
            'print preg_replace("/img=(\s+)/", \'&lt;img src="\1"&gt;\', $text);',
            'print preg_replace("/img=(\w)+/", \'&lt;img src="\1"&gt;\', $text);'
        )
    ),
    array( // 37
        'text'    => 'If I want to store a global information that not represents an object state, I can use the...',
        'answer'  => 2,
        'options' => array(
            'Singleton Pattern',
            'Model View Controller Pattern',
            'Registry Pattern',
            'Factory Pattern',
            'FactoryStore Pattern'
        )
    ),
    array( // 38
        'text'    => 'Which of the following list of potential data sources should be considered trusted?',
        'answer'  => 4,
        'options' => array(
            '$_ENV',
            '$_GET',
            '$_COOKIE',
            '$_SERVER',
            '$_SESSION'
        )
    ),
    array( // 39
        'text'    => 'To prevent cross-site scripting attacks, one should do the following (Choose 3):',
        'answer'  => array(0, 1, 3),
        'options' => array(
            'Never use include or require statements that include files based on pathnames taken from user input (e.g.: include "$username/script.txt";)',
            'Disable "allow_url_fopen" unless it is required for the site to function',
            'Avoid using extensions like curl, which opens remote connections',
            'Use functions such as "strip_tags()" on input taken from one user and displayed to another',
            'Use the "filtering()" function to filter data coming from the user'
        )
    ),
    array( // 40
        'text'    => 'What the code below will return?',
        'answer'  => 3,
        'options' => array(
            'It will print "0, 1, 2, 3, 4, 5, 6, 7, 8, 9"',
            'It will print "9, 8, 7, 6, 5, 4, 3, 2, 1, 0"',
            'It will return a Fatal Error because we can\'t use $direction inside the closure',
            'It will print "5, 6, 2, 4, 9, 0, 7, 1, 3, 8" - no changes!',
            'It will return Notices and it will print the array without an order'
        ),
        'code'    => true
    ),
    array( // 41
        'text'    => 'What would you put in the blank spot to print out "8.5" - the grades average?',
        'answer'  => '&$average',
        'code'    => true
    ),
);