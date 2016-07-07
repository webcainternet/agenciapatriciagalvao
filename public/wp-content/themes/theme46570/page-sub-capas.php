<?php
/**
* Template Name: Sub capas
*/

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
		<div class="row">
			<div class="span12" data-motopress-wrapper-file="page-home.php" data-motopress-wrapper-type="content">
				<div class="row">
					<div class="span8">
						<div style="height:30px;"></div>
						<div data-motopress-type="loop" data-motopress-loop-file="loop/loop-page.php">
							<?php get_template_part("loop/loop-page"); ?>
						</div>
					</div>
					<div style="height:30px;"></div>
					<div class="span4 sidebar" data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="home-sidebar">
						<?php dynamic_sidebar("home-sidebar"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>