<?php /* Static Name: Search */ ?>
<!-- BEGIN SEARCH FORM -->
<?php if ( of_get_option('g_search_box_id') == 'yes') { ?>  
	<div style="float:right; margin-right: 1px;"> <a href="http://agenciapatriciagalvao.org.br/quem-somos/"><strong>	Quem somos</strong></a> |<a href="http://agenciapatriciagalvao.org.br/contato/"><strong> Contatos</strong> </a>|<a href="http://agenciapatriciagalvao.org.br/cadastre-se/"><strong> Cadastro  </strong></a></div>
	<div class="search-form search-form__h hidden-phone clearfix" style="margin-top:29px;">
		<form id="search-header" class="navbar-form pull-right" method="get" action="<?php echo home_url(); ?>/" accept-charset="utf-8">
			<input type="text" name="s" placeholder="" class="search-form_it"><input type="submit" value="" id="submit" class="search-form_is">
		</form>
		<div style="float:right; margin-right: 1px;"> <a href="http://agenciapatriciagalvao.org.br/busca-avancada/">	Busca avan&ccedil;ada &raquo;</a></div>
		<!-- <div style="float:right; margin-right: -25px; margin-top: 5px;">	<?php //if(function_exists('kc_add_social_share')) kc_add_social_share(); ?></div>-->

		<div style="float:right; margin-right: -125px; margin-top: 25px; width: 280px;">
<!-- 
<div class="ssba"><div style="text-align:left"><a class="ssba_email_share" href="mailto:?Subject=Home&amp;Body=%20http://agenciapatriciagalvao.org.br/"><img src="http://agenciapatriciagalvao.org.br/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/email.png" title="Email" class="ssba" alt="Email this to someone"></a><a class="ssba_facebook_share" href="http://www.facebook.com/sharer.php?u=http://agenciapatriciagalvao.org.br/" target="_blank"><img src="http://agenciapatriciagalvao.org.br/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/facebook.png" title="Facebook" class="ssba" alt="Share on Facebook"></a><a class="ssba_twitter_share" href="http://twitter.com/share?url=http://agenciapatriciagalvao.org.br/&amp;text=Home+" target="_blank"><img src="http://agenciapatriciagalvao.org.br/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/twitter.png" title="Twitter" class="ssba" alt="Tweet about this on Twitter"></a><a class="ssba_google_share" href="https://plus.google.com/share?url=http://agenciapatriciagalvao.org.br/" target="_blank"><img src="http://agenciapatriciagalvao.org.br/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/google.png" title="Google+" class="ssba" alt="Share on Google+"></a></div></div>
 -->
 		<div style="float:left !important; margin-right: 5px;">
		<ul class="social social__row clearfix unstyled">
   			<li class="social_li">
				<a class="social_link social_link__facebook" rel="tooltip" data-original-title="facebook" href="https://www.facebook.com/agenciapatriciagalvao?fref=ts" target="blank">
				<span class="social_ico"><img src="http://agenciapatriciagalvao.org.br/wp-content/themes/theme46570/images/icons/face-g.png" height="25" width="25" alt=""></span></a>
			</li>

			<li class="social_li">
			<a class="social_link social_link__twitter" rel="tooltip" data-original-title="twitter" href="https://twitter.com/NoticiasAPG?lang=pt" target="blank">
			<span class="social_ico"><img src="http://agenciapatriciagalvao.org.br/wp-content/themes/theme46570/images/icons/twitter-g.png" height="25" width="25" alt=""></span></a>
		</li>
    
		<li class="social_li">
			<a class="social_link social_link__google+" rel="tooltip" data-original-title="YouTube" href="https://www.youtube.com/channel/UCrq2XytCoqcoSrHNmk0Hx5g" target="blank">
			<span class="social_ico"><img src="http://agenciapatriciagalvao.org.br/wp-content/themes/theme46570/images/icons/youtube100.png" height="25" width="25" alt=""></span></a>
		</li>
	</ul>
	</div>
		<div style="margin-top: 3px;" class="fb-like" data-href="https://www.facebook.com/pages/Ag&#xea;ncia-Patr&#xed;cia-Galv&#xe3;o/148870245214457?fref=ts" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
	</div>
	</div>
<?php } ?>
<!-- END SEARCH FORM -->