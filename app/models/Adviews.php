<?php
use Jenssegers\Mongodb\Model as Eloquent;

class Adviews extends Eloquent
{
    protected $table  = 'ad_views';
    public $timestamps = true;
    protected $fillable = array('*');
}
