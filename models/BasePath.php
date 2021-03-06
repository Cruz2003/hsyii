<?php

class BasePath extends BaseModel {

    public function tableName() {
        return '{{base_path}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
        return array(
                //array('', 'safe'),
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

    protected function beforeSave() {
        return true;
    }

    public function getPath($f_id="") {
        return trim(Yii::app()->request->hostInfo.'/www100/uploads/image/ ');
    }

    public function getPathFixed()
    {
        return trim(Yii::app()->request->hostInfo.'/new_hs_yii/uploads/');
    }

    public function getPicprefix($f_id="") {
        return trim(Yii::app()->request->hostInfo);
    }

    public function get_www_path($f_id="") {
        return trim(Yii::app()->request->hostInfo.'/new_hs_yii/');
    }

    public function getWwwPath($f_id="") {
        return trim(Yii::app()->request->hostInfo.'/new_hs_yii/');
    }

    public function diskPath($value='')
    {
        return trim('D:\wamp64\wamp64\www\new_hs_yii\uploads\temp/');
    }
}
