<?php

use yii\validatoers;

class MatchLive extends BaseModel {

    public function tableName() {
        return '{{matches_list}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('id,batch,time,name,state','safe'), 
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
              'batch' => '批次',
              'time' => '比赛时间',
              'name' => '赛事名称',
              'state' => '比赛状态',
              'pole_owner' => '持杆人',
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
