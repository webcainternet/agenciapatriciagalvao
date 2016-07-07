<?php
/**
* Template Name: Capa Racismo
*/

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
	
		<div>
		<div>
		<div style="float: right; width:64%;">
			<h5 style="margin-top:5px; text-align:left;">| <a href="/category/racismo_/dados-e-pesquisas-racismo/">Dados e pesquisas</a> | <a href="/category/racismo_/pautas-racismo/">Especiais e pautas</a> | <a href="/category/racismo_/noticias-racismo/">Noticias</a> | <a href="/category/racismo_/videos-racismo/">Videos</a> |&nbsp;</h5>
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
