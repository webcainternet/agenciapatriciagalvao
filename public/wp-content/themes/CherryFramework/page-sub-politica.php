<?php
/**
* Template Name: Capa Politica
*/

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
	
		<div>
		<div>
		<div style="float: right; width:90%;">
			<h5 style="margin-top:5px; text-align:left;">| <a href="/category/politica/dados-e-pesquisas-politica/">Dados e pesquisas</a> | <a href="/category/politica/pautas-politica/">Especiais e pautas</a> | <a href="/category/politica/noticias-politica/">Noticias</a> | <a href="/category/politica/videos-politica/">Videos</a> |&nbsp;</h5>
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
