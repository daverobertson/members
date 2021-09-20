<?php
/**
 * Add new/custom capability meta box.
 *
 * @package    Members
 * @subpackage Admin
 * @author     Krista Butler
 * @copyright  Copyright (c) 2021 Caseproof, LLC
 * @link       https://memberpress.com/plugins/members
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Members\Admin;

/**
 * Class to handle the hide admin bar meta box on the edit/new role screen.
 *
 * @since  2.0.0
 * @access public
 */
final class Meta_Box_Hide_Admin_Bar {

	/**
	 * Holds the instances of this class.
	 *
	 * @since  2.0.0
	 * @access private
	 * @var    object
	 */
	private static $instance;

	/**
	 * Adds our methods to the proper hooks.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	protected function __construct() {

		add_action( 'members_load_role_edit', array( $this, 'load' ) );
		add_action( 'members_load_role_new',  array( $this, 'load' ) );
	}

	/**
	 * Runs on the page load hook to hook in the meta boxes.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function load() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
	}

	/**
	 * Adds the meta box.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $screen_id
	 * @param  string  $role
	 * @return void
	 */
	public function add_meta_boxes( $screen_id, $role = '' ) {

		// If role isn't editable, bail.
		if ( $role && ! members_is_role_editable( $role ) )
			return;

		// Add the meta box.
		add_meta_box( 'hide-admin-div', esc_html__( 'Hide Admin Bar', 'members' ), array( $this, 'meta_box' ), $screen_id, 'side', 'core' );
	}

	/**
	 * Outputs the meta box HTML.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function meta_box() { ?>
		<p>
			<input type="checkbox" id="hide-admin-bar" name="hide-admin-bar" class="widefat" />
      <label for="members-hide-admin-bar-field"><?php echo esc_html_x( 'Hide Admin Bar', 'capability', 'members' ); ?></label>
		</p>
	<?php }

	/**
	 * Returns the instance.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		if ( ! self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}

Meta_Box_Hide_Admin_Bar::get_instance();
