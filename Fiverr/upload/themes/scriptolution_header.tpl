<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{if $mtitle ne ""}{$mtitle}{else}{if $pagetitle ne ""}{$pagetitle} - {/if}{$site_name}{/if}</title>
	<meta name="description" content="{if $mdesc ne ""}{$mdesc}{else}{if $pagetitle ne ""}{$pagetitle} - {/if}{if $metadescription ne ""}{$metadescription} - {/if}{$site_name}{/if}">
	<meta name="keywords" content="{if $mtags ne ""}{$mtags}{else}{if $pagetitle ne ""}{$pagetitle},{/if}{if $metakeywords ne ""}{$metakeywords},{/if}{$site_name}{/if}">   
    <link href="{$baseurl}/css/scriptolution_style_v5.css" media="screen" rel="stylesheet" type="text/css" />  
    <link href="{$baseurl}/css/scriptolution_countries.php" media="screen" rel="stylesheet" type="text/css" />  
    <script type="text/javascript">
    var base_url = "{$baseurl}";
	</script>
    <link rel="icon" href="{$baseurl}/favicon.ico" />
    <link rel="shortcut icon" href="{$baseurl}/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
	<script>
        sQuery = jQuery.noConflict(true);
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
    <script src="{$baseurl}/js/jquery.customSelect.js"></script>
	<script src="{$baseurl}/js/scriptolution.js"></script>
    {if $rtl eq "1"}{include file='scriptolution_rtl.tpl'}{/if}
    {include file='scriptolution_colorbox.tpl'}    
</head>
<body>
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
{if $smarty.session.USERID ne ""}
{literal}
<style>
.header{height:150px;}
.topnavbg{top:78px;}
</style>
{/literal}
{/if}
<div class="header">
	<div class="centerwrap relative">
    	<div class="headertop">
        	<div class="logo"><a href="{$baseurl}/"><img src="{$imageurl}/scriptolution_logo.png" alt="{$site_name}" /></a></div>
            <div class="search">
            	<dl id="sample" class="dropdown">
                    <dt><a href="#"><span>{$lang522}</span></a></dt>
                    <dd>
                        <ul>
                            <li><a href="#">{$lang522}</a></li>
                            {insert name=get_categories assign=c}
                            {section name=i loop=$c}
                            <li><a href="#" {literal}onclick="$('#scriptolution_search_cat').val('{/literal}{$c[i].CATID}'){literal};"{/literal}>{$c[i].name|stripslashes}</a></li>
                            {insert name=get_subcategories assign=subcat value=var parent=$c[i].CATID}
                            {if $subcat|@count GT "0"}
                            	{section name=sc loop=$subcat}
                            	<li><a href="#" {literal}onclick="$('#scriptolution_search_cat').val('{/literal}{$subcat[sc].CATID}'){literal};"{/literal}>- {$subcat[sc].name|stripslashes}</a></li>
                                {/section}
                            {/if}
                            {/section}
                        </ul>
                    </dd>
                </dl>
                <form action="{$baseurl}/search" id="search_form" method="get">
                <input name="query" type="text" class="textbox"/>
                <input type="hidden" name="c" id="scriptolution_search_cat" value="0" />
                <input type="submit" value="" class="searchbtn" />
                </form>
            </div>
        	<div class="headeright">
            	{if $smarty.session.USERID ne ""}
            	<ul>
                	<li><a href="{$baseurl}/">{$lang0}</a></li>
                    {insert name=msg_cnt value=var assign=msgc}
                    <li><a href="{$baseurl}/inbox">{$lang28}{if $msgc GT "0"}<span>{$msgc}</span>{/if}</a></li>
                    <li><a href="{$baseurl}/{insert name=get_seo_profile value=a username=$smarty.session.USERNAME|stripslashes}">{$lang29}</a>
                    	<ul>
                        	{if $enable_ref eq "1"}<li><a href="{$baseurl}/myreferrals">{$lang512}</a></li>{/if}
                            <li><a href="{$baseurl}/bookmarks">{$lang30}</a></li>
                            <li><a href="{$baseurl}/settings">{$lang31}</a></li>
                            <li><a href="javascript:loadContent('#loadme', '{$baseurl}/log_out');">{$lang27}</a></li>
                        </ul>
                    </li>
                    <li><a href="{$baseurl}/manage_gigs">{$lang156}</a>
                    	<ul>
                        	<li><a href="{$baseurl}/new">{$lang55}</a></li>
                            <li><a href="{$baseurl}/manage_gigs">{$lang153}</a></li>
                            <li><a href="{$baseurl}/manage_orders">{$lang154}</a></li>
                            <li><a href="{$baseurl}/balance?tab=sales">{$lang155}</a></li>
                            <li><a href="{$baseurl}/purchases">{$lang461}</a></li>
                        </ul>
                    </li>
                    <li><a href="{$baseurl}/balance">{$lang158}</a>
                    	<ul>
                        	<li><a href="{$baseurl}/orders">{$lang157}</a></li>
                            <li><a href="{$baseurl}/mysuggestions">{$lang511}</a></li>
                            <li><a href="{$baseurl}/balance">{$lang159}</a></li>
                        </ul>
                    </li>
                </ul>
            	{else}
            	<ul>
                	<li><a href="{$baseurl}/">{$lang0}</a></li>
                    <li><a href="{$baseurl}/login">{$lang2}</a></li>
                    <li><a href="{$baseurl}/signup">{$lang1}</a></li>
                </ul>
                {if $enable_fc eq "1"}
                <div class="facebook"><a href="https://www.facebook.com/dialog/permissions.request?app_id={$FACEBOOK_APP_ID}&display=page&next={$baseurl}/&response_type=code&fbconnect=1&perms=email"><img src="{$imageurl}/scriptolution_facebook.jpg" alt="{$lang469}" /></a></div>
                {/if}
                {/if}
            </div>
        	<div class="clear"></div>
        </div>
        <div class="bannertext">
        	{if $smarty.session.USERID eq ""}
        	<h3>{$lang21} {$site_name}</h3>
            <h2>{$lang102}<br />{$lang103}</h2>
            <div class="getstarted"><a href="{$baseurl}/signup">{$lang523}</a></div>
            <p><a class='inline' href="#inline1" title="{$lang419}">{$lang419}</a></p>
            {/if}
            <div class="topnavbg">
            	<ul>
                	{section name=i loop=$c max=9}
                	<li><a href="{$baseurl}/categories/{$c[i].seo|stripslashes}">{$c[i].name|stripslashes}</a></li>{if $smarty.section.i.last}{else}<li>l</li>{/if}
                    {/section}
                </ul>
            </div>
        </div>
    </div>
    <div class="categories" id="scriptolution_floating_categories">
    	<div class="reletive">
            <a href="#" id="categories">{$lang524}</a>
            <ul class="categoriesname">
            	{section name=i loop=$c}
                <li><a href="{$baseurl}/categories/{$c[i].seo|stripslashes}">{$c[i].name|stripslashes}</a>
                	{insert name=get_subcategories assign=subcat value=var parent=$c[i].CATID}
                    {if $subcat|@count GT "0"}   
                	<div class="subdrop">
                        <ul>
                            <li>{$c[i].name|stripslashes}</li>
                            {section name=sc loop=$subcat}
                            <li><a href="{$baseurl}/categories/{$subcat[sc].seo|stripslashes}">{$subcat[sc].name|stripslashes}</a></li>
                            {/section}
                        </ul>
                    	<span class="subdroparrow"><img src="{$imageurl}/scriptolution_rightarrow_dropdown.png" alt="" /></span>
                    </div>
                    {/if}
                </li>
                {/section}
            </ul>
        </div>
    </div>
    {include file='scriptolution_resolution.tpl'}
</div>
{include file='scriptolution_colorbox2.tpl'}