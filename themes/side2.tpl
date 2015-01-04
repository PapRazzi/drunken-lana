                    <div class="sidebar">
                    	<form name="langselectru" id="langselectru" method="post" style="padding:0; margin:0">
                        <input type="hidden" name="language" value="russian" />
                        </form>
                        <div class="add-nav-title">
                            <div class="t">&nbsp;</div>
                            <div class="c">{$lang152}</div>
                            <div class="b">&nbsp;</div>
                        </div>
                        <div class="add-nav">
                            <div class="t">&nbsp;</div>
                            <div class="c">
                              <ul>
                                <li {if $sm1 eq "1"}class="active"{/if}><a href="{$baseurl}/manage_gigs">{$lang153}</a></li>
                                <li {if $sm2 eq "1"}class="active"{/if}><a href="{$baseurl}/manage_orders">{$lang154}</a></li>
                                <li {if $sm3 eq "1"}class="active"{/if}><a href="{$baseurl}/orders">{$lang157} </a></li>
                              </ul>
                            </div>
                            <div class="b">&nbsp;</div>
                        </div>
                    	<div class="feedback-positive">{$lang151} {insert name=get_percent2 value=a assign=percent}{$percent}&#37; {$lang139}</div>
                    	<br/>
                    	<br/>
                    	<div class="share ideas-box">
                    		<div class="t">&nbsp;</div>
                            <div class="c">
                              <div class="holder">
                                <h3>{$lang150}</h3>
                                <div class="ideas">
                                  <p>{$lang149}:</p>
                                  <ul>
                                    {insert name=get_wants value=var assign=wants}
                                    {section name=i loop=$wants}
                                    <li>{$wants[i].want|stripslashes} (by <a href="{$baseurl}/{insert name=get_seo_profile value=a username=$wants[i].username|stripslashes}">{$wants[i].username|stripslashes}</a>)</li>
                                    {/section}
                                  </ul>
                                </div>
                              </div>
                            </div>
                    		<div class="b">&nbsp;</div>
                    	</div>
                    </div>