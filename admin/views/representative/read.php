<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>人大代表个人信息</h1><span class="back"><a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span></div><!--box-title end-->
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
                            <?php echo $model->num; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'name'); ?></td>
                       <td>
                            <?php echo $model->name; ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'sex'); ?></td>
                        <td>
                            <?php echo $model->sex; ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'birth'); ?></td>
                        <td>
                           <?php echo $model->birth; ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'healthy'); ?></td>
                        <td>
                            <?php echo $model->healthy; ?>
                        </td>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'native_place'); ?></td>
                        <td>
                            <?php echo $model->native_place; ?>
                        </td>
                         <td><?php echo $form->labelEx($model, 'nation'); ?></td>
                        <td>
                            <?php echo $model->nation; ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'work_time'); ?></td>
                        <td>
                            <?php echo $model->work_time; ?>
                         <td><?php echo $form->labelEx($model, 'party'); ?></td>
                        <td>
                           <?php echo $model->party; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'education'); ?></td>
                        <td>
                            <?php echo $model->education; ?>
                        </td>
                        <td colspan="2"><?php echo $form->labelEx($model, 'degree'); ?></td>
                        <td colspan="2">
                            <?php echo $model->degree; ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'type'); ?></td>
                        <td>
                            <?php echo $model->type; ?>
                        </td>
                    </tr>
                    <tr>
                     <td rowspan="2" colspan="2"><?php echo $form->labelEx($model, 'work'); ?></td>
                        <td rowspan="2" colspan="2">
                            <?php echo $model->work; ?>
                        <td colspan="2"><?php echo $form->labelEx($model, 'post_code1'); ?></td>
                        <td colspan="2">
                           <?php echo $model->post_code1; ?>  
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $form->labelEx($model, 'phone1'); ?></td>
                        <td colspan="2">
                            <?php echo $model->phone1; ?>
                    </tr>
                    <tr>
                     <td rowspan="2" colspan="2"><?php echo $form->labelEx($model, 'home_adress'); ?></td>
                        <td rowspan="2" colspan="2">
                            <?php echo $model->home_adress; ?>
                        <td colspan="2"><?php echo $form->labelEx($model, 'post_code2'); ?></td>
                        <td colspan="2">
                            <?php echo $model->post_code2; ?>   
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $form->labelEx($model, 'phone2'); ?></td>
                        <td colspan="2">
                            <?php echo $model->phone2; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $form->labelEx($model, 'delegation'); ?></td>
                        <td colspan="6">
                           <?php echo $model->delegation; ?>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="6" colspan="2"><?php echo $form->labelEx($model, 'experience'); ?></td>
                        <td rowspan="6" colspan="6">
                            <?php echo $model->experience; ?>
                        </td>
                    </tr>
                </table>
              
              
            </div><!--box-detail-tab-item end   style="display:block;"-->
            
        </div><!--box-detail-bd end-->
        
        <div class="box-detail-submit"><button type="button" class="btn btn-blue" onclick="we.back();">取消</button></div>
       
    <?php $this->endWidget(); ?>
    </div><!--box-detail end-->
</div><!--box end-->
