<?php

namespace Util;

class Summary
{
    
    public static function saveSession($session, $number, $answer, $action)
    {
        $user = $session->get('user');
        $summary = $session->get($user . '-summary');

        $summary = self::unsetSessionVars($number, $summary);

        if (empty($answer) && $answer !== 0 && $answer !== '0')
            $summary['Blank'][] = $number;
        else
            $summary[$action][$number] = $answer;

        $session->remove($user . '-summary');
        $session->set($user . '-summary', $summary);
    }
    
    public static function html($total_questions, $summary)
    {
        $html = '<ul>';
        for ($i = 0; $i < $total_questions; $i++)
        {
            $html .= '<li>';
            $html .= '<a href="/' . $i . '">';
            if (in_array($i, $summary['Blank']))
                $html .= '(B)';
            else if (array_key_exists($i, $summary['Review']))
            {
                $answer = $summary['Review'][$i];
                $html .= (is_array($answer) ? implode(', ', $answer) : $answer) . ' (R)';
            }
            else
            {
                $answer = $summary['Answer'][$i];
                $html .= is_array($answer) ? implode(', ', $answer) : $answer;
            }
            $html .= '</a></li>';
        }
        $html .= '</ul>';
        
        return $html;
    }
    
    public static function hasBlank($summary)
    {
        return (count($summary['Blank']) > 0);
    }
    
    public static function hasReview($summary)
    {
        return (count($summary['Review']) > 0);
    }
    
    public static function result($summary, $questions)
    {
        $result = 0.0;
        foreach ($questions as $number => $question)
        {
            $right_answer = $question['answer'];
            $result += self::resultAnswer($summary, $number, $right_answer);
        }
        
        return $result;
    }
    
    public static function save($user, $result, $summary, $questions)
    {
        $right_answers = self::rightAnswers($questions);
        $path = __DIR__ . '/../../results/';
        
        $content  = "You've got $result correct answers out of " . count($right_answers) . " questions!\n\n";
        $content .= "YOUR ANSWERS\n===========================\n";
        $content .= var_export($summary, true);
        $content .= "\n===========================\n\n\n\n";
        $content .= "RIGHT ANSWERS\n===========================\n";
        $content .= var_export($right_answers, true);
        $content .= "\n===========================";
        file_put_contents($path . str_replace(' ', '-', $user) . '-' . $result, $content, FILE_APPEND);
    }
    
    
    
    private static function unsetSessionVars($number, $summary)
    {
        if (($key = array_search($number, $summary['Blank'])) !== false)
        {
            unset($summary['Blank'][$key]);
        }
        else
        {
            foreach (array('Answer', 'Review') as $index)
                if (array_key_exists($number, $summary[$index]))
                {
                    unset($summary[$index][$number]);
                    break;
                }
        }
        
        return $summary;
    }
    
    private static function resultAnswer($summary, $number, $right_answer)
    {
        $result = 0.0;
        if (array_key_exists($number, $summary['Review']))
            $result += self::resultCheckMultiple($summary, $number, $right_answer, 'Review');
        else
            $result += self::resultCheckMultiple($summary, $number, $right_answer);
        
        return $result;
    }
    
    private static function resultCheckMultiple($summary, $number, $right_answer, $type_of_question = 'Answer')
    {
        $multiple = is_array($right_answer);
        $result = 0.0;
        
        if ($multiple)
            $result += self::resultMultiple($summary[$type_of_question][$number], $right_answer);
        else
            $result += self::resultCheckString ($summary, $number, $right_answer, $type_of_question);
        
        return $result;
    }
    
    private static function resultCheckString($summary, $number, $right_answer, $type_of_question)
    {
        $answer = $summary[$type_of_question][$number];
        $replaced = array('"', "'", ' ');
        
        if (is_string($right_answer))
            return str_replace($replaced, '', strtolower($answer)) == str_replace($replaced, '', strtolower($right_answer)) ?
                1.0 : 0.0;
            
        return $answer == $right_answer ?
                1.0 : 0.0;
    }
    
    private static function resultMultiple($answers, $right_answers)
    {
        $total_right = count($right_answers);
        $total = count($answers);
        
        if ($total > $total_right)
            return 0.0;
            
        $diff = count(array_diff($right_answers, $answers));
        $partial = ($total_right - $diff) / $total_right;
        
        return ($partial);
    }
    
    private static function rightAnswers($questions)
    {
        $right_answers = array();
        
        foreach ($questions as $question)
            $right_answers[] = $question['answer'];
        
        return $right_answers;
    }
    
}
