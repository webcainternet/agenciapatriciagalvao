<?php
/**
* Template Name: Site Antigo
*/

get_header(); ?>

<div class="motopress-wrapper content-holder clearfix">
	<div class="container">
		<div class="row">
		
			<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-title.php">
				<section class="title-section">
				<h1 class="title-header">Site Antigo</h1>
				<ul class="breadcrumb breadcrumb__t">
					<li><a href="http://agenciapatriciagalvao.org.br">Home</a></li><li class="divider">&nbsp;/&nbsp;</li><li><a href="#" title="Busca avancada">Site Antigo</a></li></ul>
				</section><!-- .title-section -->
			</div>
		
			<div class="span8">		
	<br>		<br>	
		<p>Desculpe, estamos reparando problemas t&eacute;cnicos desencadeados pela reformula&ccedil;&atilde;o do site da <strong>Ag&ecirc;ncia Patr&iacute;cia Galv&atilde;o </strong> - o que est&aacute; gerando um erro tempor&aacute;rio no redirecionamento de alguns links.</p>
<br>
<p>Por favor, use nossa ferramenta de Busca para encontrar o conte&uacute;do desejado abaixo:</p>
		
		
			<form role="search" method="get" id="searchform" action="<?php bloginfo('siteurl'); ?>">
			  <div style="margin-top:50px; margin-bottom:500px;">
			    <label class="screen-reader-text" for="s">Busca por:</label>
			    <input type="text" value="" name="s" id="s" />
			    em <?php wp_dropdown_categories('show_count=1&hierarchical=1'); ?>
			    <input type="submit" id="searchsubmit" value="Buscar" style="height: 28px;" />
			  </div>
			</form>
			</div>
			
			<div class="span4 sidebar" style="padding-top: 16px;">
			<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>