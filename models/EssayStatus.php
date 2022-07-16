<?php

use yii\validatoers;

class EssayStatus extends BaseModel {

    public function tableName() {
        return '{{essay_status}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array(),
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
			'status_name'=>'审核状态',
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
