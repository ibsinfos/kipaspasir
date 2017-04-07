						{section name=i loop=$posts}
                        {insert name=seo_clean_titles assign=title value=a title=$posts[i].gtitle}
                        <div class="cusongsblock {if $smarty.section.i.iteration % 4 == 0}last{/if}">
                            <div class="songperson">
                            	<a href="{$baseurl}/{$posts[i].seo|stripslashes}/{$posts[i].PID|stripslashes}/{$title}"><img src="{$purl}/t/{$posts[i].p1}?{$smarty.now}" alt="{$posts[i].gtitle|stripslashes}" width="214" height="132" /></a>
                                {if $posts[i].feat eq "1"}<span class="featured">{$lang526}</span>{/if}
                                {if $posts[i].toprated eq "1"}<span class="rated">{$lang525}</span>{/if}
                                {if $posts[i].youtube ne ""}{include file="scriptolution_bit_yt_small.tpl"}{/if}
                            </div>
                            <div class="price">{$lang197}{$posts[i].price|stripslashes}</div>
                            <p>
                            	{if $posts[i].days eq "0"}{include file='scriptolution_bit_instant.tpl'}{elseif $posts[i].days eq "1"}{include file='scriptolution_bit_express.tpl'}{/if}
                            	<a href="{$baseurl}/{$posts[i].seo|stripslashes}/{$posts[i].PID|stripslashes}/{$title}">{$lang62} {$posts[i].gtitle|stripslashes|mb_truncate:60:"...":'UTF-8'} {$lang63}{$posts[i].price|stripslashes}</a>
                            	<br />
                                <span class="scriptolution_user">
                                    {$lang414} <a href="{$baseurl}/{insert name=get_seo_profile value=a username=$posts[i].username|stripslashes}">{$posts[i].username|stripslashes|truncate:10:"...":true}</a>&nbsp;
                                    <span class="country {$posts[i].country}" title="{insert name=country_code_to_country value=a assign=userc code=$posts[i].country}{$userc}"></span>
                                </span>
                            </p>
                        </div>
                        {/section}