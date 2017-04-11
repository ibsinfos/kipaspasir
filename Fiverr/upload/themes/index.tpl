<div class="bodybg">
	<div class="whitebody">
        <div class="bodyshadow"></div>
        <div class="cusongs" style="padding-top:25px;">
            <div class="cusongtitle">
                <h3>{$lang109}:</h3>
                <p>
                	{if $s eq "d" OR $s eq ""}
                	<a href="{$baseurl}?s=dz{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang110}</a> 
                    {else}
                    <a href="{$baseurl}?s=d{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "d" OR $s eq "dz" OR $s eq ""}class="active"{/if}>{$lang110}</a> 
                    {/if}
                    {if $s eq "p"}
                    <a href="{$baseurl}?s=pz{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang111}</a> 
                    {else}
                    <a href="{$baseurl}?s=p{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "p" OR $s eq "pz"}class="active"{/if}>{$lang111}</a> 
                    {/if}
                    {if $s eq "r"}
                    <a href="{$baseurl}?s=rz{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang112}</a>
                    {else}
                    <a href="{$baseurl}?s=r{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "r" OR $s eq "rz"}class="active"{/if}>{$lang112}</a>
                    {/if} 
                    {if $s eq "c"}
                    <a href="{$baseurl}?s=cz{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang436}</a> 
                    {else}
                    <a href="{$baseurl}?s=c{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "c" OR $s eq "cz"}class="active"{/if}>{$lang436}</a> 
                    {/if}
                    {if $s eq "e"}
                    <a href="{$baseurl}?s=ez{if $sdisplay eq "list"}&sdisplay=list{/if}" class="active">{$lang494}</a> 
                    {else}
                    <a href="{$baseurl}?s=e{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $s eq "e" OR $s eq "ez"}class="active"{/if}>{$lang494}</a> 
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
                    <option value="{$baseurl}?s=o&p={$packs[p].pprice|stripslashes}{if $sdisplay eq "list"}&sdisplay=list{/if}" {if $p eq $packs[p].pprice|stripslashes}selected="selected"{/if}>{$lang197}{$packs[p].pprice|stripslashes}</option>
                    {/section}
                    </select>
                    {/if}             
                </p>
                
                <div class="topright">
                	{if $sdisplay eq "list"}
                    <a href="{$baseurl}/?page={$currentpage}{$adds}"><img src="{$imageurl}/leftbox_hover.png" /></a>
                    <a href="{$baseurl}/?page={$currentpage}{$adds}&sdisplay=list"><img src="{$imageurl}/rightbox.png" /></a>
                    {else}
                    <a href="{$baseurl}/?page={$currentpage}{$adds}"><img src="{$imageurl}/leftbox.png" /></a>
                    <a href="{$baseurl}/?page={$currentpage}{$adds}&sdisplay=list"><img src="{$imageurl}/rightbox_hover.png" /></a>
                    {/if}
                </div>
            
                <div class="clear"></div>
            </div>
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
            	{if $tpp ne ""}
            	<a href="{$baseurl}/?page={$tpp}{$adds}{if $sdisplay eq "list"}&sdisplay=list{/if}" class="agreenbutton">{$lang528}</a>
                {/if}
                {if $tnp ne ""}
                <a href="{$baseurl}/?page={$tnp}{$adds}{if $sdisplay eq "list"}&sdisplay=list{/if}" class="agreenbutton">{$lang527}</a>
                {/if}
            </div>
            <div class="clear" style="padding-bottom:20px;"></div>
            
        </div>
        <div class="noteworthy">
            <h2>{$lang529}</h2>
            {section name=i loop=$scriptolutionrand}
            {insert name=seo_clean_titles assign=title value=a title=$scriptolutionrand[i].gtitle}
            <div class="newgirl">
                <div class="newgirlimg"><a href="{$baseurl}/{$scriptolutionrand[i].seo|stripslashes}/{$scriptolutionrand[i].PID|stripslashes}/{$title}"><img src="{$purl}/t2/{$scriptolutionrand[i].p1}?{$smarty.now}" alt="{$scriptolutionrand[i].gtitle|stripslashes}" width="134" height="82" />{if $scriptolutionrand[i].youtube ne ""}{include file="scriptolution_bit_yt_small.tpl"}{/if}</a></div>
                <div class="newdetails">
                    <h3><a href="{$baseurl}/{$scriptolutionrand[i].seo|stripslashes}/{$scriptolutionrand[i].PID|stripslashes}/{$title}">{$lang62} {$scriptolutionrand[i].gtitle|stripslashes|mb_truncate:30:"...":'UTF-8'} {$lang63}{$scriptolutionrand[i].price|stripslashes}</a></h3>
                    <p>{$scriptolutionrand[i].gdesc|stripslashes|mb_truncate:100:"...":'UTF-8'} <a href="{$baseurl}/{$scriptolutionrand[i].seo|stripslashes}/{$scriptolutionrand[i].PID|stripslashes}/{$title}">{$lang105}</a></p>
                    <h5>{$lang414} <a href="{$baseurl}/{insert name=get_seo_profile value=a username=$scriptolutionrand[i].username|stripslashes}">{$scriptolutionrand[i].username|stripslashes|truncate:20:"...":true}</a>&nbsp;<span class="country {$scriptolutionrand[i].country}" title="{insert name=country_code_to_country value=a assign=userc code=$scriptolutionrand[i].country}{$userc}"></span></h5>
                </div>
                <div class="clear"></div>
            </div>
            {/section}
        </div>
        <div class="noteworthy">
            <h2>{$lang530}</h2>
            {section name=i loop=$scriptolutionrating}
            {insert name=seo_clean_titles assign=title value=a title=$scriptolutionrating[i].gtitle}
            <div class="newgirl">
                <div class="newgirlimg"><a href="{$baseurl}/{$scriptolutionrating[i].seo|stripslashes}/{$scriptolutionrating[i].PID|stripslashes}/{$title}"><img src="{$purl}/t2/{$scriptolutionrating[i].p1}?{$smarty.now}" alt="{$scriptolutionrating[i].gtitle|stripslashes}" width="134" height="82" />{if $scriptolutionrating[i].youtube ne ""}{include file="scriptolution_bit_yt_small.tpl"}{/if}</a></div>
                <div class="newdetails">
                    <h3><a href="{$baseurl}/{$scriptolutionrating[i].seo|stripslashes}/{$scriptolutionrating[i].PID|stripslashes}/{$title}">{$lang62} {$scriptolutionrating[i].gtitle|stripslashes|mb_truncate:30:"...":'UTF-8'} {$lang63}{$scriptolutionrating[i].price|stripslashes}</a></h3>
                    <p>{$scriptolutionrating[i].gdesc|stripslashes|mb_truncate:100:"...":'UTF-8'} <a href="{$baseurl}/{$scriptolutionrating[i].seo|stripslashes}/{$scriptolutionrating[i].PID|stripslashes}/{$title}">{$lang105}</a></p>
                    <h5>{$lang414} <a href="{$baseurl}/{insert name=get_seo_profile value=a username=$scriptolutionrating[i].username|stripslashes}">{$scriptolutionrating[i].username|stripslashes|truncate:20:"...":true}</a>&nbsp;<span class="country {$scriptolutionrating[i].country}" title="{insert name=country_code_to_country value=a assign=userc code=$scriptolutionrating[i].country}{$userc}"></span></h5>
                </div>
                <div class="clear"></div>
            </div>
            {/section}
        </div>
    	<div class="clear"></div>
	</div>
</div>