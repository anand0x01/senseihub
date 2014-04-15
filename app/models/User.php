<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Jenssegers\Mongodb\Model as Eloquent;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    protected $table  = 'users';
    public $timestamps = true;
    protected $hidden = array(
        'password'
    );

    public function advers()
    {
        if($this->u_account_type == 2 || $this->u_account_type == 3)
            return $this->hasMany('Adver', 'ads_user_id', '_id');
        App::abort(404);
    }

    public function infos()
    {
        return $this->hasOne('Uinfo', 'inf_user_id', '_id');
    }

    public function lists()
    {
        return $this->hasMany('Ulists', 'list_master', '_id');
    }

    public function messages()
    {
        return $this->hasMany('UMessages', 'msg_user_id', '_id');
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function companyGuy()
    {
        if($this->u_account_type == 3 || ($this->u_account_type == 2 && isset($this->company_id)))
            return true;
        return false;
    }

    public function notStudent()
    {
        if($this->u_account_type == 1)
            return false;
        return true;
    }

    public function setPassword($password)
    {
        $this->password = Hash::make($password);
    }

    public function profilePic()
    {
        return 'media/img/avatar-blank.jpg';
    }

    public function getSkills()
    {
        return "Not mentioned";
    }

    public function getName()
    {
        return $this->name;
    }

    public function resumeLink()
    {
        return '#';
    }

    public function hasList()
    {
        return !empty($this->ulist);
    }

    public function getList()
    {
        return $this->ulist;
    }

    public function jsonData()
    {
        return array(
            'name' => $this->getName(),
            '_id' => $this->_id,
            'email' => $this->email,
            'profilePic' => URL::asset($this->profilePic()),
        );
    }
}
