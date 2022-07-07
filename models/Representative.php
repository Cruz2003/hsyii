<?php

use yii\validatoers;

class Representative extends BaseModel {

    public function tableName() {
        return '{{rd}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
            array('name,num,sex,birth,nation,party,education,check,work_time,healthy,degree,native_place,type,work,phone1,home_adress,phone2,post_code1,post_code2,delegation,experience','safe'), 
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
			'name'=>'姓名',
            'num'=>'编码',
            'sex'=>'性别',
            'birth'=>'出生年月',
            'nation'=>'民族',
            'party'=>'党派',
            'education'=>'文化程度',
            'check'=>'审核状态',
            'work_time'=>'参加工作时间',
            'healthy'=>'健康状态',
            'degree'=>'学位或技术职称',
            'native_place'=>'籍贯',
            'type'=>'代表类型',
            'work'=>'工作单位及职务',
            'phone1'=>'联系电话',
            'home_adress'=>'家庭住址',
            'phone2'=>'联系电话',
            'post_code1'=>'邮政编码',
            'post_code2'=>'邮政编码',
            'delegation'=>'所属代表团',
            'experience'=>'个人经历',
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
