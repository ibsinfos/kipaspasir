            {insert name=seo_clean_titles assign=title value=a title=$p.gtitle}
            <div class="main-wrapper">
                <div id="main">
                    <div class="content"> 
                    {include file='view_image_js.tpl'}
                    <div class="section">
                        <div class="c">
                            <div class="article">
                                <div class="article-promo">
                                    <div class="article-txt">
                                        <div class="seller">
                                            <div class="holder">
                                                <div class="gig-header">						  
                                                    <div class="gig-title-g">
                                                        <h1 style="width:500px;">{$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}</h1>
                                                        <p>{$lang119}: <b><a href="{$baseurl}/categories/{$p.seo|stripslashes}">{$p.name|stripslashes}</a></b></p>
                                                        <ul class="gig-meta">
                                                            {if $smarty.session.USERID GT "0"}
                                                            {insert name=like_cnt value=var assign=liked pid=$p.PID}
                                                            <li id="removebookmark" class="like active" {if $liked ne "1"}style="display:none"{/if}><a href="{$baseurl}/bookmark?id={$p.PID|stripslashes}&do=rem" class="removebookmark">{$lang148}</a></li>
                                                            <li id="addbookmark" class="like" {if $liked eq "1"}style="display:none"{/if}><a href="{$baseurl}/bookmark?id={$p.PID|stripslashes}&do=add" class="addbookmark">{$lang147}</a></li>
                                                            {/if}
                                                        </ul>
                                                    </div>
                                                    {include file='view_ship.tpl'}
                                                    {include file='view_order_bit.tpl'}		
                                                    {include file='view_order_multi.tpl'}                                                        									
                                                </div>
												<link href="{$baseurl}/css/scriptolution.php" media="screen" rel="stylesheet" type="text/css" />                                               
                                                <br clear="all"/>
                                                <ul class="gig-stats prime ">
                                                    <li class="user-det">
                                                    	{insert name=get_member_profilepicture assign=profilepicture value=var USERID=$p.USERID}
                                                        <img src="{$membersprofilepicurl}/thumbs/{$profilepicture}?{$smarty.now}" width="50px" height="50px" align="left" class="user-photo" alt="true"/>		
                                                        <div>
                                                        	<a href="{$baseurl}/{insert name=get_seo_profile value=a username=$p.username|stripslashes}">{$p.username|stripslashes}</a>	
                                                            <br />
                                                            {insert name=get_percent value=a assign=mpercent userid=$p.USERID}
                                                            {if $mpercent ne ""}
                                                            <div class='user-rate'>{$lang398} <span class='colored green'>{$mpercent}&#37;</span></div>
                                                            {else}
                                                            <div class='user-rate'>{$lang138}</div>
                                                            {/if}
                                                            <br class="clear" />
                                                            <div class="country {$p.country}"></div>
                                                            
                                                        </div>
                                                    </li>
                                                    <li class="queue ">
                                                    	{if $p.days eq "0"}
                                                        {include file='view_instant.tpl'}
                                                    	{elseif $p.days eq "1"}
                                                        <div class="big-txt">24<span class="mid-txt">{$lang493}</span></div>
                                                        {else}
                                                        <div class="big-txt">{$p.days|stripslashes}<span class="mid-txt">{$lang131}</span></div>
                                                        {/if}
                                                        <div class="small-txt">{$lang474}</div>
                                                    </li>
                                                    <li class="gig-rating">
                                                    	{if $f|@count eq "0"}
                                                        <span class="big-txt">{$lang471} </span>
                                                        <div class="small-txt">{$lang138}</div> 
                                                        {else}
                                                        {insert name=get_rating value=a assign=percent b=$brat g=$grat}
                                                        <span class="big-txt">{$percent}<span class='mid-txt'>&#37;</span> </span>
                                                        <div class="small-txt max-rate">{$lang472}</div>
                                                        {/if}   
                                                    </li>
                                                    <li class="queue ">
                                                        <div class="big-txt">{$quecount}<span class="mid-txt">{$lang475}</span></div>
                                                        <div class="small-txt">{$lang473}</div>
                                                    </li>
                                                
                                                    <li class="clear">
                                                    </li>
                                                </ul>
									  			<br clear="all"/>
												<div class="gig-desc">
                                                	<div class="mydesc" style="padding-bottom:15px;">
													{$p.gdesc|stripslashes}
                                                    </div>
                                                    {literal}
													<script type="text/javascript">
													$(document).ready( function() {
														$('a#fbsharer').click(function (){ 
															url = encodeURIComponent('{/literal}{$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title|replace:"'":""}?viewmode=1{literal}');
															title = encodeURIComponent('{/literal}{$p.username|stripslashes}: {$lang62} {$p.gtitle|stripslashes|replace:"'":""} {$lang63}{$p.price|stripslashes}.{literal}');
															fbshare_url = 'http://www.facebook.com/sharer.php?u=' + url + '&t=' + title;
															openCenteredWindow(fbshare_url);
															return false;
														});
													});
													</script>
                                                    {/literal}
                                                    <ul class="share-control">
                                                        <li>
                                                            {$lang135}:
                                                        </li>
                                                        <li>
                                                            <a id="fbsharer" href='#'><img alt="Btn-facebook" src="{$imageurl}/btn-facebook.png" />&nbsp; facebook</a>
                                                        </li>
                                                        <li>
                                                            <a href="mailto:?subject={$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}&amp;body={$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title}" target="_blank"><img alt="Btn-email" src="{$imageurl}/btn-email.png?1283617092" /></a>&nbsp;
                                                            <a href="mailto:?subject={$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}&amp;body={$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title}">email</a>
                                                        </li>
                                                        {insert name=get_short_url value=a assign=takento PID=$p.PID seo=$p.seo short=$posts[i].short title=$title}
                                                        {if $short_urls eq "1"}
                                                        <li>
                                                            <a href="http://twitter.com/share" class="twitter-share-button" data-url="{$baseurl}/{$p.seo|stripslashes|replace:' ':'+'}/{$p.PID|stripslashes}/{$title}" data-via="{$twitter}" data-text="{$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}" data-count="none">Tweet</a>
                                                            <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                                        </li>
                                                        <li>
                                                        	<a href="http://pinterest.com/pin/create/button/?url={$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title}&media={$purl}/t2/{$p.p1}&description={$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                                                        </li>
                                                        <li>
                                                        	<g:plusone size="medium" count="false" href="{$takento}"></g:plusone>
                                                        </li>
                                                        {else}
                                                        <li>
                                                            <a href="http://twitter.com/share" class="twitter-share-button" data-url="{$baseurl}/{$p.seo|stripslashes|replace:' ':'+'}/{$p.PID|stripslashes}/{$title}" data-via="{$twitter}" data-text="{$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}" data-count="none">Tweet</a>
															<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                                                        </li>
                                                        <li>
                                                        	<a href="http://pinterest.com/pin/create/button/?url={$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title}&media={$purl}/t2/{$p.p1}&description={$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
                                                        </li>
                                                        <li>
                                                        	<g:plusone size="medium" count="false" href="{$takento}"></g:plusone>
                                                        </li>
                                                        {/if}
                                                        <li>
                                                            <a class="addthis_button" addthis:url="{$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title}" addthis:title="{$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}" href="http://www.addthis.com/bookmark.php?v=250&amp;pub="><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share"></a>
                                                            {literal}
                                                            <script type="text/javascript">
                                                            var addthis_config = {
                                                                services_exclude: 'email, facebook, twitter, print'
                                                            }
                                                            </script>
                                                            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pub="></script>
                                                            {/literal}
                                                        </li>
                                                        {include file='view_vjs.tpl'}
                                                    </ul>
                                                    <div style="padding-top:15px;">
                                                    {if $smarty.session.USERID ne $p.USERID}
                                                    {if $smarty.session.USERID GT "0"}
                                                        <a href="{$baseurl}/{insert name=get_seo_convo value=a assign=cvseo username=$p.username|stripslashes}{$cvseo}?id={$p.PID}">{$lang142}</a>
                                                    {else}
                                                        <a href="{$baseurl}/login?r={insert name=get_redirect2 value=a assign=rurl2 uname=$p.username pid=$p.PID}{$rurl2|stripslashes}">{$lang142}</a>
                                                    {/if}
                                                    {/if}
                                                    </div>
												</div>
												<div class="image-box-holder">
													{include file='view_image_box.tpl'}												
                                                    <div id="photo1"><img alt="{$p.gtitle|stripslashes}" src="{$purl}/t2/{$p.p1}?{$smarty.now}" /></div>	
                                                    {if $p.p2 ne ""}<div id="photo2"><img alt="{$p.gtitle|stripslashes}" src="{$purl}/t2/{$p.p2}?{$smarty.now}" /></div>	{/if}
                                                    {if $p.p3 ne ""}<div id="photo3"><img alt="{$p.gtitle|stripslashes}" src="{$purl}/t2/{$p.p3}?{$smarty.now}" /></div>	{/if}
												</div>
											</div>
										</div>
										<div class="spacer plus10"></div>
											{if $p.youtube ne ""}{include file='view_yt.tpl'}{/if}											
										</div>
									</div>
        							{include file='view_extra.tpl'}                       
									<div class="article-info">
                                    <div>
                                        <ul class="gig-stats secondary">
                                            <li class="thumbs">
                                                <div class="gig-stats-numbers"><span>{$grat}</span></div>
                                                <div class="thumb"></div>
                                                <br class="clear" />
                                                <div class="gig-stats-text">{$lang476}</div>
                                            </li>
                                        
                                            <li class="thumbs">
                                                <div class="gig-stats-numbers"><span>{$brat}</span></div>
                                                <div class="down"><span class="thumb"></span></div>
                                                <br class="clear" />
                                                <div class="gig-stats-text">{$lang477}</div>
                                            </li>
                                        
                                            <li class="thumbs stars">
                                                <div class="gig-stats-numbers">{$ftot}</div>
                                                <div class="stat-star"></div>
                                                <br class="clear" />
                                                <div class="gig-stats-text">{$lang478}</div>
                                            </li>
                                            
                                            <li class="clear"></li>
                                        </ul>   
                                    </div>
                                    {if $f|@count GT 0}
                                    <div class="feedback">
                                        <h3>{$lang143}</h3>
                                        <ul>
                                        	{section name=i loop=$f}
                                            <li>
                                                <div>
                                                    <a href="{$baseurl}/{insert name=get_seo_profile value=a username=$f[i].username|stripslashes}">{$f[i].username|stripslashes}</a>                                                    
                                                        <img src="{$imageurl}/thumb_{if $f[i].good eq "1"}up{else}down{/if}.png" align="absmiddle" border="0"/>
                                                    <div>
                                                    <p>{$f[i].comment|stripslashes}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            {/section}
                                        </ul>
                                    </div>
                                    {/if}
				
                                    <div class="other-gigs">
                                        <h3>{$lang137} <strong><a href="{$baseurl}/{insert name=get_seo_profile value=a username=$p.username|stripslashes}">{$p.username|stripslashes}</a></strong></h3>
                                        <ul>                    
                    					{section name=i loop=$u}
                                        {insert name=seo_clean_titles assign=utitle value=a title=$u[i].gtitle}
                                        <li class="other-gig-box">
                                            <a href="{$baseurl}/{$u[i].seo|stripslashes}/{$u[i].PID|stripslashes}/{$utitle}"><img alt="{$u[i].gtitle|stripslashes}" src="{$purl}/t2/{$u[i].p1}?{$smarty.now}" /></a>
                                            <div>
                                            <p><a href="{$baseurl}/{$u[i].seo|stripslashes}/{$u[i].PID|stripslashes}/{$utitle}">{$lang62} {$u[i].gtitle|stripslashes} {$lang63}{$u[i].price|stripslashes}</a></p>
                                            <p class="category-label"><a href="{$baseurl}/categories/{$u[i].seo|stripslashes}">{$u[i].name|stripslashes}</a></p>
                                            </div>
                                        </li>
										{/section}
                                        </ul>
                                    </div>

										<div class="related-gigs">
											<h3>{$lang136}</h3>
											<ul>
                                            	{section name=i loop=$r}
                                                {insert name=seo_clean_titles assign=rtitle value=a title=$r[i].gtitle}
                                                <li class="other-gig-box">
                                                    <a href="{$baseurl}/{$r[i].seo|stripslashes}/{$r[i].PID|stripslashes}/{$rtitle}"><img alt="{$r[i].gtitle|stripslashes}" src="{$purl}/t2/{$r[i].p1}?{$smarty.now}" /></a>
                                                    <div>
                                                    <p><a href="{$baseurl}/{$r[i].seo|stripslashes}/{$r[i].PID|stripslashes}/{$rtitle}">{$lang62} {$r[i].gtitle|stripslashes} {$lang63}{$r[i].price|stripslashes}</a></p>
                                                    <p class="category-label"><a href="{$baseurl}/categories/{$r[i].seo|stripslashes}">{$r[i].name|stripslashes}</a></p>
                                                
                                                    </div>
                                                </li>
                                                {/section}
											</ul>
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