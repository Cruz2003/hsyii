<?php
 
//TSGBZ-BTLWJ-ZB5FB-FEHUH-VLBAV-TKFEJ
class   ReadController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);

        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    public function actionDelete($id) {
        parent::_clear($id,get_cookie('_currentUrl_'));
        //ajax_status(1, '保存成功', get_cookie('_currentUrl_')); 
    }
    
      public function actionIndex($type_id='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        set_session('type_id',$type_id);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;

      //  $user_id=Yii::app()->session['name'];
       // $type_id=Yii::app()->session['type_id'];
        $criteria->addCondition('type_id='.$type_id);
        // $criteria->condition=get_where($criteria->condition,($start_date!=""),'news_date_start>=',$start_date,'"');
        // $criteria->condition=get_where($criteria->condition,($start_date!=""),'news_date_end<=',$end_date,'"');
        //$criteria->condition=get_like($criteria->condition,'name,introduce',$keywords,'');//get_where
        $criteria->order = 'id DESC';
        $data = array();
        $Readselect=Readselect::model()->find('id='.$type_id);
        if(isset($Readselect))
        $data['type_name']=$Readselect->typename;
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
            $temp=$_POST[$modelName];    
            $path=ROOT_PATH.'/uploads/image/read/';
            $filename=substr($temp['image'],strripos($temp['image'],'/',0)+1);
           if(!is_dir($path))
              mkdir($path);
           copy(ROOT_PATH.'/uploads/temp/'.$temp['image'],$path.$filename);
            $temp['image']=$filename;
            $temp['type_id']=get_session('type_id');
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
            put_msg($temp);
            $path=ROOT_PATH.'/uploads/image/read/';
            $filename=substr($temp['image'],strripos($temp['image'],'/',0)+1);
           if(!is_dir($path))
              mkdir($path);
           copy(ROOT_PATH.'/uploads/temp/'.$temp['image'],$path.$filename);
            $temp['image']=$filename;
           $this-> saveData($model,$temp);
        }
    }

         function saveData($model,$post) {
           $model->attributes =$post;
           show_status($model->save(),'保存成功', get_cookie('_currentUrl_'),'保存失败');  
     }


     public function actionPreview($id,$showController='true'){
              $data=array();
               $modelName = $this->model;
              $model = $this->loadModel($id, $modelName);
              $criteria = new CDbCriteria;
              $criteria->addCondition('id='.$id);
              if(!isset($model))
              {
                $this->redirect(array('/read/index'));
                return;
              }
              $data['model'] = $model;
             // $text=explode('<image>',$article->content);
            //  $data['text'] = $text;
             // $data['article']=$article;
              parent::_list($model, $criteria, 'read', $data);
      }

}
