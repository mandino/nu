<?php
if ( ! class_exists( 'Hustle_Icontact' ) ) :

class Hustle_Icontact extends Hustle_Provider_Abstract {

	const SLUG = "icontact";
	//const NAME = "IContact";

	protected static $api;

	/**
	 * Provider Instance
	 *
	 * @since 3.0.5
	 *
	 * @var self|null
	 */
	protected static $_instance = null;

	/**
	 * @since 3.0.5
	 * @var string
	 */
	protected $_slug 				   = 'icontact';

	/**
	 * @since 3.0.5
	 * @var string
	 */
	protected $_version				   = '1.0';

	/**
	 * @since 3.0.5
	 * @var string
	 */
	protected $_class				   = __CLASS__;

	/**
	 * @since 3.0.5
	 * @var string
	 */
	protected $_title                  = 'iContact';

	/**
	 * @since 3.0.5
	 * @var bool
	 */
	protected $_supports_fields 	   = true;

	/**
	 * Class name of form settings
	 *
	 * @var string
	 */
	protected $_form_settings = 'Hustle_Icontact_Form_Settings';

	/**
	 * Class name of form hooks
	 *
	 * @since 4.0
	 * @var string
	 */
	protected $_form_hooks = 'Hustle_Icontact_Form_Hooks';

	/**
	 * Array of options which should exist for confirming that settings are completed
	 *
	 * @since 4.0
	 * @var array
	 */
	protected $_completion_options = array( 'app_id', 'username', 'password' );

	/**
	 * Provider constructor.
	 */
	public function __construct() {
		$this->_icon_2x = plugin_dir_url( __FILE__ ) . 'images/icon.png';
		$this->_logo_2x = plugin_dir_url( __FILE__ ) . 'images/logo.png';
	}

	/**
	 * Get Instance
	 *
	 * @return self|null
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Get the wizard callbacks for the global settings.
	 *
	 * @since 4.0
	 *
	 * @return array
	 */
	public function settings_wizards() {
		return array(
			array(
				'callback'     => array( $this, 'configure_credentials' ),
				'is_completed' => array( $this, 'is_connected' ),
			),
		);
	}

	/**
	 * API Set up
	 *
	 * @param String $app_id - the application id
	 * @param String $api_password - the api password
	 * @param String $api_username - the api username
	 *
	 * @return WP_Error|Object
	 */
	public static function api( $app_id, $api_password, $api_username ) {
		if ( ! class_exists( 'Hustle_Icontact_Api' ) )
			require_once 'hustle-icontact-api.php';

		if( empty( self::$api ) ){
			try {
				self::$api = new Hustle_Icontact_Api( $app_id, $api_password, $api_username );
			} catch( Exception $e ) {
				return new WP_Error( 'something_wrong', $e->getMessage() );
			}
		}
		return self::$api;
	}

	/**
	 * Configure Global settings.
	 *
	 * @since 4.0
	 *
	 * @param array $submitted_data
	 * @return array
	 */
	public function configure_credentials( $submitted_data ) {
		$has_errors = false;
		$default_data = array(
			'app_id' => '',
			'username' => '',
			'password' => '',
			'name' => '',
		);
		$current_data = $this->get_current_data( $default_data, $submitted_data );
		$is_submit = isset( $submitted_data['app_id'] ) && isset( $submitted_data['username'] )
				&& isset( $submitted_data['password'] );
		$global_multi_id = $this->get_global_multi_id( $submitted_data );

		$app_id_valid = $api_username_valid = $api_password_valid = true;
		if ( $is_submit ) {

			$app_id_valid = ! empty( trim( $current_data['app_id'] ) );
			$api_username_valid = ! empty( trim( $current_data['username'] ) );
			$api_password_valid = ! empty( trim( $current_data['password'] ) );
			$api_key_validated = $app_id_valid
			                     && $api_username_valid
			                     && $api_password_valid
			                     && $this->validate_credentials( $submitted_data['app_id'], $submitted_data['username'], $submitted_data['password'] );
			if ( ! $api_key_validated ) {
				$error_message = $this->provider_connection_falied();
				$has_errors = true;
			}

			if ( ! $has_errors ) {
				$settings_to_save = array(
					'app_id' => $current_data['app_id'],
					'username' => $current_data['username'],
					'password' => $current_data['password'],
					'name' => $current_data['name'],
				);
				// TODO: Wrap this in a friendlier method
				// If not active, activate it.
				if ( Hustle_Provider_Utils::is_provider_active( $this->_slug )
						|| Hustle_Providers::get_instance()->activate_addon( $this->_slug ) ) {
					$this->save_multi_settings_values( $global_multi_id, $settings_to_save );
				} else {
					$error_message = __( "Provider couldn't be activated.", Opt_In::TEXT_DOMAIN );
					$has_errors = true;
				}
			}

			if ( ! $has_errors ) {

				return array(
					'html'         => Hustle_Api_Utils::get_modal_title_markup( __( 'iContact Added', Opt_In::TEXT_DOMAIN ), __( 'You can now go to your forms and assign them to this integration', Opt_In::TEXT_DOMAIN ) ),
					'buttons'      => array(
						'close' => array(
							'markup' => Hustle_Api_Utils::get_button_markup( __( 'Close', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'close' ),
						),
					),
					'redirect'     => false,
					'has_errors'   => false,
					'notification' => array(
						'type' => 'success',
						'text' => '<strong>' . $this->get_title() . '</strong> ' . __( 'Successfully connected', Opt_In::TEXT_DOMAIN ),
					),
				);

			}

		}

		$options = array(
			array(
				'type'     => 'wrapper',
				'class'    => $api_username_valid ? '' : 'sui-form-field-error',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'username',
						'value' => __( 'Email', Opt_In::TEXT_DOMAIN ),
					),
					'app_id' => array(
						'type'          => 'text',
						'name'          => 'username',
						'value'         => $current_data['username'],
						'placeholder'   => __( 'Enter Email', Opt_In::TEXT_DOMAIN ),
						'id'            => 'username',
						'icon'          => 'mail',
					),
					'error' => array(
						'type'  => 'error',
						'class' => $api_username_valid ? 'sui-hidden' : '',
						'value' => __( 'Please enter a valid iContact email', Opt_In::TEXT_DOMAIN ),
					),
				)
			),
			array(
				'type'     => 'wrapper',
				'class'    => $app_id_valid ? '' : 'sui-form-field-error',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'app_id',
						'value' => __( 'Application ID', Opt_In::TEXT_DOMAIN ),
					),
					'app_id' => array(
						'type'          => 'text',
						'name'          => 'app_id',
						'value'         => $current_data['app_id'],
						'placeholder'   => __( 'Enter Application ID', Opt_In::TEXT_DOMAIN ),
						'id'            => 'app_id',
						'icon'          => 'key',
					),
					'error' => array(
						'type'  => 'error',
						'class' => $app_id_valid ? 'sui-hidden' : '',
						'value' => __( 'Please enter a valid iContact API Application ID (API-AppId)', Opt_In::TEXT_DOMAIN ),
					),
				)
			),
			array(
				'type'     => 'wrapper',
				'class'    => $api_password_valid ? '' : 'sui-form-field-error',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'password',
						'value' => __( 'Application Password', Opt_In::TEXT_DOMAIN ),
					),
					'app_id' => array(
						'type'          => 'password',
						'name'          => 'password',
						'value'         => $current_data['password'],
						'placeholder'   => __( 'Enter Application Password', Opt_In::TEXT_DOMAIN ),
						'id'            => 'password',
						'icon'          => 'eye-hide',
					),
					'error' => array(
						'type'  => 'error',
						'class' => $api_password_valid ? 'sui-hidden' : '',
						'value' => __( 'Please make sure the password you entered is the same you created for your Application ID (API-AppId)', Opt_In::TEXT_DOMAIN ),
					),
				)
			),
			array(
				'type'     => 'wrapper',
				'style'    => 'margin-bottom: 0;',
				'elements' => array(
					'label' => array(
						'type'  => 'label',
						'for'   => 'instance-name-input',
						'value' => __( 'Identifier', Opt_In::TEXT_DOMAIN),
					),
					'name' => array(
						'type'        => 'text',
						'name'        => 'name',
						'value'       => $current_data['name'],
						'placeholder' => __( 'E.g. Business Account', Opt_In::TEXT_DOMAIN ),
						'id'          => 'instance-name-input',
					),
					'message' => array(
						'type'  => 'description',
						'value' => __( 'Helps to distinguish your integrations if you have connected to the multiple accounts of this integration.', Opt_In::TEXT_DOMAIN ),
					),
				)
			),
		);

		$step_html = Hustle_Api_Utils::get_modal_title_markup(
			__( 'Configure iContact', Opt_In::TEXT_DOMAIN ),
			sprintf(
				__( 'Set up a new application in your %1$siContact account%2$s to get your credentials. Make sure your credentials have API 2.0 enabled', Opt_In::TEXT_DOMAIN ),
				'<a href="https://app.icontact.com/icp/core/registerapp/" target="_blank">',
				'</a>'
			)
		);
		if ( $has_errors ) {
			$step_html .= '<span class="sui-notice sui-notice-error"><p>' . esc_html( $error_message ) . '</p></span>';
		}
		$step_html .= Hustle_Api_Utils::get_html_for_options( $options );

		$is_edit = $this->settings_are_completed( $global_multi_id );
		if ( $is_edit ) {
			$buttons = array(
				'disconnect' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Disconnect', Opt_In::TEXT_DOMAIN ), 'sui-button-ghost', 'disconnect', true ),
				),
				'save' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Save', Opt_In::TEXT_DOMAIN ), '', 'connect', true ),
				),
			);
		} else {
			$buttons = array(
				'connect' => array(
					'markup' => Hustle_Api_Utils::get_button_markup( __( 'Connect', Opt_In::TEXT_DOMAIN ), '', 'connect', true ),
				),
			);

		}

		$response = array(
			'html'       => $step_html,
			'buttons'    => $buttons,
			'has_errors' => $has_errors,
		);

		return $response;
	}

	/**
	 * Validate the provided credentials.
	 *
	 * @since 4.0
	 *
	 * @param string $app_id
	 * @param string $username
	 * @param string $password
	 * @return bool
	 */
	private function validate_credentials( $app_id, $username, $password ) {
		if ( empty( $app_id ) || empty( $username ) || empty( $password ) ) {
			return false;
		}

		try {
			// Check if credentials are valid
			$api = self::api( $app_id, $password, $username );

			if ( is_wp_error( $api ) ) {
				Hustle_Api_Utils::maybe_log( __METHOD__, __( 'Invalid iContact API credentials.', Opt_In::TEXT_DOMAIN ) );
				return false;
			}

		} catch ( Exception $e ) {
			Hustle_Api_Utils::maybe_log( __METHOD__, $e->getMessage() );
			return false;
		}

		return true;
	}

	/**
	 * Check if email is already subcribed to list
	 */
	public function _is_subscribed( $api, $list_id, $email ) {
		$contacts = $api->get_contacts( $list_id );
		if ( !is_wp_error( $contacts ) ) {
			if ( is_array( $contacts ) && isset( $contacts['contacts'] ) && is_array( $contacts['contacts'] ) ) {
				foreach ( $contacts['contacts'] as $contact ) {
					if ( $contact['email'] === $email ){
						return true;
					}
				}
			}
		}
		return false;
	}

	public function get_30_provider_mappings() {
		return array(
			'app_id'   => 'app_id',
			'username' => 'username',
			'password' => 'password',
		);
	}

	public static function add_custom_fields( $fields, $api ) {
		$existed = array();
		$added = array();
		$error = array();
		foreach ( $fields as $field ) {
			$response = $api->add_custom_field( array(
				'displayToUser'  => 1,
				'privateName'    => $field['name'],
				'fieldType'      => ( 'email' === $field['type'] ) ? 'text' : $field['type']
			) );
			if ( isset( $response['customfields'] ) && isset( $response['warnings'][0] ) && is_array( $response['warnings'][0] ) ) {
				$existed[] = $field['name'];
			} else if ( isset( $response['customfields'] ) && ! empty( $response['customfields'] ) ) {
				$added[] = $field['name'];
			} else if ( isset( $response['warnings'][0] ) && ! is_array( $response['warnings'][0] ) ) {
				Hustle_Api_Utils::maybe_log( $response['warnings'][0] );
				$error[] = $field['name'];
			}
		}
		return array(
			'success' => true,
			'field' => $fields,
			'added' => $added,
			'existed' => $existed,
			'error' => $error,
		);
	}
}

endif;
