<?php

use yii\validatoers;

class Application extends BaseModel {

    public function tableName() {
        return '{{application}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('id,name,school,grade,user_id,contact,activity_id,province,city,content,experience,class,introduce,time','safe'), 
            array('submit_time','default','value'=>date('Y-m-d H:i:s',time())),
		);
    }	


    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
		 
		);
    }

    /**
     * 属性标签
     */
    public function attributeLabels() {
        return array(
			 'id'=>'ID',
            'name'=>'姓名',
            'school_name'=>'学校名称',
            'grade'=>'年级',
            'user_id'=>'学生ID',
            'contact'=>'联系电话',
            'activity_id'=>'活动id',
            'province'=>'省',
            'city'=>'市',
            'content'=>'参赛内容',
            'experience'=>'参赛经验',
            'class'=>'班级',
            'introduce'=>'自我介绍',
            'time'=>'报名时间',
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
