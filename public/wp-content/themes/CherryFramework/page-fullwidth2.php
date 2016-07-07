<?php
/**
* Template Name: Fullwidth Page 2
*/

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
	
		<div>
		<!--<span style="background: #D5D4D4; margin-top:5px;">Dados e pesquisas | Noticias | Especiais e pautas | Videos</span>-->
		<!--<div style="align: right; width:99%"> trabalho-->
		<!-- <div style="align: right; width:93%"> direitos -->
		<!-- <div style="align: right; width:82%"> lgbt -->
		<!-- <div style="align: right; width:70%"> racismop -->
		<!-- <div style="align: right; width:57%"> violerncia -->
		<!-- <div style="align: right; width:42%"> Politica -->
		<!-- <div style="align: right; width:35%; border: 1px solid #d3d3d3;"> -->
		<div>
		<div style="float: left; width:64%;"></div>
		<div style="float: right; width:35%; border: 1px solid #d3d3d3;">
			<h5 style="margin-top:5px; text-align:right;">| <a href="#">Dados e pesquisas</a> | <a href="#">Noticias</a> | <a href="#">Especiais e pautas</a> | <a href="#">Videos</a> |&nbsp;</h5>
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
