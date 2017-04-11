            <script src="{$baseurl}/js/jquery.qtip-1.0.0-rc3.js" type="text/javascript"></script>
            <script src="{$baseurl}/js/balance.js" type="text/javascript"></script>

			  <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}
					
                    <div class="page-title">
                    	<h2>{$lang512}</h2>
                    </div>
                    <div style="padding-bottom:7px;">
                    	<div style="font-size:16px">Your referral link is: {$baseurl}/signup?ref={$smarty.session.USERID|stripslashes}</div>
                        <br />
                        <div style="font-size:12px">For each unique member you refer that signs up you will get {$lang197}{$ref_price} added to your account balance once it is approved by us.</div>
                        <br />
                        <div style="font-size:12px; color:#F00">Note: If we decide a referral is fraud it will be declined and you will not receive anything.</div>
                    </div>
                    <div class="tabs">
                        <div class="tabSet">
                          <div class="tabControlShopping selected"><span>{$lang513} </span></div>
                        </div>
                        <div id="tabs-shopping" class="tabShopping yellow tabs index" style="{if $smarty.request.tab eq "sales"}display:none;{/if}">
                          <div class="info">
                              {if $o|@count eq "0"}{$lang515}{else}<b>{$o|@count}</b> {$lang514}{/if}
                          </div>    
                          {if $o|@count eq "0"}                    
                          <div class="stats shopping">
                            <div class="notice">
                              <p>{$lang516}</p>
                            </div>
                          </div>
                          {else}
                          	<div class="table-container"> 
                            <table width="100%"> 
                              <thead class="topics icons"> 
                                <tr> 
                                  <td class="date first">{$lang110}</td> 
                                  <td class="order">{$lang36}</td> 
                                  <td class="statuses"></td> 
                                  <td class="amount last">{$lang389}</td> 
                                </tr> 
                              </thead> 
                              <tbody> 
                              	{section name=i loop=$o}
                                <tr class="entry"> 
                                  <td class="first" align="left"><div>{insert name=get_time_to_days_ago value=a time=$o[i].time_added}</div></td>  
                                  <td class="id">{$o[i].username|stripslashes} </td> 
                                  {if $o[i].status eq "0"}
                                  <td class="status completed" title="{$lang194}"><div>{$lang194}</div></td> 
                                  {elseif $o[i].status eq "1"}
                                  <td class="status reversal" title="{$lang202}"><div>{$lang202}</div></td>
                                  {elseif $o[i].status eq "2"}
                                  <td class="status dispute" title="{$lang517}"><div>{$lang517}</div></td>
                                  {else}
                                  <td class="status reversal" title=""><div>&nbsp;</div></td>
                                  {/if}
                                  <td class="gross last" width="5px"><div>{$lang197}{if $o[i].status eq "2"}0{else}{$o[i].money}{/if}</div></td> 
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