<?php

use yii\validatoers;

class Essay extends BaseModel {
    public $Article_pic='';
    public function tableName() {
        return '{{essay}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            // array('status', 'required', 'message' => '{attribute} 不能为空'),
            // array('teacher_name', 'required', 'message' => '{attribute} 不能为空'),
            // array('submit_time','default','value'=>date('Y-m-d H:i:s',time())),
            //  array('image', 'required', 'message' => '{attribute} 不能为空'),
            // array('image', 'required', 'message' => '{attribute} 不能为空'),
            //  array('school_name', 'required', 'message' => '{attribute} 不能为空'),
            //  array('province', 'required', 'message' => '{attribute} 不能为空'),
            //  array('city', 'required', 'message' => '{attribute} 不能为空'),
            // array('file', 'required', 'message' => '{attribute} 不能为空'),
            // array('publish_column', 'required', 'message' => '{attribute} 不能为空'),
            // array('publish_date', 'required', 'message' => '{attribute} 不能为空'),
            // array('frequency_id', 'required', 'message' => '{attribute} 不能为空'),
			array('title,user_id,content,author_id,author,grade,submit_time,status,status_name,file,share_state,good_mark,opinion0,province,city,area,school_name,school_code,school_location','safe'),
		);
        // return $this->attributeLabels();
    }	


    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
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
            'content'=>'内容',
            'introduce'=>'介绍',
            'image'=>'图片',
            'author_id'=>'作者id',
            'author'=>'作者',
            'grade'=>'年级',
            'submit_time'=>'投稿时间',
            'column_id'=>'投稿栏目id',
            'status'=>'状态',
            'status_name'=>'状态名',
            'file'=>'文档',
            'share_state'=>'是否展示，1是，0否',
            'type_id'=>'文章类型id',
            'type_name'=>'文章类型',
            'user_id'=>'用户账号',
            'good_mark'=>'点赞数',
            'opinion0'=>'拒稿/收稿原因',
            'province'=>'省',
            'city'=>'市',
            'area'=>'区（县）',
            'location'=>'地区',
            'school_location'=>'学校',
            'school_name'=>'学校名称',
            'school_code'=>'学校编码',
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
}
