<?php
 
//TSGBZ-BTLWJ-ZB5FB-FEHUH-VLBAV-TKFEJ
class   ApplicationController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);

        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    private function DeleteImage($id)
    {
        $imagePath=ROOT_PATH.'/uploads/image/column/';
        $array = explode(",", $id);
        foreach ($array as $v) {
          $model=NewsColumn::model()->find('id='.$v); 
          if($model->image!=''&&file_exists($imagePath.$model->image))
          {
            unlink($imagePath.$model->image);
          }
        }
        
    }
    public function actionDelete($id) {
       // $this->DeleteImage($id);
        parent::_clear($id);
    }
    
      public function actionIndex($activity_id='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        set_session('activity_id',$activity_id);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
      //  $user_id=Yii::app()->session['name'];
       // $type_id=Yii::app()->session['type_id'];
        $criteria->addCondition('activity_id='.$activity_id);
        // $criteria->condition=get_where($criteria->condition,($start_date!=""),'news_date_start>=',$start_date,'"');
        // $criteria->condition=get_where($criteria->condition,($start_date!=""),'news_date_end<=',$end_date,'"');
        //$criteria->condition=get_like($criteria->condition,'name,introduce',$keywords,'');//get_where
        $criteria->order = 'id DESC';
        $data = array();
      //  $Readselect=Readselect::model()->find('id='.$type_id);
      /*  if(isset($Readselect))
        $data['type_name']=$Readselect->typename;*/
        parent::_list($model, $criteria, 'index', $data);
    }

     public function actionCreate() {   
        $modelName = $this->model;
        $model = new $modelName('create');
        $data = array();
        if (!Yii::app()->request->isPostRequest) {
            $data['model'] = $model;
            $this->render('update', $data);
        }else{
          
            $this-> saveData($model,$temp);
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
            $temp=$_POST[$modelName];
           
           $this-> saveData($model,$temp);
        }
    }

         function saveData($model,$post) {
           $model->attributes =$post;
           show_status($model->save(),'保存成功', get_cookie('_currentUrl_'),'保存失败');  
     }
}
