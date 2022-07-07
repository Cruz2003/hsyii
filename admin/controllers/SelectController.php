<?php

class SelectController extends BaseController {

    protected $model = '';

    public function init() {
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    } 

    public function actionSchoolName($keywords = '') {
        $data = array();
        $model = SchoolList::model();
        $criteria = new CDbCriteria;
 
            if ($keywords!='') {
          $criteria->condition="school_name='".$keywords."'";}
        parent::_list($model, $criteria, 'schoolName', $data);
    }

    public function actionGetLocation($z) {
        $data = array();
        $criteria = new CDbCriteria;
        if($code!=''){
            $criteria->condition="pid=".$code;
            $criteria->select='id,name';
            $data['data'] = Location::model()->findAll($criteria);
        }
        echo CJSON::encode($data);
    }

    public function actionMatchesInfo($batch = '') {
        $data = array();
        $model = MatchesInfo::model();
        $criteria = new CDbCriteria;
 
        if ($batch!='') {
          $criteria->condition="batch=".$batch;}
        parent::_list($model, $criteria, 'matchesInfo', $data);
    }

}



