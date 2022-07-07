<?php

use yii\validatoers;

class Teacher extends BaseModel {

    public function tableName() {
        return '{{teacher}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			
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
			'teacher_name'=>'批改老师姓名',
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
