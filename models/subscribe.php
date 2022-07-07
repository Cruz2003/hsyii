<?php

use yii\validatoers;

class subscribe extends BaseModel {

    public function tableName() {
        return '{{subscribe}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            
		);
    }	


    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
            // 'stu'=>array(self::HAS_MANY, 'user', 'school'),
            // 'num' => array(self::STAT, 'user', 'school'),
           'subscribe_user'=>array(self::BELONGS_TO, 'user', ['subscribe_id'=>'userid']),
           'subscribed_user'=>array(self::BELONGS_TO, 'user', ['subscribed_id'=>'userid']),
		);
    }

    /**
     * 属性标签
     */
    public function attributeLabels() {
        return array(
			
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
