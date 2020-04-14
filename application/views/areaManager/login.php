<div class="alert alert-success">
  <strong>片区经理-登录</strong>
</div>
<div class="container">

    <div class="form-group">
	    <label for="usr">手机号码:</label>
	    <div class="input-group">
			<input type="number" id="mobile" maxlength="11" class="form-control">
			<span class="input-group-btn">
				<button class="btn btn-success" type="button" id="getcode">
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
		<button type="button" id="loginBtn" class="btn btn-success btn-lg btn-block"> 登 录 </button>
	</div>

</div>

