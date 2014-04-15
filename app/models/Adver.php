<?php
use Jenssegers\Mongodb\Model as Eloquent;

class Adver extends Eloquent
{
    protected $table  = 'ads';
    public $timestamps = true;

    public function user()
    {
        $this->belongsTo('User', 'ads_user_id', '_id');
    }

    public function aviews()
    {
        return $this->hasMany('Adviews', 'view_ad_id');
    }

    public function aresponse()
    {
        return $this->hasMany('Adresponse', 'res_ad_id');
    }

    public function adoubts()
    {
        return $this->hasMany('Addoubts', 'doubts_ad_id');
    }

    public function scopeAcver($query)
    {
        return $query->where('status.active', true)
                ->where('status.verified', true)
                ->where('status.complete', false)
                ->where('created_at', '>', \Carbon\Carbon::now()->subYear());
    }

    public function getTitle()
    {
        return $this->ads_title;
    }

    public function activeTill()
    {
        return $this->created_at->addYear()->diffForHumans(\Carbon\Carbon::now());
    }

    public function createdTill()
    {
        return $this->created_at->diffForHumans(\Carbon\Carbon::now());
    }

    public function getImageUrl()
    {
        if(isset($this->ads_meta['image']))
            return $this->ads_meta['image'];
        return 'media/img/Project-2013_2.png';
    }

    public function formattedDesc($lt = 0)
    {
        if($lt){
            return '<p>' . preg_replace('/[\r\n]+/', '</p><p>', Str::limit($this->ads_meta['description'], $limit = $lt, $end = '...')) . '</p>';
        }
        return '<p>' . preg_replace('/[\r\n]+/', '</p><p>', $this->ads_meta['description']) . '</p>';
    }

    public function getDegrees()
    {
        $degree = '';
        if($this->ads_degree['undergrad'])
            $degree .= ', Undergraduate';
        if($this->ads_degree['grad'])
            $degree .= ', Graduate';
        if($this->ads_degree['phd'])
            $degree .= ', PHD';
        $degree[0] = '';
        return $degree;
    }

    public function sectorName()
    {
        return Config::get('senseihub.sector_names')[$this->ads_sector];
    }

    public function getContact()
    {
        if(isset($this->ads_contact))
            return $this->ads_contact;
        return 'Not provided';
    }

    public function sourceType()
    {
        if($this->ads_type == 1)
            return 'Company';
        elseif($this->ads_type == 2)
            return 'Non - Profit';
        else return 'Unknown';
    }

    public function fcreatedOn()
    {
        return $this->created_at->format('F d, Y');
    }

    public function getStatus()
    {
        $msg = '';
        if($this->isVerified())
            $msg = $msg . 'Verified';
        else
            $msg = $msg . 'Unverified';
        if($this->isActive())
            $msg = $msg . ' and Active';
        else
            $msg = $msg . ' and Inactive';
        return $msg;
    }

    public function shouldBeVisible()
    {
        if($this->isVerified() && $this->isActive() && $this->isNotExpired())
            return true;
        return false;
    }

    public function isNotExpired()
    {
        return ($this->created_at->addYear()->diffInSeconds(\Carbon\Carbon::now(), false) < 0) ? true : false;
    }

    public function getActions()
    {
        $buttons = array(array('bname' => 'Delete', 'url' => '#', 'extra' => null));
        if($this->isVerified()) {
            if($this->isActive())
                $buttons[] = array('bname' => 'Pause', 'url' => '#', 'extra' => null);
            else
                $buttons[] = array('bname' => 'Mark Active', 'url' => '#', 'extra' => null);

            if(!$this->isSold())
                $buttons[] = array('bname' => 'Mark Sold', 'url' => '#', 'extra' => null);
            return $buttons;
        }
        $buttons[] = array('special' => true, 'messages' => 'Your project has not been validated yet, It will sonn be validated and avtivated.Thanks for your patience.');
        return $buttons;
    }

    public function isActive()
    {
        if(isset($this->status['active']) && $this->status['active'])
            return true;
        return false;
    }

    public function isVerified()
    {
        if(isset($this->status['verified']) && $this->status['verified'])
            return true;
        return false;
    }

    public function isSold()
    {
        if(isset($this->status['sold']) && $this->status['sold'])
            return true;
        return false;
    }

    public function isComplete()
    {
        if(isset($this->status['complete']) && $this->status['complete'])
            return true;
        return false;
    }

    public function hasManageRights()
    {
        if($this->ads_user_id == Auth::user()->_id)
            return true;
        if(Auth::user()->u_account_type == 3) {
            $owner = User::find($this->ads_user_id);
            if($owner->u_account_type == 2) {
                if(isset($owner->company_id)) {
                    if($owner->company_id == $this->_id)
                        return true;
                }
            }
        }
        return false;
    }

    public function getSludData()
    {
        return array($this->_id, substr(Str::slug($this->ads_title), 0, 50));
    }

    public function projectType()
    {
        $exist = array('sales&m' => 'Sales and Marketing', 'marketing' => 'Market Research', 'productdev' => 'Product Development');
        $outcome = array();
        foreach ($exist as $index => $value) {
            if(!empty($this->ads_ptype[$index]))
                $outcome[] = $value;
        }
        return implode(', ', $outcome);
    }

    public function studentsNo()
    {
        return $this->ads_meta['studentsn'];
    }
}
