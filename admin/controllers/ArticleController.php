<?php
 
class ArticleController extends BaseController {

    protected $model = '';

    public function init() 
    {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    //删除文章的附带文件及图片
    private function DeleteFileAndImage($id)
    {
        $filePath=ROOT_PATH.'/uploads/file/article/';
        $imagePath=ROOT_PATH.'/uploads/image/article/';
        $array = explode(",", $id);
        foreach ($array as $v) {
            $model=Article::model()->find('id='.$v); 
            $image=$model->image;
            $file=$model->file;
            if($file!=''&&file_exists($filePath.$file))
            {
                unlink($filePath.$file);
            } 
            if($image!='')
            {
                $img=explode(',',$image);
                foreach ($img as $v) {
                    if($v!=''&&file_exists($imagePath.$v)){
                        unlink($imagePath.$v);
                        put_msg('unlink '.$v);
                    }
                }
            }
        }
    }

    public function actionDelete($id) 
    {
        $this->DeleteFileAndImage($id);
        parent::_clear($id);
    }
    
    public function actionCreate()
    {
        $modelName = $this->model;//返回实例
        $model = new $modelName('create');//创造实例
        $data = array();//创造数组
        $data['grade'] = QuestionGrade::model()->findAll(); 
        $data['type'] = articleType::model()->findAll();
        $data['province'] = Location::model()->findAll('pid=0');
        if (!Yii::app()->request->isPostRequest) {//请求
            $data['model'] = $model;//保存实例
            $this->render('update', $data);
        } 
        else {
            $temp=$_POST[$modelName];  
            $path=ROOT_PATH.'/uploads/file/article/';
            $filename=substr($temp['file'],strripos($temp['file'],'/',0)+1);
            // put_msg("filename=".$filename);//正确
            // put_msg($path);//D:/wamp64/wamp64/www/new_hs_yii/uploads/file/article/
            if(!is_dir($path))
                mkdir($path);

            copy(ROOT_PATH.'/uploads/temp/'.$temp['file'],$path.$filename);
            //copy(file,to_file)
            $temp['file']=$filename;
            // $img=$this->readZipPart($filename);
            // $model->image=$img;
            $model->author_id=123;
            $model->column_id=1;
            $model->status=1;//先默认为1
            $model->status_name='未审核';
            $this->saveData($model, $_POST[$modelName]);
        }
    }

    //将docx中文字图片读取出来
    private function readZipPart($filename) {
        $zip = new ZipArchive();
        $copyName=array();
        $img='';
       if (true === $zip->open($filename)) {
            $zip->extractTo('uploads/file/temp');
            $zip->close();
            $this->readXml('uploads/file/temp/word/document.xml');   
            if(strpos($this->xmlText,"<image>")!=false)  //如果有图片则将图片移动到相应目录下
               $this->xCopy('uploads/file/temp/word/media', ROOT_PATH.'/uploads/image/article', $child = 1,$copyName);
            $this->deldir('uploads/file/temp/');
            $num=0;
            for($i=0;$i<count($this->xmlImg);$i++)
            {
              for($j=$i-1;$j>=0;$j--)
              {
                if($this->xmlImg[$j]==$this->xmlImg[$i]){
                    $img.=$copyName[$j].',';
                    $num++;
                    break;
                }
              }
              $img.=$copyName[$i-$num].',';
            }
        } 
        else die('non zip file');
        return $img;

    }

  /*  public function actionLinkloaction($model, $_POST[$modelName])
    {
        $model->attributes = $post;
       // if (!Yii::app()->request->isPostRequest)
        {
        if($model->area=='')
        {
            $address=$model->province.$model->city;
        }
        else
        {
            $address=$model->province.$model->city.$model->area;
        }

        $model->school_location=$address.$model->school_name;
        }
    }*/

/*public function actionUpload()
{
    $model=new UploadFrom();
    if(Yii::$app->request->isPost)
    {
        $model->imageFile=UploadedFile::getInstance($model,'imageFile');
        if($model->upload())
        {
            return;
        }

    }
    return this->render('file',['model'=>$model]);
}*/


 
 public function actionUpdate($id) {
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        // echo CJSON::encode($model);
        if (!Yii::app()->request->isPostRequest) {
           $data = array();
           $data['id'] = $id;
           $data['model'] = $model;
           $this->render('update', $data);
        } else {
           $this->saveData($model,$_POST[$modelName]);
        }
    }
    


  

    public function actionUpdate0($id) {
      //set_cookie('_currentUrl_', Yii::app()->request->url);

        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        //$data['teacher'] = Teacher::model()->findAll();
        $article=Article::model()->find('id='.$id);

        if (!Yii::app()->request->isPostRequest) {
            $data = array();
            $data['model'] = $model;
            $data['teacher'] = Teacher::model()->findAll();
            $data['status']=ArticleStatus::model()->findAll(); 
            $data['text'] = explode(" <image> ",$model->content);
            $data['img'] = explode(",",$model->image);
            $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/image/article/";


            $data['article'] = $article;
            if($article->content==''){
                com_load_typelib('Word.Application');
                $dir=ROOT_PATH.'/uploads/file/article/';
                header('Content-type:text/html;charset=utf-8');
                //$filename=$dir.$article->file;
                $filename=substr($article->file,strripos($article->file,'_',0)-1);
                com_load_typelib('Word.Application');
                $filename=$dir.$filename;
                put_msg($filename);
                $word = new COM("word.application",null,CP_UTF8) or die("Unable to instanciate Word");
                $word->Visible = 0;
                $word->Documents->Open($filename,false,true);
                $text= $word->ActiveDocument->content->Text;
                $data['text'] = $text;
            }
            else{
                //以什么符号分隔生成数组 
                $text=explode('<image>',$article->content);
                $img=explode(',',$article->image);
                $index=0;
                $data['text'] = $text;
                $data['img'] = $img;
                $dir=ROOT_PATH.'/uploads/imges/article/';
                // put_msg(ROOT_PATH);
                $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/image/article/";
            }
            $this->render('update0', $data);
        } 
        else {
            $this-> saveData($model,$_POST[$modelName]);
        }
    }

    public function actionUpdate1() {

        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model=Article::model()->find('status=4');
        
        if(isset($model))
      {
        $id=Article::model()->find('status=4')->id;
        $model = $this->loadModel($id, $modelName);
      
        //Subtime::put_time();


        $article=Article::model()->find('id='.$id);
        if (!Yii::app()->request->isPostRequest) {
           $data = array();
            $data['model'] = $model;
            $data['status']=ArticleStatus::model()->findAll(); 
            $data['text'] = explode(" <image> ",$model->content);
            $data['img'] = explode(",",$model->image);
            $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/image/article/";
            $data['article'] = $article;
              if($article->content==''){
                com_load_typelib('Word.Application');
                  $dir=ROOT_PATH.'/uploads/file/article/';
                  header('Content-type:text/html;charset=utf-8');
                  //$filename=$dir.$article->file;
                  $filename=substr($article->file,strripos($article->file,'_',0)-1);
                  com_load_typelib('Word.Application');
                  $filename=$dir.$filename;
                  put_msg($filename);
                   $word = new COM("word.application",null,CP_UTF8) or die("Unable to instanciate Word");
                   $word->Visible = 0;
                   $word->Documents->Open($filename,false,true);
                   $text= $word->ActiveDocument->content->Text;
                   $data['text'] = $text;
              }
              else{
                //以什么符号分隔生成数组 
                $text=explode('<image>',$article->content);
                $img=explode(',',$article->image);
                $index=0;
                $data['text'] = $text;
                $data['img'] = $img;
                $dir=ROOT_PATH.'/uploads/imges/article/';
                put_msg(ROOT_PATH);
                $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/image/article/";

              }





           $this->render('update1', $data);

        } else { 
            $model->firsttrialtime=date('Y-m-d H:i:s',time());
     
           $this-> saveData($model,$_POST[$modelName]);
          //$this->update1(1);
        }
      }
      else
      {
        $msg="已经没有可以继续审核的稿件";
        echo $msg;
      }
    }






        public function actionUpdate2() {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $model=Article::model()->find('status=2');
        //$id=Article::model()->find('status=2')->id;
        if(isset($model))
        {
          $id=$model->id;
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        $article=Article::model()->find('id='.$id);
        if (!Yii::app()->request->isPostRequest) {
            $data = array();
            $data['model'] = $model;
            $data['status']=ArticleStatus::model()->findAll(); 
            $data['text'] = explode(" <image> ",$model->content);
            $data['img'] = explode(",",$model->image);
            $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/image/article/";


            $data['article'] = $article;
               if($article->content==''){
                    com_load_typelib('Word.Application');
                    $dir=ROOT_PATH.'/uploads/file/article/';
                    header('Content-type:text/html;charset=utf-8');
                    //$filename=$dir.$article->file;
                    $filename=substr($article->file,strripos($article->file,'_',0)-1);
                    com_load_typelib('Word.Application');
                    $filename=$dir.$filename;
                    put_msg($filename);
                    $word = new COM("word.application",null,CP_UTF8) or die("Unable to instanciate Word");
                    $word->Visible = 0;
                    $word->Documents->Open($filename,false,true);
                    $text= $word->ActiveDocument->content->Text;
                    $data['text'] = $text;
                }
            else{
                //以什么符号分隔生成数组 
                $text=explode('<image>',$article->content);
                $img=explode(',',$article->image);
                $index=0;
                $data['text'] = $text;
                $data['img'] = $img;
                $dir=ROOT_PATH.'/uploads/imges/article/';
                put_msg(ROOT_PATH);
                $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/image/article/";
            }
           $this->render('update2', $data);

        } else {
          $model->secondtrialtime=date('Y-m-d H:i:s',time());
           $this-> saveData($model,$_POST[$modelName]);
        }
      }
      else
      {
        $msg="已经没有可以继续审核的稿件";
        echo $msg;
      }
    }
    public function actionUpdate3() {
      set_cookie('_currentUrl_', Yii::app()->request->url);
        $model=Article::model()->find('status=6');
        if(isset($model))
        {
        $id=$model->id;
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);

        $article=Article::model()->find('id='.$id);

        if (!Yii::app()->request->isPostRequest) {
            $data = array();
            $data['model'] = $model;
            $data['status']=ArticleStatus::model()->findAll(); 
            $frequency=Frequency::model()->findAll(); 
            $arr=array();
            array_push($arr,'请选择');
            foreach($frequency as $f){
                $arr[$f->id]=$f->name;
            }
            $data['frequency']=$arr;
            $data['text'] = explode(" <image> ",$model->content);
            $data['img'] = explode(",",$model->image);
            $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/image/article/";



            $data['article'] = $article;
              if($article->content==''){
                com_load_typelib('Word.Application');
                  $dir=ROOT_PATH.'/uploads/file/article/';
                  header('Content-type:text/html;charset=utf-8');
                  //$filename=$dir.$article->file;
                  $filename=substr($article->file,strripos($article->file,'_',0)-1);
                  com_load_typelib('Word.Application');
                  $filename=$dir.$filename;
                  put_msg($filename);
                   $word = new COM("word.application",null,CP_UTF8) or die("Unable to instanciate Word");
                   $word->Visible = 0;
                   $word->Documents->Open($filename,false,true);
                   $text= $word->ActiveDocument->content->Text;
                   $data['text'] = $text;
              }
              else{
                //以什么符号分隔生成数组 
                $text=explode('<image>',$article->content);
                $img=explode(',',$article->image);
                $index=0;
                $data['text'] = $text;
                $data['img'] = $img;
                $dir=ROOT_PATH.'/uploads/imges/article/';
                put_msg(ROOT_PATH);
                $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/image/article/";

              }






           $this->render('update3', $data);

        } else {
          $model->finaltrialtime=date('Y-m-d H:i:s',time());
           $this-> saveData($model,$_POST[$modelName]);

        }
      }
      else
      {
        $msg="已经没有可以继续审核的稿件";
        echo $msg;
      }
    }

    function saveData($model,$post) {
        $model->attributes = $post;
        //更改稿件的状态
        //put_msg($_POST['teacher_name']);
        if(isset($_POST['grade']))
        {
            $grade = $_POST['grade'];
            $model->grade = $grade; 
        }
        if(isset($_POST['type_name']))
        {
            $type = $_POST['type_name'];
            if($type!="")
            {
                $ts = articleType::model()->find("id=".$type);
                $model->type_name = $ts->type;
            }
        }
        if(isset($_POST['teacher_id']))
        {
            $type = $_POST['teacher_id'];
            if($type!="")
            {
                $ts = Teacher::model()->find("id=".$type);
                $model->teacher_id=$ts->id;
                $model->teacher_name = $ts->teacher_name;
            }
        }
        if(isset($_POST['status'])){
            $status=$_POST['status'];
            $model->status=$status; 
            if($status!=""){
            $as=ArticleStatus::model()->find("id= ".$status);
            $model->status_name=$as->status_name;}
        }
        if(isset($_POST['area']))
        {
            $area=$_POST['area'];
            if($area!='')
                $model->area=$area;
        }
        show_status($model->save(),'保存成功', get_cookie('_currentUrl_'),'保存失败'); 
    }




    ///稿件浏览
     public function actionIndex($keywords='',$columnId= '',$start_date='',$end_date='',$grade='',$type='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'title,introduce,content,author',$keywords,'');//get_where
        if($columnId!='')
            $criteria->addCondition('column_id='.$columnId);
        if($grade!='')
            $criteria->addCondition('grade='.$grade);
        if($type!='')
            $criteria->addCondition('type_id='.$type);
   //选择默认显示的状态
        $status=1;
        $criteria->addCondition('status='.$status);
          
        $criteria->order = 'submit_time DESC';
        $data = array();
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        parent::_list($model, $criteria, 'index', $data);
    }   
    ///稿件一审
    public function actionFirstTrial($keywords='',$columnId= '',$start_date='',$end_date='',$grade='',$type='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'title,introduce,content,author',$keywords,'');//get_where
        if($columnId!='')
            $criteria->addCondition('column_id='.$columnId);
        if($grade!='')
            $criteria->addCondition('grade='.$grade);
        if($type!='')
            $criteria->addCondition('type_id='.$type);
         
            //选择默认显示的状态
            $status=4;
            $criteria->addCondition('status='.$status);
          
        $criteria->order = 'submit_time ASC';
        $data = array();
        $data['article']=Article::model()->findAll("status=".$status);
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        parent::_list($model, $criteria, 'firstTrial', $data);
    } 
    
    public function trialfirst()
    {
      set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
         $status=4;
        $criteria->addCondition('status='.$status);
        $criteria->order = 'submit_time DESC';
        $data = array();
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        parent::_list($model, $criteria, 'update1', $data);
    }
    ///稿件二审
     public function actionSecondTrial($keywords='',$columnId= '',$start_date='',$end_date='',$grade='',$type='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'title,introduce,content,author',$keywords,'');//get_where
        if($columnId!='')
            $criteria->addCondition('column_id='.$columnId);
        if($grade!='')
            $criteria->addCondition('grade='.$grade);
        if($type!='')
            $criteria->addCondition('type_id='.$type);

          //选择默认显示的状态
            $status=2;
            $criteria->addCondition('status='.$status);
        $criteria->order = 'submit_time ASC';
        $data = array();
        $data['article']=Article::model()->findAll('status='.$status);
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        parent::_list($model, $criteria, 'secondTrial', $data);
    } 
        ///稿件总审
     public function actionFinalTrial($keywords='',$columnId= '',$start_date='',$end_date='',$grade='',$type='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'title,introduce,content,author',$keywords,'');//get_where
        if($columnId!='')
            $criteria->addCondition('column_id='.$columnId);
        if($grade!='')
            $criteria->addCondition('grade='.$grade);
        if($type!='')
            $criteria->addCondition('type_id='.$type);
  
          //选择默认显示的状态
            $status=6;
            $criteria->addCondition('status='.$status);
          
        $criteria->order = 'submit_time ASC';
        $data = array();
        $data['article']=Article::model()->findAll('status='.$status);
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        parent::_list($model, $criteria, 'finalTrial', $data);
    } 
     public function actionPublished($keywords='',$columnId= '',$start_date='',$end_date='',$grade='',$type='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'title,introduce,content,author',$keywords,'');//get_where
        if($columnId!='')
            $criteria->addCondition('column_id='.$columnId);
        if($grade!='')
            $criteria->addCondition('grade='.$grade);
        if($type!='')
            $criteria->addCondition('type_id='.$type);
        
          //选择默认显示的状态
            $status=7;
            $criteria->addCondition('status='.$status);
            $criteria->addCondition('frequency_id is NULL');
            //$criteria->addCondition('publish_column="" and publish_date ="0000-00-00" and frequency_id =0');
        $criteria->order = 'submit_time ASC';
        $data = array();
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        parent::_list($model, $criteria, 'published', $data);
    }

     public function actionPublishOn($keywords='',$columnId= '',$start_date='',$end_date='',$grade='',$type='',$publishColumn='',$frequency='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'publish_date>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'publish_date<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'title,introduce,content,author',$keywords,'');//get_where
        if($columnId!='')
            $criteria->addCondition('column_id='.$columnId);
        if($grade!='')
            $criteria->addCondition('grade='.$grade);
        if($type!='')
            $criteria->addCondition('type_id='.$type);
        if($publishColumn!='')
           $criteria->condition=get_like($criteria->condition,'publish_column',$publishColumn,'');
        if($frequency!='')
            $criteria->addCondition('frequency_id='.$frequency);

        //选择默认显示的状态
        $status=7;
        $criteria->addCondition('status='.$status);
        $criteria->addCondition('publish_column!="" or publish_date !="0000-00-00" or frequency_id !=0');
        // $criteria->addCondition('');
        // $criteria->addCondition('frequency_id is not null');

        $criteria->select = 't.*,f.name name';
        $criteria->join='LEFT JOIN frequency f on f.id=t.frequency_id';
          
        $criteria->order = 'publish_date DESC';
        $data = array();
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        $data['frequency']=Frequency::model()->findAll();
        parent::_list($model, $criteria, 'publishOn', $data);
    }

        public function actionRefused($keywords='',$columnId= '',$start_date='',$end_date='',$grade='',$type='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'title,introduce,content,author',$keywords,'');//get_where
        if($columnId!='')
            $criteria->addCondition('column_id='.$columnId);
        if($grade!='')
            $criteria->addCondition('grade='.$grade);
        if($type!='')
            $criteria->addCondition('type_id='.$type);
  
          //选择默认显示的状态
            $status=5;
            $criteria->addCondition('status='.$status);
          
        $criteria->order = 'submit_time DESC';
        $data = array();
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        parent::_list($model, $criteria, 'refused', $data);
    }

     public function actionRemodefied($keywords='',$columnId= '',$start_date='',$end_date='',$grade='',$type='') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'submit_time<=',$end_date,'"');
        $criteria->condition=get_like($criteria->condition,'title,introduce,content,author',$keywords,'');//get_where
        if($columnId!='')
            $criteria->addCondition('column_id='.$columnId);
        if($grade!='')
            $criteria->addCondition('grade='.$grade);
        if($type!='')
            $criteria->addCondition('type_id='.$type);
  
          //选择默认显示的状态
            $status=3;
            $criteria->addCondition('status='.$status);
          
        $criteria->order = 'submit_time DESC';
        $data = array();
        $data['column']=NewsColumn::model()->findAll();
        $data['type']=ArticleType::model()->findAll();
        $data['status']=ArticleStatus::model()->findAll();
        parent::_list($model, $criteria, 'remodefied', $data);
    }

      public function actionDownload($file_name) {
        $file_dir='www/new_hs_yii/uploads/file/article/';
        if (!file_exists($file_dir.$file_name )) {    
            header('HTTP/1.1 404 NOT FOUND');  
        } else {    
            // 以只读和二进制模式打开文件   
            $file = fopen ( $file_dir . $file_name, "rb" ); 
            // 告诉浏览器这是一个文件流格式的文件    
            Header ( "Content-type: application/octet-stream" ); 
            //请求范围的度量单位  
            Header ( "Accept-Ranges: bytes" );  
            // Content-Length是指定包含于请求或响应中数据的字节长度  
           $file = fopen ( $file_dir . $file_name, "r" );    
        //输入文件标签     
          Header ( "Content-type: application/octet-stream" );    
          Header ( "Accept-Ranges: bytes" );    
          Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );    
          Header ( "Content-Disposition: attachment; filename=" . $file_name );    
          //输出文件内容     
          //读取文件内容并直接输出到浏览器    
          echo fread ( $file, filesize ( $file_dir . $file_name ) );    
          fclose ( $file );    
          exit ();      
       }   
    }

      public function actionDownloadZip($columnId) {
        $file_dir=ROOT_PATH.'/uploads/file/article/';
        $fileName=Article::model()->findAll('column_id='.$columnId);
        $name=NewsColumn::model()->find('id='.$columnId)->name;
        if(count($fileName)>0) {
              $zipname = $name.date('Ymd',time()).'.zip';

            $zip = new ZipArchive();
            $res = $zip->open($file_dir.$zipname, ZipArchive::CREATE);
            if ($res === TRUE) {
             foreach ($fileName as $file) {
             //这里直接用原文件的名字进行打包，也可以直接命名，需要注意如果文件名字一样会导致后面文件覆盖前面的文件，所以建议重新命名
              $zip->addFile($file_dir.$file->file, $file->file);
             }
            }
            //关闭文件
            $zip->close();

            if(!file_exists($file_dir.$zipname)){
                echo "无法找到文件"; //即使创建，仍有可能失败。。。。
            }
            header("Cache-Control: public"); 
            header("Content-Description: File Transfer"); 
            header("Content-Type: application/zip");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length: " . filesize($file_dir.$zipname));
            header("Content-Disposition: attachment; filename=".$zipname);
            readfile($file_dir.$zipname);
            unlink($file_dir.$zipname);
            exit();
        }
        else
          $this->redirect(array('/Article/index'));
    }

    public function actionConfirmPublication($id,$title,$author,$grade){
        $data=array();
        put_msg($id);
        $data['id']=$id;
        $data['title']=$title;
        $data['author']=$author;
        $data['grade']=$grade;
        $data['frequency']=Frequency::model()->findAll();
        $data['institution']=Institutions::model()->findALL();
        $this->render('confirmPublication',$data);
    }

    public function actionChangeToPublishOn($id,$publishColumn,$publishDate,$institution,$frequency)
    {
          $data=array();
          $data['state']=Article::model()->updateAll(array('publish_column'=>$publishColumn,'publish_date'=>$publishDate,'institution'=>$institution,'frequency_id'=>$frequency,),'id='.$id);
          echo CJSON::encode($data);
    }

    public function actionGetRootPath()
    {
        return "www/new_hs_yii/";
    }

    public function actionPreview($id,$showController='true'){
        $data=array();
        $data['text'] = '';
        $data['img'] = '';
        $article=Article::model()->find('id='.$id);
        $data['Aid']=$article->id;
        $data['status_name'] = $article->status_name;
        $data['article'] = $article;
        if($article->content==''){
            com_load_typelib('Word.Application');
            $dir=ROOT_PATH.'/uploads/file/article/';
            header('Content-type:text/html;charset=utf-8');
            //$filename=$dir.$article->file;
            $filename=substr($article->file,strripos($article->file,'_',0)-1);
            com_load_typelib('Word.Application');
            $filename=$dir.$filename;
            put_msg($filename);
            $word = new COM("word.application",null,CP_UTF8) or die("Unable to instanciate Word");// 打开word
            $word->Visible = 0;
            $word->Documents->Open($filename,false,true);
            $content= $word->ActiveDocument->content->Text;
            $data['text'] = $content;
        }
        else{//微信小程序端记录进入该处
            put_msg("123");
            //以什么符号分隔生成数组 
            $content=explode('<image>',$article->content);
            $image=explode(',',$article->image);
            $index=0;
            $data['text'] = $content;
            $data['img'] = $image;
            $dir=ROOT_PATH.'/uploads/file/article/';
            $data['dir'] =Yii::app()->request->hostInfo."/new_hs_yii/uploads/file/article/";
        }
        $statusId='5';
        $opinionTip='';
        switch ($article->status) {
            case '1':
                $statusId.=',4';
                $opinionTip='拒稿/收稿原因';
                break;
            case '4':
                $statusId.=',2,3';
                $opinionTip='一审意见';
                break;
            case '2':
                $statusId.=',6,3';
                $opinionTip='二审意见';
                break;
            case '6':
                $statusId.=',7';
                $opinionTip='总审意见';
                $data['frequency'] =Frequency::model()->findAll();
                break;
        }
        $data['opinionTip'] =$opinionTip;
        $data['showController'] =$showController=='false'?false:true;
        $data['status'] = ArticleStatus::model()->findAll('id in ('.$statusId.')');
        $this->render('read',$data);
    }

        public function actionStatusChange($id,$sid,$opinion,$statusNow,$publishColumn,$publishDate,$frequency){
              $data=array();
              $status = ArticleStatus::model()->find('id='.$sid);
              $opinionName='opinion';
              switch ($statusNow) {
                case '1':
                   $opinionName.='0';
                break;
                case '4':
                   $opinionName.='1';
                break;
                case '2':
                   $opinionName.='2';
                break;
                case '6':
                   $opinionName.='3';
                break;
              }
              $data['state']=Article::model()->updateAll(array('status'=>$status->id,'status_name'=>$status->status_name,$opinionName=>$opinion,'publish_column'=>$publishColumn,'publish_date'=>$publishDate,'frequency_id'=>$frequency),'id='.$id);
              echo CJSON::encode($data);
      }

     /* public function actionfirstcountnumber()
      {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $time=date('Y-m-d',time());
        $start_date=$time.' 00:00:00';
        $end_date=$time.' 23:59:59';
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'firsttrialtime>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'firsttrialtime<=',$end_date,'"');
        $criteria->order = 'firsttrialtime DESC';
        $data = array();
         $this->render('firstTrialcount', $data);
        parent::_list($model, $criteria, 'firstTrialcount', $data);
      }*/


      public function actionfirstcountnumber($start_date='',$end_date='')
      {
         set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
   //选择默认显示的状态
        
     
        $time=date('Y-m-d',time());
       if($start_date=='') {$start_date=$time.' 00:00:00';}
       if($end_date=='') {$end_date=$time.' 23:59:59';}
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'firsttrialtime>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'firsttrialtime<=',$end_date,'"');
        $criteria->order = 'submit_time DESC';
        $data = array();
        $status=4;
        $data['article']=Article::model()->findAll("status=".$status);
        parent::_list($model, $criteria, 'firstTrialcount', $data);
      }

      public function showtrialnumber($type=1)
      {
         $modelName = $this->model;
          $model = $modelName::model();
          $time=date('Y-m-d',time());
          $start_date=$time.' 00:00:00';
         $end_date=$time.' 23:59:59';
         $criteria = new CDbCriteria;
         if($type==1)
        { $criteria->condition=get_where($criteria->condition,($start_date!=""),'firsttrialtime>=',$start_date,'"');
         $criteria->condition=get_where($criteria->condition,($start_date!=""),'firsttrialtime<=',$end_date,'"');
        $arclist=$model->findAll($criteria);}
        else if($type==2)
        { $criteria->condition=get_where($criteria->condition,($start_date!=""),'secondtrialtime>=',$start_date,'"');
         $criteria->condition=get_where($criteria->condition,($start_date!=""),'secondtrialtime<=',$end_date,'"');
        $arclist=$model->findAll($criteria);
        }
        else
        { $criteria->condition=get_where($criteria->condition,($start_date!=""),'finaltrialtime>=',$start_date,'"');
         $criteria->condition=get_where($criteria->condition,($start_date!=""),'finaltrialtime<=',$end_date,'"');
        $arclist=$model->findAll($criteria);
        }
        $count=0;
        foreach ($arclist as $v) {
          $count++;
        }
        return $count;
      }
      public function showremain($type=1)
      {
         $modelName = $this->model;
          $model = $modelName::model();
          $criteria = new CDbCriteria;
          if($type==1)
          {
            $status=4;
          }
          else if($type==2)
          {
            $status=2;
          }
          else 
          {
            $status=6;
          }
          $criteria->addCondition('status='.$status);
          $arclist=$model->findAll($criteria);
 
          $count=0;
        foreach ($arclist as $v) {
          $count++;
        }
        return $count-1;
      }
            public function actionsecondcountnumber($start_date='',$end_date='')
      {
         set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
   //选择默认显示的状态
        
    
        $time=date('Y-m-d',time());
         if($start_date=='') {$start_date=$time.' 00:00:00';}
       if($end_date=='') {$end_date=$time.' 23:59:59';}
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'secondtrialtime>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'secondtrialtime<=',$end_date,'"');
        $criteria->order = 'submit_time DESC';
        $data = array();
        $status=2;
        $data['article']=Article::model()->findAll("status=".$status);
        parent::_list($model, $criteria, 'secondTrialcount', $data);
      }




        public function actionfinalcountnumber($start_date='',$end_date='')
      {
         
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
   //选择默认显示的状态
        
    
        $time=date('Y-m-d',time());
     if($start_date=='') {$start_date=$time.' 00:00:00';}
       if($end_date=='') {$end_date=$time.' 23:59:59';}
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'finaltrialtime>=',$start_date,'"');
        $criteria->condition=get_where($criteria->condition,($start_date!=""),'finaltrialtime<=',$end_date,'"');
        $criteria->order = 'submit_time DESC';
        $data = array();
        $status=6;
        $data['article']=Article::model()->findAll('status='.$status);
        parent::_list($model, $criteria, 'finalTrialcount', $data);
      }
     public function actionRead($wordname){
         //  $file_dir='D:/xampp/htdocs/new_hs_yii/uploads/file/article/';
         //  $word = new COM("word.application",null,CP_UTF8) or die("Unable to instanciate Word");
         // $word->Visible = 0;
         // $word->Documents->open($file_dir.$wordname);
         // $test= $word->ActiveDocument->content->Text;
         // put_msg($test);
         // $content=explode(' ',$test);
         // $word->Quit();
         // $word = null;
         // unset($word);
         // $data['content'] = $content;
         // $data['status'] = ArticleStatus::model()->findAll();
         // $this->render('read',$data);
     }

    public function actionDownloadTemplateWord() {
        $file_dir='./uploads/file/template/';
        $file_name = 'template.docx';
        
        put_msg($file_dir . $file_name);

        if (!file_exists($file_dir . $file_name)) {  
            // put_msg("error:文件不存在");
            header('HTTP/1.1 404 NOT FOUND');
        } 
        else {    
            // 以只读和二进制模式打开文件   
            // $file = fopen ( $file_dir . $file_name, "rb" );   
            // 告诉浏览器这是一个文件流格式的文件    
            Header ( "Content-type: application/octet-stream" );
            //请求范围的度量单位  
            Header ( "Accept-Ranges: bytes" ); 
            // Content-Length是指定包含于请求或响应中数据的字节长度  
            $file = fopen ( $file_dir . $file_name, "r" );
            //输入文件标签     
            // Header ( "Content-type: application/octet-stream" );    
            // Header ( "Accept-Ranges: bytes" );    
            // Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );    
            // Header ( "Content-Disposition: attachment; filename=" . $file_name );

            if (strpos($_SERVER["HTTP_USER_AGENT"],'MSIE'))
                Header('Content-Disposition: attachment; filename=' . $file_name );  
            else if (strpos($_SERVER["HTTP_USER_AGENT"],'Firefox'))
                Header('Content-Disposition: attachment; filename=' . $file_name );  
            else 
                Header('Content-Disposition: attachment; filename=' . $file_name );
            //输出文件内容     
            //读取文件内容并直接输出到浏览器    
            echo fread ( $file, filesize ( $file_dir . $file_name ) );    
            fclose ( $file );    
            exit ();
        }
    }

    public function actionWord2html($id)
    {
        $file_dir='./uploads/file/article/';
        $word = new cword();
        $article=Article::model()->find('id='.$id);
        if($article->file=='')
        {
            $text1=explode('<image>',$article->content);
            $img1=explode(',',$article->image);
              //  $text1=explode('<image>',$text->f_msg);
              // $img1=explode(',',$img->f_msg);
            $index=0;
            $word->start();
            echo '<div>';
            foreach($text1 as $k)
            {
                echo '<pre>'.$k.'</pre>';
                if($index<count($img1)-1)
                {
                    echo '<img width="500" height="300" src="'.Yii::app()->request->hostInfo.'/new_hs_yii/uploads/image/article/'.$img1[$index++].'">'; 
                }
            }
            echo '</div>';

            $file_name=$article->title.'-'.$article->author.'.doc';
            $word->save($file_dir.$file_name);
            ob_flush();//每次执行前刷新缓存
        }
        else{
            $file_name=substr($article->file,strripos($article->file,'_',0)-1);
            //$file_name=$article->file;
            //header("Content-type:text/html;charset=gbk");
            //$word->save($file_dir.$file_name);
            //flush();
        }
        put_msg($file_dir . $file_name);
        if (!file_exists($file_dir.$file_name )) {    
            header('HTTP/1.1 404 NOT FOUND');  
        } 
        else {    
            // 以只读和二进制模式打开文件   
            // $file = fopen ( $file_dir . $file_name, "rb" ); 
            // 告诉浏览器这是一个文件流格式的文件    
            Header ( "Content-type: application/octet-stream" ); 

            // Header("Content-type: Image/jpg");
            //请求范围的度量单位  
            Header ( "Accept-Ranges: bytes" );  
            // Content-Length是指定包含于请求或响应中数据的字节长度  
            $file = fopen ( $file_dir . $file_name, "r" );    
            //输入文件标签      

            if (strpos($_SERVER["HTTP_USER_AGENT"],'MSIE')) {  
            header('Content-Disposition: attachment; filename=' . $file_name );  
            }else if (strpos($_SERVER["HTTP_USER_AGENT"],'Firefox')) {  
            Header('Content-Disposition: attachment; filename=' . $file_name );  
            } else {  
            header('Content-Disposition: attachment; filename=' . $file_name );  
            }

            //输出文件内容     
            //读取文件内容并直接输出到浏览器    
            echo fread ( $file, filesize ( $file_dir . $file_name ) );  
            fclose ( $file );    
            exit ();      
        }   
    }


}
//！！！！！
 class cword
{
    function start()
    {
        ob_start();
        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:w="urn:schemas-microsoft-com:office:word"
        xmlns="http://www.w3.org/TR/REC-html40">';
    }
    function save($path)
    {
      
        echo "</html>";
        $data = ob_get_contents();
        ob_end_clean();
        $this->wirtefile ($path,$data);

    }
  
    function wirtefile ($fn,$data){
        $fp=fopen($fn,"wb");
        fwrite($fp,$data);
        fclose($fp);
        }
    }