<?php
 
//TSGBZ-BTLWJ-ZB5FB-FEHUH-VLBAV-TKFEJ
class   NewsColumnController extends BaseController {

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

    public function actionDelete($id) 
    {
        $this->DeleteImage($id);
        parent::_clear($id);
    }
    
    public function actionIndex($keywords = '') 
    {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        // $criteria->condition=get_where($criteria->condition,($start_date!=""),'news_date_start>=',$start_date,'"');
        // $criteria->condition=get_where($criteria->condition,($start_date!=""),'news_date_end<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'name,introduce',$keywords,'');//get_where
        $criteria->order = 'id DESC';
        $data = array();
        parent::_list($model, $criteria, 'index', $data);
    }

    public function actionCreate() 
    {   
        $modelName = $this->model;
        $model = new $modelName('create');
        $data = array();
        if (!Yii::app()->request->isPostRequest) 
        {
            $data['model'] = $model;
            $this->render('update', $data);
        }
        else
        {
            $temp=$_POST[$modelName];    
            $path=ROOT_PATH.'/uploads/image/column';
            $filename=substr($temp['column_img'],strripos($temp['column_img'],'/',0)+1);
            if(!is_dir($path))
                mkdir($path);
            copy(ROOT_PATH.'/uploads/temp/'.$temp['column_img'],$path.$filename);
            // put_msg(ROOT_PATH.'/uploads/temp/'.$temp['column_img']);
            $temp['column_img']=$filename;
            $this-> saveData($model,$temp);
        }
    }

    public function actionUpdate($id) {
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        if (!Yii::app()->request->isPostRequest) 
        {
            $data = array();
            $data['model'] = $model;
            $this->render('update', $data);
        } 
        else 
        {
            $temp=$_POST[$modelName];
            put_msg($temp);
            $path=ROOT_PATH.'/uploads/image/column/';
            $filename=substr($temp['pic'],strripos($temp['pic'],'/',0)+1);
            if(!is_dir($path))
                mkdir($path);
            copy(ROOT_PATH.'/uploads/temp/'.$temp['pic'],$path.$filename);
            $temp['pic']=$filename;
            $this-> saveData($model,$temp);
        }
    }

    function saveData($model,$post) 
    {
        $model->attributes =$post;
        show_status($model->save(),'保存成功', get_cookie('_currentUrl_'),'保存失败');  
    }
}
