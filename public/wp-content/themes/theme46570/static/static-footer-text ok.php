<?php /* Static Name: Footer text */ ?>
<div id="footer-text" class="footer-text">
	<?php $myfooter_text = of_get_option('footer_text'); ?>
	
	<?php if($myfooter_text){?>
		<?php echo of_get_option('footer_text'); ?>
	<?php } else { ?>
		<!--<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> <?php bloginfo('description'); ?> &copy; <?php echo date('Y'); ?>. &nbsp;&nbsp; <a href="<?php echo home_url(); ?>/privacy-policy/" title="<?php echo theme_locals('privacy_policy'); ?>"><?php echo theme_locals("privacy_policy"); ?></a>-->

		<div style="text-align: center; width: 1230px; "><a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="site-name">Ag&ecirc;ncia Patr&iacute;cia Galv&atilde;o</a>  &copy; <?php echo date('Y'); ?> - <a href="politica-de-privacidade/" title="Politica de privacidade">Pol&iacute;tica de privacidade</a><br>Desenvolvimento <a href="http://www.qualitacomunicacao.com" title="Qualita Comunicacao">Qualit&agrave; Comunica&ccedil;&atilde;o</a></div>		
	<?php } ?>
	<?php if( is_front_page() ) { ?>
		<!-- {%FOOTER_LINK} -->
	<?php } ?>
</div>