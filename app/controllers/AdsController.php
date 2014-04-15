<?php

class AdsController extends Controller
{
    public function getListing()
    {
        $data = array(
            'results' => Adver::acver()->paginate(10),
        );
        return View::make('search.listing', array('data' => $data));
    }

    public function getPView($id, $slug)
    {
        $data = array(
            'adver' => Adver::acver()->find($id),
        );
        if(is_null($data['adver'])) App::abort(404);
        // slug check
        if($data['adver']->getSludData()[1] != $slug)
            return Redirect::route('ads_pview', $data['adver']->getSludData());
        // Increse the view count.
        $adview = new Adviews;
        $adview->viewer_id = Auth::user()->_id;
        $data['adver']->aviews()->save($adview);
        return View::make('search.pview', array('data' => $data));
    }

    public function getPApply($id, $slug)
    {
        $data = array(
            'adver' => Adver::acver()->find($id),
        );
        if(is_null($data['adver'])) App::abort(404);
        if($data['adver']->getSludData()[1] != $slug)
            return Redirect::route('ads_papply', $data['adver']->getSludData());
        $appcontent = $data['adver']->aresponse()->where('res_user_id', Auth::user()->id)->first();
        $data['applicationcontent'] = (is_null($appcontent)) ? '' : $appcontent->short_summary;
        return View::make('search.papply', array('data' => $data));
    }

    public function postPApply($id, $slug)
    {
        $data = Adver::acver()->find($id);
        if(is_null($data) || $data->getSludData()[1] != $slug)
            App::abort(404);
        $summary = (Input::has('short_summary')) ? Input::get('short_summary') : null;
        DB::collection('ads_response')->where('res_ad_id', $data->_id)->where('res_user_id', Auth::user()->_id)
                ->update(array('short_summary' => $summary), array('upsert' => true));
        return Redirect::route('ads_papply', $data->getSludData())->with('applymsg', 'false');
    }

    public function getPDoubts($id, $slug)
    {
        $data = array(
            'adver' => Adver::acver()->find($id),
        );
        if(is_null($data['adver'])) App::abort(404);
        if($data['adver']->getSludData()[1] != $slug)
            return Redirect::route('ads_doubts', $data['adver']->getSludData());
        $doubts = $data['adver']->adoubts;
        $data['nodoubts'] = true;
        if(count($doubts)) {
            $data['nodoubts'] = false;
            $data['solved'] = null;
            $data['unsolved'] = null;
            foreach ($doubts as $sdoubt) {
                if($sdoubt->isAnswered()) {
                    $data['solved'][] = $sdoubt;
                } else {
                    $data['unsolved'][] = $sdoubt;
                }
            }
        }
        return View::make('search.pdoubts', array('data' => $data));
    }

    public function postPDoubts($id, $slug)
    {
        $data = Adver::acver()->find($id);
        if(is_null($data) || $data->getSludData()[1] != $slug || !Input::has('qstr') || strlen(trim(Input::get('qstr'))) < 10)
        App::abort(404);
        $ques = new Addoubts;
        $ques->setQuestion(Input::get('qstr'));
        $data->adoubts()->save($ques);
        return Response::json(array('success' => true));
        App::abort(404);
    }
}
