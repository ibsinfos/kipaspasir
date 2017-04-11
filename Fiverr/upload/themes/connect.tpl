<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{if $mtitle ne ""}{$mtitle}{else}{if $pagetitle ne ""}{$pagetitle} - {/if}{$site_name}{/if}</title>
	<meta name="description" content="{if $mdesc ne ""}{$mdesc}{else}{if $pagetitle ne ""}{$pagetitle} - {/if}{if $metadescription ne ""}{$metadescription} - {/if}{$site_name}{/if}">
	<meta name="keywords" content="{if $mtags ne ""}{$mtags}{else}{if $pagetitle ne ""}{$pagetitle},{/if}{if $metakeywords ne ""}{$metakeywords},{/if}{$site_name}{/if}">    
    <link href="{$baseurl}/css/style.php" media="screen" rel="stylesheet" type="text/css" />
    <link href="{$baseurl}/css/scriptolution_countries.php" media="screen" rel="stylesheet" type="text/css" />
    <!--[if lte IE 8]><link href="{$baseurl}/css/ie8.php" media="screen" rel="stylesheet" type="text/css" /><![endif]-->
    <!--[if lte IE 7]><link href="{$baseurl}/css/ie7.php" media="screen" rel="stylesheet" type="text/css" /><![endif]-->
    <link href="{$baseurl}/css/uploadify.css" media="screen" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    var base_url = "{$baseurl}";
	</script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
	<script>
        sQuery = jQuery.noConflict(true);
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
	<script src="{$baseurl}/js/ie-hover-pack.js" type="text/javascript"></script>
	<script src="{$baseurl}/js/main.js" type="text/javascript"></script>
	<script src="{$baseurl}/js/topmenu.js" type="text/javascript"></script>
	<script src="{$baseurl}/js/jquery.cookie.js" type="text/javascript"></script>
	<script src="{$baseurl}/js/facebook_share.js" type="text/javascript"></script>    
    <script src="{$baseurl}/js/jquery.tools.min.js" type="text/javascript"></script>
    <script src="{$baseurl}/js/jquery.uploadify.v2.1.0.min.js" type="text/javascript"></script>
	<script src="{$baseurl}/js/swfobject.js" type="text/javascript"></script>
	<script src="{$baseurl}/js/jquery.corner.js" type="text/javascript"></script>
    <link rel="icon" href="{$baseurl}/favicon.ico" />
    <link rel="shortcut icon" href="{$baseurl}/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <link href="{$baseurl}/css/scriptolution_style.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="{$baseurl}/js/jquery.customSelect.js"></script>
	<script src="{$baseurl}/js/scriptolution.js"></script>
    {if $rtl eq "1"}{include file='scriptolution_rtl2.tpl'}{/if}
</head>
<body class="inner">
<div id="loadme"></div>
{if $enable_fc eq "1"}
<div id="fb-root"></div>
{literal}
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  FB.init({appId: '{/literal}{$FACEBOOK_APP_ID}{literal}', status: true,
           cookie: true, xfbml: true});
  FB.Event.subscribe('auth.login', function(response) {
  });	  
</script>
{/literal}
{/if}
{if $smarty.session.USERID ne ""}
{literal}
<script type="text/javascript">
function loadContent(elementSelector, sourceURL) {
$(""+elementSelector+"").load(""+sourceURL+"");
}
</script>
{/literal}
{/if}
<div class="header">
	<div class="centerwrap relative">
    	<div class="headertop">
        	<div class="logo"><a href="{$baseurl}/"><img src="{$imageurl}/scriptolution_logo.png" alt="{$site_name}" /></a></div>        	
        	<div class="clear"></div>
        </div>
    </div>
</div>
    <div id="main-wrapper">
      <div id="wrapper">
        <div class="main-area">
          <div class="main-content">
            <div class="main-content">
              <div class="main-wrapper">
                <div id="main">
                  <div>
                      	<link href="{$baseurl}/css/login.css" media="screen" rel="stylesheet" type="text/css" />
                        <div class="login-holder">	
                            <div id="login-toggle-box" class="login-container">
                                <div id="reg-login">
                                    <div class="login-area">
                                        <div class="loginform" >
                                            <div class="loginwrapper" >
                                                <div class="badge-header">
                                                    <h2>{$lang448}</h2>
                                                    <h3>{$lang449}</h3>
                                                </div>
                                                <form action="{$baseurl}/connect.php" method="post">  
                                                    {if $error ne ""}
                                                        <div id="errorExplanation">
                                                            <h2>{$lang11}</h2>
                                                            <ul style="width:700px;">
                                                                {$error}
                                                            </ul>
                                                        </div>
                                                    {/if}
                                                    <div class="form-entry">
                                                        <label for="l_username">{$lang36}</label>
                                                        <input class="text" id="l_username" maxlength="16" name="l_username" size="16" tabindex="1" type="text" value="{$user_username}" />
                                                    </div>
                                                    <div class="row">
                                                        <input type="submit" value="{$lang46}" class="button" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px;" />
                                                        <input type="hidden" name="jlog" id="jlog" value="1" />
                                                    </div>
                                                </form>
                                            </div>
                                            <div style="float:right"><a href="{$baseurl}/logout.php">{$lang27}</a></div>
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                </div>                
              </div>
              <div style="height:450px;"></div>
            </div>
          </div>
        </div>
      </div>