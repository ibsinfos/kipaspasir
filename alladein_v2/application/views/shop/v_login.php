<head>
<style>
	
.button span {
  cursor: pointer!important;
  display: inline-block!important;
  position: relative!important;
  transition: 0.5s!important;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
</head>
<div id="wrapper" class="container">    
			<section class="header_text sub">
			<img class="pageBanner" src="<?=base_url(); ?>assets/themes/images/pageBanner.png"  alt="New products" >
				<h4><span style="    margin-left: -31px;">Sign In</span></h4>
			</section>			
			<section class="main-content">				
				<div class="row">
					<div style="    width: 100%;">					
						<h4 class="title" style="    width: 100%!important;
    margin-left: 32px;"><span class="text"><strong>Sign In</strong> Form</span></h4>
						<center><form action="#" method="post">
							<input type="hidden" name="next" value="/">
							<fieldset style="    background-color: rgba(251, 180, 80, 0.54);
    padding-top: 21px;
    padding-bottom: 21px;
    width: 50%;
    border-radius: 20px;">
								<div class="control-group">
									
									<div class="controls">
										<label class="control-label" style="    font-size: 15px!important;font-weight: 600;">Username</label><input style="height: 34px!important; padding: 7px 27px!important;" type="text" placeholder="Enter your username" id="username" class="input-xlarge">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" style="    font-size: 15px!important;font-weight: 600;">Password</label>
									<div class="controls">
										<input style="height: 34px!important; padding: 7px 27px!important;" type="password" placeholder="Enter your password" id="password" class="input-xlarge">
									</div>
								</div>
								<div class="control-group" style="margin-right: -11px;">
								
									<a href="#"><input style="display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 7px;
  width: 100px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
"tabindex="3" class="button" type="submit" value="Sign In" style="vertical-align:middle"><span style=" cursor: pointer!important;
  display: inline-block!important;
  position: relative!important;
  transition: 0.5s!important;"></span></button></a>
									<a href="https://dinarpal.com/index.php/login/getstarted" ><input style="display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 15px;
  padding: 7px;
  width: 100px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
"tabindex="3" target="_blank" class="button" type="submit" value="Register" style="vertical-align:middle"><span style=" cursor: pointer!important;
  display: inline-block!important;
  position: relative!important;
  transition: 0.5s!important;" ></span></button></a>
									<hr>
									<p class="reset">Recover your <a style="color: #eb4800!important;" tabindex="4" href="#" title="Recover your username or password">username or password</a></p>
								</div>
							</fieldset>
						</form>	</center>			
					</div>
										
				</div>
			</section>	
				
	</div>		