<?php
 
class ArticleNumController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }


    /*曾老师保留部份，---结束*/


///列表搜索
     public function actionIndex( $school = '') {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->order = 'article_num';
        $criteria->condition='1';
        if ($school!='') {
          $criteria->condition="(school='".$school."')";}
        $data = array();
        parent::_list($model, $criteria, 'index', $data);
    }

}
