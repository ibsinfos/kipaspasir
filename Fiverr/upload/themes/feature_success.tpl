              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                    
                    <div class="section"> 
                      <div class="t">&nbsp;</div> 
                      <div class="c"> 
                        <div class="page"> 
                          <div class="to-payment"> 
                            <h1><strong>{$lang455}</strong></h1>
                            
                            {if $message ne ""}
                            {include file="error.tpl"}
                            {/if}
                  
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