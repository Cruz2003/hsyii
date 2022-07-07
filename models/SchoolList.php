<?php

use yii\validatoers;

class SchoolList extends BaseModel {

    public function tableName() {
        return '{{school_list}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            array('school_name', 'required', 'message' => '{attribute} 不能为空'),
            array('school_code', 'required', 'message' => '{attribute} 不能为空'),
            array('province', 'required', 'message' => '{attribute} 不能为空'),
            array('city', 'required', 'message' => '{attribute} 不能为空'),
            array('stu_num', 'safe'),
			array('remark','safe'), 
		);
    }	


    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
            // 'stu'=>array(self::HAS_MANY, 'user', 'school'),
            // 'num' => array(self::STAT, 'user', 'school'),
             'provinceName'=>array(self::BELONGS_TO, 'location', ['province'=>'id'],'select'=>'name'),
             'cityName'=>array(self::BELONGS_TO, 'location', ['city'=>'id'],'select'=>'name'),
             'areaName'=>array(self::BELONGS_TO, 'location', ['area'=>'id'],'select'=>'name'),
		);
    }

    /**
     * 属性标签
     */
    public function attributeLabels() {
        return array(
			'school_code'=>'学校编码',
            'school_name'=>'学校名称',
            'location'=>'地区',
            'province'=>'省',
            'city'=>'市',
            'area'=>'区(县)',
            'stu_num'=>'学生人数',
            'remark'=>'备注',
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
