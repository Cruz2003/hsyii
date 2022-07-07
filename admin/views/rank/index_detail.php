<style>
    .box-table .list tr:hover td{
        background-color:transparent;
    }
    .box-table .list tr td:hover{
        background-color:#f8f8f8;
    }
</style>
<div class="box">
    <div class="box-content">
        
        <div class="box-table">
                      <table class="list">
                <thead>
                    <tr>  
                        <th>完成时间</th>
                        <th>文章</th>
                        <th>测试类型</th>
                        <th>问题</th>
                        <th>得分</th>
                    </tr>
                </thead>
                <tbody>

                    
                    <?php foreach($arclist as $v){?>
                        
                        
                        <tr>
                            <td><?php echo $v->finish_time; ?></td>
                            <td><?php echo $v->article_name; ?></td>
                            <td><?php echo $v->test_type; ?></td>
                            <td><?php echo $v->question; ?></td>
                            <td><?php echo $v->score; ?></td>
                        </tr>
                    <?php } //}?>
                </tbody>
            </table>
        </div><!--box-table end-->
        <div class="box-page c"><?php $this->page($pages); ?></div>
    </div><!--box-content end-->
</div><!--box end-->
<script>
    $(function(){
        var parentt = $.dialog.parent;  // 父页面window对象
        api = $.dialog.open.api;    // art.dialog.open扩展方法
        if (!api) return;

        // 操作对话框
         api.button(
        {
            name: '关闭'
        }
    );
    });

</script>