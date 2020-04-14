<div class="alert alert-success">
  <strong>
  
  <a href="<?php echo site_url('main/modifyPhone'); ?>">修改手机号码</a>
  <a style="float:right" href="<?php echo site_url('login/sessionOuts'); ?>">退出</a>
  
  </strong>
</div>


<div class="table-responsive">
<table class="table table-striped">
    <tbody>

      <tr>
        <th>日期</th>
        <th><?php echo $info->RiQi ?></th>
      </tr>
      <tr>
        <th>职员代码</th>
        <th><?php echo $info->ZhiYuanDaiMa ?></th>
      </tr>

      <tr>
        <th>职员姓名</th>
        <th><?php echo $info->ZhiYuanXingMing ?></th>
      </tr>

      <tr>
        <th>月工作日</th>
        <th><?php echo $info->YueGongZuoRi ?></th>
      </tr>


      <tr>
        <th>出勤</th>
        <th><?php echo $info->ChuQin ?></th>
      </tr>

      <tr>
        <th>事假天数</th>
        <th><?php echo $info->ShiJia ?></th>
      </tr>


      <tr>
        <th>病假天数</th>
        <th><?php echo $info->BingJia ?></th>
      </tr>

      <tr>
        <th>年假天数</th>
        <th><?php echo $info->NianJia ?></th>
      </tr>
           

      <tr>
        <th>婚假天数</th>
        <th><?php echo $info->HunJia ?></th>
      </tr>     

      <tr>
        <th>产假天数</th>
        <th><?php echo $info->ChanJia ?></th>
      </tr> 


      <tr>
        <th>陪产假天数</th>
        <th><?php echo $info->PeiChanJia ?></th>
      </tr> 

      <tr>
        <th>丧假天数</th>
        <th><?php echo $info->SangJia ?></th>
      </tr> 
           
      <tr>
        <th>丧假路程假天数</th>
        <th><?php echo $info->SangJiaLuChengJia ?></th>
      </tr> 

      <tr>
        <th>迟到次数</th>
        <th><?php echo $info->ChiDaoCiShu ?></th>
      </tr> 

      <tr>
        <th>旷工天数</th>
        <th><?php echo $info->KuangGong ?></th>
      </tr> 

      <tr>
        <th>工伤假</th>
        <th><?php echo $info->GongShangJia ?></th>
      </tr> 


<?php if($info->Value == 'SH'){ ?> <!-- 上海 -->

      <tr>
        <th>加班工资</th>
        <th><?php echo $info->JiaBanGongZi ?></th>
      </tr>
      <tr>
        <th>其他补贴</th>
        <th><?php echo $info->QiTaBuTie ?></th>
      </tr>
      <tr>
        <th>销售奖金</th>
        <th><?php echo $info->XiaoShouJiangJin ?></th>
      </tr>
      <tr>
        <th>效益系数</th>
        <th><?php echo $info->XiaoYiXiShu ?></th>
      </tr>
         

<?php } ?>




<?php if($info->Value == 'SZ'){ ?> <!-- 深圳 -->

      <tr>
        <th>效益奖金</th>
        <th><?php echo $info->XiaoYiJiangJin ?></th>
      </tr> 
             
      <tr>
        <th>效益系数</th>
        <th><?php echo $info->XiaoYiXiShu ?></th>
      </tr> 
         
      <tr>
        <th>补助补贴</th>
        <th><?php echo $info->BuZhu ?></th>
      </tr> 

      <tr>
        <th>岗位补助</th>
        <th><?php echo $info->GangWeiBuZhu ?></th>
      </tr> 
      
      <tr>
        <th>岗位补贴</th>
        <th><?php echo $info->GangWeiBuTie ?></th>
      </tr> 
    
      <tr>
        <th>店经理津贴</th>
        <th><?php echo $info->DianJingLiJinTie ?></th>
      </tr> 
      <tr>
        <th>药师津贴</th>
        <th><?php echo $info->YaoShiJinTie ?></th>
      </tr> 

          <tr>
        <th>基本工资</th>
        <th><?php echo $info->JiBenGongZi ?></th>
      </tr> 

      <tr>
        <th>岗位工资</th>
        <th><?php echo $info->GangWeiGongZi ?></th>
      </tr> 

      <tr>
        <th>全勤奖</th>
        <th><?php echo $info->QuanQin ?></th>
      </tr> 
            
      <tr>
        <th>考核工资</th>
        <th><?php echo $info->KaoHe ?></th>
      </tr> 

      <tr>
        <th>晋级补贴</th>
        <th><?php echo $info->JinJiBuTie ?></th>
      </tr> 
      <tr>
        <th>其他补贴</th>
        <th><?php echo $info->QiTaBuTie ?></th>
      </tr> 

      <tr>
        <th>加班工资</th>
        <th><?php echo $info->JiaBanGongZi ?></th>
      </tr>
      
<?php } ?>



<?php if($info->Value == 'HZ'){ ?> <!-- 杭州 -->

      <tr>
        <th>基本工资</th>
        <th><?php echo $info->JiBenGongZi ?></th>
      </tr> 

      <tr>
        <th>岗位工资</th>
        <th><?php echo $info->GangWeiGongZi ?></th>
      </tr> 

      <tr>
        <th>全勤奖</th>
        <th><?php echo $info->QuanQin ?></th>
      </tr> 
            
      <tr>
        <th>效益奖金</th>
        <th><?php echo $info->XiaoYiJiangJin ?></th>
      </tr> 

      <tr>
        <th>晋级补贴</th>
        <th><?php echo $info->JinJiBuTie ?></th>
      </tr> 
      <tr>
        <th>其他补贴</th>
        <th><?php echo $info->QiTaBuTie ?></th>
      </tr> 

      <tr>
        <th>销售奖金</th>
        <th><?php echo $info->XiaoShouJiangJin ?></th>
      </tr> 


<?php } ?>

<!--  -->
<?php if($info->Value == 'NB'){ ?>

      <tr>
        <th>加班工资</th>
        <th><?php echo $info->JiaBanGongZi ?></th>
      </tr>

      <tr>
        <th>销售奖金</th>
        <th><?php echo $info->XiaoShouJiangJin ?></th>
      </tr> 

<?php } ?>


<?php if($info->Value == 'DG'){ ?><!-- 东莞 -->
      <tr>
        <th>岗位补助</th>
        <th><?php echo $info->GangWeiBuZhu ?></th>
      </tr> 
      
      <tr>
        <th>岗位补贴</th>
        <th><?php echo $info->GangWeiBuTie ?></th>
      </tr> 
      <tr>
        <th>晋级补贴</th>
        <th><?php echo $info->JinJiBuTie ?></th>
      </tr> 

      <tr>
        <th>其他补贴</th>
        <th><?php echo $info->QiTaBuTie ?></th>
      </tr> 


      <tr>
        <th>药师津贴</th>
        <th><?php echo $info->YaoShiJinTie ?></th>
      </tr> 

      <tr>
        <th>店经理津贴</th>
        <th><?php echo $info->DianJingLiJinTie ?></th>
      </tr> 

      <tr>
        <th>加班工资</th>
        <th><?php echo $info->JiaBanGongZi ?></th>
      </tr>

      <tr>
        <th>销售奖金</th>
        <th><?php echo $info->XiaoShouJiangJin ?></th>
      </tr> 

<?php } ?>



<?php if($info->Value == 'BJ'){ ?><!-- 北京 -->
  <tr>
    <th>岗位补助</th>
    <th><?php echo $info->GangWeiBuZhu ?></th>
  </tr> 
  
  <tr>
    <th>岗位补贴</th>
    <th><?php echo $info->GangWeiBuTie ?></th>
  </tr> 
  <tr>
    <th>销售奖金</th>
    <th><?php echo $info->XiaoShouJiangJin ?></th>
  </tr>   
  <tr>
    <th>加班工资</th>
    <th><?php echo $info->JiaBanGongZi ?></th>
  </tr>

<?php } ?>


      <tr>
        <th>应发工资</th>
        <th><?php echo $info->YingFaGongZi ?></th>
      </tr> 
      <tr>
        <th>其它</th>
        <th><?php echo $info->QiTa ?></th>
      </tr>   
      <tr>
        <th>社保个人缴交</th>
        <th><?php echo $info->SheBaoGeRen ?></th>
      </tr> 
       
      <tr>
        <th>住房公积金个人</th>
        <th><?php echo $info->ZhuFangGongJiJin ?></th>
      </tr> 

      <tr>
        <th>代扣税</th>
        <th><?php echo $info->DaiKouShui ?></th>
      </tr> 
             
      <tr>
        <th>宿舍管理费</th>
        <th><?php echo $info->SuSheGuanLiFei ?></th>
      </tr> 
         
      <tr>
        <th>其它扣款</th>
        <th><?php echo $info->QiTaKouKuan ?></th>
      </tr> 
           
      <tr>
        <th>扣款合计</th>
        <th><?php echo $info->KouKuanHeJi ?></th>
      </tr> 
      
      <tr>
        <th>实发工资</th>
        <th><?php echo $info->ShiFaGongZi ?></th>
      </tr>

    </tbody>
</table>

</div>

