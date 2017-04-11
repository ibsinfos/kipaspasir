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
                                                    <h2>{$lang40}</h2>
                                                    <h3>{$lang48} <a href="{$baseurl}/signup{if $r ne ""}?r={$r|stripslashes}{/if}">{$lang49}</a></h3>
                                                </div>
                                                <form action="{$baseurl}/login" method="post">  
                                                	
                                                    {if $error ne ""}
                                                        <div id="errorExplanation">
                                                            <h2>{$lang11}</h2>
                                                            <ul>
                                                                {$error}
                                                            </ul>
                                                        </div>
                                                    {/if}
                                                                                                  
                                                    <div class="form-entry">
                                                        <label for="l_username">{$lang36}</label>
                                                        <input class="text" id="l_username" maxlength="16" name="l_username" size="16" tabindex="1" type="text" value="{$user_username}" />
                                                    </div>
                                                    <div class="form-entry">
                                                        <div class="form-label">
                                                            <label for="l_password">{$lang37}</label>
                                                            <span> <a href="{$baseurl}/forgotpassword" style="text-decoration:none">{$lang39}</a></span>
                                                        </div>
                                                        <input class="text" id="l_password" name="l_password" size="30" tabindex="2" type="password" />
                                                    </div>
                                                    <div class="row">
                                                        <input type="submit" value="{$lang2}" class="button" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" />
                                                        <input type="hidden" name="jlog" id="jlog" value="1" />
                                                        <div class="remember">
                                                            <input class="checkbox" id="l_remember_me" name="l_remember_me" type="checkbox" value="1" />
                                                            <label for="l_remember_me">{$lang38}</label>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="r" value="{$r|stripslashes}" />
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