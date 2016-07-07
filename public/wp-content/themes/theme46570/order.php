<?php
/**
* Template Name: Order
*/

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
		<div class="row">
			<div class="span12" data-motopress-wrapper-file="page-home.php" data-motopress-wrapper-type="content">
				<div class="row">

				<?php
  $order = "&orderby=cost&order=DESC";
  $s2 = ' selected="selected"';
  if ($_POST['select'] == 'title') { $order = "&orderby=title&order=ASC"; $s1 = ' selected="selected"'; $s2 = ''; }
  if ($_POST['select'] == 'newest') { $order = "&orderby=cost&order=DESC"; $s2 = ' selected="selected"'; }
  if ($_POST['select'] == 'oldest') { $order = "&orderby=cost&order=ASC"; $s3 = ' selected="selected"'; $s2 = ''; }
?>

<form method="post" id="order">
  Sort reviews by:
  <select name="select" onchange='this.form.submit()'>
    <option value="title"<?php echo $s1; ?>>Title</option>
    <option value="newest"<?php echo $s2; ?>>Newest</option>
    <option value="oldest"<?php echo $s3; ?>>Oldest</option>
  </select>
</form>

		<?php 
		
		if ( have_posts() ) {
			$posts = query_posts($query_string . $order);
			while ( have_posts() ) {
				the_post(); 
			//?>
			<?php the_title(); ?>
<?php the_content(); ?>
<?php the_time('F jS, Y'); ?>  
<?php the_permalink(); ?>
<?php
			// Post Content here
			//
			} // end while
		} // end if
	?>


					
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>