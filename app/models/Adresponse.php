<?php
use Jenssegers\Mongodb\Model as Eloquent;

class Adresponse extends Eloquent
{
    protected $table  = 'ads_response';
    public $timestamps = true;
    protected $fillable = array('*');

    public function adver()
    {
        return $this->belongsTo('Adver', 'res_ad_id', '_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'res_user_id');
    }

    public function getMsg()
    {
        if(!empty($this->short_summary))
            return $this->short_summary;
        return '';
    }

}
