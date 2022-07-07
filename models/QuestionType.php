<?php

use yii\validatoers;

class QuestionType extends BaseModel {

    public function tableName() {
        return '{{question_type}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array(  'id,type','safe'), 
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
			  'id' =>  'id',
              'type' =>  '题目类型',
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
