            <script src="{$baseurl}/js/jquery.qtip-1.0.0-rc3.js" type="text/javascript"></script>
            <script src="{$baseurl}/js/balance.js" type="text/javascript"></script>

			  <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}
					
                    <div class="page-title">
                    	<h2>{$lang205} ({$lang197}{$funds})<b class="balance">{$lang206}</b></h2>
                    </div>
                    <div class="tabs">
                        <h2 class="richer"><span>{$lang207} <b>{$lang197}{$overall}</b></span></h2>
                        <div class="tabSet">
                          <div class="tabControlShopping {if $smarty.request.tab ne "sales"}selected{/if}"><span>{$lang33} </span></div>
                          <div class="tabControlSales {if $smarty.request.tab eq "sales"}selected{/if}"><span>{$lang208} </span></div>
                        </div>
                        <div id="tabs-shopping" class="tabShopping yellow tabs index" style="{if $smarty.request.tab eq "sales"}display:none;{/if}">
                          <div class="info">
                              {if $o|@count eq "0"}{$lang209}{else}<b>{$o|@count}</b> {$lang379}{/if}
                          </div>    
                          {if $o|@count eq "0"}                    
                          <div class="stats shopping">
                            <div class="notice">
                              <p>{$lang210} <a href="{$baseurl}/">{$lang211}</a></p>
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
                                {insert name=get_gtitle value=a assign=gtitle oid=$o[i].OID}
                                <tr class="entry"> 
                                  <td class="first" align="left"><div>{insert name=get_time_to_days_ago value=a time=$o[i].time}</div></td>  
                                  <td class="id">{if $gtitle eq ""}#{$o[i].OID}{else}<a href="{$baseurl}/track?id={$o[i].OID}">#{$o[i].OID}</a>{/if} </td> 
                                  <td class="gig"><div>{if $gtitle eq ""}{$lang384}{else}{$gtitle|stripslashes}{/if}</div></td> 
                                  {if $o[i].t eq "1"}
                                  <td class="status payment" title="{$lang385}: {$lang197}{$o[i].price}"><div>{$lang387}</div></td>
                                  {else}
                                  <td class="status reversal" title="{$lang386}: {$lang197}{$o[i].price}"><div>{$lang388}</div></td> 
                                  {/if}
                                  <td class="gross last" width="5px"><div>{$lang197}{$o[i].price}</div></td> 
                                </tr> 
                                {/section}                     
                              </tbody> 
                            </table> 
                            <div class="sep"></div> 
                          </div> 
                          {/if}
                        </div>  
                        {insert name=wdreq value=a assign=wreqnt}       
                        {if $afunds ne "0"}
                        {if $wreqnt eq "0"}
                        <form name="wdfrm" id="wdfrm" method="post" style="padding:0; margin:0">
                        <input type="hidden" name="wdfunds" value="1" />
                        </form>
                        <form name="wdfrm2" id="wdfrm2" method="post" style="padding:0; margin:0">
                        <input type="hidden" name="wdfunds2" value="1" />
                        </form>
                        {/if}
                        {/if}
                        <div id="tabs-sales" class="tabSales green tabs index" style="{if $smarty.request.tab ne "sales"}display:none;{/if}">
                            <div class="info">                            
                                <span class="left">{if $p|@count GT "0"}<b>{$p|@count}</b> {$lang379}{else}{$lang209}{/if}</span><span class="{if $afunds eq "0" OR $wreqnt GT "0"}disabled{/if} right"><strong><a href="#" {if $afunds ne "0"}onclick="toggle('wdsection');"{/if}>{if $wreqnt GT "0"}{$lang396}{else}{$lang212}{/if}</a></strong></span>
	                        </div>
                            {literal}
                            <script language="javascript" type="text/javascript">
							function toggle(obj) {
								var el = document.getElementById(obj);
								if ( el.style.display != 'none' ) {
									$('#' + obj).slideUp();
								}
								else {
									$('#' + obj).slideDown();
								}
							}
							</script>
                            <style>
							.info2{border:1px solid #DCDCCA;background:#DCDCCA;border-bottom:1px solid #CCCCBA!important;color:#5C5C5A;font-weight:bold;text-shadow:none;margin:0 0 10px;padding:10px 10px 10px 13px;}
							.info2{border:1px solid #E4ECEE;background:#E4ECEE;color:#577;font-weight:bold;text-shadow:#eff 1px 1px;border-bottom:1px solid #D4DCDE!important;margin:0 0 10px;}
							.info2{overflow:hidden;margin:0!important;padding:5px 5px 5px 13px;}
							.info2 span.right{float:right;background:#008dcd;border:1px solid #bcc;padding:4px 6px;}
							.info2 span.right a{text-decoration:none;text-shadow:none;color:#fff;}
							.info2 span.right:hover a{color:#008dcd;}
							.info2 span.right:hover{background:#fff;border:1px solid #008dcd;padding:4px 6px;}
							.info2 span.right2{float:right;background:#390;border:1px solid #bcc;padding:4px 6px;margin-left:5px;}
							.info2 span.right2 a{text-decoration:none;text-shadow:none;color:#fff;}
							.info2 span.right2:hover a{color:#390;}
							.info2 span.right2:hover{background:#fff;border:1px solid #390;padding:4px 6px;}
							.info2 span.right em{font-style:normal;}
							.info2 span.right.disabled{background:#fafafa;border:1px solid #dadada;cursor:text!important;padding:4px 6px;}
							.info2 span.right.disabled a{cursor:text!important;color:#aaa;}
							.info2 span.right.disabled:hover{border:1px solid #dadada!important;}
							</style>
                            {/literal}
                            <div class="info2" id="wdsection" style="display:none;">                            
                                {if $enable_alertpay eq "1"}
                                <span class="{if $afunds eq "0" OR $wreqnt GT "0"}disabled{/if} right2"><strong><a href="#" {if $afunds ne "0"}onclick="document.wdfrm2.submit();"{/if}>{if $wreqnt GT "0"}{$lang396}{else}{$lang451}{/if}</a></strong></span>
                                {/if}
                                {if $enable_paypal eq "1"}
                                <span class="{if $afunds eq "0" OR $wreqnt GT "0"}disabled{/if} right"><strong><a href="#" {if $afunds ne "0"}onclick="document.wdfrm.submit();"{/if}>{if $wreqnt GT "0"}{$lang396}{else}{$lang450}{/if}</a></strong></span>
                                {/if}
	                        </div>                            
                          	<div class="stats">
                            	<div class="pane">
                              		<h3 class="available"><b>{$lang197}{$afunds}</b>{$lang213}<span>{$lang214}</span></h3>
                              		<h3 class="pending"><b>{$lang197}{$app}</b>{$lang194}<span>{$lang394}</span></h3>
                              		<h3 class="upcoming right"><b>{$lang197}{$clr}</b>{$lang215}<span>{$lang216}</span></h3>
                            	</div>
                            	<div class="pane last">
                                	<h3 class="upcoming"><b>{$lang197}{$upcoming}</b>{$lang217}<span>{$lang218}</span></h3> 
                              		<h3 class="withdrawn"><b>{$lang197}{$withdrawn}</b>{$lang219}<span>{$lang220}</span></h3>
                                	<h3 class="paid-by"><b>{$lang197}{$used}</b> {$lang221}<span>{$lang222}</span></h3> 
                            	</div>
                          	</div> 
                            {if $p|@count GT "0"} 
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
                              	{section name=i loop=$p}
                                {if $p[i].IID GT "0"}
                                {insert name=get_ctp value=a assign=myctp IID=$p[i].IID}
                                {insert name=get_yprice value=a assign=yprice p=$p[i].price c=$myctp}
                                {else}
                                {insert name=get_yprice value=a assign=yprice p=$p[i].price c=$p[i].ctp}
                                {/if}
                                {insert name=get_gtitle value=a assign=gtitle oid=$p[i].OID}
                                <tr class="entry"> 
                                  <td class="first" align="left"><div>{insert name=get_time_to_days_ago value=a time=$p[i].time}</div></td>  
                                  <td class="id">{if $gtitle eq ""}#{$p[i].OID}{else}<a href="{$baseurl}/track?id={$p[i].OID}">#{$p[i].OID}</a>{/if} </td> 
                                  <td class="gig"><div>{if $gtitle eq ""}{$lang384}{else}{$gtitle|stripslashes}{/if}</div></td> 
                                  
                                {if $p[i].status eq "5"}
                                	{insert name=get_days_withdraw value=a assign=wd t=$p[i].cltime}
                                	{if $wd GT "0"}
	                                <td class="status clearing &nbsp;<u>{$wd}</u>" title="{$wd} {$lang391}"><div>{$lang392} &nbsp;<u>{$wd}</u></div></td>
                                    <td class="gross last" width="5px"><div>{$lang197}{$yprice}</div></td>
                                    {else}
                                    	{if $p[i].wd eq "1"}
                                        <td class="status withdrawn" title="{$lang397}"><div>{$lang397}</div></td>
                                        {else}
                                        <td class="status cleared" title="{$lang393}"><div>{$lang393}</div></td>
                                        {/if}
                                        <td class="gross last" width="5px"><div>{$lang197}{$yprice}</div></td>
                                    {/if}
                                {elseif $p[i].status eq "2" OR $p[i].status eq "3" OR $p[i].status eq "7"}
                                <td class="status cancelled" title="{$lang390}"><div>{$lang203}</div></td>
                                <td class="gross last" width="5px"><div>{$lang197}0</div></td>
                                {elseif $p[i].status eq "4"}
                                <td class="status completed" title="{$lang140}"><div>{$lang201}</div></td>
                                <td class="gross last" width="5px"><div>{$lang197}{$yprice}</div></td>
                                {else}
                                <td class="status withdrawal" title="{$lang362}"><div>{$lang362}</div></td>
                                <td class="gross last" width="5px"><div>{$lang197}{$yprice}</div></td>
                                {/if}
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