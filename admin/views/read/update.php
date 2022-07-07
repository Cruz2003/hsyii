<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>修改栏目文章信息</h1><span class="back"><a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span></div><!--box-title end-->
    <div class="box-detail">
    <?php  $form = $this->beginWidget('CActiveForm', get_form_list());?>
        <div class="box-detail-tab">
            <ul class="c">
                <li class="current">基本信息</li>
            </ul>
        </div><!--box-detail-tab end-->
        <div class="box-detail-bd">
            <div style="display:block;" class="box-detail-tab-item">
                <table>
                	<tr class="table-title">
                    	<td colspan="2">栏目信息</td>
                    </tr>
                	<tr>
                    	<td width="30%"><?php echo $form->labelEx($model, 'name'); ?></td>
                       <td width="30%">
                            <?php echo $form->textField($model, 'name', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'typename', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                         <td><?php echo $form->labelEx($model, 'introduce'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'introduce', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'introduce', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                     <tr>
                         <td><?php echo $form->labelEx($model, 'content'); ?></td>
                       
                            <td colspan="1">
                            <?php echo $form->textArea($model, 'content', array('class' => 'input-text', 'style'=>'width:97%;height:300px;resize:none','maxlength' => '6000','placeholder'=>"栏目文章内容")); ?>
                            <?php echo $form->error($model, 'content', $htmlOptions = array()); ?>
                        </td>
                        </td>
                    </tr>
                       <tr>
                         <td><?php echo $form->labelEx($model, 'image'); ?></td>
                        <td>
                            <?php echo $form->hiddenField($model, 'image', array('class' => 'input-text fl')); ?>
                            <!-- face_game_bigpic -->
                            <?php $basepath=BasePath::model()->getPath().'read/';
                            $picprefix='';
                            //$model->news_pic='t1234.jpg';
                            //if($basepath){ $picprefix=$basepath; }?>
                         <div class="upload_img fl" id="upload_pic_NewsColumn_pic"> 
                          <?php if(!empty($model->image)) {?>
                             <a href="<?php echo $basepath.$model->image;?>" target="_blank">
                             <img src="<?php echo $basepath.$model->image;?>" width="100">
                             </a>
                             <?php }?>
                             </div>
                            <script>we.uploadpic('<?php echo get_class($model);?>_image','<?php echo $picprefix;?>','','','',0);</script>
                            <?php echo $form->error($model, 'image', $htmlOptions = array()); ?>
                        </td>
                    </tr>
         
                </table>
              
              
            </div><!--box-detail-tab-item end   style="display:block;"-->
            
        </div><!--box-detail-bd end-->
        
        <div class="box-detail-submit"><button onclick="submitType='baocun'" class="btn btn-blue" type="submit">保存</button><button class="btn" type="button" onclick="we.back();">取消</button></div>
       
    <?php $this->endWidget(); ?>
    </div><!--box-detail end-->
</div><!--box end-->
<script>
    $(function(){
        var start_time=$('#NewsColumn_start_time');
        var end_time=$('#NewsColumn_end_time');
        start_time.on('click', function(){
            WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss'});});
        end_time.on('click', function(){
            WdatePicker({startDate:'%y-%M-%D 00:00:00',dateFmt:'yyyy-MM-dd HH:mm:ss '});});

    });
</script>