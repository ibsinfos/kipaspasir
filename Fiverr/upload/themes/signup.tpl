              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                      	<link href="{$baseurl}/css/login.css" media="screen" rel="stylesheet" type="text/css" />
                        <div class="login-holder">	
                            <div id="join-toggle-box" class="join-holder">
                                <div class="login-container">
                                    <div id="reg-register">
                                        <div class="join-area" style="display:block !important;">
                                            <div class="loginwrapper">                        
                                                <div class="badge-header">
                                                    <h2>{$lang1}</h2>
                                                    <h3>{$lang10} <a href="{$baseurl}/login{if $r ne ""}?r={$r|stripslashes}{/if}">{$lang2}</a></h3>
                                                </div>                        
                                                <form action="{$baseurl}/signup" method="post">
                                                
                                                	{if $error ne ""}
                                                        <div id="errorExplanation">
                                                            <h2>{$lang11}</h2>
                                                            <ul>
                                                                {$error}
                                                            </ul>
                                                        </div>
                                                    {/if}
                                                    
                                                    <div class="form-entry">
                                                        <label>{$lang4}</label>
                                                        <input class="text" id="user_email" name="user_email" size="30" type="text" value="{$user_email|stripslashes}" />
                                                    </div>
                                                    <div class="form-entry">
                                                        <label>{$lang5}</label>
                                                        <input class="text username" id="user_username" maxlength="15" name="user_username" size="15" type="text" value="{$user_username|stripslashes}" />
                                                        <div id="status" class="username-validation"></div>
                                                    </div>
                                                    <div class="form-entry">
                                                        <label class="style3">{$lang6}</label>
                                                        <input class="text style1" id="user_password" name="user_password" size="30" type="password" value="{$user_password|stripslashes}" />
                                                    </div>
                                                    {if $enable_captcha eq "3"}
                                                    <div class="form-entry">
                                                        <label class="style3">{$lang7}</label>
                                                        {$scriptolutiongetplaythru}
                                                    </div>
                                                    {/if}
                                                    <div class="bottom">
                                                        <div class="right">
                                                            <div class="form-entry"> 
                                                            	{if $enable_captcha eq "1"}                                                               
                                                                <div class="captcha">
                                                                    <label class="style1">{$lang7}</label><br/>
                                                                    <span><img src="{$baseurl}/include/captcha.php" style="border: 0px; margin:0px; padding:0px" id="cimg" /></span> <input class="text style2" id="captcha" name="user_captcha_solution" size="30" type="text" />
                                                                </div>	
                                                                {/if}				
                                                            </div>
                                                        </div>
                                                        <div class="left">
                                                        	<div class="remember" style="padding-bottom:5px;">
                                                                <input class="checkbox" id="user_terms_of_use" name="user_terms_of_use" type="checkbox" value="1" {if $user_terms_of_use eq "1"}checked="checked"{/if} />
                                                                <label for="user_terms_of_use"><a href="{$baseurl}/terms_of_service" target="_blank" style="text-decoration:none">{$lang8}</a></label>
                                                            </div>
                                                            <input type="submit" value="{$lang46}" class="button" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" />
                                                            <input type="hidden" name="jsub" id="jsub" value="1" />
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="r" value="{$r|stripslashes}" />
                                                    {if $enable_ref eq "1"}<input type="hidden" name="ref" value="{$ref|stripslashes}" />{/if}
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