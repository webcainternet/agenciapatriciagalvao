<?php /* Wrapper Name: Header */ ?>
<!--
<div class="row-1">
    <div class="container">
	<div class="row">
	    <div class="span8" data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="header-sidebar-1">
		<?php //dynamic_sidebar("header-sidebar-1"); ?>
	    </div>
	    <div class="span4 hidden-phone" data-motopress-type="static" data-motopress-static-file="static/static-search.php">
		<?php //get_template_part("static/static-search"); ?>
	    </div>
	</div>	
    </div>	
</div>
-->
<div class="row-2">
    <div class="container">
	<div class="row">
	    <div class="span8" data-motopress-type="static" data-motopress-static-file="static/static-logo.php">
		<?php get_template_part("static/static-logo"); ?> 
	    </div>
	    <div class="span4" data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="header-sidebar-2">
		<?php //dynamic_sidebar("header-sidebar-2"); ?>
		<?php get_template_part("static/static-search"); ?>
	    </div>
	</div>	
    </div>	
</div>
<div class="row-3">
    <div class="container">
	<div class="row">
	    <div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-nav.php">
		<?php get_template_part("static/static-nav"); ?>
	    </div>
	</div>	
    </div>
</div>
