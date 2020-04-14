<div class="panel panel-success">

  <div class="panel-heading">
    <div class="btn-group btn-group-justified">
      <div class="btn-group">
        <button onclick="javascript:window.location.href='<?php echo site_url('areamanager/main/addinfo'); ?>'" type="button" class="btn btn-success">上报数据</button>
      </div>
      <div class="btn-group">
        <button onclick="javascript:window.location.href='<?php echo site_url('areamanager/main/history'); ?>'" type="button" class="btn btn-success">查询历史资料</button>
      </div>

      <div class="btn-group">
        <button onclick="javascript:window.location.href='<?php echo site_url('areamanager/login/sessionOuts'); ?>'" type="button" class="btn btn-success">退出登录</button>
      </div>
    </div>
  </div>

  <div class="panel-body">


  <div class="panel panel-default">
      <div class="panel-heading">
          <h3 class="panel-title">基本数据</h3>
      </div>
      <table class="table" id="show_title"> 


          <tbody>
            <tr>
              <td><b>大区：</b><?php echo $RegionName; ?></td>
              <td><b>片区：</b><?php echo $SliceName; ?></td>
            </tr>
            <tr>
              <td><b>片区经理：</b><?php echo $ManagerName; ?></td>
              <td><b>月任务：</b><?php echo $MonthTasks; ?></td>
            </tr>
            <tr>
              <td><b>日均任务：</b><?php echo $DayTask; ?></td>
              <td><b>当日达成：</b><?php echo $Quantity; ?></td>
            </tr>
             <tr>
              <td><b>当日完成比例：</b><?php echo $DayPercen; ?></td>
              <td><b>月份完成比例：</b><?php echo $MonthPercen; ?></td>
            </tr>

            <tr>
              <td colspan="2"><b>当月完成：</b><?php echo $Summary; ?></td>
              <td></td>
            </tr>
          </tbody>


      </table>
  </div>


 <div class="panel panel-default">
      <div class="panel-heading">
          <h3 class="panel-title">上报日期：<?php if(!empty($info)){ echo date('Y-m-d',strtotime($info->DataDate)); } ?></h3>
      </div>
      
      <table class="table">

        <?php if(!empty($info)){ ?>
          
             
              <thead><tr><th>名称</th><th>数量</th></tr></thead>
              <?php foreach ($list as $key => $value) { ?>
                    <tr>
                      <td><?php echo $value->CateGoryName; ?></td>
                      <td><?php echo $value->Quantity.' '.$value->Unit ?></td>
                    
                    </tr>
              <?php } ?>

        <?php }else{echo '<tr><td>没有数据！</td></tr>'; } ?>
      </table>
    </div>


  
  </div>
</div>

<!--
<th>计划量</th><th>完成比例</th>
  <td><?php //echo $value->MonthTasks; ?></td>
  <td><?php //echo $value->Percentage; ?></td>

 -->