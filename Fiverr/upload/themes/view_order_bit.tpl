													<div class="orderNow">   
                                                    	{if $smarty.session.USERID eq $p.USERID}   
                                                        <a href="{$baseurl}/edit?id={$p.PID}" class="order-now-g roundedbutton" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px; background-color:#F60; color:#FFF;">{$lang141}</a>
                                                        {elseif $smarty.session.USERID GT "0"}
                                                        <a onclick="document.ordermulti.submit();" href="#" class="order-now-g roundedbutton" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px; background-color:#F60; color:#FFF;">{$lang140}</a>
                                                        {else}
                                                        <a href="{$baseurl}/login?r={insert name=get_redirect value=a assign=rurl PID=$p.PID seo=$p.seo gtitle=$title}{$rurl|stripslashes}" class="login-link order-now-g roundedbutton" style="padding-left:10px;padding-right:10px;padding-top:5px;padding-bottom:5px; background-color:#F60; color:#FFF;">{$lang140}</a>
                                                        {/if}
                                                    </div>