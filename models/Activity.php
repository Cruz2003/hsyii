<?php

use yii\validatoers;

class Activity extends BaseModel {

    public function tableName() {
        return '{{activity}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('id,name,introduce,start_time,end_time,image','safe'), 
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
			'name'=>'活动名称',
            'introduce'=>'简介',
            'student_name'=>'报名学生名称',
            'student_id'=>'报名学生ID',
            'student_school'=>'报名学生学校',
            'student_grade'=>'报名学生年级',
            'start_time'=>'开始时间',
            'end_time'=>'截止时间',
            'end_date'=>'活动时间',
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
}
