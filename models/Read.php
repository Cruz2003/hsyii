<?php

use yii\validatoers;

class Read extends BaseModel {

    public function tableName() {
        return '{{read}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('id,name,image,introduce,content,type_id','safe'), 
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
			'name'=>'栏目文章名称',
            'content'=>'内容',
            'image'=>'图片',
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
