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
<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>稿件总审》》<span style="color:DodgerBlue">未审稿件</span></h1>   </div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
             <div class="main">
            <a class="btn" href="<?php echo $this->createUrl('finalcountnumber'); ?>"><i ></i>显示已审稿件</a>
            <a class="btn"  style="background-color: gray;"><i ></i>显示未审稿件</a>
        </div>
          <a class="btn" href="<?php echo $this->createUrl('update3', array());?>" title="审核"><i class="fa fa-edit"></i>开始审核(待审<?php $index=0;foreach($article as $v){$index++;}echo $index;?>篇)</a></h1>
        </div><!--box-header end-->


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
                    <span>关键字：</span>
                    <input style="width:200px;" class="input-text" type="text" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords');?>">
                </label>
                <label style="margin-right:20px;">
                    <span>栏目：</span>
                    <select name="columnId">
                        <option value="">请选择</option>
                        <?php foreach($column as $v){?>
                            <option value="<?php echo $v->id;?>"<?php if(Yii::app()->request->getParam('columnId')==$v->id){?> selected<?php }?>><?php echo $v->name;?></option>
                        <?php }?>
                    </select>
                </label>
                 <label style="margin-right:20px;">
                    <span>文章类型：</span>
                    <select name="type">
                        <option value="">请选择</option>
                        <?php foreach($type as $v){?>
                            <option value="<?php echo $v->id;?>"<?php if(Yii::app()->request->getParam('type')==$v->id){?> selected<?php }?>><?php echo $v->type;?></option>
                        <?php }?>
                    </select>
                </label>
                  <label style="margin-right:20px;">
                    <span>年级：</span>
                    <select name="grade">
                        <option value="">请选择</option>
                        <?php $grade=range(1,9); foreach($grade as $v){?>
                            <option value="<?php echo $v;?>"<?php if(Yii::app()->request->getParam('grade')==$v){?> selected<?php }?>><?php echo $v.'年级';?></option>
                        <?php }?>
                    </select>
                </label>
                <label style="margin-right:10px;">
                    <span>日期：</span>
                    <input style="width:120px;" class="input-text" type="text" id="start_date" name="start_date" value="<?php echo Yii::app()->request->getParam('start_date',date("Y-m-d 00:00:00",time()+8*3600));?>">
                    <span>-</span>      
                    <input style="width:120px;" class="input-text" type="text" id="end_date" name="end_date" value="<?php echo Yii::app()->request->getParam('end_date',date("Y-m-d 23:59:59",time()+8*3600));?>">
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
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('introduce');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('type_name');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('author');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('grade');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('file');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('submit_time');?></th>
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
                        <td style='text-align:left;'><?php echo $v->title; ?></td>
                        <td style='text-align: center;'><?php echo $v->introduce; ?></td>
                        <td style='text-align: center;'><?php echo $v->type_name; ?></td>
                        <td style='text-align: center;'><?php echo $v->author; ?></td>
                        <td style='text-align: center;'><?php echo $v->grade; ?></td>
                        <td style='text-align: center;'>
                         <!--    <a href="<?php echo $this->createUrl('download', array('file_name'=>$v->file));?>" ><?php echo $v->file; ?></a>      -->
                            <a href="javascript:;" onclick="preview('<?php echo $v->id; ?>')" >预览</a>  
                            <a href="<?php echo $this->createUrl('word2html', array('id'=>$v->id));?>" >下载</a>    
                            <!-- <a href="javascript:;" onclick="read('<?php echo $v->file; ?>')" >预览</a> -->
                        </td>
                            <!-- substr($v->file,0,strlen($v->file)-strrpos($v->file,'.')) -->
                        <td style='text-align: center;'><?php echo $v->submit_time; ?></td>
                        <td style='text-align: center;'><?php echo $v->status_name; ?></td>
                        
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