
<div class="box">
    <div class="box-title c">
<h1><i class="fa fa-table"></i>各学校投稿明细</h1></div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a style="display:none;" id="j-delete" class="btn" href="javascript:;" onclick="we.dele(we.checkval('.check-item input:checked'), deleteUrl);"><i class="fa fa-trash-o"></i>删除</a>
        </div><!--box-header end-->
        <div class="box-search">
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">

                    <label style="margin-right:10px;">
                    <span>学校：</span>
                    <span id="school_box">
                    <input style="width:50px;" class="input-text" name="school" value="<?php echo Yii::app()->request->getParam('school');?>">    
                    </span>                
                    <td colspan="1"><input id="school_select_btn" class="btn" type="button" value="选择学校"></td>
                </label>                  
 
               
      <button class="btn btn-blue" type="submit">查询</button>

            </form>
        </div><!--box-search end-->
        <div class="box-table">
           
            <table class="list">
                <thead>
                    <tr>
                         <th style="text-align:center"><?php echo $model->getAttributeLabel('id');?></th>
                        <th style="text-align:center"><?php echo $model->getAttributeLabel('school_name');?></th>
                        <th style="text-align:center"><?php echo $model->getAttributeLabel('article_num');?></th>
                        <th style="text-align:center"><?php echo $model->getAttributeLabel('refused_num');?></th>
                        <th style="text-align:center"><?php echo $model->getAttributeLabel('accepted_num');?></th>
                        
         
                        
                
                   
                        
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arclist as $v){ ?>
                    <tr>  
                    <td style="text-align:center"><?php echo $v->id; ?></td>  
                         <td style="text-align:center"><?php echo $v->school_name; ?></td>
                        <td style="text-align:center"><?php echo $v->article_num; ?></td>
                        <td style="text-align:center"><?php echo $v->refused_num; ?></td>
                        <td style="text-align:center"><?php echo $v->accepted_num; ?></td>
                    
                
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><!--box-table end-->
        <div class="box-page c"><?php $this->page($pages); ?></div>
    </div><!--box-content end-->
</div><!--box end-->
<script>


var $school_box=$('#school_box');
var $schoolName_school_id=$('#schoolName_school_id');
    $('#school_select_btn').on('click', function(){
      //  $.dialog.data('id', 0);
        $.dialog.open('<?php echo $this->createUrl("select/schoolName");?>',{
            id:'xuexiao',
            lock:true,
            opacity:0.3,
            title:'选择学校',
            width:'40%',
            height:'55%',
            close: function() {
                if($.dialog.data('id') > 0){
               //     id=$.dialog.data('id');
                  // $SupplierName_supplier_id.val($.dialog.data('id')).trigger('blur');
                        var name=$.dialog.data('school_name');
                    $school_box.html('<input style="width:50px;" class="input-text" type="text" name="school" value="'+name+'">'); 
                }
            }
        });
    }
)



</script>

