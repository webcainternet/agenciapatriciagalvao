<?php get_header(); ?>
<?php cherry_setPostViews(get_the_ID()); ?>
<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
		<div class="row">
			<div class="span12" data-motopress-wrapper-file="single.php" data-motopress-wrapper-type="content">
				<div class="row">
					<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php">
						<?php get_template_part("static/static-title"); ?>
						<!-- . title.php -->
						<div style="padding-bottom:15px;"></div>
						<?php
							$output1 .= ''.the_time('d/m/Y  - H:i'). '';
							echo $output1;
						?>
				</div>
				</div>
				<div class="row">
					<div class="span8 <?php echo of_get_option('blog_sidebar_pos'); ?>" id="content" data-motopress-type="loop" data-motopress-loop-file="loop/loop-single.php">
						<?php get_template_part("loop/loop-single-sidebar"); ?>
					</div>
					<div class="span4 sidebar" id="sidebar" data-motopress-type="static-sidebar"  data-motopress-sidebar-file="sidebar.php">
					<?php
	get_template_part( 'includes/post-formats/related-posts-sidebar' );
	comments_template('', true);

?>

						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>