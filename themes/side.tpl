				<div class="sidebar">
                    <div class="side-nav">
                    	<form name="langselectru" id="langselectru" method="post" style="padding:0; margin:0">
                        <input type="hidden" name="language" value="russian" />
                        </form>                
                      <div class="t"></div>
                      <div class="c">
                        <form action="{$baseurl}/search" id="search_form" method="get">      
                        	<div class="search">
                            	<input class="text swap-value-small-search" id="query" name="query" type="text" value="" placeholder="{$lang465}"/>
                            	<input type="image" src="{$imageurl}/btn-go02.gif" alt="Go" class="button" />
                          	</div>
                        </form>
                        <ul>
                          <li ><strong><a href="{$baseurl}/" style="color:green;">{$lang115}</a></strong></li>                          
                              {insert name=get_categories assign=c}
                              {section name=i loop=$c}
                              <li {if $catselect eq $c[i].CATID}class="active"{/if}><a href="{$baseurl}/categories/{$c[i].seo|stripslashes}">{$c[i].name|stripslashes}</a></li>
                              {/section}
                        </ul>                        
                      </div>
                      <div class="b">&nbsp;</div>
                    </div>
			<!-- VK Widget -->
			<div id="vk_groups" style="padding-top:10px; width: 180px; min-height: 292px;">
                <div id="vk_groups_inner"></div>
            </div>
			<script type="text/javascript">
			VK.Widgets.Group("vk_groups_inner", {
			mode: 0, width: "auto"
			}, 25664015);
		        </script>              

                    <div class="suggest" style="margin-top:10px;">
                      <div class="c">
                        <form action="{$baseurl}/" id="suggest_form" method="post">                        
                        <div class="suggest-form">
                          <h3 style="margin-bottom:4px;">{$lang116}</h3>
                          <label>{$lang117}</label>
                          <textarea class="suggestion-box" cols="20" id="suggestion_content" maxlength="80" name="sugcontent" rows="3"></textarea>
                          <br clear="both"/>
                            <div class="suggest-category-select">
                                <div class="in">{$lang119}</div>
                                <div class="category">
                                  <select id="suggestion_category_id" name="sugcat">
                                  {section name=i loop=$c}
                                  <li ><a href="{$baseurl}/categories/{$c[i].seo|stripslashes}">{$c[i].name|stripslashes}</a></li>
                                  <option value="{$c[i].CATID|stripslashes}">{$c[i].name|stripslashes}</option>
                                  {/section}
                                  </select>
                                </div>
                            </div>
                          <div class="errors-for-suggestions"></div> 
                          {if $smarty.session.USERID eq ""}
                          <a href="#" class="login-link" style="float:right; text-decoration:none;" rel="#register-spotlight"><input type="button" value="{$lang118}" style="padding-left:5px;padding-right:5px;padding-top:3px;padding-bottom:3px;float:right;" /></a>
                          {else}
                          <input type="submit" value="{$lang118}" class="button" style="padding-left:5px;padding-right:5px;padding-top:3px;padding-bottom:3px;float:right;" />  
                          {/if}
                          <div class="suggest-progress-indicator-icon-message">{$lang120}</div>                      
                          <input type="hidden" name="sugsub" value="1" />
                        </div>
                        </form>
                        <div class="recent-suggestions">
                          <ul>
                          	{insert name=get_wants value=var assign=wants}
                            {section name=i loop=$wants}
                            <li><span class="user-wants"> <a href="{$baseurl}/{insert name=get_seo_profile value=a username=$wants[i].username|stripslashes}">{$wants[i].username|stripslashes}</a> {$lang122}:</span><br/>{$wants[i].want|stripslashes}
                                <br/>                                
                            </li>
                            {/section}
                          </ul>
                        </div>
                    
                      </div>
                      <div class="b">&nbsp;</div>                     
                      
                    <div style="padding-top:10px; height:700px;">
                    {insert name=get_advertisement AID=2}
                    </div>
                    </div>                    
				</div>