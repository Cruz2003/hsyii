<?php
 
//TSGBZ-BTLWJ-ZB5FB-FEHUH-VLBAV-TKFEJ
class   ActivityDetailController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);

        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    private function DeleteImage($id)
    {
        $imagePath=ROOT_PATH.'/uploads/image/activity/';
        $array = explode(",", $id);
        foreach ($array as $v) {
          $model=activity::model()->find('id='.$v); 
          if($model->image!=''&&file_exists($imagePath.$model->image))
          {
            unlink($imagePath.$model->image);
          }
        }
    }
    public function actionDelete($id) {
        $this->DeleteImage($id);
        parent::_clear($id);
    }
      public function actionIndex($activity_id='',$status='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $time=date('Y-m-d H:i:s',time());
     //   put_msg($status);
        if($status!='')
        $criteria->addCondition('status='.$status);
        if($activity_id!='')
        $criteria->addCondition('activity_id='.$activity_id);
        $criteria->order = 'id DESC';
        $data = array();
        if($status=='')
        parent::_list($model, $criteria, 'index', $data);
        else
        parent::_list($model, $criteria, 'index1', $data);
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
            $path=ROOT_PATH.'/uploads/image/activity/';
            $filename=substr($temp['image'],strripos($temp['image'],'/',0)+1);
           if(!is_dir($path))
              mkdir($path);
           copy(ROOT_PATH.'/uploads/temp/'.$temp['image'],$path.$filename);
            $temp['image']=$filename;
            $temp['status']=1;
            $temp['status_name']='待审核';
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
            $path=ROOT_PATH.'/uploads/image/activity/';
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
}
