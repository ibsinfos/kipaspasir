              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}                   
                     
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal_form" name="paypal_form">
                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="{$paypal_email}">
                    <input type="hidden" name="item_name" value="#{$p.PID|stripslashes} - {$lang455}">
                    <input type="hidden" name="item_number" value="{$p.PID|stripslashes}">
                    <input type="hidden" name="custom" value="{$smarty.session.USERID}">
                    <input type="hidden" name="amount" value="{$fprice|stripslashes}">
                    <input type="hidden" name="currency_code" value="{$currency}">
                    <input type="hidden" name="button_subtype" value="services">
                    <input type="hidden" name="no_note" value="1">
                    <input type="hidden" name="no_shipping" value="2">
                    <input type="hidden" name="rm" value="2">
                    <input type="hidden" name="return" value="{$baseurl}/feature_success?g={$eid}">
                    <input type="hidden" name="cancel_return" value="{$baseurl}/">
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
                    <input type="hidden" name="address_override" value="1">
                    <input type="hidden" name="notify_url" value="{$baseurl}/ipn_pf.php">
                    </form>    
                    
                    <form action="" method="post" id="bal_form" name="bal_form">
                    <input type="hidden" name="subbal" value="1">
                    </form>               
                    
                    <form method="post" action="https://secure.payza.com/checkout" id="alertpay_form" name="alertpay_form">
                    <input type="hidden" name="ap_merchant" value="{$alertpay_email}"/>
                    <input type="hidden" name="ap_purchasetype" value="service"/>
                    <input type="hidden" name="ap_itemname" value="{$lang455} #{$p.PID|stripslashes}"/>
                    <input type="hidden" name="ap_amount" value="{$fprice|stripslashes}"/>
                    <input type="hidden" name="ap_currency" value="{$alertpay_currency}"/>
                    <input type="hidden" name="ap_quantity" value="1"/>
                    <input type="hidden" name="ap_itemcode" value="{$smarty.session.USERID}"/>
                    <input type="hidden" name="ap_description" value="{$p.gtitle|stripslashes}"/>
                    <input type="hidden" name="ap_returnurl" value="{$baseurl}/feature_success?g={$eid}"/>
                    <input type="hidden" name="ap_cancelurl" value="{$baseurl}/"/>
                    <input type="hidden" name="apc_1" value="{$p.PID|stripslashes}"/>  
                    <input type="hidden" name="apc_2" value="featured"/>                        
                    </form>
                    
                    <div class="section"> 
                      <div class="t">&nbsp;</div> 
                      <div class="c"> 
                        <div class="page"> 
                          <div class="to-payment"> 
                            <h1><strong>{$lang455}</strong></h1>
                            <div class="featured">
                                {insert name=seo_clean_titles assign=title value=a title=$p.gtitle}
                                <div class="box edit">
                                  <div class="c">
                                    <div class="holder edit-status-&lt;%=gig.status%&gt;">
                                        <div class="frame-img">
                                            <a href="{$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title}"><img src="{$purl}/t2/{$p.p1}?{$smarty.now}" /></a>
                                        </div>
                                        <div class="frame">
                                            <h2>
                                                <a href="{$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title}">{$lang62} {$p.gtitle|stripslashes} {$lang63}{$p.price|stripslashes}</a>
                                            </h2>
                                            <p>
                                              {$p.gdesc|stripslashes}
                                            </p>                                
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                    		{if $p.feat eq "1"}
                            <h3>{$lang460}</h3>
                            {else}
                            <h3>{$lang457}</h3>
                            <h3>{$lang436}: {$lang197}{$fprice}</h3>
                            <h3>{$lang456}: {$fdays} {$lang131}</h3>
                            
                            {if $enable_paypal eq "1"}
                            <h2><a style="text-decoration:none" href="#" onclick="document.paypal_form.submit();">{$lang411}</a></h2>   
                            {/if}
                            {if $enable_alertpay eq "1"}                          
                            <h2><a style="text-decoration:none" href="#" onclick="document.alertpay_form.submit();">{$lang447}</a></h2>
                            {/if}
                            {if $funds GTE $fprice}
                            <h2><a style="text-decoration:none" href="#" onclick="document.bal_form.submit();">{$lang412}</a></h2>
                            {/if}
                            
                            {/if}
                            <div style="padding-bottom:20px;"></div>
                            <center>
                            <a href="{$baseurl}/{$p.seo|stripslashes}/{$p.PID|stripslashes}/{$title}" style="font-size:30px; text-decoration:none">{$lang458}</a>
                            </center>
                          </div> 
                        </div> 
                      </div> 
                      <div class="b">&nbsp;</div> 
                    </div>

                  </div>
                  {include file="side2.tpl"}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>