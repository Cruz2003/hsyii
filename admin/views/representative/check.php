<div class="box-title c"><h1><i class="fa fa-table"></i>人大代表个人信息审核列表</h1></div><!--box-title end-->

<div class="box-content">
<div class="box-table">
        <table class="list">
            <thead>
            <tr>
                <!-- <th class="check"><input id="j-checkall" class="input-check" type="checkbox"></th> -->
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('num'); ?></th>
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('name'); ?></th>
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('sex'); ?></th>
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('birth'); ?></th>
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('party'); ?></th>
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('education'); ?></th>
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('work_time'); ?></th>
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('degree'); ?></th>
                <th style='text-align: center;'><?php echo $model->getAttributeLabel('check'); ?></th>

                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($arclist as $v) { ?>
                <tr><!-- 
                    <td class="check check-item"><input class="input-check" type="checkbox"
                        value="<?php echo CHtml::encode($v->id); ?>"></td> -->
                    <td style='text-align: center;'><?php echo $v->num; ?></td>
                    <td style='text-align: center;'><?php echo $v->name; ?></td>
                    <td style='text-align: center;'><?php echo $v->sex; ?></td>
                    <td style='text-align: center;'><?php echo $v->birth; ?></td>
                    <td style='text-align: center;'><?php echo $v->party; ?></td>
                    <td style='text-align: center;'><?php echo $v->education; ?></td>
                    <td style='text-align: center;'><?php echo $v->work_time; ?></td>
                    <td style='text-align: center;'><?php echo $v->degree; ?></td>
                    <td style='text-align: center;'><?php echo $v->check; ?></td>
                    <td>
                        <a class="btn" href="<?php echo $this->createUrl('update0', array('id' => $v->id)); ?>"
                           title="审核"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div><!--box-table end-->
    </div><!-- box-content end -->