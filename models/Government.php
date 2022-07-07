<?php

use yii\validatoers;

class Government extends BaseModel {

    public function tableName() {
        return '{{government}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            array('num', 'required', 'message' => '{attribute} 不能为空'),
            array('department', 'required', 'message' => '{attribute} 不能为空'),
            array('name,num,department,describe','safe'), 
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
            'num'=>'编码',
            'department'=>'政府部门',
            'describe'=>'职能描述',
            
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
