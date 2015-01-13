              <div class="main-wrapper">
                <div id="main">
                  <div class="content">
                  {if $message ne ""}
                  {include file="error.tpl"}
                  {/if}
                  	{if $smarty.session.USERID ne ""}
                    {include file="sub_bit.tpl"}
                    {else}
                    <div class="welcomebox">
                      <div style="position:relative;">
                      	<div class="how-it-works-button">
                          <a href="#" id="show-how-it-works" rel="#how-it-work-spotlight">
                            {$lang419}
                          </a>
                        </div>
                      </div>

                    </div>
					{/if}
                    <div class="how-it-work-popup apple_overlay" id="how-it-work-spotlight" style="display:none;">
                      <div class="how-it-works-wrapper" id="how-it-works-spot">
                        <div class="t"></div>
                        <div class="c">
                          <div class="close"><a href="#" class="spotlight-close"></a></div>
                          <div class="spacer"></div>
                           <object width="640" height="390"><param name="movie" value="http://www.youtube.com/v/7tr2tfp_skk?hl=ru&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/7tr2tfp_skk?hl=ru&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="390"></embed></object>                          
                          <div class="spacer"></div>
                          <div class="more"><a href="{$baseurl}/terms_of_service">{$lang434}</a></div>
                        </div>
                        <div class="b"></div>
                      </div>
                    </div>
					<div class="darkenBackground"></div>
				<style>
				        .innerLabel{
				            color: #6699ff;
				            font-family: "Helvetica", "Arial", sans-serif;
				            font-size: 1.60em;
				            font-style: normal;
				            font-variant: normal;
				            font-weight: 700;
				            line-height: 1em;
				            }
				           .innerFont{
				              font-size:16px;  
				           }  
				 </style>	
                    <div class="featured">
			<p>
			&nbsp;</p>
			<div class="innerLabel"><h2 align="center">
			Внимание! Акция!</h2></div>
			<p>
			&nbsp;</p>
			<p class="innerFont">
			12 января на cheerick.ru стартует акция &ldquo;<b>Популярная услуга</b>&rdquo;!</p>
			<p class="innerFont">
				Победителем станет тот, чья услуга соберет больше всего лайков на нашем сайте*!</p>
			<ul class="innerFont">
			<li>
				1-е место &ndash; 1200 рублей</li>
			<li>
				2-e место &ndash; 600 рублей</li>
			<li>
				3-е место &ndash; 300 рублей</li>
			</ul>
			<p class="innerFont">
		</p>
			<p class="innerFont">
			Для участия в акции Вам необходимо вступить в нашу группу вконтакте и рассказать друзьям о своей услуге.
			Просто нажмите "Нравится" и "Рассказать друзьям"!  <br/><br/>Победитель будет определен 1 февраля 2015 года.</p>	
			<p class="innerFont">
			</p>

                            </strong><br/>*ВНИМАНИЕ! Считаются только лайки, поставленные на нашем сайте. СОВЕТ: укажите в комментарии к посту, что необходимо перейти по ссылке сайта и поставить лайк там. <br/>
                            
                        
                    </div>

					<div class="rss-link"><a href="{$baseurl}/rss">{$lang108}</a></div>
                  </div>
                  {include file="side.tpl"}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
