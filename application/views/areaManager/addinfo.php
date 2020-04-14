<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">上报资料填写</h3>
  </div>
  <div class="panel-body">
    <div class='input-group' >
        <span class="input-group-addon">
           日期：
        </span>
        <input type='Number' id="datetimepicker1" value="<?php echo date('Ymd'); ?>" class="form-control" placeholder="日期格式20190301" />
    </div>
  </div>

  <div id="info_list" class="panel-body">
    
    

  </div>

   <div class="panel-footer"> 

    <div class="btn-group btn-group-justified">
      <div class="btn-group">
        <button  type="button" id="save_info" class="btn btn-success">提交</button>
      </div>
      <div class="btn-group">
        <button  onclick="javascript:window.location.replace(document.referrer);" type="button" class="btn btn-warning">返回</button>
      </div>
    </div>

</div>


