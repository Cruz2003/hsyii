
<div class="box">
    <div class="box-title c">
        <h1><i class="fa fa-table"></i>信息列表</h1></div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
        </div><!--box-header end-->
        <div class="box-search">
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
                
                <label style="margin-right:10px;">
                    <span>学校：</span>
                    <span id="school_box">
                    <input style="width:50px;" class="input-text" name="school_name" value="<?php echo Yii::app()->request->getParam('school_name');?>">    
                    </span>                
                    <td colspan="1"><input id="school_select_btn" class="btn" type="button" value="选择学校"></td>
                </label> 
                <label style="margin-right:20px;">
                    <span>年级：</span>
                    <select name="grade">
                        <option value="">请选择</option>
                        <?php $grade=range(1,9); foreach($grade as $v){?>
                            <option value="<?php echo $v;?>"<?php if(Yii::app()->request->getParam('grade')==$v){?> selected<?php }?>><?php echo $v;?></option>
                        <?php }?>
                    </select>
                </label>
                <label style="margin-right:10px;">
                    <span>学生：</span>
                    <input style="width:200px;" class="input-text" type="text" placeholder="姓名" name="stu_name" value="<?php echo Yii::app()->request->getParam('stu_name');?>">
                </label>
 

                
                <button class="btn btn-blue" type="submit">查询</button>
            </form>
        </div><!--box-search end-->
        <div class="box-table">
            <table class="list">
                <thead>
                    <tr>
                    <th style='text-align: center;'>排名</th>
                    <th style='text-align: center;width: 300px'><?php echo $model->getAttributeLabel('school');?></th>
                    <th style='text-align: center;'><?php echo $model->getAttributeLabel('grade');?></th>
                    <th style='text-align: center;'><?php echo $model->getAttributeLabel('class');?></th>
                    <th style='text-align: center;'><?php echo $model->getAttributeLabel('user_name');?></th>
                    <th style='text-align: center;'><?php echo $model->getAttributeLabel('score');?></th> 
            
                    <th style='text-align: center;width: 90px'>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $index = 1;
                    foreach($arclist as $v){ 
                    ?>
                    <tr>
                        <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
                        <td style='text-align:center;'><?php echo $v->school; ?></td>
                        <td style='text-align:center;'><?php echo $v->grade; ?></td>
                        <td style='text-align:center;'><?php echo $v->class; ?></td>
                        <td style='text-align:center;'><?php echo $v->user_name; ?></td>
                        <td style='text-align:center;'><?php echo $v->score; ?></td> 
                                    
                        <td style='text-align: center; width: 90px'><input  class="btn" type="button" value="得分明细" onclick="score_detail_btn('<?php echo $this->createUrl("index_detail" , array('id'=>$v->id));?>')"></td>
                        
                    </tr>
                <?php $index++; } ?>
                </tbody>
            </table>
        </div><!--box-table end-->
        
        <div class="box-page c"><?php $this->page($pages);?></div>
        
    </div><!--box-content end-->
</div><!--box end-->
<script>
    var $school_box=$('#school_box');
var $SchoolName_school_id=$('#SchoolName_school_id');
    $('#school_select_btn').on('click', function(){
      //  $.dialog.data('id', 0);
        $.dialog.open('<?php echo $this->createUrl("select/schoolName");?>',{
            id:'xuexiao',
            lock:true,
            opacity:0.3,
            title:'选择学校',
            width:'45%',
            height:'100%',
            close: function() {
                if($.dialog.data('id') > 0){
               //     id=$.dialog.data('id');
                  // $SupplierName_supplier_id.val($.dialog.data('id')).trigger('blur');
                        var name=$.dialog.data('school_name');
                    $school_box.html('<input style="width:50px;" class="input-text" type="text" name="school_name" value="'+name+'">'); 
                }
            }
        });
    }
)

    function score_detail_btn(url){
      //  $.dialog.data('id', 0);
        $.dialog.open(url,{
            id:'score',
            lock:true,
            opacity:0.3,
            title:'得分明细',
            width:'45%',
            height:'95%',
            
        });
    }

</script>
