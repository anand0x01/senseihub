<?php

class MemberController extends Controller
{
    public function getDashboard()
    {
        if(Auth::user()->u_account_type == 2)
            return $this->recruiterAccount();
        elseif(Auth::user()->u_account_type == 1)
            return $this->studentAccount();
        echo "Account not ready";
    }

    private function recruiterAccount()
    {
        $data = array(
            'advers' => Auth::user()->advers()->select(array('_id', 'created_at', 'ads_type', 'ads_title', 'status'))->get(),
        );
        return View::make('member.recruiter.dashboard', array('data' => $data));
    }

    public function studentAccount()
    {
        echo "Student page";
    }

    public function getCPassword()
    {
        return View::make('member.manage.cpassword');
    }

    public function getList()
    {
        $user = Auth::user();
        $data = array('success' => true, 'users' => null);
        if($user->hasList()) {
            $op = User::whereIn('_id', $user->getList())->get();
            if(count($op)) {
                foreach ($op as $user) {
                    $data['users'][] = $user->jsonData();
                }
            }
        }
        return Response::json($data);
    }

    public function addList()
    {
        $user = Auth::user();
        if(!Input::has('uid')) App::abort(404);
        $nxt = User::find(Input::get('uid'));
        if(is_null($nxt)) App::abort(403, 'Unauthorized action');
        $finalarr = array();
        $data = array('success' => true, 'users' => null);
        if($user->hasList()) {
            $user->push('ulist', Input::get('uid'), true);
            $user->save();
            $finalarr = $user->getList();
            if(!in_array(Input::get('uid'), $finalarr))
                $finalarr[] = Input::get('uid');
        } else {
            $finalarr = array(Input::get('uid'));
            $user->ulist = $finalarr;
            $user->save();
        }
        $op = User::whereIn('_id', $finalarr)->get();
        if(count($op)) {
            foreach ($op as $user) {
                $data['users'][] = $user->jsonData();
            }
        }
        return Response::json($data);
    }

    public function removeList()
    {
        $user = Auth::user();
        if(!Input::has('uid')) App::abort(404);
        $tormv = User::find(Input::get('uid'));
        if(is_null($tormv)) App::abort(403, 'Unauthorized action');
        $finalarr = array();
        $data = array('success' => true, 'users' => null);
        if($user->hasList()) {
            $user->pull('ulist', Input::get('uid'));
            $user->save();
            $data['del'] = true;
        }
        return Response::json($data);
    }

    public function getCList()
    {
        $data = array('users' => null);
        if(Auth::user()->hasList()) {
            $data['users'] = User::whereIn('_id', Auth::user()->getList())->get();
        }
        return View::make('member.manage.clist', array('data' => $data));
    }

    public function getDbLists()
    {
        $data = array(
            'lists' => Auth::user()->lists,
        );
        return View::make('member.manage.lists', array('data' => $data));
    }

    public function getMngList($hash)
    {
        $data = array('list' => Auth::user()->lists()->find($hash));
        if($data['list'] instanceof Ulists) {
            return View::make('member.manage.mnglist', array('data' => $data));
            return;
        }
        App::abort(403, 'Unauthorized action');
    }
}
