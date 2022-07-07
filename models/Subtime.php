<?php

use yii\validatoers;

class Subtime extends BaseModel {
    public function tableName() {
        return '{{subtime}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            array('submit_time', 'required', 'message' => '{attribute} 不能为空'),
            // array('publish_column', 'required', 'message' => '{attribute} 不能为空'),
            // array('publish_date', 'required', 'message' => '{attribute} 不能为空'),
            // array('frequency_id', 'required', 'message' => '{attribute} 不能为空'),
			array('submit_time','safe'),
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
			
 );
}

    /**
     * Returns the static model of the specified AR class.
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
	 public static function put_time() {
        $this->isNewRecord = true;
        $this->submit_time=date('Y-m-d H:i:s',time());
        $this->save();
    }
	
    protected function beforeSave() {
        parent::beforeSave();
      
        return true;
    }
    public function getCode() {
        return $this->findAll('1=1');
    }
}
