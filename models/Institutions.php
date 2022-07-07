<?php

use yii\validatoers;

class Institutions extends BaseModel {

    public function tableName() {
        return '{{institutions}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('name,column,introduce','safe'), 
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
			'name'=>'机构名称',
            'column'=>'报刊栏目',
            'introduce'=>'简介',
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
