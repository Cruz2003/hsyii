<style>
    .div {
        width: 90%;
    }

    .title {
        border-bottom: 30px;
    }

    .main {
        margin: 0 5%;
        padding: 3% 10%;
        width: 70%;
        text-align: center;
        /* border: 1px solid black; */
    }
</style>
<div class="box">
    <div class="box-title c">
        <h1><i class="fa fa-table"></i>稿件总审</h1><span class="back"><a class="btn" href="http://localhost/index.php?r=article/FinalTrial" ><i class="fa fa-reply"></i>退出审核</a></span>
    </div>
    <!--box-title end-->
    <div class="box-detail">
        <?php $form = $this->beginWidget('CActiveForm', get_form_list()); ?>
        <div class="box-detail-tab">
            <ul class="c">
                <li class="current">基本信息</li>
            </ul>
        </div>
        <!--box-detail-tab end-->
        <div class="box-detail-bd">
            <div style="display:block;" class="box-detail-tab-item">
                <table>
                    <tr class="table-title">
                        <td colspan="6">稿件信息</td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'title'); ?></td>
                        <td colspan="5">
                            <?php echo $model->title; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'introduce'); ?></td>
                        <td colspan="5">
                            <?php echo $model->introduce; ?>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'type_name'); ?></td>
                        <td colspan="2">
                            <?php echo $model->type_name; ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'author'); ?></td>
                        <td colspan="2">
                            <?php echo $model->author; ?>
                        </td>
                        <td><?php echo $form->labelEx($model, 'grade'); ?></td>
                        <td colspan="2">
                            <?php echo $model->grade; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'submit_time'); ?></td>
                        <td colspan="2">
                            <?php echo $model->submit_time; ?>
                        </td>

                        <td><?php echo $form->labelEx($model, 'file'); ?></td>
                        <td colspan="2">
                           
                            <a href="<?php echo $this->createUrl('word2html', array('id' => $model->id)); ?>">下载</a>
                        </td>


                        <td><?php echo $form->labelEx($model, 'status'); ?></td>
                        <td colspan="2">
                            <select name="status">

                                <option value="">请选择</option>

                                <?php foreach ($status as $v) {
                                    if ($v->id == 7 || $v->id == 5) {; ?>
                                        <option value="<?php echo $v->id; ?>" <?php if ($v->id == $model->status) { ?> selected<?php } ?>><?php echo $v->status_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <!-- 
                            下拉框
                            <?php echo $form->dropDownList($model, 'status', Chtml::listData(ArticleStatus::model()->getCode(1009), 'id', 'status_name'), array('prompt' => '请选择', 'onchange' => 'selectStatus(this)')); ?> -->

                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'opinion0'); ?></td>
                        <td colspan="8"><?php echo $model->opinion0; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'opinion1'); ?></td>
                        <td colspan="8"><?php echo $model->opinion1; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'opinion2'); ?></td>
                        <td colspan="8"><?php echo $model->opinion2; ?></td>
                    </tr>
                    <td><?php echo $form->labelEx($model, 'opinion3'); ?></td>
                    <td colspan="8">
                        <?php echo $form->textField($model, 'opinion3', array('class' => 'input-text')); ?>
                        <?php echo $form->error($model, 'opinion3', $htmlOptions = array()); ?>
                    </td>
                    </tr>
                   

                    <tr>
                        <td colspan="9" style="text-align: center;border:1px solid black;">文章预览</td>
                    </tr>
                    <tr>
                        <td colspan="9" style="border: 1px solid black;">
                            <div class="main">
                                <?php $index = 0;
                                echo '<div class="div title"><pre style="font-size:30px;white-space: pre-wrap;word-wrap: break-word;">标题：' . $model->title . '</pre></div>';
                                echo '<div class="div introduce"><pre style="font-size:15px;white-space: pre-wrap;word-wrap: break-word;text-align:left;">摘要：' . $model->introduce . '</pre></div>';
                                if (is_array($text)) {

                                    foreach ($text as $k) {
                                        echo '<div class="div"><pre style="font-size:15px;white-space: pre-wrap;word-wrap: break-word;text-align:left;">' . $k . '</pre></div>';
                                        if ($index < count($img) - 1)
                                            echo '<img style="width:530px;height:300px;margin:10px 0px;" src="' . $dir . $img[$index++] . '">';
                                    }
                                } else {
                                    echo '<div class="div"><pre style="font-size:15px;white-space: pre-wrap;word-wrap: break-word;text-align:left;">' . $text . '</pre></div>';
                                } ?>
                            </div>
                        </td>
                    </tr>
                </table>


            </div>
            <!--box-detail-tab-item end   style="display:block;"-->

        </div>
        <!--box-detail-bd end-->

        <div class="box-detail-submit">还剩<?php echo $this->showremain(3)?>篇<button onclick="submitType='baocun'" class="btn btn-blue" type="submit">审核完成并继续</button><button class="btn" type="button" onclick="we.back();">重置</button></div>

        <?php $this->endWidget(); ?>
    </div>
    <!--box-detail end-->
</div>
<!--box end-->
<script>

    function preview(id) {
        $.dialog.open('<?php echo $this->createUrl("Article/preview"); ?>&id=' + id + '&showController=false', {
            id: 'article',
            lock: true,
            opacity: 0.3,
            title: '文章预览',
            width: '600px',
            height: '100%',
            close: function() {
                we.reload();

            }
        });
    }
</script>