
<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>人大信息列表</h1></div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a class="btn" href="<?php echo $this->createUrl('create');?>"><i class="fa fa-plus"></i>导入人大信息</a>
        </div><!--box-header end-->
        <div class="box-search">
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
                <input type="hidden" name="news_type" value="<?php echo Yii::app()->request->getParam('news_type');?>">
                <label style="margin-right:10px;">
                    <span>关键字：</span>
                    <input style="width:200px;" class="input-text" type="text" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords');?>">
                </label>
                
                <button class="btn btn-blue" type="s+ubmit">查询</button>
            </form>
        </div><!--box-search end-->
        <div class="box-table">
            <table class="list">
                <thead>
                    <tr>
                        <th style='text-align: center;'>序号</th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('num');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('name');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('sex');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('birth');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('healthy');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('native_place');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('nation');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('work_time');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('party');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('education');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('degree');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('type');?></th>
                        <th style='text-align: center;'>操作</th>
                    </tr>
                </thead>
                <tbody>
<?php 
$index = 1;
foreach($arclist as $v){ 
?>
                    <tr>
                        <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
                        <td style='text-align: center;'><?php echo $v->num; ?></td>
                        <td style='text-align: center;'><?php echo $v->name; ?></td>
                        <td style='text-align: center;'><?php echo $v->sex; ?></td>
                        <td style='text-align: center;'><?php echo $v->birth; ?></td>
                        <td style='text-align: center;'><?php echo $v->healthy; ?></td>
                        <td style='text-align: center;'><?php echo $v->native_place; ?></td>
                        <td style='text-align: center;'><?php echo $v->nation; ?></td>
                        <td style='text-align: center;'><?php echo $v->work_time; ?></td>
                        <td style='text-align: center;'><?php echo $v->party; ?></td>
                        <td style='text-align: center;'><?php echo $v->education; ?></td>
                        <td style='text-align: center;'><?php echo $v->degree; ?></td>
                        <td style='text-align: center;'><?php echo $v->type; ?></td>
                        <td style='text-align: center;'>
                            <a class="btn" href="<?php echo $this->createUrl('update', array('id'=>$v->id));?>" title="修改"><i class="fa fa-edit"></i></a>
                            <a class="btn" href="javascript:;" onclick="we.dele('<?php echo $v->id;?>', deleteUrl);" title="删除"><i class="fa fa-trash-o"></i></a>  
                        </td>
                    </tr>
<?php $index++; } ?>
                </tbody>
            </table>
        </div><!--box-table end-->
        <div class="box-page c"><?php $this->page($pages);?></div>
        
    </div><!--box-content end-->
</div><!--box end-->
<script>
var deleteUrl = '<?php echo $this->createUrl('delete', array('id'=>'ID')); ?>';
</script>
