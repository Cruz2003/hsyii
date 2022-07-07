<?php

use yii\validatoers;

class MatchesInfo extends BaseModel {

    public function tableName() {
        return '{{matches_info}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
      
        return array(
			array('id,batch,first_player,first_game_score,first_game_max,first_score,second_player,second_game_score,second_score,second_game_max,pole_owner,state','safe'), 
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
              'first_player' =>  '一号选手',
              'first_game_score' => '一号选手局小分',
              'first_game_max' => '一号选手局内单杆最高分',
              'first_score' =>  '一号选手局得分',
              'second_player' =>  '二号选手',
              'second_game_score' => '二号选手局小分',
              'second_game_max' => '二号选手局内单杆最高分',
              'second_score' =>  '二号选手得分',
              'pole_owner' => '持杆人',
              'state' =>  '比赛状态',
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
