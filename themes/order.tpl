            {if $funds eq "0" OR $funds LT $p.price}
            {literal}
            <script type="text/javascript"> 
            $(document).ready( function() {
                document.location = "/balance/";
            });
            </script>
            {/literal}
            {/if}
              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}                                 
                    <form action="" method="post" id="bal_form" name="bal_form">
                    <input type="hidden" name="subbal" value="1">
                    </form>
                    
                    <div class="section"> 
                      <div class="t">&nbsp;</div> 
                      <div class="c"> 
                        <div class="page"> 
                          <div class="to-payment"> 
                          	{if $funds eq "0" OR $funds LT $p.price}
                            <h1><strong>{$lang259}</strong></h1> 
                            <h2>{$lang258}</h2> 
                            <div class="progress"></div> 
                            {else}
                            <h1><strong>{$lang410}</strong></h1>                            
                            <h2><a style="text-decoration:none" href="#" onclick="document.bal_form.submit();">{$lang412}</a></h2> 
                            {/if}
                          </div> 
                        </div> 
                      </div> 
                      <div class="b">&nbsp;</div> 
                    </div>
                    
                  </div>
                  {include file="side.tpl"}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>