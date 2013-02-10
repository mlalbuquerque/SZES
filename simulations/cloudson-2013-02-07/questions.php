<?php

// Test simulation by Claudson Oliveira (@cloudson)
// 2013

return array(
	array(
		'text'    => 'Which of the following best describes E_WARNING among PHP Error Types ? ',
        'answer'  => 1,
        'options' => array(
            'Fatal error that occurs at script runtime',
			'Nonfatal error that occurs at runtime (for example, if the script is unable to connect to MySQL)',
			'Error that occurs at compile time due to invalid syntax',
			'None of the above' ,
        ),
        'code'    => false
	),

	array(
		'text'    => 'The function of strcspn is ',
        'answer'  => 2,
        'options' => array(
			'Returns the position of the character that\'s lowest in the ASCII ',
			'Matches one string in another using glob style matching ',
			'Returns the first position in a string that contains a character not in another string ',
			'None of the above' 
        ),
        'code'    => false
	),
	array(
		'text'  => 'The -q option on the PHP command line used to denote',
		'answer' => 1,
		'options' => array(
			'Don\'t output any HTML headers automatically' ,
			'Don\'t echo back any user inputs ',
			'Run from the command line rather than from a web page',
			'None of the Above'
		),
		'code' => false,
	),
	array(
		'text' => 'Which of the following is not valid PHP code?',
		'answer' => 0,
		'options' => array(
			'$10somethings',
			'$_10',
			'$aVar',
			'${"myVar"}',
			'&$something'
		),
		'code' => false
	),
	array(
		'text' => 'What is the output of the following script? ',
		'answer' => 1,
		'options' => array(
			'',
			'',
			'',
			'',
		),
		'code' => true
	),
	array(
		'text' => '',
		'answer' => 1,
		'options' => array(
			'',
			'',
			'',
			'',
		),
		'code' => false
	)
);