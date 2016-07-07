<?php
/**
* Template Name: Busca Nova
*/

query_posts( $query_string . '&orderby=title' ); 

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
		<div class="row">
		
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<h1><a href="<?php echo the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<div class="date">
				<div class="dateleft">
					<p><span class="time"><?php the_time('F j, Y'); ?></span> by <?php the_author_posts_link(); ?> &nbsp;<?php edit_post_link('(Edit)', '', ''); ?> <br /> Filed under <?php the_category(', ') ?></p>
				</div>
			</div>

			<div style="clear:both;"></div>

			<?php $cont = the_excerpt();
			echo Replace($cont); ?>
			<div style="clear:both;"></div>


			<?php endwhile; else: ?>

			<p><?php _e('Desculpe, não existem resultados para esta busca.'); ?></p><?php endif; ?>
			

		</div>
	</div>
</div>

<?php get_footer(); ?>