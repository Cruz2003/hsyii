<style>
  .main {
    padding: 10px 20px;
    width: 550px;
  }

  .box {
    padding: 30px 20px;
    width: 550px;
  }

  .div {
    width: 90%;
  }

  .title {
    border-bottom: 30px;
  }

  .label {
    display: block;
    margin-bottom: 20px;
  }

  .line {
    margin-bottom: 5px;

    border: black solid 1px;
  }
</style>
<div class='main'>
  <?php $index = 0;
  echo '<div class="div title"><pre style="font-size:30px;white-space: pre-wrap;word-wrap: break-word;">标题：' . $article->title . '</pre></div>';
  echo '<div class="div introduce"><pre style="font-size:15px;white-space: pre-wrap;word-wrap: break-word;">摘要：' . $article->introduce . '</pre></div>';
  if (is_array($text)) {

    foreach ($text as $k) {
      echo '<div class="div"><pre style="font-size:15px;white-space: pre-wrap;word-wrap: break-word;">' . $k . '</pre></div>';
      if ($index < count($img) - 1)
        echo '<img style="width:530px;height:300px;margin:10px 0px;" src="' . $dir . $img[$index++] . '">';
    }
  } else {
    echo '<div class="div"><pre style="font-size:15px;white-space: pre-wrap;word-wrap: break-word;">' . $text . '</pre></div>';
  } ?>
</div>

<?php if ($showController) { ?>
  <hr style="width: 90%;margin-left: 5%;" />
  <div class='box'>
    <label class="label">
      <span>目前状态：<?php echo $article->status_name; ?></span>
    </label>
    <?php if ($article->status != 1)
      echo '  <label class="label"><span>' . Article::model()->AttributeLabels()["opinion0"] . '：' . $article->opinion0 . '</span></label>'
    ?>
    <?php $array1 = [2, 6, 7, 8, 3, 5];
    if (in_array($article->status, $array1))
      echo '  <label class="label"><span>' . Article::model()->AttributeLabels()["opinion1"] . '：' . $article->opinion1 . '</span></label>'
    ?>
    <?php $array2 = [3, 5, 6, 7, 8];
    if (in_array($article->status, $array2))
      echo '  <label class="label"><span>' . Article::model()->AttributeLabels()["opinion2"] . '：' . $article->opinion2 . '</span></label>'
    ?>
    <?php $array3 = [3, 5, 7, 8];
    if (in_array($article->status, $array3)) {
      echo '  <label class="label"><span>' . Article::model()->AttributeLabels()["opinion3"] . '：' . $article->opinion3 . '</span></label>';
    }
    ?>
     <?php if ($article->status == 6) {?>
      <label class="label">
        <span><?php echo Article::model()->AttributeLabels()["publish_column"];?></span>
        <input name="publish_column" id="publish_column" style="width: 100px;">
      </label>
      <label class="label">
        <span><?php echo Article::model()->AttributeLabels()["publish_date"];?></span>
        <input name="publish_date" id="publish_date" style="width: 100px;">
      </label>
        <label class="label">
        <span><?php echo Article::model()->AttributeLabels()["frequency_id"];?></span>
        <select name="frequency" id="frequency">
          <option value="0">请选择</option>
          <?php foreach ($frequency as $v) { ?>
            <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
          <?php } ?>
        </select>
      </label>
   <?php } ?>
    <?php $array4 = [3, 5, 7, 8];
    if (!in_array($article->status, $array4)) { ?>
      <label class="label">
        <span>审核状态：</span>
        <select name="status" id="status">
          <option value="123"></option>
          <?php foreach ($status as $v) { ?>
            <option value="<?php echo $v->id; ?>"><?php echo $v->status_name; ?></option>
          <?php } ?>
        </select>
      </label>
      <label class="label">
        <span><?php echo $opinionTip; ?>:</span>
        <input name="opinion" id="opinion" style="width: 100px;">
      </label>
      <button id="submit" name="submit" class="btn btn-blue">提交</button>
    <?php  } ?>
  </div>
<?php  } ?>
<script>
  $(function() {

    $('#submit').on('click', function() {
      // console.log(value1);
      // console.log(id);
      var id = "<?php echo $Aid; ?>";
      var statusNow = "<?php echo $article->status; ?>";
      var obj = document.getElementById('status'); //定位id
      var value = obj.options[obj.selectedIndex].value; // 选中值
      if(value==123)
      {
        alert('请选择审核状态');
        return;
      }
      var opinion = $('#opinion').val();
      var publishColumn = $('#publish_column').length >0?$('#publish_column').val():'';
      var publishDate = $('#publish_date').length >0?$('#publish_date').val():'';
      var frequency = $('#publish_date').length >0?document.getElementById('frequency').options[document.getElementById('frequency').selectedIndex].value:0; // 选中值
      $.ajax({
        type: 'get',
        url: '<?php echo $this->createUrl("article/statusChange"); ?>',
        data: {
          sid: value,
          id: id,
          opinion: opinion,
          statusNow: statusNow,
          publishColumn: publishColumn,
          publishDate: publishDate,
          frequency: frequency,
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