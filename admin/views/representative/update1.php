<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>人大代表个人信息</h1><span class="back"> <!-- <a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span> --></div><!--box-title end-->
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
                        <td colspan="4"><?php echo $form->labelEx($model, 'num'); ?></td>
                        <td colspan="4">
                            <?php echo $form->textField($model, 'num', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'num', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'name'); ?></td>
                       <td>
                            <?php echo $form->textField($model, 'name', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'name', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'sex'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'sex', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'sex', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'birth'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'birth', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'birth', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'healthy'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'healthy', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'healthy', $htmlOptions = array()); ?>
                        </td>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'native_place'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'native_place', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'native_place', $htmlOptions = array()); ?>
                        </td>
                         <td><?php echo $form->labelEx($model, 'nation'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'nation', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'nation', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'work_time'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'work_time', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'work_time', $htmlOptions = array()); ?>
                        </td>
                         <td><?php echo $form->labelEx($model, 'party'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'party', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'party', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'education'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'education', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'education', $htmlOptions = array()); ?>
                        </td>
                        <td colspan="2"><?php echo $form->labelEx($model, 'degree'); ?></td>
                        <td colspan="2">
                            <?php echo $form->textField($model, 'degree', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'degree', $htmlOptions = array()); ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'type'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'type', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'type', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                     <td rowspan="2" colspan="2"><?php echo $form->labelEx($model, 'work'); ?></td>
                        <td rowspan="2" colspan="2">
                            <?php echo $form->textField($model, 'work', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'work', $htmlOptions = array()); ?>
                        <td colspan="2"><?php echo $form->labelEx($model, 'post_code1'); ?></td>
                        <td colspan="2">
                            <?php echo $form->textField($model, 'post_code1', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'post_code1', $htmlOptions = array()); ?>    
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $form->labelEx($model, 'phone1'); ?></td>
                        <td colspan="2">
                            <?php echo $form->textField($model, 'phone1', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'phone1', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                     <td rowspan="2" colspan="2"><?php echo $form->labelEx($model, 'home_adress'); ?></td>
                        <td rowspan="2" colspan="2">
                            <?php echo $form->textField($model, 'home_adress', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'home_adress', $htmlOptions = array()); ?>
                        <td colspan="2"><?php echo $form->labelEx($model, 'post_code2'); ?></td>
                        <td colspan="2">
                            <?php echo $form->textField($model, 'post_code2', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'post_code2', $htmlOptions = array()); ?>    
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $form->labelEx($model, 'phone2'); ?></td>
                        <td colspan="2">
                            <?php echo $form->textField($model, 'phone2', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'phone2', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $form->labelEx($model, 'delegation'); ?></td>
                        <td colspan="6">
                            <?php echo $form->textField($model, 'delegation', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'delegation', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="6" colspan="2"><?php echo $form->labelEx($model, 'experience'); ?></td>
                        <td rowspan="6" colspan="6">
                            <?php echo $form->textArea($model, 'experience', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'experience', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                </table>
              
              
            </div><!--box-detail-tab-item end   style="display:block;"-->
            
        </div><!--box-detail-bd end-->
        
        <div class="box-detail-submit"><button onclick="submitType='baocun'" class="btn btn-blue" type="submit">提交</button><!-- <button type="button" onclick="we.back();">取消</button></div> -->
       
    <?php $this->endWidget(); ?>
    </div><!--box-detail end-->
</div><!--box end-->
