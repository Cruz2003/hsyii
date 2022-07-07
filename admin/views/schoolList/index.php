<div class="box">
    <div class="box-title c">
        <h1><i class="fa fa-table"></i>信息列表</h1>
    </div>
    <!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a class="btn" href="<?php echo $this->createUrl('create'); ?>"><i class="fa fa-plus"></i>添加学校</a>
        </div>
        <!--box-header end-->
        <div class="box-search">
            <form action="<?php echo Yii::app()->request->url; ?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r'); ?>">
                <input type="hidden" name="news_type" value="<?php echo Yii::app()->request->getParam('news_type'); ?>">
                <label style="margin-right:10px;">
                    <span>关键字：</span>
                    <input style="width:200px;" class="input-text" type="text" placeholder="学校名称或编码" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords'); ?>">
                </label>
                <label style="margin-right:10px;">
                    <span>省：</span>
                    <select name="province" id="province">
                        <option value="">请选择</option>
                        <?php foreach ($province as $v) { ?>
                            <option value="<?php echo $v->id; ?>" <?php if (Yii::app()->request->getParam('province') == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
                        <?php } ?>
                    </select>
                </label>
                <label style="margin-right:10px;">
                    <span>市：</span>
                    <select name="city" id='city'>
                        <option value="">请选择</option>
                        <?php if(isset($city)) foreach ($city as $v) { ?>
                            <option value="<?php echo $v->id; ?>" <?php if (Yii::app()->request->getParam('city') == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
                        <?php } ?>
                    </select>
                </label>
                <label style="margin-right:10px;">
                    <span>镇(县)：</span>
                    <select name="area" id="area">
                        <option value="">请选择</option>
                        <?php if(isset($area)) foreach ($area as $v) { ?>
                            <option value="<?php echo $v->id; ?>" <?php if (Yii::app()->request->getParam('area') == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
                        <?php } ?>
                    </select>
                </label>
                <label style="margin-right:20px;">
                    <span>年级：</span>
                    <select name="grade">
                        <option value="">请选择</option>
                        <?php $grade = range(1, 9);
                        foreach ($grade as $v) { ?>
                            <option value="<?php echo $v; ?>" <?php if (Yii::app()->request->getParam('grade') == $v) { ?> selected<?php } ?>><?php echo $v . '年级'; ?></option>
                        <?php } ?>
                    </select>
                </label>
                <button class="btn btn-blue" type="submit">查询</button>
                <label style="float:right;margin-right:20px;">
                    <?php $stu_sum = 0;
                    if (Yii::app()->request->getParam('grade') != '') {
                        foreach ($arclist as $v) $stu_sum += $grade_num[$v->school_name];
                    } else foreach ($arclist as $v) $stu_sum += $v->stu_num; ?>
                    <span>人数统计：<?php echo $stu_sum; ?></span>
                </label>
            </form>
        </div>
        <!--box-search end-->
        <div class="box-table">
            <table class="list">
                <thead>
                    <tr>
                        <th style='text-align: center;width: 50px'>序号</th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('school_code'); ?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('school_name'); ?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('location'); ?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('stu_num'); ?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('remark'); ?></th>

                        <th style='text-align: center;width: 90px'>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($arclist as $v) {
                    ?>
                        <tr>
                            <td style='text-align:center;'><?php echo $v->id; ?></td>
                            <td style='text-align:center;'><?php echo $v->school_code; ?></td>
                            <td style='text-align:center;'><?php echo $v->school_name; ?></td>
                            <?php $l='';if($v->provinceName!='')  $l.=$v->provinceName->name;
                            if($v->cityName!='')  $l.=$v->cityName->name;
                            if($v->areaName!='')  $l.=$v->areaName->name;?>
                            <td style='text-align:center;'><?php echo $l; ?></td>
                            <td style='text-align:center;'><?php echo Yii::app()->request->getParam('grade') == '' ? $v->stu_num : $grade_num[$v->school_name]; ?></td>
                            <td style='text-align:center;'><?php echo $v->remark; ?></td>
                            <td style='text-align: center; width: 60px'>
                                <a class="btn" href="<?php echo $this->createUrl('update', array('id' => $v->id)); ?>" title="编辑"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        </div>
        <!--box-table end-->

        <div class="box-page c"><?php $this->page($pages); ?></div>
    </div>
    <!--box-content end-->
</div>
<!--box end-->
<script>
    $("#province").change(function() {
        $('#city').html("<option value=''>请选择</option>");
        $('#area').html("<option value=''>请选择</option>");
        getLocation("#province",'#city');
    });

    $("#city").change(function() {
        $('#area').html("<option value=''>请选择</option>");
        getLocation("#city",'#area');
    });

    function getLocation(sourece,target) {
        var code = $(sourece).val();
        getData(code,target);
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