<?php
class WordLib  extends BaseModel {
    public  $word='';
    public  $file_name='';
    
    public function tableName() {
        return '{{base_code}}';
    }
        /**
     * 模型验证规则
     */
    public function rules() {
        return array(    );
    }

    /**
     * 模型关联规则
     */
    public function relations() {
        return array();
    }

    /**
     * 属性标签
     */

    public function attributeLabels() {
        return array();
    }
    /**
     * Returns the static model of the specified AR class.
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    function save_excel_file($dtype=0)
    {
        return (($dtype) ? getWwwPath():getLocalPath()).'Article'.Yii::app()->session['TCOD'].'.xls';
    }
    // iconv('gbk', 'utf-8', $text);
    function del_wordchar($s1)
    {
        $s1 = iconv('gbk', 'utf-8', $s1);
        $s2 = str_replace(chr(7), "", $s1);
        $s1 = str_replace(chr(13), "", $s2);
        $s1 = str_replace(chr(9), "  ", $s1);
        $s1 = str_replace(chr(1), "", $s1);
        return $s1;
    }

    function fill_pic($t=1,$r=1,$c=7)
    {
        $v = BaseInfo::model()->getInfo();
        $local_pic='D:\wamp64\wamp64\www\new_hs_yii\uploads\temp/'.BasePath::model()->reMovePath($v->head_portrait);
        //put_msg($local_pic);
        //$pic='D:\wamp64\www\scnursps\uploads\image\7edb056c8e1cc42060760789bd903f7.jpg';
        $pic= $this->insertPic($t,$r,$c,$local_pic);
    }

    public function insertPic($t,$r,$c,$pic)
    {
        //Word的另存为功能
        $p1 = new VARIANT($r, VT_I4);
        $p2 = new VARIANT($c, VT_I4);
        try {
            $this->word->ActiveDocument->tables($t)->Cell($p1, $p2)->Select();
            $app=$this->word->Application;
            $app->Selection->InlineShapes->AddPicture($pic);
        }
        catch(Exception $e)
        {
            //  put_msg('Message: ' .$e->getMessage());
        }
            // $se->InlineShapes->AddPicture($pic);//InlineShapes->AddPicture($pic);
            //    put_msg('coun='.$this->word->ActiveDocument->Shapes->Count);
            //  for($i=0;$i<$this->word->ActiveDocument->Shapes->Count;$i++){// 'Shapes 类型图片
            //$this->word->ActiveDocument->Shapes($i)->Height = 400;// '设置图片高度为 400px
            //$this->word->ActiveDocument->Shapes($i)->Width = 300; //设置图片宽度 300px
    }

    function del_enter($pos, &$wordp)
    {
        if(empty($wordp)){
            return ;
        }
        $w21 = $wordp->ActiveDocument->Paragraphs($pos)->Range->Start;
        $w22 = $wordp->ActiveDocument->Paragraphs($pos)->Range->End;
        if (($w22 - $w21) % 51 == 0) {
            $del_row = ($w22 - $w21) / 51;
        } else {
            if (($w22 - $w21) % 50 == 0) {
                $del_row = ($w22 - $w21) / 50;
            } else {
                $del_row = ($w22 - $w21) / 50 + 1;
            }
        }
        $del_row = intval($del_row);
        $r = 0;
        for ($i = $r; $i < $del_row; $i++) {
            $r++;
            $wordp->ActiveDocument->Paragraphs($pos + $r)->Range->Delete;
        }
    }

    //https://blog.51cto.com/u_3071373/799447
    /*
        $word = new cOM("word.application",null, CP_UTF8) or die("请安装word");
    */

    public function open($template,$save_file='' ){
        $nocom=1;
        $this->file_name=$template;
        $s1=BaseInfo::model()->getCode();
        try{
            $save_file=(empty($save_file)) ? $s1.$template : $save_file; 
        //$template = 'txps'; //评审表 2 推荐表
        $this->word='';
        $s1=BasePath::model()->copyFile($template.'.doc',$save_file.'.doc');
        $url = BasePath::model()-> diskPath().$save_file.'.doc';//diskPath()
        //put_msg($url);
        //$url=trim('http:\ ').'\zcps.scnu.edu.cn\scnursps\uploads\temp\20101288SQB.doc';
        // $url='D:\wamp64\www\scnursps\uploads\temp\20101288SQB.doc';
        $this->word = new COM("word.application",null,CP_UTF8) //解决乱码
            or die("Unable to instantiate Word");
        $nocom= $this->word->Documents->OPen($url);
        //  put_msg('ok91');
        }
        catch(Exception $e)
        {
            put_msg('Message: '.$e->getMessage());
        }
        return $url;
    }
/*
Table table = doc.Sections[].Tables[] as Spire.Doc.Table;
 
//在指定位置新插入一行作为第三行
TableRow row = table.AddRow();
table.Rows.Insert(, row);
 
//在表格末尾插入两行，分为带格式添加和不带格式添加。注意：这里的“4”不代表行数，而是原表格一行的单元格数
table.AddRow(true, );
table.AddRow(false, );
//保存并运行文档

 */
    public function addRow($t,$r) {
        // put_msg('line 138');
        //$row =$this->word->ActiveDocument->Tables(2)->Rows(12);
        // $row=$this->word->Range($table->Rows(12)->Range->Start,$table->Rows(12)->Range->End)->Select;
        //put_msg('line 138b');
        $Table = $this->word->ActiveDocument->Tables(1)->Rows->Add($row);//指定位置之前插入一行
        // put_msg('line 138c');
        return;
        // '获取第一个表格
        // put_msg('line 138');
        $table =  $this->word->ActiveDocument->tables($t);
        // put_msg('line 138AA');
        $BeforeRow=$table->Rows(3)->Range;
        // $this->word->Range($table->Rows(3)->Range->Start,$table->Rows(3)->Range->End)->Rows;
        // $BeforeRow=$this->word->ActiveDocument->tables($t)->Rows($r);
        // put_msg('line 138a');
        $s1=$table->Rows->Add($BeforeRow);
        // put_msg('line 138c');
  
        // $table->Rows->Insert($r, $s1);
        // put_msg('line 138b');
        //'添加一行到表格的最后
        //table.AddRow(true, 4)

        //'插入一行到表格的第三行
        //table.Rows.Insert(2, table.AddRow)
   }

    public function wordclose($word='') 
    {
        $this->word->Documents(1)->Close(); 
        $this->word->Quit();
        $this->word = null;
    }

    public function saveAs($name)
    {
        $name1= BasePath::model()->diskPath().$name.'.doc';  
        try {
            $this->word->Documents(1)->SaveAs($name1);
        }
        catch(Exception $e){}
        return  BasePath::model()->getWwwPath() . $name . '.doc';
    }

    public function toWord($lable,$value)
    {
        $w1 =$this->findStr($lable);
        $tmp = Reporttable::model()->find($w1);
        if(!empty($tmp)){
            $this->toCell($tmp->f_table,$tmp->f_row, $tmp->f_col,$value);
        } else{
        $this->replace($lable,$value);
        }
    }

    public function toCell($t,$r,$c,$value){
        try{
            //    $value.='AA';
            $ln1=mb_strlen($value);
            $value=$this->togb2312($value);//转换成GB2312 否则汉字出现乱码;
            $this->word->ActiveDocument->tables($t)->Cell($r, $c)->Range->Text = $value;
            $ln2=mb_strlen($value);
            $this-> toDelechar($t,$r,$c,$ln1,$ln2);
        }
        catch(Exception $e){
            put_msg('Message: ' );
        }
    }

    public function toDelechar($t,$r,$c,$ln1,$ln2){
        return ;
        try{
            $ls1=$this->word->ActiveDocument->tables($t)->Cell($r, $c)->Range->Start;
            $ls2=$this->word->ActiveDocument->tables($t)->Cell($r, $c)->Range->End;
            for($i=0;$i<1000;$i++){
                //   put_msg('line word 190a ='.$i );
                $s3=$this->word->ActiveDocument->Range($ls1+$ln1-2,$ls1+$ln1)->Text;
                $s3=$this->toutf8($s3);
                //  put_msg('line word 190b ='.$s3 );
                //     put_msg('line word 190 ='.$i );
                if($s3=='AA'){
                    break;
                }
                $ln1=$ln1-1;
            }
            $this->word->ActiveDocument->Range($ls1+$ln1-2,$ls2)->Text='';
        }
        catch(Exception $e) {
            put_msg('line errorord 202 ='.$i );
            //  put_msg('Message: ' .$e->getMessage());
        }
    }



    public function togb2312($value){
        return $value;// mb_convert_encoding($value, "GBK", "utf-8");
        return iconv("utf-8","GBK//IGNORE",$value);
        if(!(mb_strlen($s1)==mb_strlen($value))){
            $s1=iconv_substr($s1, 0, mb_strlen($value)-2, 'gb2312');
        }
        return $s1;
        //   $s1=iconv_substr($str, 1, 1, 'gb2312');
        //  return iconv("utf-8","gb2312//IGNORE",$value);
        //    Document1.Tables(t1).Cell(r1, c1).Range.Select()
    }

    public function toutf8($value){
        return $value;
        //  put_msg('line word 219 ' );
        try {
            $value =mb_convert_encoding($value, "utf-8");// iconv("gb2312","utf-8//IGNORE",$value);
        //      put_msg('line word 219ok ' );
        }
        catch(Exception $e)
        {
            $value ="err";
            //  put_msg('Message: ' .iconv("gbk","utf-8//IGNORE",$e->getMessage()));
            //  put_msg('Message235: ' );
        }
        return $value;

    }

    public function findStr($lable){
        return  "f_name='".$this->file_name."' and f_label='".$lable."'"; 
    }

    // $lable 标签
    // $data数据
    // $v 代替值，例如 好对应的  用 =>'√'
    public function cellfill($lable,$data,$v=''){
        $w1 =$this->findStr($lable);
        $tmp = Reporttable::model()->find($w1);
        if(!empty($tmp)){
            for($i=0;$i<$tmp->f_srow;$i++)
            for($j=0;$j<$tmp->f_scol;$j++){
                $s1=$data[$i][$j];
                $s1=(empty($s1)) ? "" : ((empty($v)) ? $s1 : $v);
                $this->toCell($tmp->f_table,$tmp->f_row+$i,$tmp->f_col+$j,$s1);
            }
        }//if
    }

    public function replace($findstr,$replacestr)  {
        $s1=$this->togb2312($findstr);
        $s2=$this->togb2312($replacestr);
        $fs=False;
        $s4='';
        try{
            $wapp=$this->word->ActiveDocument->ActiveWindow->Selection->Find;
            $wapp->ClearFormatting();
            $wapp->Replacement->ClearFormatting();
            $wdAll = 1;
            $wapp->Execute($s1,$fs,$fs,$fs,$fs,$fs,True,1,$fs,$s2,$wdAll);  
        }
        catch(Exception $e)
        { }
    }

/*      const 
$row = $word->ActiveDocument->Tables(1)->Rows(3);
$Table = $word->ActiveDocument->Tables(1)->Rows->Add($row);//指定位置之前插入一行

 // $this->word->ActiveDocument->ActiveWindow->Selection->Find->Text=$s1;
   // $this->word->ActiveDocument->ActiveWindow->Selection->Find->Replacement->Text=$s2;
//    $this->word->ActiveDocument->ActiveWindow->Selection->Find->Forward=True;
  //  $this->word->ActiveDocument->ActiveWindow->Selection->Find->Wrap = $wdAll;
   // $this->word->ActiveDocument->ActiveWindow->Selection->Find->Format = False;
   // $this->word->ActiveDocument->ActiveWindow->Selection->Find->MatchCase = False;
   // $this->word->ActiveDocument->ActiveWindow->Selection->Find->MatchWholeWord = False;
    //$this->word->ActiveDocument->ActiveWindow->Selection->Find->MatchByte = True;
   // $this->word->ActiveDocument->ActiveWindow->Selection->Find->MatchWildcards = False;
   // $this->word->ActiveDocument->ActiveWindow->Selection->Find->MatchSoundsLike = False;
   //  $s2=$this->word->ActiveDocument->ActiveWindow->Selection->Find->Execute();
  
    object unitsStory = Word.WdUnits.wdStory;
    object moveType = Word.WdMovementType.wdMove;
    wordApp.Selection.HomeKey(ref unitsStory, ref moveType);
    wordApp.Selection.Find.ClearFormatting();
    wordApp.Selection.Find.Replacement.ClearFormatting();  //tried removing this, no luck
    object replaceTextWith = DateTime.Now.ToString("MM/dd/yyyy");
    object textToReplace = "<DATE>";
    object replaceAll = Word.WdReplace.wdReplaceAll;
    object typeMissing = System.Reflection.Missing.Value;
    wordApp.Selection.Find.Execute(ref textToReplace, ref typeMissing, 
        ref typeMissing, ref typeMissing, ref typeMissing, ref typeMissing, 
        ref typeMissing, ref typeMissing, ref typeMissing, ref typeMissing, 
        ref replaceTextWith, ref replaceAll, ref typeMissing, ref typeMissing, 
        ref typeMissing, ref typeMissing);


.Forward = True
.Wrap = wdFindContinue
.Format = False
.MatchCase = False
.MatchWholeWord = False
.MatchByte = True
.MatchWildcards = False
.MatchSoundsLike = False
.MatchAllWordForms = False
   $wapp=$this->word->ActiveDocument->ActiveWindow->Selection->Find;
        $wapp->ClearFormatting();
        $wapp->Replacement->ClearFormatting();
        $wapp->Text=$this->togb2312($findstr);
        $wapp->Replacement->Text=$this->togb2312($replacestr);
        $wapp->Forward=True;
        $wdReplaceAll = 1;
        $wapp->Wrap = $wdReplaceAll;
        $wapp->Format = False;
 
        $s2=$wapp->Execute();
  wdFindContinue = 1;
  wdReplaceOne = 1;
  wdReplaceAll = 2;
 app.Selection.Find.Replacement.ClearFormatting();

            app.Selection.Find.Execute("[organisation]", missing, missing, missing, missing, missing, missing, missing,
                missing, "Firedepartment");
            app.Selection.Find.Execute("[trainer]", missing, missing, missing, missing, missing, missing, missing,
                missing, "John Silver");

            app.Selection.Find.Execute("[trainee]", missing, missing, missing, missing, missing, missing, missing,
                missing, "Smith");
var 
  WordApp: Variant;
 
begin
  // create OLE object for MS Word application:
  WordApp := CreateOLEObject('Word.Application');
  // load a document from your file
  WordApp.Documents.Open(yourDocFileName);
  WordApp.Selection.Find.ClearFormatting;
  WordApp.Selection.Find.Text := yourStringForSearch;
  WordApp.Selection.Find.Replacement.Text := yourNewStringForReplace;
  WordApp.Selection.Find.Forward := True;
  WordApp.Selection.Find.MatchAllWordForms := False;
  WordApp.Selection.Find.MatchCase := False;
  WordApp.Selection.Find.MatchWildcards := False;
  WordApp.Selection.Find.MatchSoundsLike := False;
  WordApp.Selection.Find.MatchWholeWord := False;
  WordApp.Selection.Find.MatchFuzzy := False;
  WordApp.Selection.Find.Wrap := wdFindContinue; 
  WordApp.Selection.Find.Format := False;
         WordApp.Selection.Find.Wrap = wdFindContinue
        WordApp.Selection.Find.Format = False

        WordApp.Selection.Find.Execute()
  WordApp.Selection.Find.Execute(Replace := wdReplaceAll)
end;
 */
        //$w1 ="f_name='TXPS' and f_label='".$lable."'"; //评审表 2 推荐表
        //$tmp = Reporttable::model()->getlableset($template);
        //if($empty($tmp)){
        //    $this->word->Tables( $tmp->f_table)->Cell($tmp->f_row, $tmp->f_col)->Range->Text = $value;
       // }

    public function bopen($template0 = '',$nocom=0)
    {
        // $t = $this->get_tcode();
        // $this->get_tcode() = '20175053';
        $nocom=1;
        $template = ($template0 == '1') ? 'PSB' : 'TZB'; //评审表 2 推荐表
        $this->tablename=$template;
        $this->label = Reporttable::model()->getlableset($template);
        $word='';
        $url = BasePath::model()-> diskPath() . $template . '.doc';
        if($nocom==0){
         $word = new COM("word.application") or die("Unable to instantiate Word");
          $word->Documents->OPen($url);
        }
        $modelName = $this->model;
        $model = $modelName::model();
        $criteria = new CDbCriteria;
        $w = $this->get_tcode();
        $w1 = get_year();
        $criteria->condition = get_like('1', 'teacher_code', $w);
        $criteria->condition = get_like($criteria->condition, 'f_year', $w1);
        $data = BaseInfo::model()->find($criteria);
        $this->set_report_data($w, $template);
        $w0="f_tcode='" . $w . "' and f_name='" . $template . "'";
        //    put_msg($w0);
        Reportdata::model()->deleteAll($w0);
        if ($template0 == '1') {
           // $this->fill_psb_word($word);
        } 
        else {
         //   $this->fill_tzb_word($word);
        }
        // $w0="f_tcode='" . $w . "' and f_name='" . $template . "'";
        $tmp = ReportdataNew::model()->find($w0);
        $s1 = BasePath::model()->downPath();
        $s1 = str_replace('/', trim(' \ '), $s1);
        $template =$this->tablename . $this->get_tcode() . "_" . $tmp->f_new; //
        $template .= '.doc';
        $a=array('f_new'=>$tmp->f_new+1);
          
        ReportdataNew::model()->updateAll($a,$w0);
        if($nocom==0){
            $word->Documents(1)->SaveAs($s1 . $template);
            $word->Quit();
        } 

        //$this->get_tcode() = $t;    
        return BasePath::model()->getWwwPath() . $template;
    }



    function fill_wordf($tbn, $row, $col, $value, $wordp='')
    {
       $this->save_table_data($tbn, $row, $col, $value);
       return ;
    }

    public function fillBlank($tbn, $rowstart, $rowend, $colstart,$colend) {
        for ($i = $rowstart; $i <$rowend; $i++) {
        // put_msg('blank='.$tbn.',line ='.$i);
            for ($j =$colstart; $j <= $colend; $j++) {  
                $this-> toCell($tbn, $i, $j,'');//$tbn.','.$i.','.$j
            }
        }
    }


}  //end class