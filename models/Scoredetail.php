<?php

use yii\validatoers;

class Scoredetail extends BaseModel {

    public function tableName() {
        return '{{score_detail}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            array('province', 'required', 'message' => '{attribute} 不能为空'),
            array('city', 'required', 'message' => '{attribute} 不能为空'),
			array('school,grade,class,user_name,finish_time,article_name,test_type,question,score,remark,school_name','safe'), 
		);
    }	


    /**
     * 模型关联规则
     */
    public function relations() {
        return array(
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
			'school'=>'学校',
            'grade'=>'年级',
            'class'=>'班级',
            'user_name'=>'学生',
            'finish_time'=>'完成时间',
            'article_name'=>'文章',
            'test_type'=>'测试类型',
            'question'=>'问题',
            'score'=>'得分',
            'province'=>'省',
            'city'=>'市',
            'area'=>'区(县)',
			
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
