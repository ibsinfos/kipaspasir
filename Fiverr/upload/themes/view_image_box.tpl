													<div class="image-box">
														<img alt="{$p.gtitle|stripslashes}" id="big-image" src="{$purl}/t/{$p.p1}?{$smarty.now}" />
														<ul class="tags">
                                                        	{section name=i loop=$tags}
															<li><span><a href="{$baseurl}/tags/{$p.seo|stripslashes}/{$tags[i]|stripslashes}">{$tags[i]|stripslashes}</a></span></li>
															{/section}
														</ul>
													</div>