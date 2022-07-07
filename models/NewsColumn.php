<?php

use yii\validatoers;

class NewsColumn extends BaseModel {

    public function tableName() {
        return '{{news_column}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('name,introduce,start_time,end_time,pic','safe'), 
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
			'name'=>'栏目名称',
			'introduce'=>'栏目介绍',
			'start_time'=>'投稿时间',
            'end_time'=>'投稿结束时间',
            'column_img'=>'图片',
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
