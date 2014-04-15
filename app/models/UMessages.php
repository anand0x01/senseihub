<?php
use Jenssegers\Mongodb\Model as Eloquent;

class UMessages extends Eloquent
{
    protected $table  = 'u_messages';
    public $timestamps = true;
    protected $fillable = array('*');

    public function user()
    {
        $this->belongsTo('User', 'msg_user_id', '_id');
    }
}
