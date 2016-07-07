<?php /* Wrapper Name: Footer */ ?>
<div class="footer-widgets">
    <div class="container">
	<div class="row">
	    <div data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="footer-sidebar">
		<div style="float:left; width:136px; margin-left: 25px;">
			<img src="/wp-content//uploads/2014/02/logoipg1.jpg">
		</div>
		<?php dynamic_sidebar("footer-sidebar"); ?>
	    </div>
	</div>	
    </div>	
</div>
<div class="copyright">
    <div class="container">
	<div class="row">
	    <div class="span6" data-motopress-type="static" data-motopress-static-file="static/static-footer-text.php">
		<?php get_template_part("static/static-footer-text"); ?>
	    </div>
	    <div class="span6" data-motopress-type="static" data-motopress-static-file="static/static-footer-nav.php">
		<?php get_template_part("static/static-footer-nav"); ?>
	    </div>
	</div>	
    </div>
</div>