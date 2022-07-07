<?php

class RankController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    public function actionDelete($id) {
        parent::_clear($id);
    }
    

    public function actionCreate() {   
        $modelName = $this->model;
        $model = new $modelName('create');
        $data = array();
        if (!Yii::app()->request->isPostRequest) {
            $data['model'] = $model;
            $this->render('update', $data);
        }else{
            $this-> saveData($model,$_POST[$modelName]);
        }
    }

    public function actionUpdate($id) {
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        if (!Yii::app()->request->isPostRequest) {
           $data = array();
           $data['model'] = $model;
           $this->render('update', $data);
        } else {
           $this-> saveData($model,$_POST[$modelName]);
        }
    }
       
 
    /*曾老师保留部份，---结束*/
  
 function saveData($model,$post) {
       $model->attributes =$post;
       show_status($model->save(),'保存成功', get_cookie('_currentUrl_'),'保存失败');  
 }

    ///列表搜索
     public function actionIndex( $stu_name = '',$school_name = '',$grade='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
      
        $criteria->order = 'score DESC';
         if ($stu_name!='') {
        $criteria->condition="user_name='".$stu_name."'";}
        if ($school_name!='') {
        $criteria->condition="school='".$school_name."'";}
        if ($grade!='') {
        $criteria->condition="grade='".$grade."'";}
        $data = array();
        parent::_list($model, $criteria, 'index', $data);
    }

    public function actionIndex_detail($id) {
        $data = array();
         $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
       
        $dmodel=ScoreDetail::model();
        $criteria = new CDbCriteria;
        $criteria->condition='1';
        $criteria->condition="user_id='".$model->user_id."'";
        parent::_list($dmodel, $criteria, 'index_detail', $data);
    }



}