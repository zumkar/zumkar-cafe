<?php

namespace Simply_Static;

/**
 * Class which handles wrap up task.
 */
class Wrapup_Task extends Task {

	/**
	 * Task name.
	 *
	 * @var string
	 */
	protected static $task_name = 'wrapup';

	/**
	 * Perform the task.
	 *
	 * @return bool
	 */
	public function perform() {
		Util::debug_log( "Deleting temporary files" );
		$this->save_status_message( __( 'Wrapping up', 'simply-static' ) );

		// Unschedule cron first.
		wp_clear_scheduled_hook( 'simply_static_site_export_cron' );

		// Clear WP object cache.
		$flush_cashe = apply_filters( 'ss_flush_cache', true );

		if ( $flush_cashe ) {
			wp_cache_flush();
		}

		do_action( 'ss_after_cleanup' );

		return true;
	}
}
