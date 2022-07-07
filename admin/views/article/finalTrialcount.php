  <style>
       .div {
           width: 90%;
       }

       .title {
           border-bottom: 30px;
       }

       .main {
            float:right;
           text-align: center;
           /* border: 1px solid black; */
       }
   </style>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>稿件总审》》<span style="color:DodgerBlue">已审稿件</span></h1>   </div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <div class="main">
            <a class="btn"  style="background-color: gray;"><i ></i>显示已审稿件</a>
            <a class="btn" href="<?php echo $this->createUrl('FinalTrial'); ?>"><i ></i>显示未审稿件</a>
             </div>
                       <a class="btn" href="<?php echo $this->createUrl('update3', array());?>" title="审核"><i class="fa fa-edit"></i>开始审核(待审<?php $index=0;foreach($article as $v){$index++;}echo $index;?>篇)</a></h1>
           
      
   <div class="box-title c">   
     <h1>
<i class="right">今天审核稿件数量</i><i><?php echo $this->showtrialnumber(3)?></i>
</h1>
 </div>


 <div class="box-search">
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
                <input type="hidden" name="news_type" value="<?php echo Yii::app()->request->getParam('news_type');?>">
                
                <label style="margin-right:10px;">
                    <span>日期：</span>
                    <input style="width:120px;" class="input-text" type="text" id="start_date" name="start_date" value="<?php echo Yii::app()->request->getParam('start_date',date("Y-m-d 00:00:00",time()));?>">
                    <span>-</span>      
                    <input style="width:120px;" class="input-text" type="text" id="end_date" name="end_date" value="<?php echo Yii::app()->request->getParam('end_date',date("Y-m-d 23:59:59",time()));?>">
                </label>
  
                <button class="btn btn-blue" type="submit">查询</button>

            </form>
            
        </div><!--box-search end-->





        <div class="box-table">
            <table class="list">
                <thead>
                    <tr>
                        <th style='text-align: center;'>序号</th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('title');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('school_name');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('type_name');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('author');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('grade');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('firsttrialtime');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('opinion1');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('opinion2');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('opinion3');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('status');?></th>
                   
                    </tr>
                </thead>
                <tbody>
                <?php $basepath=BasePath::model()->getPath(124);?>
<?php 
$index = 1;
foreach($arclist as $v){ 
?>
                    <tr>
                        
                        <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
                         <?php $l='';if($v->provinceName!='')  $l.=$v->provinceName->name;
                            if($v->cityName!='')  $l.=$v->cityName->name;
                            if($v->areaName!='')  $l.=$v->areaName->name;  ?>
                        <td style='text-align:center;'><?php echo $v->title; ?></td>
                        <td style='text-align:center;'><?php echo $v->title; ?></td>
                        <td style='text-align: center;'><?php echo $v->type_name; ?></td>
                        <td style='text-align: center;'><?php echo $v->author; ?></td>
                        <td style='text-align: center;'><?php echo $v->grade; ?></td>
                        
                            <!-- substr($v->file,0,strlen($v->file)-strrpos($v->file,'.')) -->
                        <td style='text-align: center;'><?php echo $v->finaltrialtime; ?></td>
                        <td style='text-align: center;'><?php echo $v->opinion1; ?></td>
                        <td style='text-align: center;'><?php echo $v->opinion2; ?></td>
                        <td style='text-align: center;'><?php echo $v->opinion3; ?></td>
                        <td style='text-align: center;'><?php echo $v->status_name; ?></td>
                        
                        
                        </td>
                    </tr>
<?php $index++; } ?>
                </tbody>
            </table>
        </div><!--box-table end-->
        
        <div class="box-page c"><?php $this->page($pages);?></div>
        
    </div><!--box-content end-->
</div><!--box end-->


<script>

var deleteUrl = '<?php echo $this->createUrl('delete', array('id'=>'ID')); ?>';
$(function(){
    var start_time=$('#start_date');
    var end_time=$('#end_date');
    start_time.on('click', function(){
        WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss'});});
    end_time.on('click', function(){
         WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss '});});

});
function preview(id){
 $.dialog.open('<?php echo $this->createUrl("Article/preview");?>&id='+id,{
            id:'article',
            lock:true,
            opacity:0.3,
            title:'文章预览',
            width:'600px',
            height:'100%',
            close: function() {
               we.reload();
                
            }
        });
 
}




// function read(wordname){
//  $.dialog.open('<?php echo $this->createUrl("Article/read");?>&wordname='+wordname,{
//             id:'article',
//             lock:true,
//             opacity:0.3,
//             title:'文章预览',
//             width:'700px',
//             height:'90%',
//             close: function() {
               
                
//             }
//         });
// }
</script>
