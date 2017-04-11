              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                      	<link href="{$baseurl}/css/login.css" media="screen" rel="stylesheet" type="text/css" />
                        <div class="login-holder">	
                            <div id="login-toggle-box" class="login-container">
                                <div id="reg-login">
                                    <div class="login-area">
                                        <div class="loginform" >
                                            <div class="loginwrapper" >
                                                <div class="badge-header">
                                                    <h2>{$lang39}</h2>
                                                    <h3>{$lang44}</h3>
                                                </div>
                                                <form action="{$baseurl}/forgotpassword" method="post">  
                                                	
                                                    {include file="error.tpl"}
                                                                                                  
                                                    <div class="form-entry">
                                                        <label for="email">{$lang4}</label>
                                                        <input class="text" id="email" name="email" tabindex="1" type="text" />
                                                    </div>
                                                    <div class="row">
                                                        <input type="submit" value="{$lang46}" class="button" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" />
                                                        <input type="hidden" name="fpsub" id="fpsub" value="1" />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                  {include file="side.tpl"}
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>