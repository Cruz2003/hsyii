<?php

use yii\validatoers;

class Article extends BaseModel {
    public $Article_pic='';
    public function tableName() {
        return '{{article}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            array('status', 'required', 'message' => '{attribute} 不能为空'),
           // array('teacher_name', 'required', 'message' => '{attribute} 不能为空'),
            array('submit_time','default','value'=>date('Y-m-d H:i:s',time())),
          //  array('image', 'required', 'message' => '{attribute} 不能为空'),
           // array('image', 'required', 'message' => '{attribute} 不能为空'),
          //  array('school_name', 'required', 'message' => '{attribute} 不能为空'),
          //  array('province', 'required', 'message' => '{attribute} 不能为空'),
          //  array('city', 'required', 'message' => '{attribute} 不能为空'),
            // array('file', 'required', 'message' => '{attribute} 不能为空'),
            // array('publish_column', 'required', 'message' => '{attribute} 不能为空'),
            // array('publish_date', 'required', 'message' => '{attribute} 不能为空'),
            // array('frequency_id', 'required', 'message' => '{attribute} 不能为空'),
			array('title,introduce,content,author,author_id,submit_time,type_name,type_id,column_id,file,grade,opinion0,opinion1,opinion2,opinion3,publish_column,publish_date,frequency_id,teacher_name,teacher_id','safe'),
		);
    }	


    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
            'frequency'=>array(self::BELONGS_TO, 'frequency', ['frequency_id'=>'id'],'select'=>'name'),
            'provinceName'=>array(self::BELONGS_TO, 'location', ['province'=>'id'],'select'=>'name'),
            'cityName'=>array(self::BELONGS_TO, 'location', ['city'=>'id'],'select'=>'name'),
            'areaName'=>array(self::BELONGS_TO, 'location', ['area'=>'id'],'select'=>'name'),
        );
    }

    /**
     * 属性标签
     */
    public function attributeLabels() {
        return array(
			'id'=>'ID',
			'title'=>'标题',
			'introduce'=>'摘要',
            'content'=>'内容',
			'author'=>'作者',
            'author_id'=>'作者id',
            'submit_time'=>'投稿时间',
            'column_id'=>'投稿栏目id',
            'file'=>'文档',
            'grade'=>'年级',
            'status'=>'审核状态',
            'type_name'=>'文章类型',
            'good_mark'=>'点赞数',
            'opinion0'=>'拒稿/收稿原因',
            'opinion1'=>'一审意见',
            'opinion2'=>'二审意见',
            'opinion3'=>'总审意见',
            'publish_column'=>'发表栏目',
            'publish_date'=>'发表时间',
            'frequency_id'=>'刊期',
            'school_location'=>'学校',
            'school_name'=>'学校名称',
            'province'=>'省',
            'city'=>'市',
            'area'=>'区（县）',
            'location'=>'地区',
            'firsttrialtime'=>'审核时间',
            'teacher_name'=>'指派老师姓名',
            'image'=>'图片',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getCode() {
        return $this->findAll('1=1');
    }

    

    // protected function afterFind() {
    //    parent::afterFind();
    //    $this->tmpname=ss::model()->readValue('id='.$this->wid,'name');
    //    return true;
    // }

    //多表联查
    public $column_name = '';
    protected function afterFind() 
    {   
        parent::afterFind();
        if(isset($this->column_id))
        {
            $this->column_name = NewsColumn::model()->readValue('id='.$this->column_id, 'name');
            return true;
        }
    }
}
