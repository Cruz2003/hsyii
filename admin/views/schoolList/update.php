    <div class="box">
        <div class="box-title c">
            <h1><i class="fa fa-table"></i>学校信息修改</h1><span class="back"><a class="btn" href="javascript:;" onclick="we.back();"><i class="fa fa-reply"></i>返回</a></span>
        </div>
        <!--box-title end-->
        <div class="box-detail">
            <?php $form = $this->beginWidget('CActiveForm', get_form_list()); ?>

            <div class="box-detail-bd">
                <div style="display:block;" class="box-detail-tab-item">

                    <div class="mt15">
                        <table>
                            <tr class="table-title">
                                <td colspan="9">学校信息</td>
                            </tr>
                            <tr>
                                <td><?php echo $form->labelEx($model, 'school_name'); ?></td>
                                <td colspan="2">
                                    <?php echo $form->textField($model, 'school_name', array('class' => 'input-text')); ?>
                                    <?php echo $form->error($model, 'school_name', $htmlOptions = array()); ?>
                                </td>

                                <td><?php echo $form->labelEx($model, 'school_code'); ?></td>
                                <td colspan="2">
                                    <?php echo $form->textField($model, 'school_code', array('class' => 'input-text')); ?>
                                    <?php echo $form->error($model, 'school_code', $htmlOptions = array()); ?>
                                </td>

                                <td><?php echo $form->labelEx($model, 'stu_num'); ?></td>
                                <td colspan="2"><?php echo $model->stu_num; ?></td>

                            </tr>
                            <tr>
                                <td><?php echo $form->labelEx($model, 'province'); ?></td>
                                <td colspan="2">
                                    <select name="province" id="province">
                                        <option value="">请选择</option>
                                        <?php foreach ($province as $v) { ?>
                                            <option value="<?php echo $v->id; ?>" <?php if ($model->province == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo $form->hiddenField($model, 'province', array('class' => 'input-text')); ?>
                                    <?php echo $form->error($model, 'province', $htmlOptions = array()); ?>
                                </td>

                                <td><?php echo $form->labelEx($model, 'city'); ?></td>
                                <td colspan="2">
                                    <select name="city" id='city'>
                                        <option value="">请选择</option>
                                        <?php if (isset($city)) foreach ($city as $v) { ?>
                                            <option value="<?php echo $v->id; ?>" <?php if ($model->city == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo $form->hiddenField($model, 'city', array('class' => 'input-text')); ?>
                                    <?php echo $form->error($model, 'city', $htmlOptions = array()); ?>
                                </td>

                                <td><?php echo $form->labelEx($model, 'area'); ?></td>
                                <td colspan="2">
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
                                <td><?php echo $form->labelEx($model, 'remark'); ?></td>
                                <td colspan="8">
                                    <?php echo $form->textField($model, 'remark', array('class' => 'input-text')); ?>
                                    <?php echo $form->error($model, 'remark', $htmlOptions = array()); ?>
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
            $('#SchoolList_province').val($("#province").val());
            $('#SchoolList_city').val('');
            $('#SchoolList_area').val('');
            $('#city').html("<option value=''>请选择</option>");
            $('#area').html("<option value=''>请选择</option>");
            getLocation("#province", '#city');
            // getLocation("#city", '#area');
        });

        $("#city").change(function() {
            $('#SchoolList_city').val($("#city").val());
            $('#SchoolList_area').val('');
            $('#area').html("<option value=''>请选择</option>");
            getLocation("#city", '#area');
        });

        $("#area").change(function() {
            $('#SchoolList_area').val($("#area").val());
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