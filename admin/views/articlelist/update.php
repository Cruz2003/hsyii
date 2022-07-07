<?php
use yii\widgets\ActiveForm;
?>

<div class="box">
    <div class="box-title c">
        <h1><i class="fa fa-table"></i>稿件提交</h1><span class="back"><a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span>
    </div>
    <!--box-title end-->
    <div class="box-detail">
        <?php $form = $this->beginWidget('CActiveForm', get_form_list()); ?>
        <div class="box-detail-bd">
            <div style="display:block;" class="box-detail-tab-item">
                <div class="mt15">
                    <table>
                        <tr class="table-title">
                            <td colspan="11">稿件内容</td>
                        </tr>

                        <tr>
                            <td ><?php echo $form->labelEx($model, 'title'); ?></td>
                            <td colspan="10">
                            <?php echo $form->textField($model, 'title', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'title', $htmlOptions = array()); ?>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $form->labelEx($model, 'author'); ?></td>
                            <td colspan="2">
                                <?php echo $form->textField($model, 'author', array('class' => 'input-text')); ?>
                                <?php echo $form->error($model, 'author', $htmlOptions = array()); ?>
                            </td>
                            <td colspan="2"><?php echo $form->labelEx($model, 'grade'); ?></td>
                            <td colspan="2"> 
                                <select name="grade">
                                
                                    <option value="">请选择</option>
                                    <?php foreach($grade as $v){;?>
                                    <option value="<?php echo $v->id;?>"<?php if($v->id==$model->grade){?> selected<?php }?>><?php echo $v->class;?></option>
                                    <?php }?>
                                </select>
                            </td>
                            <td colspan="2"><?php echo $form->labelEx($model, 'type_name'); ?></td>
                            <td colspan="2"> 
                                <select  name="type_name">
                                    <option value="">请选择</option>
                                    <?php foreach($type as $v){;?>
                                    <option value="<?php echo $v->id;?>"<?php if($v->id==$model->type_name){?> selected<?php }?>><?php echo $v->type;?></option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <tr class="table-title">
                                <td colspan="11">学校信息</td>
                            </tr>
                        </tr>
                        <tr>
                            <td colspan="1">学校所在地</td>
                            
                            <td colspan="4">
                                <select name="province" id="province">
                                    <option value="">请选择</option>
                                    <?php foreach ($province as $v) { ?>
                                    <option value="<?php echo $v->id; ?>" <?php if ($model->province == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
                                        <?php } ?>
                                </select>
                                <?php echo $form->hiddenField($model, 'province', array('class' => 'input-text')); ?>
                                <?php echo $form->error($model, 'province', $htmlOptions = array()); ?>
                            </td>

                            
                            <td colspan="3">
                                <select name="city" id='city'>
                                    <option value="">请选择</option>
                                    <?php if (isset($city)) foreach ($city as $v) { ?>
                                            <option value="<?php echo $v->id; ?>" <?php if ($model->city == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo $form->hiddenField($model, 'city', array('class' => 'input-text')); ?>
                                    <?php echo $form->error($model, 'city', $htmlOptions = array()); ?>
                                </td>

                                
                                <td colspan="3">
                                    <select name="area" id='area'>
                                        <option value="">请选择</option>
                                        <?php if (isset($area)) foreach ($area as $v) { ?>
                                            <option value="<?php echo $v->id; ?>" <?php if ($model->area == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo $form->hiddenField($model, 'area', array('class' => 'input-text')); ?>
                                    <?php echo $form->error($model, 'area', $htmlOptions = array()); ?>
                                </td>
                            </tr>
                             <tr>
                                <td ><?php echo $form->labelEx($model, 'school_name'); ?></td>
                                <td colspan="10">
                                    <?php echo $form->textField($model, 'school_name', array('class' => 'input-text')); ?>
                                    <?php echo $form->error($model, 'school_name', $htmlOptions = array()); ?>
                                </td>
                             </tr>


                            </tr>

                            <tr>

                            </tr>
 

                            </tr>
                     <tr>
                         <td><?php echo $form->labelEx($model, 'file'); ?></td>
                        <td colspan="10">
                            <?php echo $form->hiddenField($model, 'file', array('class' => 'input-text fl')); ?>
                          <?php $basepath=BasePath::model()->getPath().'column/';     
                            $picprefix='';
                            //$model->news_pic='t1234.jpg';
                            //if($basepath){ $picprefix=$basepath; }?>
                         <div class="upload_img fl" id="upload_file_article_file"> 
                          <?php if(!empty($model->pic)) {?>
                             <a href="<?php echo $basepath.$model->file;?>" target="_blank">
                             <img src="<?php echo $basepath.$model->file;?>" width="100">
                             </a>
                             <?php }?>
                             </div>
                            <script>we.uploadpic('<?php echo get_class($model);?>_file','<?php echo $picprefix;?>','','','',0);</script>
                            <?php echo $form->error($model, 'file', $htmlOptions = array()); ?>
                        </td>
                    </tr>




                        </table>
                    </div>

                </div>
                <!--box-detail-tab-item end   style="display:block;"-->

            </div>
            <!--box-detail-bd end-->

            <div class="box-detail-submit"><button onclick="submitType='baocun'" class="btn btn-blue" type="submit">保存</button><button class="btn" type="button" onclick="we.back();">取消</button></div>

            <?php $this->endWidget(); ?>
        </div>
        <!--box-detail end-->
    </div>
    <!--box end-->
    <script>
        $("#province").change(function() {
            $('#Article_province').val($("#province").val());
            $('#Article_city').val('');
            $('#Article_area').val('');
            $('#city').html("<option value=''>请选择</option>");
            $('#area').html("<option value=''>请选择</option>");
            getLocation("#province", '#city');
            // getLocation("#city", '#area');
        });

        $("#city").change(function() {
            $('#Article_city').val($("#city").val());
            $('#Article_area').val('');
            $('#area').html("<option value=''>请选择</option>");
            getLocation("#city", '#area');
        });

        $("#area").change(function() {
            $('#Article_area').val($("#area").val());

        });

        function getLocation(sourece, target) {
            var code = $(sourece).val();
            getData(code, target);
        }

        function getData(code, element) {
            $.ajax({
                url: "<?php echo $this->createUrl('select/getLocation'); ?>",
                data: {
                    code: code
                },
                type: "get",
                success: function(res) {
                    var data = JSON.parse(res).data;
                    var str = "<option value=''>请选择</option>";
                    for (var i = 0; i < data.length; i++) {
                        str += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                    }
                    // //把所有<option>放到区的下拉列表里
                    $(element).html(str);
                }
            });
        }
    </script>

   