<?php

namespace Util;

class Question
{
    
    public $id, $type, $text, $answer, $options, $code;
    private $summary;
    
    public function __construct($id, array $data, $summary, $path)
    {
        $questions_path = $path;
        $this->id = $id;
        $this->text = $data['text'];
        $this->answer = $data['answer'];
        $this->summary = $summary;
        $this->options = array_key_exists('options', $data) ?
            $data['options'] : null;
        $this->code =  (array_key_exists('code', $data) && $data['code']) ?
            file_get_contents($questions_path . 'question' . $id . '.txt') : null;
        $this->type = is_array($this->answer) ?
            'multiple' : ($this->hasOptions() ? 'one' : 'text');
    }
    
    public function hasOptions()
    {
        return !empty($this->options);
    }
    
    public function hasCode()
    {
        return !empty($this->code);
    }
    
    public function html() // marcar ou colocar o valor
    {
        return $this->hasOptions() ?
            $this->getOptionsInHTML() :
            $this->getInputText();
    }
    
    public function isMultiple()
    {
        return is_array($this->answer);
    }
    
    
    
    private function getOptionsInHTML()
    {
        $answer = $this->getAnswer();

        $type =  is_array($this->answer) ? 'checkbox' : 'radio';

        $options = '';
        foreach ($this->options as $key => $option)
        {
            $options .= '<input type="' . $type . '" name="answer';
            $options .= is_array($this->answer) ? '[]"' : '"';
            $options .= ' value="' . $key . '"';
            $options .= ' id="answer_' . $key . '"';
            
            if (is_array($answer))
            {
                foreach ($answer as $each)
                {
                    if ((!empty($each) || $each === 0 || $each === '0') && $each == $key)
                    {
                        $options .= ' checked="checked"';
                        break;
                    }
                }
                $options .= " />\n";
            }
            else
                $options .= ((!empty($answer) || $answer === 0 || $answer === '0') && $answer == $key ?
                ' checked="checked"' : '') . " />\n";
            
            $options .= '<label for="answer_' . $key . '">';
            $options .= $option . '</label>' . "\n";
        }

        return $options;
    }
    
    private function getInputText()
    {
        $answer = $this->getAnswer();
    
        $input = '<input type="text" name="answer"';
        $input .= empty($answer) ? ' />' : ' value="' . $answer . '" />' . "\n";
        return $input;
    }
    
    private function getAnswer()
    {
        $answer = '';
        if (array_key_exists($this->id, $this->summary['Review']))
            $answer = $this->summary['Review'][$this->id];
        else if (array_key_exists($this->id, $this->summary['Answer']))
            $answer = $this->summary['Answer'][$this->id];
        else
            $answer = null;
            
        return $answer;
    }
    
}
