<?php

final class ITSEC_Global_Settings_New extends ITSEC_Settings {
	public function get_id() {
		return 'global';
	}

	public function get_defaults() {
		global $itsec_globals;

		$email = get_option( 'admin_email' );

		return array(
			'notification_email'        => array( $email ),
			'backup_email'              => array( $email ),
			'lockout_message'           => __( 'error', 'better-wp-security' ),
			'user_lockout_message'      => __( 'You have been locked out due to too many invalid login attempts.', 'better-wp-security' ),
			'community_lockout_message' => __( 'Your IP address has been flagged as a threat by the iThemes Security network.', 'better-wp-security' ),
			'blacklist'                 => true,
			'blacklist_count'           => 3,
			'blacklist_period'          => 7,
			'email_notifications'       => true,
			'lockout_period'            => 15,
			'lockout_white_list'        => array(),
			'log_rotation'              => 14,
			'log_type'                  => 'database',
			'log_location'              => ITSEC_Core::get_storage_dir( 'logs' ),
			'log_info'                  => '',
			'allow_tracking'            => false,
			'write_files'               => false,
			'nginx_file'                => ABSPATH . 'nginx.conf',
			'infinitewp_compatibility'  => false,
		'did_upgrade'               => false,
			'lock_file'                 => false,
			'digest_email'              => false,
			'proxy_override'            => false,
			'hide_admin_bar'            => false,
			'show_error_codes'          => false,
			'show_new_dashboard_notice' => true,
		);
	}

	protected function handle_settings_changes( $old_settings ) {
		if ( $this->settings['digest_email'] && ! $old_settings['digest_email'] ) {
			$digest_queue = array(
				'last_sent' => ITSEC_Core::get_current_time_gmt(),
				'messages'  => array(),
			);

			update_site_option( 'itsec_message_queue', $digest_queue );
		}

		if ( $this->settings['write_files'] && ! $old_settings['write_files'] ) {
			ITSEC_Response::regenerate_server_config();
			ITSEC_Response::regenerate_wp_config();
		}
	}
}

ITSEC_Modules::register_settings( new ITSEC_Global_Settings_New() );
