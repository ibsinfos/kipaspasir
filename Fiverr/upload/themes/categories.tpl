              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                      {if $message ne ""}
                      {include file="error.tpl"}
                      {/if}
                        <div class="darkenBackground"></div>
                        <link href="{$baseurl}/css/scriptolution_dir.css" media="screen" rel="stylesheet" type="text/css" />
                        <h1 class="page-title">{$lang520}</h1>
                        <div class="category-tree" style="display:table;"> 
                            <div class="row" style="display:table-row;width:33%;">               
                                {insert name=get_categories assign=c}
                                {section name=i loop=$c}
                                <div class="category" style="display:table-cell;">
                                    <h2><a href="{$baseurl}/categories/{$c[i].seo|stripslashes}">{$c[i].name|stripslashes}</a></h2>
                                    {if $c[i].CATID ne "0"}
                                        <ul>
                                            {insert name=get_subcategories assign=scats parent=$c[i].CATID}
                                            {section name=j loop=$scats}
                                            <li><a href="{$baseurl}/categories/{$scats[j].seo|stripslashes}">{$scats[j].name|stripslashes}</a></li>
                                            {/section}
                                        </ul>
                                    {/if}
                                </div>
                                {if $smarty.section.i.iteration mod 3 eq "0"}
                                </div>
                                <div class="row" style="display:table-row;width:33%;">
                                {/if}
                                {/section}
                            </div>
                        </div>
              		</div>
                  {include file="side.tpl"}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>