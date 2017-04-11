              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}
                  	<link href="{$baseurl}/css/scriptolution_cat.css" media="screen" rel="stylesheet" type="text/css" />
                    <div class="cat-utility-area ">
                        <h1 class="page-title">{$lang504}</h1>
                        <div class="cat-explore-box">	
                            <div class="cat-page-subcat-area">
                                <div class="pagetop-search">
                                    <form action="{$baseurl}/search" method="get">				
                                    <div class="row">
                                        <input class="text" name="query" type="text" value="{$tag|stripslashes}" />
                                        <input type="submit" value="{$lang504}" />
                                        <div class="search-in">
                                            <label for="Search_In:">{$lang503}:</label>
                                            {if $c GT "0"}
                                            <input {if $search_in ne "scriptolution_all"}checked="checked"{/if} name="search_in" type="radio" value="scriptolution_category" />
                                            <label for="search_cat">{$cname|stripslashes}</label>
                                            
                                            <input {if $search_in eq "scriptolution_all"}checked="checked"{/if} name="search_in" type="radio" value="scriptolution_all" />
                                            <label for="everywhere">{$lang505}</label>
                                            
                                            <input name="c" type="hidden" value="{$c|stripslashes}" />
                                            {else}
                                            <input checked="checked"  name="search_in" type="radio" value="scriptolution_all" />
                                            <label for="everywhere">{$lang505}</label>
                                            {/if}
                                        </div>
                                    </div>
                                    </form>	
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom:10px;"></div>
                    <div class="results-bar">
                        <h2>{$lang124}<span>:</span> {$tag|stripslashes}</h2>
                    
                        <p>{$lang125} <b>{$beginning}&nbsp;-&nbsp;{$ending}</b> {$lang470} <b>{$total}</b></p>
                    </div>
                    <div class="featured">   
                    	<div class="gig_filters bordertop">
                          <div class="ul bg-f-a">
                                <div class="li"><span class="helptext">{$lang109}</span></div>
                            	{if $s eq "d" OR $s eq ""}
                                <div class="li sep-right"><a href="{$baseurl}/search?s=dz&query={$tag}&search_in={$search_in}&c={$c}" class="current">{$lang110}</a></div>
                                {else}
                                <div class="li sep-right"><a href="{$baseurl}/search?s=d&query={$tag}&search_in={$search_in}&c={$c}" {if $s eq "d" OR $s eq "dz" OR $s eq ""}class="current"{/if}>{$lang110}</a></div>
                                {/if}
                                {if $s eq "p"}
                                <div class="li sep-right"><a href="{$baseurl}/search?s=pz&query={$tag}&search_in={$search_in}&c={$c}" class="current">{$lang111}</a></div>
                                {else}
                                <div class="li sep-right"><a href="{$baseurl}/search?s=p&query={$tag}&search_in={$search_in}&c={$c}" {if $s eq "p" OR $s eq "pz"}class="current"{/if}>{$lang111}</a></div>
                                {/if}
                                {if $s eq "r"}
                                <div class="li sep-right"><a href="{$baseurl}/search?s=rz&query={$tag}&search_in={$search_in}&c={$c}" class="current">{$lang112}</a></div>
                                {else}
                                <div class="li sep-right"><a href="{$baseurl}/search?s=r&query={$tag}&search_in={$search_in}&c={$c}" {if $s eq "r" OR $s eq "rz"}class="current"{/if}>{$lang112}</a></div>
                                {/if}
                                {if $s eq "c"}
                                <div class="li sep-right"><a href="{$baseurl}/search?s=cz&query={$tag}&search_in={$search_in}&c={$c}" class="current">{$lang436}</a></div>
                                {else}
                                <div class="li sep-right"><a href="{$baseurl}/search?s=c&query={$tag}&search_in={$search_in}&c={$c}" {if $s eq "c" OR $s eq "cz"}class="current"{/if}>{$lang436}</a></div>
                                {/if}
                                
                                <div class="li sep-right">
                                {if $price_mode eq "3"}
                                <script language="JavaScript" type="text/JavaScript"> 
								function Scriptolution_jumpMenu(targ,selObj,restore){
								  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'"); 
								  if (restore) selObj.selectedIndex=0; 
								} 
								</script> 
                                {insert name=get_packs value=a assign=packs}
                                <select onChange="Scriptolution_jumpMenu('parent',this,0)">
                                <option value="{$baseurl}">{$lang495}</option>
                                {section name=p loop=$packs}
                                <option value="{$baseurl}/search?s=o&p={$packs[p].pprice|stripslashes}&query={$tag}&search_in={$search_in}&c={$c}" {if $p eq $packs[p].pprice|stripslashes}selected="selected"{/if}>{$lang197}{$packs[p].pprice|stripslashes}</option>
                                {/section}
                                </select>
                                {/if}
                                </div>
                                
                                {if $s eq "e"}
                                <div class="li last"><a href="{$baseurl}/search?s=ez&query={$tag}&search_in={$search_in}&c={$c}" class="current">{$lang494}</a></div>
                                {else}
                                <div class="li last"><a href="{$baseurl}/search?s=e&query={$tag}&search_in={$search_in}&c={$c}" {if $s eq "e" OR $s eq "ez"}class="current"{/if}>{$lang494}</a></div>
                                {/if}
                          </div>
                        </div>                
                        {include file="bit.tpl"}
                    </div>
                    
  					<div class="paging">
                    	<div class="p1">
                        	<ul>
                            	{$pagelinks}
                            </ul>
                        </div>
                    </div>
					<div class="rss-link"><a href="{$baseurl}/rss">{$lang108}</a></div>
                  </div>
                  {include file="side.tpl"}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>