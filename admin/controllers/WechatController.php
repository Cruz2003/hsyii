<?php

class IndexController extends BaseController
{

protected $model = '';
    public function init()
    {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }
  //public $layout = false;

  /*public function actionGetId()
  {
        $code = Yii::$app->request->post('code');
        $params = Yii::$app->params['wechat.payment.platform'];
        $config = [
            'appid' => $params['appid'],
            'appsecret' => $params['appsecret']
        ];
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $config['appid'] . '&secret=' .    $config['appsecret'] . '&js_code=' . $code . '&grant_type=authorization_code';
        $data = file_get_contents($url);
        $access = json_decode($data);
        return $access;
  }*/
  public function actionSendmsg()
  {
     $msg='更新成功';
    $data=array();
    $data['msg']=$msg;
    echo CJSON::encode($data);
  }
 /*public function actionConfigUserInfo($open_id,$phone,$signature)
 {
      $modelName = 'User';
      $User=User::model()->find('open_id='.$open_id);
      if(isset($id))
      {
          $User->phone=$phone;
          $User->signature=$signature;
      }
      else
      {
        $model = new $modelName('create');
        $model->open_id=$open_id;
        $model->$phone=$phone;
        $model->$signature=$signature;
      }
      $msg='更新成功';
      $data = array();

      echo $msg;
}
      */
 

    echo CJSON::encode($data);
  

}