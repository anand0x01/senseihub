<?php
use Jenssegers\Mongodb\Model as Eloquent;

class Uinfo extends Eloquent
{
    protected $table  = 'user_info';

    public function user()
    {
        $this->belongsTo('User', 'inf_user_id', '_id');
    }
}
