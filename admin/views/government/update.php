<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>政府部门职能信息</h1><span class="back"><a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span></div><!--box-title end-->
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
                    <tr>
                        <td width="30%"><?php echo $form->labelEx($model, 'num'); ?></td>
                       <td width="30%">
                            <?php echo $form->textField($model, 'num', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'num', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                	<tr>
                    	<td width="30%"><?php echo $form->labelEx($model, 'department'); ?></td>
                       <td width="30%">
                            <?php echo $form->textField($model, 'department', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'department', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                     <tr>
                        <td><?php echo $form->labelEx($model, 'describe');?></td>
                         <td > <?php echo $form->textArea($model, 'describe', 
                             array('class' => 'input-text', 'style'=>'width:97%;height:100px','maxlength' => '2000','placeholder'=>"本栏目限填2000字"));?>
                         <?php echo $form->error($model, 'describe', $htmlOptions = array());?>
                        </td>
                    </tr>

                     
                
         
                </table>
              
              
            </div><!--box-detail-tab-item end   style="display:block;"-->
            
        </div><!--box-detail-bd end-->
        
        <div class="box-detail-submit"><button onclick="submitType='baocun'" class="btn btn-blue" type="submit">保存</button><button class="btn" type="button" onclick="we.back();">取消</button></div>
       
    <?php $this->endWidget(); ?>
    </div><!--box-detail end-->
</div><!--box end-->
