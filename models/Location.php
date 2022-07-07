<?php

use yii\validatoers;

class Location extends BaseModel {

    public function tableName() {
        return '{{location}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('name,pid','safe'), 
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
            'name'=>'名字',
            'level'=>'上级id',
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
