 {literal}
 <style>
 .featured h2
 {
 	font: bold 1.8100em arial,helvetica,sans-serif;
 }
 .iwill
 {
	 height:auto;
	 background-color: #F7F7F7;
	padding: 10px;
 }
 .sugtop
 {
	font: 24px Helvetica,Arial,sans-serif;
	font-weight: bold;
	color:#5E5B5B; 
 }
 .in
 {
	 display:inline-block;
 }
 .scriptolution_will
 {
	font-size:14px; 
	font-weight:normal;
 }
 .scriptolution_want
 {
	font-size:16px; 
	padding: 5px; 
 }
 </style>
 {/literal}
              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {include file="error.tpl"}
                  
                  
                  
                  <form action="{$baseurl}/suggested" method="POST">
                    <div class="iwill">
                        <div class="sugtop">{$lang116}</div>
                        <div class="iwill-holder">
                            <div class="txt">{$lang117} </div>
                            <div class="f"><input class="text" type="text" value="" maxlength="80" name="sugcontent" /></div>
                            <div style="clear:both; padding-top:5px;"></div>
                            <div class="in">{$lang119}</div>
                            <select name="sugcat">
                            {insert name=get_categories assign=c}
                            {section name=i loop=$c}
                            <option value="{$c[i].CATID|stripslashes}">{$c[i].name|stripslashes}</option>
                            {/section}
                            </select>
                            <div style="clear:both; padding-top:5px;"></div>
                            <div><input type="submit" value="{$lang118}" class="button" style="padding-left:5px;padding-right:5px;padding-top:3px;padding-bottom:3px;" /></div>
                        </div>
                    </div>
                    <input type="hidden" name="sugsub" value="1" />
                    </form>
                  
                  
                  
					<div class="darkenBackground"></div>
                    <div class="featured">   
                    	<div style="padding-top:10px; padding-bottom:10px; font-size:24px">{$lang496}</div>
                    	<div class="gig_filters bordertop">
                          <div class="ul bg-f-a">
                            	<div class="li"><span class="helptext">{$lang109}</span></div>
                            	{if $s eq "d" OR $s eq ""}
                                <div class="li last"><a href="{$baseurl}/suggested?s=dz" class="current">{$lang110}</a></div>
                                {else}
                                <div class="li last"><a href="{$baseurl}/suggested?s=d" {if $s eq "d" OR $s eq "dz" OR $s eq ""}class="current"{/if}>{$lang110}</a></div>
                                {/if}
                          </div>
                        </div>                
                        {include file="bit_suggest.tpl"}
                    </div>
                    
  					<div class="paging">
                    	<div class="p1">
                        	<ul>
                            	{$pagelinks}
                            </ul>
                        </div>
                    </div>
                  </div>
                  {include file="side3.tpl"}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>