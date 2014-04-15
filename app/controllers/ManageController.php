<?php

class ManageController extends Controller
{
    public function getIndex($hash)
    {
        $adver = Adver::find($hash);
        if(is_null($adver)) App::abort(404);
        if($adver->hasManageRights()) {
            $data = array(
                'hash' => $hash,
                'adver' => $adver,
            );
            return View::make('member.manage.manage', array('data' => $data));
        }
        App::abort(404);
    }

    public function getEdit($hash)
    {
        $adver = Adver::find($hash);;
        if(is_null($adver)) App::abort(404);
        if($adver->hasManageRights()) {
            $data = array(
                'hash' => $hash,
                'adver' => $adver,
                'sectors' => Config::get('senseihub.sector_names'),
            );
            return View::make('member.manage.edit', array('data' => $data));
        }
        App::abort(404);
    }

    public function getResponses($hash)
    {
        $data = array('adver' => Adver::find($hash));
        if(is_null($data['adver'])) App::abort(404);
        if($data['adver']->hasManageRights()) {
            $data['hash'] = $hash;
            $data['responses'] = $data['adver']->aresponse()->with('user')->paginate(10);
            return View::make('member.manage.responses', array('data' => $data));
        }
        App::abort(404);
    }

    public function getDoubts($hash)
    {
        $data = array('adver' => Adver::find($hash));
        if(is_null($data['adver'])) App::abort(404);
        if($data['adver']->hasManageRights()) {
            $data['hash'] = $hash;
            $data['doubts'] = $data['adver']->adoubts;
            if(count($data['doubts'])) {
                $data['solved'] = null;
                $data['unsolved'] = null;
                foreach ($data['doubts'] as $sdoubt) {
                    $k = ($sdoubt->isAnswered()) ? 'solved' : 'unsolved';
                    $data[$k][] = $sdoubt;
                }
            }
            return View::make('member.manage.doubts', array('data' => $data));
        }
        App::abort(404);
    }

    public function postAnswer($hash)
    {
        $adver = Adver::find($hash);
        if(is_null($adver)) App::abort(404);
        $acond = $adver->hasManageRights() && Input::has('qid') && Input::has('qanswer') && strlen(trim(Input::get('qanswer'))) > 1 && strlen(Input::get('qid')) > 10;
        if($acond) {
            $affrows = Addoubts::where('_id', Input::get('qid'))->update(array('answer' => Input::get('qanswer')));
            return Response::json(array('success' => true, 'affrows' => $affrows));
        }
        App::abort(404);
    }

}
