
<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>报名列表
    </h1>
     <span class="back" style="position: absolute;right:0px;"><a class="btn" href="<?php echo $this->createUrl('activitydetail/index&status=4')?>"><i class="fa fa-reply"></i>返回</a></span>
</div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
        </div><!--box-header end-->
        <div class="box-search">
            <form action="<?php echo Yii::app()->request->url;?>" method="get">
                <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
                <input type="hidden" name="news_type" value="<?php echo Yii::app()->request->getParam('news_type');?>">
                <label style="margin-right:10px;">
                    <span>关键字：</span>
                    <input style="width:200px;" class="input-text" type="text" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords');?>">
                </label>
                
                <button class="btn btn-blue" type="submit">查询</button>
            </form>
        </div><!--box-search end-->
        <div class="box-table">
            <table class="list">
                <thead>
                    <tr>
                        
                        <th style='text-align: center;'>序号</th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('name');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('class');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('school_name');?></th>
                         <th style='text-align: center;'><?php echo $model->getAttributeLabel('contact');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('time');?></th>
                       <th style='text-align: center;'>签到</th>
                    </tr>
                </thead>
                <tbody>
<?php 
$index = 1;
foreach($arclist as $v){ 
?>
                    <tr>
                        <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
                        <td style='text-align:center;'><?php echo $v->name; ?></td>
                        <td style='text-align: center;'><?php echo $v->class; ?></td>
                        <td style='text-align: center;'><?php echo $v->school_name; ?></td>
                        <td style='text-align: center;'><?php echo $v->contact; ?></td>
                        <td style='text-align: center;'><?php echo $v->time; ?></td>
                        <td style='text-align: center;'><?php if($v->sign==1)echo '已签到';
                        else echo '未签到';
                         ?></td>
                    </tr>
<?php $index++; } ?>
                </tbody>
            </table>
        </div><!--box-table end-->
        
        <div class="box-page c"><?php $this->page($pages);?></div>
        
    </div><!--box-content end-->
</div><!--box end-->
<script>

</script>
