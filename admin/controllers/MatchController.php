<?php

class MatchController extends BaseController {

	public function actionGetInfo($id){
		$data=array();

		$match=MatchesInfo::model()->findAll("batch=".$id);

        $data['MatchesInfo']=$match;
        if($match)
            $data['code'] = 0;
		echo CJSON::encode($data);
	}

}