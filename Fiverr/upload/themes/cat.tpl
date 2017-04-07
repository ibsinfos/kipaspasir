<div class="bodybg">
	<div class="whitebody">        
        {include file="cat_bit.tpl"}
        <div class="category-tags">
        {section name=i loop=$tags max=10}
        {if $tags[i] != ""}<a href="{$baseurl}/tags/{$cid}/{$tags[i]|stripslashes}" class="tag" title="logo">&nbsp;{$tags[i]|stripslashes}&nbsp;</a>{/if}
        {/section}
        </div>
        <div class="cusongs">
            <div class="cusongtitle">
                <h3>{$lang109}:</h3>
                <p>
                	{if $s eq "d" OR $s eq ""}
                	<a href="{$baseurl}/categories/{$cid}?s=dz{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang110}</a> 
                    {else}
                    <a href="{$baseurl}/categories/{$cid}?s=d{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "d" OR $s eq "dz" OR $s eq ""}class="active"{/if}>{$lang110}</a> 
                    {/if}
                    {if $s eq "p"}
                    <a href="{$baseurl}/categories/{$cid}?s=pz{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang111}</a> 
                    {else}
                    <a href="{$baseurl}/categories/{$cid}?s=p{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "p" OR $s eq "pz"}class="active"{/if}>{$lang111}</a> 
                    {/if}
                    {if $s eq "r"}
                    <a href="{$baseurl}/categories/{$cid}?s=rz{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang112}</a>
                    {else}
                    <a href="{$baseurl}/categories/{$cid}?s=r{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "r" OR $s eq "rz"}class="active"{/if}>{$lang112}</a>
                    {/if} 
                    {if $s eq "c"}
                    <a href="{$baseurl}/categories/{$cid}?s=cz{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang436}</a> 
                    {else}
                    <a href="{$baseurl}/categories/{$cid}?s=c{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "c" OR $s eq "cz"}class="active"{/if}>{$lang436}</a> 
                    {/if}
                    {if $s eq "e"}
                    <a href="{$baseurl}/categories/{$cid}?s=ez{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang494}</a> 
                    {else}
                    <a href="{$baseurl}/categories/{$cid}?s=e{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "e" OR $s eq "ez"}class="active"{/if}>{$lang494}</a> 
                    {/if}
                    {if $price_mode eq "3"}
					<script language="JavaScript" type="text/JavaScript"> 
                    function Scriptolution_jumpMenu(targ,selObj,restore){
                      eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'"); 
                      if (restore) selObj.selectedIndex=0; 
                    } 
                    </script> 
                    &nbsp;&nbsp;&nbsp;
                    {insert name=get_packs value=a assign=packs}
                    <select onChange="Scriptolution_jumpMenu('parent',this,0)" style="font-size:16px; margin-top:2px; margin-left:2px;">
                    <option value="{$baseurl}">{$lang495}</option>
                    {section name=p loop=$packs}
                    <option value="{$baseurl}/categories/{$cid}?s=o&p={$packs[p].pprice|stripslashes}{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $p eq $packs[p].pprice|stripslashes}selected="selected"{/if}>{$lang197}{$packs[p].pprice|stripslashes}</option>
                    {/section}
                    </select>
                    {/if}             
                </p>
                
                <div class="topright">
                	{if $sdisplay eq "list"}
                    <a href="{$baseurl}/categories/{$cid}?page={$currentpage}{$adds}"><img src="{$imageurl}/leftbox_hover.png" /></a>
                    <a href="{$baseurl}/categories/{$cid}?page={$currentpage}{$adds}&sdisplay=list"><img src="{$imageurl}/rightbox.png" /></a>
                    {else}
                    <a href="{$baseurl}/categories/{$cid}?page={$currentpage}{$adds}"><img src="{$imageurl}/leftbox.png" /></a>
                    <a href="{$baseurl}/categories/{$cid}?page={$currentpage}{$adds}&sdisplay=list"><img src="{$imageurl}/rightbox_hover.png" /></a>
                    {/if}
                </div>
            
                <div class="clear"></div>
            </div>
            {include file="scriptolution_error.tpl"}
            <div class="cusongslist">
            	{if $sdisplay eq "list"}
                {include file="scriptolution_bit_list.tpl"}
                <div style="padding-bottom:10px;"></div> 
                {else}
            	{include file="scriptolution_bit.tpl"}                
                {/if}
                <div class="clear"></div>
            </div>
            <div align="center">
                <div class="paging">
                    <div class="p1">
                        <ul>
                            {$pagelinks}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="rss-link"><a href="{$baseurl}/rss?c={$catselect}">{$lang108}</a></div>
            <div class="clear" style="padding-bottom:20px;"></div>
            
        </div>
        
    	<div class="clear"></div>
	</div>
</div>