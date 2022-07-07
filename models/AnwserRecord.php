<?php

use yii\validatoers;

class AnwserRecord extends BaseModel {

    public function tableName() {
        return '{{anwser_record}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('user_id,date,score,right_num,question_num','safe'), 
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
			'user_id'=>'用户id',
			'date'=>'日期',
            'score'=>'得分',
			'right_num'=>'答对数量',
            'question_num'=>'问题数量',

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
