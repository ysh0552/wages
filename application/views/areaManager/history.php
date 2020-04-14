
<div class="panel panel-success">
  <div class="panel-heading">
    查询历史资料
  </div>
  <div class="panel-body">
  <div class="btn-group btn-group-justified">
      <div class="btn-group">
        <button id="checkDay" type="button" class="btn btn-success">按日查询</button>
      </div>
      <div class="btn-group">
        <button id="checkMonth" onclick="" type="button" class="btn btn-success">按月查询</button>
      </div>
      <div class="btn-group">
        <button onclick="javascript:window.location.replace(document.referrer);" type="button" class="btn btn-success">返回</button>
      </div>
    </div>
<br>

    <div class="input-group datetimepicker1" >
      <input type="Number" value="<?php echo date('Ymd'); ?>" class="form-control " id="datetimepicker1"  placeholder="按日查询20190409" >
      <span class="input-group-btn">
        <button id="inDate" class="btn btn-warning" type="button">
          搜 索
        </button>
      </span>
    </div>


    <div class="input-group datetimepicker2" style="display:none">
      <input type="Number" value="<?php echo date('Ym'); ?>" class="form-control " id="datetimepicker2"  placeholder="按月查询201904" >
      <span class="input-group-btn">
        <button id="inMonth" class="btn btn-warning" type="button">
          搜 索
        </button>
      </span>
    </div>


  <div class="panel panel-default">
      <table class="table" id="sreachList">
        
      </table>
  
  </div>

  
  </div>
</div>


