<?php

use yii\validatoers;

class Rank extends BaseModel {

    public function tableName() {
        return '{{rank}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('user_id,user_name,score','safe'), 
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
			'user_id'=>'用户ID',
            'school'=>'学校',
            'grade'=>'年级',
            'class'=>'班级',
			'user_name'=>'用户名称',
            'score'=>'得分',
         
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
