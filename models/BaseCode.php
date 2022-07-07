<?php

class BaseCode extends BaseModel {
   var $d_path;
    public function tableName() {
        return '{{base_code}}';
    }

    /**
     * 模型验证规则
     */
    public function rules() {
        return array(
			array('F_TCODE', 'required', 'message' => '{attribute} 不能为空'),
			array('F_TYPECODE', 'required', 'message' => '{attribute} 不能为空'),
			array('F_NAME', 'required', 'message' => '{attribute} 不能为空'),
            array('f_id,F_TCODE,F_TYPECODE,F_CODE,F_NAME,f_value,F_SHORTNAME,fater_id,if_oper', 'safe'),
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
            'f_id' => '内部自增id',
            'F_TCODE' => '类型编码',
            'F_TYPECODE'=>'二级编码',
            'F_CODE'  =>  '编号',
            'F_NAME'  =>  '类型名称',
            'f_value'  =>  '取值使用',
            'F_SHORTNAME'  =>  '短名称',
            'fater_id'  =>  '父级ID',
            'if_oper' => '是否开放'
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

    // 获取单条数据，主表名转换为模型返回
    public function getOne($id, $ismodel = true) {
        $rs = $this->find('f_id=' . $id);
        if (!$ismodel) {
            return $rs;
        }

        if ($rs != null && $rs->user_table != '') {
            $modelName = explode(',',$rs->user_table);
            $arr = explode('_', $modelName[0]);
            $modelName[0] = '';
            foreach ($arr as $v) {
                $modelName[0].=ucfirst($v);
            }
            $rs->user_table = implode(',', $modelName);
            return $rs;
        } else {
            return $rs;
        }
    }

  public function getName($id) {
        $rs = $this->find('f_id=' . $id);
        return  str_replace(' ','',is_null($rs->F_NAME) ? "" : $rs->F_NAME);
    }

  public function getInputSetType() {
        return $this->findAll('arr_input_set_type > 0');
    }
  public function getGameState() {
        return $this->findAll('f_id in(151, 145, 146, 149)');
    }
    public function getCode($fater_id,$cond='') {
        return $this->findAll('fater_id=' . $fater_id.$cond);
    }
	
	public function getAttrtype() {
        return $this->findAll('fater_id in(349,350,360,362)');
    }
	
	public function getPurpose() {
        return $this->findAll('fater_id in(829,830)');
    }
	public function getPurpose2($f_id) {
        return $this->findAll('fater_id in(829,830) AND f_id<>'.$f_id);
    }
	
	public function getCustomer($f_id) {
        return $this->findAll('fater_id=208 AND f_id<>'.$f_id);
    }
	public function getPaytype($f_id) {
        return $this->findAll('fater_id=452 AND f_id<>'.$f_id);
    }
	public function getCounttype($f_id) {
        return $this->findAll('fater_id=711 AND f_id<>'.$f_id);
    }

    /**
     * 传过来的值调用单个或多个
     */
    public function getReturn($f_id,$whe='') {
        return $this->findAll('f_id in('.$f_id.')'.$whe);
    }
	public function getProductType() {
        return $this->findAll('f_id in(361,364)');
    }

	
	public function getOrderType2() {
        $cooperation= $this->getOrderType();
         $arr = array();$r=0;
        foreach ($cooperation as $v) {
                $arr[$r]['f_id'] = $v->f_id;
                $arr[$r]['F_NAME'] = $v->F_NAME;
                $arr[$r]['fater_id'] = $v->fater_id;
                $r=$r+1;
        }
        return $arr;
    }

	public function getOrderType() {
        return $this->findAll('fater_id in(350,360,362,367)');
    }
	
	public function getOrderType1() {
        return $this->findAll('fater_id in(350,362,367)');
    }
	
	public function getPayway() {
        return $this->findAll('f_id in(483,484,485)');
    }
	
	//return $this->findAll('fater_id in (8,9,189,380,495)');
	//return $this->findAll('fater_id=' . $f_id);
	public function getClubtype() {
		return $this->findAll('fater_id=10');
    }

    public function getClub_type2() {
        $cooperation= $this->getClub_type2_all();
        return toArray($cooperation,'f_id,F_NAME,fater_id');
    }

    /*wankai tianjia*/
    public function getGame_format() {
		return $this->findAll('fater_id in (984,985,988)');
    }

	public function getGame_format2() {
        $cooperation= $this->getGame_format2_all();
        $arr = array();
        $r=0;
        foreach($cooperation as $v){
            $arr[$r]['f_id'] = $v->f_id;
            $arr[$r]['F_NAME'] = $v->F_NAME;
            $arr[$r]['fater_id'] = $v->fater_id;
            $r=$r+1;
        }
        return $arr;
    }

    public function getGame_format2_all() {
        return $this->findAll('fater_id in (984)');
    }
    /*..........*/

   public function getClub_type2_all() {
        return $this->findAll('fater_id in (8,9,189,380,495)');
    }
	//return  $this->findAll("F_TCODE='PARTNAME' and fater_id<>10 and fater_id<>0");

    public function getSex($f_id=0) {
        return $this->findAll('f_id in (205,207)');
    }  
    public function getTypeCode() {//资质人类型261、identity_
        return $this->getCode(261);
    }

  public function getPicSetType() {//图集/视频./音频251
        return $this->getCode(251);
    }

public function getProjectState() {//项目状态/115
        return $this->getCode(505);
    }
public function getApproveState() {
        return $this->getCode(452);
    }
public function getAuthState() {
        return $this->getCode(455);
    }
public function getShenheState() {
        return $this->getCode(370);
    }
public function getPicType() {//125商品图片类型
        return $this->getCode(125);
    }
	

//资格证书类型122
public function getZheShuType() {///资格证书类型122
        return $this->getCode(122);
    }

//证件扫描图138
public function getZjImg() {///138证件扫描图
        return $this->getCode(138);
    }

//服务者类型383
public function getSservicType() {///388服务者类型描图
        return $this->getCode(383);
    }

   // 开关模式695
   // 
   public function getShowState() {///695服务者类型描图
        return $this->getCode(695);
    }

    // 学员申请状态
   public function getStatus() {///695服务者类型描图
        return $this->getCode(336);
    }

       // 学员申请状态
   public function getUsertype() {///695服务者类型描图
        return $this->getCode(886);
    }

    // 竞赛项目性别要求
    public function getCode_sex(){
        $cooperation=$this->getCode_sex_all();
        $arr = array();
        $r=0;
        foreach($cooperation as $v){
            $arr[$r]['f_id'] = $v->f_id;
            $arr[$r]['F_NAME'] = $v->F_NAME;
            $arr[$r]['fater_id'] = $v->fater_id;
            $r=$r+1;
        }
        return $arr;
    }

    public function getCode_sex_all() {
        return $this->findAll('fater_id=204');
    }

    // 赛事裁判审核方式
    public function getCode_way(){
        $cooperation= $this->getCode_way_all();
        $arr = array();
        $r=0;
        foreach($cooperation as $v){
            $arr[$r]['f_id'] = $v->f_id;
            $arr[$r]['F_NAME'] = $v->F_NAME;
            $arr[$r]['fater_id'] = $v->fater_id;
            $r=$r+1;
        }
        return $arr;
    }

    public function getCode_way_all() {
        return $this->findAll('fater_id=791');
    }

    // 赛事
    public function getCode_id2() {
        $cooperation= $this->getCode_id2_all();
         $arr = array();$r=0;
        foreach ($cooperation as $v) {
                $arr[$r]['f_id'] = $v->f_id;
                $arr[$r]['F_NAME'] = $v->F_NAME;
                $arr[$r]['F_TYPECODE'] = $v->F_TYPECODE;
                $arr[$r]['fater_id'] = $v->fater_id;
                $r=$r+1;
        }
        return $arr;
    }

     public function getCode_id() {
        
        return  $this->findAll('fater_id = 169');
    }

    public function temporary() {
        
        return  $this->findAll('fater_id = 1057');
    }


   public function getCode_id2_all() {
        return  $this->findAll('fater_id in (163,810)');
    }
	
	public function getQualificationType2() {
        $cooperation= $this->getQualificationType();
         $arr = array();$r=0;
        foreach ($cooperation as $v) {
                $arr[$r]['f_id'] = $v->f_id;
                $arr[$r]['F_NAME'] = $v->F_NAME;
                $arr[$r]['fater_id'] = $v->fater_id;
                $r=$r+1;
        }
        return $arr;
    }
	
	public function getQualificationType() {
        return $this->findAll('F_TCODE="WAITER" AND fater_id <>383');
    }

    public function getGameArrange2($pid) {
        $cooperation=$this->findAll('fater_id='.$pid);
        $arr = array();$r=0;
        foreach ($cooperation as $v) {
            $arr[$r]['f_id'] = $v->f_id;
            $arr[$r]['F_NAME'] = $v->F_NAME;
            $arr[$r]['fater_id'] = $v->fater_id;
            $r=$r+1;
        }
        return $arr;
    }
	
	public function getMembertype_all() {
        return  $this->findAll('fater_id in (10,383)');
    }
	
	public function getMembertype() {
        $cooperation=$this->findAll('fater_id in (10,383)');
        $arr = array();$r=0;
        foreach ($cooperation as $v) {
            $arr[$r]['f_id'] = $v->f_id;
            $arr[$r]['F_NAME'] = $v->F_NAME;
            $arr[$r]['fater_id'] = $v->fater_id;
            $r=$r+1;
        }
        return $arr;
    }
	
	public function getStateType() {
        return  $this->findAll('f_id in (371,372,373,721)');
    }
	
	public function getLogisticsType() {
        return  $this->findAll('f_id in (472,473,474,476)');
    }

    //扩充 记录对象转换成数组
  public function recToArray($tmp,$afieldstr) {
    $arr=array();
    $afieldstmp=explode(',',$afieldstr);
    if($tmp) //$rec=$tmp->attributes;
    foreach($afieldstmp as $v1){
      $a=explode(':',$v1);
      $r=$a[0]; $s1='';
      $r0=$r; $v20=0;
       if(isset($a[2])) {
         $s1= $a[2];//默认值
         $v20=1;
       }
      if(isset($a[1])){
          $r=(empty($a[1]))  ? $r : $a[1];//有别名
      }
      if($v20==0){ 
         $s1= $tmp->{$r0};//表的值
       }      
      $arr[$r]=$s1;
    }
    return $arr;
  }




function mk_dir($path){
/*
 写出一个能创建多级目录的PHP函数
 */
 $this->createdirlist($path,0777);
}
/*
 写出一个能创建多级目录的PHP函数
 */
 function createdirlist($path,$mode){
   if (is_dir($path)){
   //判断目录存在否，存在不创建
  //   echo "目录'" . $path . "'已经存在";
  //已经存在则输入路径
   }else{ //不存在则创建目录
      $re=mkdir($path,$mode,true);
  //第三个参数为true即可以创建多极目录
     if ($re){
   //    echo "目录创建成功";//目录创建成功
     }else{
     //  echo "目录创建失败";
      }
     }
  }
//$path="/a/x/cc/cd"; //要创建的目录
//$mode=0755; //创建目录的模式，即权限.
//createdirlist($path,$mode);//测试

  function delete_file($path_filename)
    { 
        return unlink($path_filename);
      }
  //删除网上的文件，包括路径，新文件纸，旧文件值
   function delete_file_set($path,$new_filenames,$old_filenames)
    {
        $old_file = explode(",",$old_filenames);
        for ($i = 0; $i < count($old_file); $i = $i + 1) {
           if (strpos($new_filenames,$old_file[$i]) == false)//不存在，要删除
           {
            $this->delete_file($path.$old_file[$i]);//，要删除
           }        
        }
    }

function getTime(){
 $time = explode ( " ", microtime () );  
 $time = "".($time [0] * 1000);  
 $time2 = explode ( ".", $time );  
 $time = $time2 [0]; 
 $s1=str_replace('-','',date('y-m-d h:i:s',time()));
 $s1=str_replace(':','',$s1);
 $s1=str_replace(' ','',$s1);
 return $this->get_date_ymd(2).$s1.$time;
//2010-08-29 11:25:26
}


  function get_filename($fillename_type){
   return $this->getTime().$fillename_type;
  }

 function get_relatively_filename($fillename_type){
   $fname=$this->get_filename($fillename_type);//read_max_value_key($where=" 1=1 ",$fields,$order)
   return  substr($fname,0,4).'/'.substr($fname,4,2).'/'.substr($fname,6,2).'/'.$fname;
   // relatively
  }

 
 function str_to_file_old($str_content,$filename) //内容保存文件/早期版本
    {  
       BasePath::model()->check_save_path($filename);//检查路径是否存在，不存在创建
       $filename=BasePath::model()->get_lpath().$filename;
       $fp = fopen($filename, 'w');
       if ($this->indexof(strtolower($filename),'.htm')>=0){
          $str_content=str_replace('\\"','"',$str_content);
       }
      $w=fwrite($fp,$str_content);
      $w=fclose($fp);
    }

 function str_to_file($str_content,$filename,$param) //内容保存文件
    {  
      if ($this->indexof(strtolower($filename),'.htm')>=0){
          $str_content=str_replace('\\"','"',$str_content);
       }
       $param['fileType']=".html";
       $param['oldfilename']=$filename;
       $data=$this->saveFileTo73($str_content,$param);
       return $data['code']==0?$data['filename']:"";
    }

    function str_to_html($str,$filename,$param) //内容保存文件
    { 
     
      $str=str_replace(BasePath::model()->get_wpath(),'<gf></gf>',$str);
      $str=str_replace(BasePath::model()->get_www_gwpath(),'<gw></gw>',$str);
      return $this->str_to_file($str,$filename,$param);
    }
    
   function str_to_html_ke4($str,$filename,$param) //内容保存文件
    {   
      $s0=BasePath::model()->get_www_path();
      $sw=BasePath::model()->get_www_gwpath();

      $sh1='<!doctype html><html><head><meta charset="utf-8">';
      $sh1.='<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">';
      $sh1.='<script type="text/javascript" src="'.$sw.'view/layout/info/rule/diyUpload/css/wap.js"></script>';
      $sh1.='<link rel="stylesheet" type="text/css" href="'.$sw.'view/layout/info/rule/diyUpload/css/wap.css" />';
      $sh1.='<style>';
      $sh1.='body{padding:5px;margin:0 auto; position:absolute;}';
      $sh1.='img{width:100%;height:auto;float:left;}';
      $sh1.='p,h1,h2,h3,h4,h5,h6,strong{margin:0px;}';
      $sh1.='</style>';
      $sh1.='<script type="text/javascript">';
      $sh1.='window.onload = function() { var h =document.body.scrollHeight;parent.postMessage(h,"'.$s0.'");}';
      $sh1.='</script><title></title></head>';
      $sh1.='<body align="absmiddle">';
     
      $st1='</body></html>';
      if($this->indexof($str,$st1)<0) { $str=$sh1.$str.$st1;}
      return $this->str_to_html($str,$filename,$param);
    }
    
    function file_to_str($filename)
     {
      $content="";
      if($this->indexof($filename,'.')>0){
             $filename= BasePath::model()->get_www_path().$filename;
      try{
           $handle = @fopen($filename,"rb");
           if ($handle>0){
           $i=0;
          do {
                $data = fread($handle, 8192);
                if (strlen($data) == 0) {
                   break; 
                }
               $content .= $data; 
            } while(true);
          @fclose ($handle);
         }
          $content=str_replace('\\"','"',$content);
        } 
        catch (Exception $e) {
         $content=""; 
       }
      }
        return  $content;
     }

     function file_to_html($filename)
     {
      $content=$this->file_to_str($filename);
      $content=str_replace('<gf></gf>',BasePath::model()->get_www_path(),$content);
      $content=str_replace('<gf><gf>',BasePath::model()->get_www_path(),$content);
      $content=str_replace('<gw></gw>',BasePath::model()->get_www_gwpath(),$content);
      return  $content;
     }
     
     /**
      * 文件流上传至73服务器, 表单上传、分段上传可查看fileuploader文件上传.docx 文档说明，位于主目录PHP下
      * @param $streamData 文件流
      * @param $suffix 后缀名
      * @param $codeName 上传文件属性代码
      * @return array('code'=>0,'message'=>'success','filname'=>'文件相对路径','fileUrl'=>'文件获取域名')，如code！=0，上传失败
      */
     function saveFileTo73($streamData,$param){
     
        $maxlen=5*1024*1024;//
        $seglen=1024*1024;//
    
        $suffix=empty($param['fileType'])?"":$param['fileType'];
        $codeName=empty($param['fileCode'])?"":$param['fileCode'];
        $oldfilenane=empty($param['oldfilename'])?"":$param['oldfilename'];
        $v_type=empty($param['v_type'])?252:$param['v_type'];
        $upload_id=empty($param['upload_id'])?"":$param['upload_id'];
      
        $upload_url=BasePath::model()->upload_url."FileUploader/";
        $slen=strlen($streamData);
        if($slen>$maxlen){
            $suffix=str_replace('.','',$suffix);
            $ask_url=$upload_url."upload?action=ask_new&";
            $segs=ceil($slen/$seglen);
            if(!empty($param['visit_id'])){
                $aesKey=$param['visit_key'];
                $ts=time();
                $sign_key=array('fileCode'=>$codeName,'type'=>$suffix,'size'=>$slen,'segs'=>$segs,'id'=>$upload_id,'ts'=>$ts,'v_type'=>$v_type,'file_md5'=>md5($streamData),'isdata'=>'false');
                $ask_url.="db_num=2&visit_id=".$param['visit_id']."&ts=".$ts."&enparam=".Aesencode::model()->aesEncrypt(json_encode($sign_key),$aesKey);
            }else{
                $ask_url.="fileCode=".$codeName."&type=".$suffix."&size=".$slen."&segs=".$segs."&id=".$upload_id."&isdata=false";
            }
            $ask_dat=CommonTool::model()->url_get($ask_url);



            $ask_json=json_decode($ask_dat, true);
            if(!empty($param['visit_id'])){
                $moreInfo=json_decode(Aesencode::model()->aesDecrypt($ask_json['moreInfo'],$param['visit_key']), true);
            }else{
                $moreInfo=$ask_json['moreInfo'];
            }
            $ask_json=array_merge($ask_json,$moreInfo);
            if($ask_json['code']==0&&!empty($ask_json['fileId'])){
                $suc=true;
                for($i=0;$i<$segs;$i++){
                    $data_url=$upload_url."upload?action=data&";
                    $ulen=$i==$segs-1?$slen-$i*$seglen:$seglen;
                    $start_l=$i*$seglen;
                    if(!empty($param['visit_id'])){
                        $aesKey=$param['visit_key'];
                        $ts=time();
     
                        $sign_key=array('fileid'=>$ask_json['fileId'],'start'=>$start_l,'length'=>$ulen,'segno'=>($i+1),'ts'=>$ts,'file_md5'=>md5($streamData));
                        $data_url.="db_num=2&visit_id=".$param['visit_id']."&ts=".$ts."&enparam=".Aesencode::model()->aesEncrypt(json_encode($sign_key),$aesKey);
                        $en_steam=CommonTool::model()->content_encrypt(substr($streamData,$start_l,$ulen),$aesKey);
                    }else{
                        $en_steam=substr($streamData,$start_l,$ulen);
                        $data_url.="fileid=".$ask_json['fileId']."&start=".$start_l."&length=".$ulen."&segno=".($i+1);
                    }
                    $opts = array(
                        'http' => array(
                            'method' => 'POST',
                            'header' => 'content-type:application/octet-stream;',
                            'content' => $en_steam
                        )
                    );
                    $context = stream_context_create($opts);
                    $response = file_get_contents($data_url, false, $context);
                    $data_json=json_decode($response, true);
                    if($data_json['code']!=0){
                        //记录上传失败的区块，重新上传
                        $suc=false;
                    }
                }
            }
     
            if($suc){
                return $ask_json;
            }else{
                return array('code'=>1,"message"=>"");
            }
        }else{
            $upload_url.="fileUpload?";
            if(!empty($param['visit_id'])){
                $aesKey=$param['visit_key'];
                $en_steam=CommonTool::model()->content_encrypt($streamData,$aesKey);
                $ts=time();
                $sign_key=array('fileCode'=>$codeName,'fileType'=>$suffix,'oldfilename'=>$oldfilenane,'ts'=>$ts,'v_type'=>252,'file_md5'=>md5($streamData));
                $upload_url.="db_num=2&visit_id=".$param['visit_id']."&ts=".$ts."&enparam=".Aesencode::model()->aesEncrypt(json_encode($sign_key),$aesKey);
            }else{
                $en_steam=$streamData;
                $upload_url.="fileCode=".$codeName."&fileType=".$suffix."&oldfilename=".$oldfilenane;
            }
            $opts = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'content-type:application/octet-stream;',
                    'content' => $en_steam
                )
            );

     
            $context = stream_context_create($opts);
            $response = file_get_contents($upload_url, false, $context);
            $return_json=json_decode($response, true);
            if(!empty($param['visit_id'])){
                $moreInfo=json_decode(Aesencode::model()->aesDecrypt($return_json['moreInfo'],$param['visit_key']), true);
                $return_json=array_merge($return_json,$moreInfo);
            }
            return $return_json;
        }
        
     }
     
     /**
      * 获取详细描述
      */
    function getContentById($id,$table,$column){
        global $p_clubnews;
        $url_dir=parent::get_base_path($table,$column);
        $list=parent::get_data_list("id=".$id,$column,$table,"",0,0,$column);
        $dat="";
        if(count($list))  {
            $url_name=$this->to_base64($list[0][$column]);
            if(empty($url_name)){
                return $dat;
            }
            $url=$url_dir.$url_name;
                $dat=CommonTool::model()->url_get($url);
            $dat=str_replace('<gw></gw>',BasePath::model()->get_www_gwpath(),$dat);
          $dat=str_replace('<gf></gf>',$url_dir,$dat);//替换图片路径，在HTML文件中 <gf></gf> 表示文件的路径的前部分$url_dir
          $dat=str_replace('<gf><gf>',$url_dir,$dat);
        }
        return $dat;
    }
    
    function getContentByFileName($dir,$filename){
        $url_name=$this->to_base64($filename);
        if(empty($filename)){
            return "";          
        }
        $url=$dir.$url_name;
        $dat=CommonTool::model()->url_get($url);
        $dat=str_replace('<gw></gw>',BasePath::model()->get_www_gwpath(),$dat);
        $dat=str_replace('<gf><gf>',$dir,$dat);
        return str_replace('<gf></gf>',$dir,$dat);//替换图片路径，在HTML文件中 <gf></gf> 表示文件的路径的前部分$url_dir
    }
    /**
     * html的不解码
     */
    function to_base64($htmlstr){
       return  (strpos($htmlstr,".html")=== false) ? parent::base64_decodeing($htmlstr) : $htmlstr; 
    }

    public  function down_list_bycode($pcode){
       $datalist=$this->getCode($pcode);
       return BaseLib::optionList($datalist,'f_id','F_NAME','0');
       //downList($datalist,$idname,$showname,$selectname,$pvalue='0')
    }

    
}
