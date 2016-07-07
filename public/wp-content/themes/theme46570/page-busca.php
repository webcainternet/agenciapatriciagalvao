<?php
/**
* Template Name: Busca
*/


global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} // foreach

$search = new WP_Query($search_query);

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
		<div class="row">
		

		Desc
		<?php get_search_form($query_string . '&orderby=date&order=DESC') ?>
		
		<p>
		Asc
		<?php get_search_form($query_string . '&orderby=date&order=ASC') ?>
		</p>
		
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text">Search for:</span>
		<input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search for:" />
	</label>
	<input type="submit" class="search-submit" value="Search" />
</form>		
	
		
<form role="search" method="get" id="searchform" action="<?php bloginfo('siteurl'); ?>">
  <div>
    <label class="screen-reader-text" for="s">Pesquisar por:</label>
    <input type="text" value="" name="s" id="s" />
    em <?php wp_dropdown_categories( 'show_option_all=Todas as categorias&hierarchical=1' ); ?>
    <input type="submit" id="searchsubmit" value="Search" />
  </div>
</form>

<p>Ordem de data:

<?php echo '<p><a href="' . get_bloginfo('siteurl') . '?s=' . get_search_query() . '&orderby=post_date&order=asc">Order results by date<a></p>'; ?><br>
<?php echo '<p><a href="' . get_bloginfo('siteurl') . '?s=IBOPR&orderby=post_date&order=asc">ASC<a></p>'; ?>
		
		</div>
	</div>
</div>

<?php get_footer(); ?>