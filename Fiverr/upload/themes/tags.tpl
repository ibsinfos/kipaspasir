              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}
                  	{if $smarty.session.USERID ne ""}
                    {include file="sub_bit.tpl"}
                    {else}
                    <div class="welcomebox">
                      <div style="position:relative;"></div>
                      <h1>{$lang102}<br />{$lang103}</h1>
                      <h2>{$lang104}</h2>
                    </div>
					{/if}
					<div class="darkenBackground"></div>
                    
                    <div class="category-tags">
                    {if $tag != ""}<a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}" class="tag selected" title="{$tag|stripslashes}">&nbsp;{$tag|stripslashes}&nbsp;</a>{/if}
                    {section name=i loop=$tags max=10}
                    {if $tags[i] != "" AND $tags[i] !=$tag}<a href="{$baseurl}/tags/{$cid}/{$tags[i]|stripslashes}" class="tag" title="{$tags[i]|stripslashes}">&nbsp;{$tags[i]|stripslashes}&nbsp;</a>{/if}
                    {/section}
                    </div>

                    <div class="featured">   
                    	<div class="gig_filters bordertop">
                          <div class="ul bg-f-a">
                                <div class="li"><span class="helptext">{$lang109}</span></div>
                            	{if $s eq "d" OR $s eq ""}
                                <div class="li sep-right"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=dz" class="current">{$lang110}</a></div>
                                {else}
                                <div class="li sep-right"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=d" {if $s eq "d" OR $s eq "dz" OR $s eq ""}class="current"{/if}>{$lang110}</a></div>
                                {/if}
                                {if $s eq "p"}
                                <div class="li sep-right"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=pz" class="current">{$lang111}</a></div>
                                {else}
                                <div class="li sep-right"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=p" {if $s eq "p" OR $s eq "pz"}class="current"{/if}>{$lang111}</a></div>
                                {/if}
                                {if $s eq "r"}
                                <div class="li sep-right"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=rz" class="current">{$lang112}</a></div>
                                {else}
                                <div class="li sep-right"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=r" {if $s eq "r" OR $s eq "rz"}class="current"{/if}>{$lang112}</a></div>
                                {/if}
                                {if $s eq "c"}
                                <div class="li sep-right"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=cz" class="current">{$lang436}</a></div>
                                {else}
                                <div class="li sep-right"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=c" {if $s eq "c" OR $s eq "cz"}class="current"{/if}>{$lang436}</a></div>
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
                                <option value="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=o&p={$packs[p].pprice|stripslashes}" {if $p eq $packs[p].pprice|stripslashes}selected="selected"{/if}>{$lang197}{$packs[p].pprice|stripslashes}</option>
                                {/section}
                                </select>
                                {/if}
                                </div>
                                
                                {if $s eq "e"}
                                <div class="li last"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=ez" class="current">{$lang494}</a></div>
                                {else}
                                <div class="li last"><a href="{$baseurl}/tags/{$cid}/{$tag|stripslashes}?s=e" {if $s eq "e" OR $s eq "ez"}class="current"{/if}>{$lang494}</a></div>
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