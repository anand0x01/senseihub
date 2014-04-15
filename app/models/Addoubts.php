<?php
use Jenssegers\Mongodb\Model as Eloquent;

class Addoubts extends Eloquent
{
    protected $table  = 'ads_doubts';
    public $timestamps = true;
    protected $fillable = array('*');

    public function adver()
    {
        return $this->belongsTo('Adver', 'doubts_ad_id', '_id');
    }

    public function isAnswered()
    {
        return !empty($this->answer);
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($ques)
    {
        $this->question = $ques;
        $this->answer = null;
    }

    public function setAnswer($ans)
    {
        if(!empty($ques)) {
            $this->answer = $ques;
            return true;
        }
        return false;
    }

    public function getAnswer()
    {
        if($this->isAnswered())
            return '<p class="db_ans_ans"><strong>Answer :- </strong>' . preg_replace('/[\r\n]+/', '</p><p>', $this->answer) . '</p>';
        return 'This question has not been answered';
    }

    public function getId()
    {
        return $this->_id;
    }
}
