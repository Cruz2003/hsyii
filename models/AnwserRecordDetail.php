<?php

use yii\validatoers;

class AnwserRecordDetail extends BaseModel {

    public function tableName() {
        return '{{anwser_record_detail}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('answer_record_id,question_id,answer,is_right','safe'), 
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
			'answer_record_id'=>'记录id',
			'question_id'=>'问题id',
            'answer'=>'回答',
			'is_right'=>'是否正确',

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
