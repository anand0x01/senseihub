<?php
class ValidationController extends Controller
{

    /*
    function to signup a recruiter
    */
    public function signupRecruiter()
    {
        $rules = array(
            'inputUserName' => 'required|between:5,100',
            'inputEmail' => 'required|email|max:100|unique:users,email',
            'inputPassword' => 'required|between:7,32',
            'inputPasswordR' => 'required|same:inputPassword'
        );
        $attributes = array(
            'inputUserName' => 'Name',
            'inputEmail' => 'email',
            'inputPassword' => 'password',
            'inputPasswordR' => 'repeated password'
        );
        $v = Validator::make(Input::all() , $rules);
        $v->setAttributeNames($attributes);
        if ($v->fails()) {
            return Redirect::route('static_reg_rec')->withErrors($v)->withInput(Input::except('inputPassword'));
        }
        $uid = $this->createUser(Input::get('inputEmail') , Input::get('inputPassword') , 2);
        $uid->name = Input::get('inputUserName');
        $uid->save();
        $this->loginId($uid);
        return Redirect::route(Config::get('senseihub.rec_reg_redir'));
    }

    public function signupStudent()
    {
        Validator::extend('e_filter', function ($field, $value, $params)
        {
            if (preg_match("/@gmail|@hotmail|@yahoo|@facebook@fastmail|@mailnator|@gmx|@aim|@zoho/", $value)) return false;
            return true;
        });
        $rules = array(
            'inputUserName' => 'required|between:5,100',
            'inputEmail' => 'required|email|max:100|e_filter|unique:users,email',
            'inputPassword' => 'required|between:7,32',
            'inputPasswordR' => 'required|same:inputPassword'
        );
        $attributes = array(
            'inputUserName' => 'Name',
            'inputEmail' => 'email',
            'inputPassword' => 'password',
            'inputPasswordR' => 'repeated password'
        );
        $messages = array(
            'e_filter' => 'We do not allow email adresses like gmail, yahoo, hotmail etc. We encourage your to use you university email adresses.'
        );
        $v = Validator::make(Input::all() , $rules, $messages);
        $v->setAttributeNames($attributes);
        if ($v->fails()) {
            return Redirect::route('static_reg_student')->withErrors($v)->withInput(Input::except('inputPassword'));
        }
        $uid = $this->createUser(Input::get('inputEmail') , Input::get('inputPassword') , 1);
        $uid->name = Input::get('inputUserName');
        $uid->save();
        $this->loginId($uid);
        return Redirect::route(Config::get('senseihub.stu_reg_redir'));
    }

    public function signupCompany()
    {
        $rules = array(
            'inputUserName' => 'required|max:100',
            'inputEmail' => 'required|email|max:100|unique:users,email',
            'inputPassword' => 'required|between:7,32',
            'inputPasswordR' => 'required|same:inputPassword'
        );
        $attributes = array(
            'inputUserName' => 'Company name',
            'inputEmail' => 'email',
            'inputPassword' => 'password',
            'inputPasswordR' => 'repeated password'
        );
        $v = Validator::make(Input::all() , $rules);
        $v->setAttributeNames($attributes);
        if ($v->fails()) {
            return Redirect::route('static_reg_comp')->withErrors($v)->withInput(Input::except('inputPassword'));
        }
        $uid = $this->createUser(Input::get('inputEmail') , Input::get('inputPassword') , 3);
        $uid->name = Input::get('inputUserName');
        $uid->save();
        $this->loginId($uid);
        return Redirect::route(Config::get('senseihub.comp_reg_redir'));
    }

    public function postLogin()
    {
        $rules = array(
            'inputEmail' => 'required',
            'inputPassword' => 'required',
        );
        $attributes = array(
            'inputEmail' => 'Email',
            'inputPassword' => 'Password',
        );
        $v = Validator::make(Input::all() , $rules);
        $v->setAttributeNames($attributes);
        $mbag = new \Illuminate\Support\MessageBag(array(
            'loginError' => 'Authencation details incorrect'
        ));
        if ($v->fails()) {
            return Redirect::route('auth_login')->withErrors($mbag)->withInput(Input::except('inputPassword'));
        }
        $credentials = array(
            'email' => Input::get('inputEmail'),
            'password' => Input::get('inputPassword')
        );
        $remember = ((Input::get('remember_me') === 'yes') ? true : false);
        if(!Auth::attempt($credentials, $remember)) {
            return Redirect::guest('login')->withInput(Input::except('inputPassword'))->withErrors($mbag);
        }
        return Redirect::route(Config::get('senseihub.login_redir'));
    }

    public function newAdCompany()
    {
        $rules = array(
            'title' => 'required|between:5,256',
            'cp_sector' => 'required',
            'project_type' => 'required',
            'description' => 'required',
            'phone' => 'required|min:10',
            'degree' => 'required',
            'n_stu' => 'required|integer|max:999|not_in:0',
            'images' => 'image:max:10240'
        );

        $attributes = array(
            'cp_sector' => 'company sector',
            'project_type' => 'project type',
            'n_stu' => 'number of students'
        );

        $v = Validator::make(Input::all(), $rules);
        $v->setAttributeNames($attributes);
        if($v->fails())
        {
            return Redirect::route('add_company')->withErrors($v)->withInput();
        }

        if(Input::hasFile('images'))
        {
            $file = Input::file('images');
            $tdir = '/media/uploads/' . date('Y') . '/' . date('m') . '/' . date('d');
            $ctpath = public_path() . $tdir;
            if(!file_exists($ctpath))
                mkdir($ctpath, 0777, true);
            $tdir = $tdir . '/' . Str::quickRandom(8) . '.' . $file->getClientOriginalExtension();
            Image::make($file->getRealPath())->widen(200)->save(public_path() . $tdir, 88);
        } else
        {
            $tdir = null;
        }

        $authUser = Auth::user();

        $adver = new Adver;
        $adver->ads_user_id = $authUser->_id;
        $adver->ads_type = 1;
        $adver->ads_title = Input::get('title');
        $adver->ads_sector = Input::get('cp_sector');
        $adver->ads_ptype = array(
            'sales&m' => in_array('t_s_m', Input::get('project_type')),
            'marketing' => in_array('t_m_r', Input::get('project_type')),
            'productdev' => in_array('t_p_d', Input::get('project_type')),
        );
        $adver->ads_meta = array(
            'description' => Input::get('description'),
            'image' => $tdir,
            'studentsn' => Input::get('n_stu')
        );
        $adver->ads_contact = Input::get('phone');
        $adver->ads_degree = array(
            'undergrad' => in_array('d_u', Input::get('degree')),
            'grad' => in_array('d_g', Input::get('degree')),
            'phd' => in_array('d_p', Input::get('degree'))
        );
        $adver->save();
        return Redirect::route(Config::get('senseihub.proj_cre_redir'));
    }

    public function newNonProfit()
    {
        $rules = array(
            'title' => 'required|between:5,256',
            'cp_sector' => 'required',
            'project_type' => 'required',
            'description' => 'required',
            'phone' => 'required|min:10',
            'degree' => 'required',
            'n_stu' => 'required|integer|max:999|not_in:0',
            'images' => 'image:max:10240'
        );

        $attributes = array(
            'cp_sector' => 'company sector',
            'project_type' => 'project type',
            'n_stu' => 'number of students'
        );

        $v = Validator::make(Input::all(), $rules);
        $v->setAttributeNames($attributes);
        if($v->fails())
        {
            return Redirect::route('add_non_profit')->withErrors($v)->withInput();
        }

        if(Input::hasFile('images'))
        {
            $file = Input::file('images');
            $tdir = '/media/uploads/' . date('Y') . '/' . date('m') . '/' . date('d');
            $ctpath = public_path() . $tdir;
            if(!file_exists($ctpath))
                mkdir($ctpath, 0777, true);
            $tdir = $tdir . '/' . Str::quickRandom(8) . '.' . $file->getClientOriginalExtension();
            Image::make($file->getRealPath())->widen(200)->save(public_path() . $tdir, 88);
        } else
        {
            $tdir = null;
        }

        $authUser = Auth::user();

        $adver = new Adver;
        $adver->ads_user_id = $authUser->_id;
        $adver->ads_type = 2;
        $adver->ads_title = Input::get('title');
        $adver->ads_sector = Input::get('cp_sector');
        $adver->ads_ptype = array(
            'sales&m' => in_array('t_s_m', Input::get('project_type')),
            'marketing' => in_array('t_m_r', Input::get('project_type')),
            'productdev' => in_array('t_p_d', Input::get('project_type')),
        );
        $adver->ads_meta = array(
            'description' => Input::get('description'),
            'image' => $tdir,
            'studentsn' => Input::get('n_stu')
        );
        $adver->ads_contact = Input::get('phone');
        $adver->ads_degree = array(
            'undergrad' => in_array('d_u', Input::get('degree')),
            'grad' => in_array('d_g', Input::get('degree')),
            'phd' => in_array('d_p', Input::get('degree'))
        );
        $adver->save();
        return Redirect::route(Config::get('senseihub.proj_cre_redir'));
    }

    public function editProject($hash)
    {
        $adver = Adver::find($hash);
        if(is_null($adver)) App::abort(404);
        if($adver->hasManageRights()) {
            $rules = array('title' => 'required|between:5,256', 'cp_sector' => 'required',
                'project_type' => 'required', 'description' => 'required', 'phone' => 'required|min:10', 'degree' => 'required',
                'n_stu' => 'required|integer|max:999|not_in:0', 'images' => 'image:max:10240'
            );
            $attributes = array('cp_sector' => 'company sector', 'project_type' => 'project type', 'n_stu' => 'number of students');
            $v = Validator::make(Input::all(), $rules);

            if($v->fails()) {
                return Redirect::route('manage_edit', array($hash))->withErrors($v);
            }
            $tdir = null;

            if(Input::hasFile('images')) {
                $file = Input::file('images');
                $tdir = '/media/uploads/' . date('Y') . '/' . date('m') . '/' . date('d');
                $ctpath = public_path() . $tdir;
                if(!file_exists($ctpath))
                    mkdir($ctpath, 0777, true);
                $tdir = $tdir . '/' . Str::quickRandom(8) . '.' . $file->getClientOriginalExtension();
                Image::make($file->getRealPath())->widen(200)->save(public_path() . $tdir, 88);
            }

            $adver->ads_title = Input::get('title');
            $adver->ads_sector = Input::get('cp_sector');
            $adver->ads_ptype = array(
                'sales&m' => in_array('t_s_m', Input::get('project_type')),
                'marketing' => in_array('t_m_r', Input::get('project_type')),
                'productdev' => in_array('t_p_d', Input::get('project_type')),
            );
            $ads_meta_arr = $adver->ads_meta;
            $ads_meta_arr['description'] = Input::get('description');
            $ads_meta_arr['studentsn'] = Input::get('n_stu');
            if(!is_null($tdir))
                $ads_meta_arr['image'] = $tdir;
            $adver->ads_meta = $ads_meta_arr;
            $adver->ads_contact = Input::get('phone');
            $adver->ads_degree = array(
                'undergrad' => in_array('d_u', Input::get('degree')),
                'grad' => in_array('d_g', Input::get('degree')),
                'phd' => in_array('d_p', Input::get('degree'))
            );
            $adver->save();

            return Redirect::route('manage_edit', array($hash))->with('success', 'Updated');
        }
        App::abort(404);
    }

    public function postCPassword()
    {
        Validator::extend('valid_password', function ($field, $value, $params)
        {
            return Hash::check(trim(Input::get('cPassword')) , Auth::user()->password);
        });

        $rules = array('cPassword' => 'required|between:7,32|valid_password', 'nPassword' => 'required|between:7,32', 'nPasswordr' => 'required|between:7,32|same:nPassword');
        $messages = array('valid_password' => 'The given password is incorrect');
        $attributes = array('cPassword' => 'Current password', 'nPassword' => 'New password', 'nPasswordr' => 'Repeated new password');

        $v = Validator::make(Input::all(), $rules, $messages);
        $v->setAttributeNames($attributes);
        if($v->fails()) {
            return Redirect::route('mem_chng_pass')->withErrors($v);
        }
        $user = Auth::user();
        $user->setPassword(Input::get('cPassword'));
        $user->save();
        return Redirect::route('mem_chng_pass')->with('up_p', '1');
    }

    public function postCList()
    {
        $user = Auth::user();
        if(!$user->hasList()) App::abort(403, 'Unauthorized action');
        $rules = array('projectname' => 'required|min:3|max:256', 'invletter' => 'required|min:10');
        $attributes = array('projectname' => 'project name', 'invletter' => 'invitation letter');
        $v = Validator::make(Input::all(), $rules);
        $v->setAttributeNames($attributes);
        if($v->fails()) {
            return Redirect::back()->withErrors($v)->withInput();
        }
        $list = new Ulists;
        $list->members = $user->getList();
        $list->l_name = Input::get('projectname');
        $list->l_letter = Input::get('invletter');
        $slist = $user->lists()->save($list);
        $umessage = array('from' => Auth::user()->id, 'type' => 3, 'created_at' => new DateTime ,'details' => array('list_id' => $slist->_id ,'name' => Input::get('projectname'), 'letter' => Input::get('invletter')));
        $fusers = array();
        foreach ($user->getList() as $value) {
            $umessage['msg_user_id'] = $value;
            $fusers[] = $umessage;
        }
        $user->ulist = null;
        $user->save();
        DB::collection('u_messages')->insert($fusers);

        return Redirect::route(Config::get('senseihub.list_inv_redir'));
    }

    /*
    function to create an user.
    */
    private function createUser($email, $password, $type = 0)
    {
        $user = new User;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->u_account_type = $type;
        return $user;
    }

    /*
    to login th user use this function
    */
    private function loginId($id)
    {
        Auth::loginUsingId($id->_id);
    }
}
