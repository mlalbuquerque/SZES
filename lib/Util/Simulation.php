<?php

namespace Util;

class Simulation
{
	protected $name;
	protected $directory; 
	protected $questions;

	public function __construct($config)
	{
		$this->directory = __DIR__.'/../../simulations/';
		$this->setName($config['module']);
		$this->questions = $this->loadQuestions();
	}

	public function setName($name)
	{
		$dir = $this->directory.$name;
		if (!is_dir($dir)) {
			throw new \UnexpectedValueException("Diretório '{$dir}' não existente, cheque suas configurações.");
		}

		$this->name = $name;
	}

	public function loadQuestions()
	{
		$questionsFile = $this->directory.$this->name.'/questions.php';
		if (!file_exists($questionsFile)) {
			throw new \UnexpectedValueException("Módulo '{$this->name}' não possui arquivo questions.php .");	
		}

		return include $questionsFile;
	}

	public function getQuestions()
	{
		return $this->questions;
	}

	public function getQuestion($number, $summary)
	{
		if ($number < 0 || $number > count($this->questions)) {
			throw new \InvalidArgumentException("Tentativa de acessar questão inexistente, número {$number}");
		} 

		return new Question($number, $this->questions[$number], $summary, $this->directory.$this->name.'/codes/');
	}

	public function __toString()
	{
		return $this->name;
	}

}