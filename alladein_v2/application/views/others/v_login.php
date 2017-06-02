<head>
<style>
	

a .button {
    perspective: 500px;
    -webkit-perspective: 500px;
    -moz-perspective: 500px;
    transform-style: preserve-3d;
    -webkit-transform-style: preserve-3d;
}

a .button div {
    position: absolute;
    text-align: center;
    padding: 10px;
    border: #000000 solid 1px;
    pointer-events: none;
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}

a .button div:nth-child(1) {
    color: #000000;
    background-color: #ffffff;
    z-index: 0;
    width: 100%;
    height: 50px;
    clip: rect(0px, 100px, 50px, 0px);
    position: absolute;
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    transform: rotateX(0deg);
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
    transform-origin: 50% 50% -25px;
    -webkit-transform-origin: 50% 50% -25px;
    -moz-transform-origin: 50% 50% -25px;
}

a .button div:nth-child(2) {
    color: #000000;
    background-color: #000000;
    z-index: -1;
    width: 100%;
    height: 50px;
    clip: rect(0px, 100px, 50px, 0px);
    position: absolute;
    transform: rotateX(90deg);
    -webkit-transform: rotateX(90deg);
    -moz-transform: rotateX(90deg);
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    transform-origin: 50% 50% -25px;
    -webkit-transform-origin: 50% 50% -25px;
    -moz-transform-origin: 50% 50% -25px;
}

a .button div:nth-child(3) {
    color: #000000;
    background-color: #ffffff;
    z-index: 0;
    width: 100%;
    height: 50px;
    clip: rect(0px, 200px, 50px, 100px);
    position: absolute;
    transition: all 0.2s ease 0.1s;
    -webkit-transition: all 0.2s ease 0.1s;
    -moz-transition: all 0.2s ease 0.1s;
    transform: rotateX(0deg);
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
    transform-origin: 50% 50% -25px;
    -webkit-transform-origin: 50% 50% -25px;
    -moz-transform-origin: 50% 50% -25px;
}

a .button div:nth-child(4) {
    color: #000000;
    background-color: #000000;
    z-index: -1;
    width: 100%;
    height: 50px;
    clip: rect(0px, 200px, 50px, 100px);
    position: absolute;
    transform: rotateX(-90deg);
    -webkit-transform: rotateX(-90deg);
    -moz-transform: rotateX(-90deg);
    transition: all 0.2s ease 0.1s;
    -webkit-transition: all 0.2s ease 0.1s;
    -moz-transition: all 0.2s ease 0.1s;
    transform-origin: 50% 50% -25px;
    -webkit-transform-origin: 50% 50% -25px;
    -moz-transform-origin: 50% 50% -25px;
}

a .button:hover div:nth-child(1) {
    background-color: #000000;
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    transform: rotateX(-90deg);
    -webkit-transform: rotateX(-90deg);
    -moz-transform: rotateX(-90deg);
}

a .button:hover div:nth-child(2) {
    color: #ffffff;
    transition: all 0.2s ease;
    -webkit-transition: all 0.2s ease;
    -moz-transition: all 0.2s ease;
    transform: rotateX(0deg);
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
}

a .button:hover div:nth-child(3) {
    background-color: #000000;
    transition: all 0.2s ease 0.1s;
    -webkit-transition: all 0.2s ease 0.1s;
    -moz-transition: all 0.2s ease 0.1s;
    transform: rotateX(90deg);
    -webkit-transform: rotateX(90deg);
    -moz-transform: rotateX(90deg);
}

a .button:hover div:nth-child(4) {
    color: #ffffff;
    transition: all 0.2s ease 0.1s;
    -webkit-transition: all 0.2s ease 0.1s;
    -moz-transition: all 0.2s ease 0.1s;
    transform: rotateX(0deg);
    -webkit-transform: rotateX(0deg);
    -moz-transform: rotateX(0deg);
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