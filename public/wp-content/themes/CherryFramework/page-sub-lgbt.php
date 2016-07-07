<?php
/**
* Template Name: Capa LGBT
*/

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
	
		<div>
		<div>
		<div style="float: right; width:54%;">
			<h5 style="margin-top:5px; text-align:left;">| <a href="/category/lgbt_/dados-e-pesquisas-lgbt/">Dados e pesquisas</a> | <a href="/category/lgbt_/pautas-lgbt/">Especiais e pautas</a> | <a href="/category/lgbt_/noticias-lgbt/">Noticias</a> | <a href="/category/lgbt_/videos-lgbt/">Videos</a> |&nbsp;</h5>
		</div>
		</div>
		<div class="row">
			<div class="span12" data-motopress-wrapper-file="page-fullwidth.php" data-motopress-wrapper-type="content">
				<div class="row">
					<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php">
						<?php get_template_part("static/static-title"); ?>
					</div>
				</div>
				<div id="content" class="row">
					<div class="span12" data-motopress-type="loop" data-motopress-loop-file="loop/loop-page.php">
						<?php get_template_part("loop/loop-page"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
