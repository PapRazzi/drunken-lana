						{section name=i loop=$posts}
                        {if $smarty.section.i.iteration eq "6"}
                        <div style="padding:5px;">
                        <center>
                        {insert name=get_advertisement AID=3}
                        </center>
                        </div>
                        {/if}
                        {insert name=seo_clean_titles assign=title value=a title=$posts[i].gtitle}
                        <div class="box">
                          <div class="c">
                            <div class="holder">                              
                                {if $posts[i].feat eq "1"}<span class="featured-label">featured</span>{/if}
                              	<div class="frame-img">
                                	<a href="{$baseurl}/{$posts[i].seo|stripslashes}/{$posts[i].PID|stripslashes}/{$title}"><img alt="{$posts[i].gtitle|stripslashes}" src="/thumb/102x72xin/pics/{$posts[i].p1}" /></a>
                              	</div>
                              	<div class="frame">
                                	<h2><a href="{$baseurl}/{$posts[i].seo|stripslashes}/{$posts[i].PID|stripslashes}/{$title}/">{$lang62} {$posts[i].gtitle|stripslashes|truncate:50:"...":true} {$lang63}{$posts[i].price|stripslashes}{$lang446}</a></h2>
                                	<p>{$posts[i].gdesc|stripslashes|truncate:140:"...":true}<span>&nbsp;({$lang414} <a href="{$baseurl}/{insert name=get_seo_profile value=a username=$posts[i].username|stripslashes}/">{$posts[i].username|stripslashes}</a>)</span></p>
	                                <table>
                                        <tr>
                                            <td>
                                                <ul class="control">
                                                  <li>
                                                    <a href="{$baseurl}/{$posts[i].seo|stripslashes}/{$posts[i].PID|stripslashes}/{$title}">{$lang105}</a>
                                                  </li>
                                  		            <li class="share">
                                                        {literal}
                                                         <div id="vk_like_{/literal}{$smarty.section.i.index}{literal}"></div>
                                                        <script type="text/javascript">
                                                        VK.Widgets.Like("vk_like_{/literal}{$smarty.section.i.index}{literal}", {
                                                            type: "mini", 
                                                            "pageUrl" : "{/literal}{$baseurl}/{$posts[i].seo|stripslashes}/{$posts[i].PID|stripslashes}/{$title}{literal}/",
                                                            "pageTitle" : "{/literal}{$lang62} {$posts[i].gtitle|stripslashes} {$lang63}{$posts[i].price|stripslashes}{$lang446}{literal}",
                                                            "pageDescription" : "{/literal}{$posts[i].gdesc|escape:javascript}{literal}",
                                                            "pageImage" : "{/literal}{$baseurl}{literal}/pics/{/literal}{$posts[i].p1}{literal}"
                                                        }, {/literal}{$posts[i].PID}{literal});
                                                        </script>
                                                        {/literal}
                                  		            </li>
                                	            </ul>
                                            </td>
                                            <td>
                                	            <div class="quick-order">
	                                                <a class="login-link" {if $smarty.session.USERID ne ""}href="{$baseurl}/{$posts[i].seo|stripslashes}/{$posts[i].PID|stripslashes}/{$title}"{else}href="#" rel="#register-spotlight"{/if}>{$lang107}</a>                                  
                                	            </div>
                                            </td>
                                        </tr>
                                    </table>
                            	</div>
                            </div>
                          </div>
                        </div>
                        {/section}