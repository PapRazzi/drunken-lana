              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                      
                      <div class="section">
                          <div class="t">&nbsp;</div>
                          <div class="c">
                            <div class="page">
                              <div class="static-page">
                                <h1><strong>{insert name=get_static value=var sel=title ID=5}</strong></h1>
                                {insert name=get_static value=var sel=value ID=5}
                              </div>
                              <div>
                                <style type="text/css">
                                    {literal}
                                    .mf-req {color : #FF0000;}
                                    .input-error { border: red; border-style: double;}
                                    {/literal}
                                </style>
                                {if $success}<span style="color: #0F0">{$lang453}</span>{/if}
                                 <form action="" method="POST">
                                    <table width="100%">
                                        <tr width="100%">
                                            <td>{$lang454}<span class="mf-req">*</span>:</td>
                                            <td><input type="text" {if $nameError}style="border: red; border-style: double;} "{/if} name="user_name" value="{$name}" /></td>
                                        </tr>
                                        <tr width="100%">
                                            <td>{$lang455}<span class="mf-req">*</span>:</td>
                                            <td><input type="text" {if $emailError}style="border: red; border-style: double;} "{/if} name="user_email" value="{$email}" /></td>
                                        </tr>
                                        <tr width="100%">
                                            <td>{$lang456}<span class="mf-req">*</span>:</td>
                                            <td><textarea name="MESSAGE" {if $messageError}class="input-error"{/if} rows="5" cols="30">{$message}</textarea></td>    
                                        </tr>
                                        
                                        <tr width="100%">
                                            <td colspan="2">
                                                <input style="width: 100%;" type="submit" name="submit" value="{$lang457}"> 
                                            </td>
                                        </tr>
                                    </table>                                        
                                 </form>
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