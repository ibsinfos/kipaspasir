            <script src="{$baseurl}/js/jquery.qtip-1.0.0-rc3.js" type="text/javascript"></script>
            <script src="{$baseurl}/js/balance.js" type="text/javascript"></script>

			  <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}
					
                    <div class="page-title">
                    	<h2>{$lang462}</h2>
                    </div>
                    <div class="tabs">
                        <div class="tabSet">
                          <div class="tabControlShopping selected"><span>{$lang461} </span></div>
                        </div>
                        <div id="tabs-shopping" class="tabShopping yellow tabs index" style="{if $smarty.request.tab eq "sales"}display:none;{/if}">
                          <div class="info">
                              {if $o|@count eq "0"}{$lang209}{else}<b>{$o|@count}</b> {$lang379}{/if}
                          </div>    
                          {if $o|@count eq "0"}                    
                          <div class="stats shopping">
                            <div class="notice">
                              <p>{$lang464}</p>
                            </div>
                          </div>
                          {else}
                          	<div class="table-container"> 
                            <table width="100%"> 
                              <thead class="topics icons"> 
                                <tr> 
                                  <td class="date first">{$lang110}</td> 
                                  <td class="order">{$lang140}</td> 
                                  <td class="statuses"></td> 
                                  <td class="statuses"></td> 
                                  <td class="amount last">{$lang389}</td> 
                                </tr> 
                              </thead> 
                              <tbody> 
                              	{section name=i loop=$o}
                                <tr class="entry"> 
                                  <td class="first" align="left"><div>{insert name=get_time_to_days_ago value=a time=$o[i].time}</div></td>  
                                  <td class="id">#{$o[i].PID} </td> 
                                  <td class="gig"><div>{$o[i].gtitle|stripslashes}</div></td> 
                                  <td class="status reversal" title="{$lang463}"><div>{$lang463}</div></td> 
                                  <td class="gross last" width="5px"><div>{$lang197}{$o[i].price}</div></td> 
                                </tr> 
                                {/section}                     
                              </tbody> 
                            </table> 
                            <div class="sep"></div> 
                          </div> 
                          {/if}
                        </div>                          
                    </div>
                  </div>
                  {include file="side2.tpl"}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>