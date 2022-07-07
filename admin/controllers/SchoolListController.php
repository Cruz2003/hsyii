<?php

class SchoolListController extends BaseController
{

    protected $model = '';

    public function init()
    {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }
    public function actionDelete($id)
    {
        parent::_clear($id);
    }


    public function actionCreate()
    {
        $modelName = $this->model;
        $model = new $modelName('create');
        $data = array();
        if (!Yii::app()->request->isPostRequest) {
            $data['model'] = $model;
            $data['province'] = Location::model()->findAll('pid=0');
            $this->render('update', $data);
        } else {
            $this->saveData($model, $_POST[$modelName]);
        }
    }

  /*  public function actionUpdate($id)
    {
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        if (!Yii::app()->request->isPostRequest) {
            $data = array();
            $data['model'] = $model;
            $data['province'] = Location::model()->findAll('pid=0');
            if ($model->city != '')
                $data['city'] = Location::model()->findAll('pid=' . $model->province);
            if ($model->city != '')
                $data['area'] = Location::model()->findAll('pid=' . $model->city);
            $this->render('update', $data);
        } else {
            $this->saveData($model, $_POST[$modelName]);
        }
    }*/


    /*曾老师保留部份，---结束*/

    function saveData($model, $post)
    {
        $model->attributes = $post;
        show_status($model->save(), '保存成功', get_cookie('_currentUrl_'), '保存失败');
    }

    ///列表搜索
    public function actionIndex($keywords = '', $province = '', $city = '', $area = '', $grade = '')
    {
        set_cookie('_currentUrl_', Yii::app()->request->url);
        $data = array();
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $criteria->order = 'id';
        $criteria->condition = get_like($criteria->condition, 'school_name,school_code', $keywords, '');
        $criteria->join = 'left join location l1 on t.province=l1.id';
        $criteria->join = 'left join location l2 on t.city=l2.id';
        $criteria->join = 'left join location l3 on t.area=l3.id';

        if ($province != '') {
            $criteria->addCondition('province=' . $province);
            $data['city'] = Location::model()->findAll('pid=' . $province);
        }
        if ($city != '') {
            $criteria->addCondition('city=' . $city);
            $data['area'] = Location::model()->findAll('pid=' . $city);
        }
        if ($area != '') {
            $criteria->addCondition('area=' . $area);
        }
        if ($grade != '') {
            $count = Yii::app()->db->createCommand('SELECT school_name school,num from school_list s left JOIN (select school,count(id) num from user where grade=' . $grade . ' GROUP BY school ) u on s.school_name=u.school')->queryAll();
            $grade_num = array();
            foreach ($count as $c) {
                $grade_num[$c['school']] = $c['num'] == null ? 0 : $c['num'];
            }
            $data['grade_num'] = $grade_num;
        }
        $data['province'] = Location::model()->findAll('pid=0');

        parent::_list($model, $criteria, 'index', $data);
    }
}
