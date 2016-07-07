<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die (theme_locals("please_do_not"));

	if ( post_password_required() ) { ?>
	<?php //echo '<p class="nocomments">' . theme_locals("password") . '</p>'; ?>
	<?php
		//return;
	}
?>
