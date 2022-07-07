<?php
 
class ScoredetailController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }


    /*曾老师保留部份，---结束*/
    public function actionCreate()
    {
        $modelName = $this->model;
        $model = new $modelName('create');
        $data = array();
        if (!Yii::app()->request->isPostRequest) {
            $data['model'] = $model;
            $data['province'] = Location::model()->findAll('pid=0');
            $this->render('update', $data);
        } else {
            $this->saveData($model, $_POST[$modelName]);
        }
    }

///列表搜索
     public function actionIndex($start_time='',$end_time='', $stu_name = '',$school_name = '',$grade='',$article_name='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->order = 'finish_time';
        $criteria->condition='1 ';
        if ($stu_name!='') {
          $criteria->condition="(user_name='".$stu_name."')";}
          if ($article_name!='') {
          $criteria->condition="(article_name='".$article_name."')";}
          if ($school_name!='') {
        $criteria->condition="school='".$school_name."'";}
        if ($grade!='') {
        $criteria->condition="grade='".$grade."'";}
       $criteria->condition=get_where($criteria->condition,($start_time!=""),'finish_time>=',$start_time.' 00:00:00','"');
        $criteria->condition=get_where($criteria->condition,($end_time!=""),'finish_time<=',$end_time.' 23:59:59','"');
        $data = array();
        parent::_list($model, $criteria, 'index', $data);
    }

      function saveData($model, $post)
    {
        $model->attributes = $post;
        show_status($model->save(), '保存成功', get_cookie('_currentUrl_'), '保存失败');
    }

        public function actionDelete($id)
    {
        parent::_clear($id);
    }


       /* public function actionUpdate($id, $question_type = "") {
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        // echo CJSON::encode($model);
        if (!Yii::app()->request->isPostRequest) {
           $data = array();
           
           if($question_type!="")
           {
               $model['question_type'] = QuestionType::model()->find("id=".$question_type)->type;
            }
           $data['id'] = $id;
           $data['model'] = $model;
           $data['grade'] = QuestionGrade::model()->findAll(); 
           $data['type'] = QuestionType::model()->findAll();
           $this->render('update', $data);
        } else {
           $this->saveData($model,$_POST[$modelName]);
        }
    }*/
    
}

    

 