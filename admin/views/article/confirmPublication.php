<style>
  .main {
    padding: 10px 20px;
    width: 550px;
    text-align: center;
  }
  .label {
    display: block;
    margin-bottom: 20px;
  }
</style>
<div class='main'>
  <label class="label">
    <span>文章标题：<?php echo $title; ?></span>
  </label>
  <label class="label">
    <span style="margin:0 10px;">作者：<?php echo $author; ?></span>
    <span style="margin:0 10px;">年级：<?php echo $grade; ?></span>
  </label>
  <label class="label">
    <span>发表栏目：</span>
    <input style="width:200px;" class="input-text" type="text" id="publish_column" name="publish_column">
  </label>
  <label class="label">
    <span>发表日期：</span>
    <input style="width:200px;" class="input-text" type="text" id="publish_date" name="publish_date">
  </label>
    <label class="label">
    <span>报刊机构：</span>
    <select id="institution" name="institution" style="width:200px;" >
      <option value="">请选择</option>
      <?php foreach ($institution as $v) { ?>
        <option value="<?php echo $v->id; ?>" <?php if (Yii::app()->request->getParam('institution') == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
      <?php } ?>
    </select>
  </label>
    <label class="label">
    <span>期刊：</span>
    <select id="frequency" name="frequency" style="width:200px;" >
      <option value="">请选择</option>
      <?php foreach ($frequency as $v) { ?>
        <option value="<?php echo $v->id; ?>" <?php if (Yii::app()->request->getParam('frequency') == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
      <?php } ?>
    </select>
  </label>

  <button class="btn btn-blue" id="submit" name="submit">发表</button>
</div>
<script>
  $(function() {
    var publish_date = $('#publish_date');
    publish_date.on('click', function() {
      WdatePicker({
        startDate: '%y-%M-%D',
        dateFmt: 'yyyy-MM-dd'
      });
    });

    $('#submit').on('click', function() {

      var id = "<?php echo $id; ?>";
      var publishColumn = $('#publish_column').val();
      var publishDate = $('#publish_date').val();
      var institution=$('#institution').val();
      var frequency = $('#frequency').val();
     
      $.ajax({
        type: 'get',
        url: '<?php echo $this->createUrl("article/ChangeToPublishOn"); ?>',
        data: {
          id: id,
          publishColumn: publishColumn,
          publishDate: publishDate,
          institution:institution,
          frequency:frequency,
          
        },
        dataType: "json",
        error: function(request) {
          console.log(request);
        },
        success: function(data) {
          console.log(data);
          $.dialog.close();
        }
      });
    });
  });
</script>