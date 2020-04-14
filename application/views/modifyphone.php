<div class="alert alert-success">
  <strong>修改手机号</strong>
</div>
<div class="container">

    <div class="form-group">
      <label for="usr">身份证:</label>
      <input type="text" id="card" class="form-control">
    </div>

    <div class="form-group">
      <label for="usr">手机号码:</label>
      <input type="text" id="oldmobile" class="form-control">
    </div>

    <div class="form-group">
	    <label for="usr">新手机号码:</label>
	    <div class="input-group">
			<input type="number" id="mobile" maxlength="11" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-primary" type="button" id="getcode">
					获取验证码
				</button>
			</span>
		</div>
	</div>

  <div class="form-group">
    <label for="pwd">短信验证码:</label>
    <input type="number" class="form-control" id="code">
  </div>

	<div class="form-group" style=" text-align: center; ">
		<button type="button" id="modifyPhoneBtn" class="btn btn-success btn-lg btn-block"> 修 改 </button>
	</div>

</div>