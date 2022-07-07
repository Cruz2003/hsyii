<?php

use yii\validatoers;

class ArticleNum extends BaseModel {

    public function tableName() {
        return '{{articlenum_detail}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('school_name,article_num,refused_num,accepted_num','safe'), 
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
            'id'=>'序号',
			'school_name'=>'学校名称',
            'article_num'=>'投稿数',
            'refused_num'=>'被拒稿数',
            'accepted_num'=>'发表稿数',

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
