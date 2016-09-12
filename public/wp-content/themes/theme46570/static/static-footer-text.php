<?php /* Static Name: Footer text */ ?>
<div id="footer-text" class="footer-text">
	<?php $myfooter_text = of_get_option('footer_text'); ?>
	
	<?php if($myfooter_text){?>
		<?php echo of_get_option('footer_text'); ?>
	<?php } else { ?>
		<!--<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> <?php bloginfo('description'); ?> &copy; <?php echo date('Y'); ?>. &nbsp;&nbsp; <a href="<?php echo home_url(); ?>/privacy-policy/" title="<?php echo theme_locals('privacy_policy'); ?>"><?php echo theme_locals("privacy_policy"); ?></a>-->

		<div style="text-align: center; width: 1230px; "><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="site-name">Instituto Patr&iacute;cia Galv&atilde;o</a>  &copy; <?php echo date('Y'); ?> 
		Fone: (11) 3266.5434 / Email: <a href="mailto:contato@patriciagalvao.org.br">contato@patriciagalvao.org.br</a>
		<br><a href="politica-de-privacidade/" title="Politica de privacidade">Pol&iacute;tica de privacidade</a>	- <a href="termo-de-uso/" title="Termos de uso">Termos de uso</a>
		 - Desenvolvimento <a href="http://www.qualitacomunicacao.com" title="Qualita Comunicacao">Qualit&agrave; Comunica&ccedil;&atilde;o</a>
		<!-- git ii -->
		</div>		
	<?php } ?>
	<?php if( is_front_page() ) { ?>
		<!-- {%FOOTER_LINK} -->
	<?php } ?>
</div>

