              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}                    
					<div class="darkenBackground"></div>
                    <div class="featured">   
                    	<div style="padding-top:10px; padding-bottom:10px; font-size:24px">{$lang511}</div>
                    	<div class="gig_filters bordertop">
                          <div class="ul bg-f-a">
                            	<div class="li"><span class="helptext">{$lang109}</span></div>
                            	{if $s eq "d" OR $s eq ""}
                                <div class="li last"><a href="{$baseurl}/mysuggestions?s=dz" class="current">{$lang110}</a></div>
                                {else}
                                <div class="li last"><a href="{$baseurl}/mysuggestions?s=d" {if $s eq "d" OR $s eq "dz" OR $s eq ""}class="current"{/if}>{$lang110}</a></div>
                                {/if}
                          </div>
                        </div>                
                        {include file="bit_suggest2.tpl"}
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