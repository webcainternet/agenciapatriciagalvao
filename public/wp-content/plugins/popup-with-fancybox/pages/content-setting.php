<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php if ( ! empty( $_POST ) && ! wp_verify_nonce( $_REQUEST['wp_create_nonce'], 'content-setting-nonce' ) )  { die('<p>Security check failed.</p>'); } ?>
<div class="wrap">
  <div class="form-wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post"><br>
    </div>
    <h2><?php _e('Popup with fancybox', 'popup-with-fancybox'); ?></h2>
    <?php
	$Popupwfb_session = get_option('Popupwfb_session');
	$Popupwfb_group = get_option('Popupwfb_group');

	if (isset($_POST['Popupwfb_form_submit']) && $_POST['Popupwfb_form_submit'] == 'yes')
	{
		//	Just security thingy that wordpress offers us
		check_admin_referer('Popupwfb_form_setting');
			
		$Popupwfb_session = stripslashes(sanitize_text_field($_POST['Popupwfb_session']));	
		$Popupwfb_group = stripslashes(sanitize_text_field($_POST['Popupwfb_group']));
		
		if($Popupwfb_session != "YES" && $Popupwfb_session != "NO")
		{
			$Popupwfb_session = "NO";
		} 
		
		update_option('Popupwfb_session', $Popupwfb_session );
		update_option('Popupwfb_group', $Popupwfb_group );
		
		?>
		<div class="updated fade">
			<p><strong><?php _e('Details was successfully updated.', 'popup-with-fancybox'); ?></strong></p>
		</div>
		<?php
	}
	?>
	<script language="JavaScript" src="<?php echo POPUPWFB_PLUGIN_URL; ?>/pages/setting.js"></script>
	<h3><?php _e('Popup Setting', 'popup-with-fancybox'); ?></h3>
	<form name="Popupwfb_form_setting" method="post" action="#" onsubmit="return _Popupwfb_submit_setting()">
	
		<label for="tag-title"><?php _e('Popup group (Widget setting)', 'popup-with-fancybox'); ?></label>
		<select name="Popupwfb_group" id="Popupwfb_group">
		<option value=''></option>
		<?php
		$sSql = "SELECT distinct(Popupwfb_group) as Popupwfb_group FROM `".Popupwfb_Table."` order by Popupwfb_group";
		$myDistinctData = array();
		$thisselected = "";
		$myDistinctData = $wpdb->get_results($sSql, ARRAY_A);
		foreach ($myDistinctData as $DistinctData)
		{
			if($Popupwfb_group == strtoupper($DistinctData["Popupwfb_group"])) 
			{ 
				$thisselected = "selected='selected'" ; 
			}
			?><option value='<?php echo strtoupper($DistinctData["Popupwfb_group"]); ?>' <?php echo $thisselected; ?>><?php echo strtoupper($DistinctData["Popupwfb_group"]); ?></option><?php
			$thisselected = "";
		}
		?>
		</select>
		<p><?php _e('Select popup group for widget option.', 'popup-with-fancybox'); ?></p>
	
		<label for="tag-title"><?php _e('Session option (Global setting)', 'popup-with-fancybox'); ?></label>
		<select name="Popupwfb_session" id="Popupwfb_session">
            <option value=''>Select</option>
			<option value='NO' <?php if($Popupwfb_session == 'NO') { echo 'selected' ; } ?>>NO</option>
            <option value='YES' <?php if($Popupwfb_session == 'YES') { echo 'selected' ; } ?>>YES</option>
          </select>
		<p><?php _e('Select YES to show popup once per session, Meaning, popup never appear again if user navigate to another page.', 'popup-with-fancybox'); ?></p>
				
		<div style="height:10px;"></div>
		<input type="hidden" name="Popupwfb_form_submit" value="yes"/>
		<input name="Popupwfb_submit" id="Popupwfb_submit" class="button" value="<?php _e('Submit', 'popup-with-fancybox'); ?>" type="submit" />
		<input name="publish" lang="publish" class="button" onclick="_Popupwfb_redirect()" value="<?php _e('Cancel', 'popup-with-fancybox'); ?>" type="button" />
		<input name="Help" lang="publish" class="button" onclick="_Popupwfb_help()" value="<?php _e('Help', 'popup-with-fancybox'); ?>" type="button" />
		<?php wp_nonce_field('Popupwfb_form_setting'); ?>
		<input type="hidden" name="wp_create_nonce" id="wp_create_nonce" value="<?php echo wp_create_nonce( 'content-setting-nonce' ); ?>"/>
	</form>
  </div>
  <br />
  <p class="description">
	<?php _e('Check official website for more information', 'popup-with-fancybox'); ?>
	<a target="_blank" href="<?php echo Popupwfb_FAV; ?>"><?php _e('click here', 'popup-with-fancybox'); ?></a>
  </p>
</div>