<article id="post-<?php the_ID(); ?>" <?php //post_class('post__holder'); ?>>
	<?php if(!is_singular()) : ?>
	<header class="post-header">
		<?php if(is_sticky()) : ?>
			<h5 class="post-label"><?php echo theme_locals("featured");?></h5>
		<?php endif; ?>	
		<h2 class="post-title" style="margin-bottom: 5px !important;"><a href="<?php the_permalink(); ?>" title="<?php echo theme_locals("permalink_to"); ?><?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</header>
	<?php endif; ?>			
	<?php //get_template_part('includes/post-formats/post-thumb'); ?>
	
	<?php if(!is_singular()) : ?>				
	<!-- Post Contentttt -->
	<div class="post_content" style="padding-bottom: 0px !important;">
		<?php $post_excerpt = of_get_option('post_excerpt'); ?>
		<?php if ($post_excerpt=='true' || $post_excerpt=='') { ?>		
			<div class="excerpt">
			<?php 
				$content = get_the_content();
				$excerpt = get_the_excerpt();
			if (has_excerpt()) {
				the_excerpt();
			} else {
				if(!is_search()) {
				echo my_string_limit_words($content,24);
				} else {
				echo my_string_limit_words($excerpt,24);
				}
			} ?>	
			</div>
			<!-- <div style="float:right; margin-right: 30px; margin-top: -20px;"><a href="<?php //the_permalink() ?>" class="btn btn-link btn-normal"><?php //echo "Leia mais"; ?></a>	</div> -->
		<?php } ?>

		<div class="clear"></div>
	</div>
					
	<?php else :?>	
	<!-- Post Content -->
	<div class="post_content">	
		<?php the_content(''); ?>
		<div class="clear"></div>
	</div>
	<!-- //Post Content -->	
	<?php endif; ?>
	
	<?php get_template_part('includes/post-formats/post-meta'); ?>
			 
</article>