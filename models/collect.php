<?php

use yii\validatoers;

class collect extends BaseModel {

    public function tableName() {
        return '{{collect}}';
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
           'user'=>array(self::BELONGS_TO, 'user', ['user_id'=>'userid']),
           'article'=>array(self::BELONGS_TO, 'article', ['article_id'=>'id']),

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
