		<footer class="motopress-wrapper footer">
		    <div data-motopress-wrapper-file="wrapper/wrapper-footer.php" data-motopress-wrapper-type="footer" data-motopress-id="<?php echo uniqid() ?>">
			<?php get_template_part('wrapper/wrapper-footer'); ?>
		    </div>
		    <div id="back-top-wrapper" class="visible-desktop">
			<p id="back-top">
			    <a href="#top"><span><?php _e("Top", CURRENT_THEME); ?></span></a>
			</p>
		    </div>
		</footer>

		<!--End #motopress-main-->

	</div>
	<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work properly -->
	<?php if(of_get_option('ga_code')) { ?>
		<script type="text/javascript">
			<?php echo stripslashes(of_get_option('ga_code')); ?>
		</script>
	  <!-- Show Google Analytics -->	
	<?php } ?>
</body>
</html>