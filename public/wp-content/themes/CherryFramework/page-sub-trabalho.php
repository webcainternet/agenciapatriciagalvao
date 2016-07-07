<?php
/**
* Template Name: Capa Trabalho
*/

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
	
		<div>
		<div>
		<div style="float: left; width:64%;"></div>
		<div style="float: right; width:35%;">
			<h5 style="margin-top:5px; text-align:right;">| <a href="/category/trabalho_/dados-e-pesquisas-trabalho/">Dados e pesquisas</a> | <a href="/category/trabalho_/pautas-trabalho/">Especiais e pautas</a> | <a href="/category/trabalho_/noticias-trabalho/">Noticias</a> | <a href="/category/trabalho_/videos-trabalho/">Videos</a> |&nbsp;</h5>
		</div>
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
