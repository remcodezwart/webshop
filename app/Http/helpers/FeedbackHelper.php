<?php

namespace App\Http\helpers;

class FeedBackHelper
{
	CONST FEEDBACKPOSITIVE = "Positive";
	CONST FEEDBACKNEGATIVE = "Negative";

	private $positive;
	private $negative;

	public function __construct()
    {
    	$this->positive = (!empty(session(self::FEEDBACKPOSITIVE))) ? session(self::FEEDBACKPOSITIVE) : array();
    	$this->negative = (!empty(session(self::FEEDBACKNEGATIVE))) ? session(self::FEEDBACKNEGATIVE) : array();
    }

    public function addFeedback($feedback, $type = 'negative')
    {
    	$feedback = htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8');
    	if ($type === 'negative') {
    		$this->negative[] = $feedback;
    		session([self::FEEDBACKNEGATIVE => $this->negative]);
    	} else {
    		$this->positive[] = $feedback;
    		session([self::FEEDBACKPOSITIVE => $this->positive]);
    	}
    }

    private function deleteAllFeedback()
    {
        session([self::FEEDBACKPOSITIVE => '']);
        session([self::FEEDBACKNEGATIVE => '']);
    }

    public function getFeedback($delete = true)
    {
    	$html = "";

    	if ($this->negative !== []) {
    		$html .= "
    		<div class=\"container\">
            	<div class=\"alert alert-danger\" role=\"alert\">
            	<span class=\"sr-only\">Error(s):</span>";
            	$html = $this->generateFeedback($this->negative, $html);
    	} 
    	if ($this->positive !== []) {
    		$html .= "
    		<div class=\"container\">
            	<div class=\"alert alert-success\" role=\"alert\">
            	<span class=\"sr-only\">succe(s):</span>";
            	$html = $this->generateFeedback($this->positive, $html);
    	}

    	if ($delete) $this->deleteAllFeedback();
    	return $html;
    }

    private function generateFeedback($feedback, $html)
    {
    	foreach ($feedback as $message) {
    		$html .= $message."<br>";
    	}

    	$html .= "
    		</div>
        </div>";
        return $html;
    }
}