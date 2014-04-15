<?php
use Jenssegers\Mongodb\Model as Eloquent;

class Ulists extends Eloquent
{
    protected $table  = 'user_lists';
    public $timestamps = true;

    public function user()
    {
        $this->belongsTo('User', 'list_master', '_id');
    }
}
