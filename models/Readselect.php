<?php

use yii\validatoers;

class Readselect extends BaseModel {

    public function tableName() {
        return '{{readselect}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('id,typename,image,introduce','safe'), 
            array('image', 'required', 'message' => '{attribute} 不能为空'),
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
            'typename'=>'阅读栏目名称',
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
