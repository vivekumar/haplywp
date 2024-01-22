<?php

/**
 * HTML Elements for admin pages excluding boxes
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
class EPKB_HTML_Admin {

	/********************************************************************************
	 *
	 *                             ADMIN HEADER
	 *
	 ********************************************************************************/

	/**
	 * Show Admin Header
	 *
	 * @param $kb_config
	 * @param $permissions
	 * @param string $content_type
	 * @param string $position
	 */
	public static function admin_header( $kb_config, $permissions, $content_type='header', $position = '' ) {  ?>

		<!-- Admin Header -->
		<div class="epkb-admin__header">
			<div class="epkb-admin__section-wrap <?php echo empty( $position ) ? '' : 'epkb-admin__section-wrap--' . esc_attr( $position ); ?> epkb-admin__section-wrap__header">   <?php

				switch ( $content_type ) {
					case 'header':
					default:
						echo self::admin_header_content( $kb_config, $permissions ) ;
						break;
					case 'logo':
						echo self::admin_header_logo();
						break;
				}  ?>

			</div>
		</div>  <?php
	}

	/**
	 * Content for Admin Header - KB Logo, List of KBs
	 *
	 * @param $kb_config
	 * @param array $contexts
	 * @return string
	 */
	public static function admin_header_content( $kb_config, $contexts=[] ) {

		ob_start();

		$link_output = EPKB_Core_Utilities::get_current_kb_main_page_link( $kb_config, __( 'View KB', 'echo-knowledge-base' ), 'epkb-admin__header__view-kb__link' );
		if ( empty( $link_output ) && EPKB_Admin_UI_Access::is_user_access_to_context_allowed( 'admin_eckb_access_frontend_editor_write' ) ) {
			$link_output = '<a href="' . esc_url( admin_url( '/edit.php?post_type=' . EPKB_KB_Handler::get_post_type( $kb_config['id'] ) . '&page=epkb-kb-configuration&setup-wizard-on' ) ) .
			               '" class="epkb-admin__header__view-kb__link" target="_blank">' . esc_html__( "Setup KB", "echo-knowledge-base" ) . '</a>';
		}

		echo self::admin_header_logo();    ?>

		<div class="epkb-admin__header__controls-wrap">

			<!-- KBs List -->
			<p class="epkb-admin__header__label"><?php esc_html__( 'Select KB', 'echo-knowledge-base' ); ?></p>
			<div class="epkb-admin__header__dropdown">      <?php
				EPKB_Core_Utilities::admin_list_of_kbs( $kb_config, $contexts ); 			?>
			</div>

			<!-- Link to KB View -->
			<div class="epkb-admin__header__view-kb">
				<?php echo $link_output; ?>
			</div>  <?php    ?>
		</div>      <?php

		$result = ob_get_clean();

		return empty( $result ) ? '' : $result;
	}

	/**
	 * Get logo container for the admin header
	 *
	 * @return string
	 */
	public static function admin_header_logo() {

		ob_start();     ?>

		<!-- Echo Logo -->
		<div class="epkb-admin__header__logo-wrap">
			<img class="epkb-admin__header__logo-mobile" alt="<?php esc_html_e( 'Echo Knowledge Base Logo', 'echo-knowledge-base' ); ?>" src="<?php echo Echo_Knowledge_Base::$plugin_url . 'img/kb-icon.png'; ?>">
			<img class="epkb-admin__header__logo-desktop" alt="<?php esc_html_e( 'Echo Knowledge Base Logo', 'echo-knowledge-base' ); ?>" src="<?php echo Echo_Knowledge_Base::$plugin_url . 'img/echo-kb-logo' . ( is_rtl() ? '-rtl' : '' ) . '.png'; ?>">
		</div>  <?php

		$result = ob_get_clean();

		return empty( $result ) ? '' : $result;
	}


	/********************************************************************************
	 *
	 *                             ADMIN TABS
	 *
	 ********************************************************************************/

	/**
	 * Show Admin Toolbar
	 *
	 * @param $admin_page_views
	 */
	public static function admin_primary_tabs( $admin_page_views ) {     ?>

		<!-- Admin Top Panel -->
		<div class="epkb-admin__top-panel">
			<div class="epkb-admin__section-wrap epkb-admin__section-wrap__top-panel">      <?php

				foreach( $admin_page_views as $page_view ) {

					// Optionally we can have null in $page_view, make sure we handle it correctly
					if ( empty( $page_view ) || ! is_array( $page_view ) ) {
						continue;
					}

					// Fill missing fields in admin page view configuration array with default values
					$page_view = self::admin_page_view_fill_missing_with_default( $page_view );

					// Do not render toolbar tab if the user does not have permission
					if ( ! current_user_can( $page_view['minimum_required_capability'] ) ) {
						continue;
					}   ?>

					<div class="epkb-admin__top-panel__item epkb-admin__top-panel__item--<?php echo esc_attr( $page_view['list_key'] );
					echo empty( $page_view['secondary_tabs'] ) ? '' : ' epkb-admin__top-panel__item--parent ';
					echo esc_attr( $page_view['main_class'] ); ?>"
						<?php echo empty( $page_view['list_id'] ) ? '' : ' id="' . esc_attr( $page_view['list_id'] ) . '"'; ?> data-target="<?php echo esc_attr( $page_view['list_key'] ); ?>">
						<div class="epkb-admin__top-panel__icon epkb-admin__top-panel__icon--<?php echo esc_attr( $page_view['list_key'] ); ?> <?php echo esc_attr( $page_view['icon_class'] ); ?>"></div>
						<p class="epkb-admin__top-panel__label epkb-admin__boxes-list__label--<?php echo esc_attr( $page_view['list_key'] ); ?>"><?php echo wp_kses_post( $page_view['label_text'] ); ?></p>
					</div> <?php
				}       ?>

			</div>
		</div>  <?php
	}

	/**
	 * Display admin second-level tabs below toolbar
	 *
	 * @param $admin_page_views
	 */
	public static function admin_secondary_tabs( $admin_page_views ) {  ?>

		<!-- Admin Secondary Panels List -->
		<div class="epkb-admin__secondary-panels-list">
			<div class="epkb-admin__section-wrap epkb-admin__section-wrap__secondary-panel">  <?php

				foreach ( $admin_page_views as $page_view ) {

					// Optionally we can have null in $page_view, make sure we handle it correctly
					if ( empty( $page_view ) || ! is_array( $page_view ) ) {
						continue;
					}

					// Optionally we can have empty in $page_view['secondary_tabs'], make sure we handle it correctly
					if ( empty( $page_view['secondary_tabs'] ) || ! is_array( $page_view['secondary_tabs'] ) ) {
						continue;
					}

					// Fill missing fields in admin page view configuration array with default values
					$page_view = self::admin_page_view_fill_missing_with_default( $page_view );

					// Do not render toolbar tab if the user does not have permission
					if ( ! current_user_can( $page_view['minimum_required_capability'] ) ) {
						continue;
					}   ?>

					<!-- Admin Secondary Panel -->
					<div id="epkb-admin__secondary-panel__<?php echo esc_attr( $page_view['list_key'] ); ?>" class="epkb-admin__secondary-panel">  <?php

						foreach ( $page_view['secondary_tabs'] as $secondary ) {

							// Optionally we can have empty in $secondary, make sure we handle it correctly
							if ( empty( $secondary ) || ! is_array( $secondary ) ) {
								continue;
							}

							// Do not render toolbar tab if the user does not have permission
							if ( ! current_user_can( $secondary['minimum_required_capability'] ) ) {
								continue;
							}   ?>

							<div class="epkb-admin__secondary-panel__item epkb-admin__secondary-panel__<?php echo esc_attr( $secondary['list_key'] ); ?> <?php
							echo ( $secondary['active'] ? 'epkb-admin__secondary-panel__item--active' : '' );
							echo esc_attr( $secondary['main_class'] ); ?>" data-target="<?php echo esc_attr( $page_view['list_key'] ) . '__' .esc_attr( $secondary['list_key'] ); ?>">     <?php

								// Optional icon for secondary panel item
								if ( ! empty( $secondary['icon_class'] ) ) {        ?>
									<span class="epkb-admin__secondary-panel__icon <?php echo esc_attr( $secondary['icon_class'] ); ?>"></span>     <?php
								}       ?>

								<p class="epkb-admin__secondary-panel__label epkb-admin__secondary-panel__<?php echo esc_attr( $secondary['list_key'] ); ?>__label"><?php echo wp_kses_post( $secondary['label_text'] ); ?></p>
							</div>  <?php

						}   ?>
					</div>  <?php

				}   ?>

			</div>
		</div>  <?php
	}

	/**
	 * Show content (such as settings and features) for each primary tab
	 *
	 * @param $admin_page_views
	 */
	public static function admin_primary_tabs_content( $admin_page_views ) {    ?>

		<!-- Admin Content -->
		<div class="epkb-admin__content"> <?php

		echo '<div class="epkb-admin__boxes-list-container">';
		foreach ( $admin_page_views as $page_view ) {

			// Optionally we can have null in $page_view, make sure we handle it correctly
			if ( empty( $page_view ) || ! is_array( $page_view ) ) {
				continue;
			}

			// Fill missing fields in admin page view configuration array with default values
			$page_view = self::admin_page_view_fill_missing_with_default( $page_view );

			// Do not render view if the user does not have permission
			if ( ! current_user_can( $page_view['minimum_required_capability'] ) ) {
				continue;
			}   ?>

			<!-- Admin Boxes List -->
			<div id="epkb-admin__boxes-list__<?php echo esc_attr( $page_view['list_key'] ); ?>" class="epkb-admin__boxes-list">     <?php

			// List body
			self::admin_single_primary_tab_content( $page_view );

			// Optional list footer
			if ( ! empty( $page_view['list_footer_html'] ) ) {   ?>
				<div class="epkb-admin__section-wrap epkb-admin__section-wrap__<?php echo esc_attr( $page_view['list_key'] ); ?>">
					<div class="epkb-admin__boxes-list__footer"><?php echo wp_kses_post( $page_view['list_footer_html'] ); ?></div>
				</div>      <?php
			}   ?>

			</div><?php
		}
		echo '</div>'; ?>
		</div><?php
	}

	/**
	 * Show single List of Settings Boxes for Admin Page
	 *
	 * @param $page_view
	 */
	private static function admin_single_primary_tab_content( $page_view ) {

		// CASE: secondary tabs
		if ( ! empty( $page_view['secondary_tabs'] ) && is_array( $page_view['secondary_tabs'] ) ) {

			// Secondary tabs
			foreach ( $page_view['secondary_tabs'] as $secondary_tab ) {

				// Make sure we can handle empty boxes list correctly
				if ( empty( $secondary_tab['boxes_list'] ) || ! is_array( $secondary_tab['boxes_list'] ) ) {
					continue;
				}

				// Do not render toolbar tab if the user does not have permission
				if ( ! current_user_can( $secondary_tab['minimum_required_capability'] ) ) {
					continue;
				}   ?>

				<!-- Admin Section Wrap -->
				<div class="epkb-setting-box-container epkb-setting-box-container-type-<?php echo esc_attr( $page_view['list_key'] ); ?>">

					<!-- Secondary Boxes List -->
					<div id="epkb-setting-box__list-<?php echo esc_attr( $page_view['list_key'] ) . '__' . esc_attr( $secondary_tab['list_key'] ); ?>"
					     class="epkb-setting-box__list <?php echo ( $secondary_tab['active'] ? 'epkb-setting-box__list--active' : '' ); ?>">   <?php

						self::admin_tab_content_boxes_list( $secondary_tab );   ?>

					</div>

				</div>  <?php
			}
			return;
		}

		// CASE: vertical (secondary) tabs
		if ( ! empty( $page_view['vertical_tabs'] ) && is_array( $page_view['vertical_tabs'] ) ) {      ?>

			<!-- Admin Form -->
			<div class="epkb-admin__form">
				<div class="epkb-admin__form__save_button">
					<button class="epkb-success-btn epkb-admin__kb__form-save__button"><?php esc_html_e( 'Save Settings', 'echo-knowledge-base' ); ?></button>
				</div>
				<div class="epkb-admin__form__body"><?php
					self::display_admin_vertical_tabs( $page_view['vertical_tabs'] );   ?>
				</div>
			</div>  <?php

			return;
		}

		// CASE: Boxes List for view without secondary tabs - make sure we can handle empty boxes list correctly
		if ( ! empty( $page_view['boxes_list'] ) && is_array( $page_view['boxes_list'] ) ) {    ?>

			<!-- Admin Section Wrap -->
			<div class="epkb-admin__section-wrap epkb-admin__section-wrap__<?php echo esc_attr( $page_view['list_key'] ); ?>">  <?php

				self::admin_tab_content_boxes_list( $page_view );   ?>

			</div>      <?php
			return;
		}
	}

	/**
	 * Display boxes list for admin settings
	 *
	 * @param $page_view
	 */
	private static function admin_tab_content_boxes_list( $page_view ) {

		// Optional buttons row displayed at the top of the boxes list
		if ( ! empty( $page_view['list_top_actions_html'] ) ) {
			echo $page_view['list_top_actions_html'];
		}

		// Admin Boxes with configuration
		foreach ( $page_view['boxes_list'] as $box_options ) {

			// Do not render empty or not valid array
			if ( empty( $box_options ) || ! is_array( $box_options ) ) {
				continue;
			}

			EPKB_HTML_Forms::admin_settings_box( $box_options );
		}

		// Optional buttons row displayed at the bottom of the boxes list
		if ( ! empty( $page_view['list_bottom_actions_html'] ) ) {
			echo $page_view['list_bottom_actions_html'];
		}
	}

	/**
	 * Display vertical tabs
	 *
	 * @param $vertical_tabs
	 */
	private static function display_admin_vertical_tabs( $vertical_tabs ) { ?>

		<!-- TABS -->
		<div class="epkb-admin__form-tabs">    <?php
			foreach ( $vertical_tabs as $tab ) {

				$data_escaped = '';
				if ( ! empty( $tab['data'] ) ) {
					foreach ( $tab['data'] as $key => $value ) {
						$data_escaped .= 'data-' . esc_attr( $key ) . '="' . esc_attr( $value ) . '" ';
					}
				}   ?>

				<div class="epkb-admin__form-tab<?php echo $tab['active'] ? ' epkb-admin__form-tab--active' : ''; ?>" data-target="<?php echo esc_attr( $tab['key'] ); ?>" <?php echo $data_escaped; ?>>
					<i class="<?php echo esc_attr( $tab['icon'] ); ?> epkb-admin__form-tab-icon"></i>
					<span class="epkb-admin__form-tab-title"><?php echo esc_html( $tab['title'] ); ?></span>
				</div>  <?php
			}   ?>
		</div>

		<!-- TAB CONTENTS -->
		<div class="epkb-admin__form-tab-contents"> <?php
			foreach ( $vertical_tabs as $tab ) {    ?>

				<div class="epkb-admin__form-tab-wrap epkb-admin__form-tab-wrap--<?php echo esc_attr( $tab['key'] ); echo $tab['active'] ? ' epkb-admin__form-tab-wrap--active' : ''; ?>">  <?php

					foreach ( $tab['contents'] as $content ) {

						$data_escaped = '';
						if ( ! empty( $content['data'] ) ) {
							foreach ( $content['data'] as $key => $value ) {
								$data_escaped .= 'data-' . esc_attr( $key ) . '="' . esc_attr( $value ) . '" ';
							}
						}   ?>

						<div class="epkb-admin__form-tab-content <?php echo empty( $content['css_class'] ) ? '' : esc_attr( $content['css_class'] ); ?>" <?php echo $data_escaped; ?>>

							<div class="epkb-admin__form-tab-content-title">    <?php
								echo esc_html( $content['title'] );
						        if ( ! empty( $content['help_links_html'] ) ) {
                                    echo wp_kses( $content['help_links_html'], EPKB_Utilities::get_admin_ui_extended_html_tags() );
                                }   ?>
                            </div>  <?php

							if ( ! empty( $content['desc'] ) ) {   ?>
								<div class="epkb-admin__form-tab-content-desc">
									<span class="epkb-admin__form-tab-content-desc__text"><?php echo esc_html( $content['desc'] ); ?></span>    <?php
									if ( ! empty( $content['read_more_url'] ) ) {   ?>
										<a class="epkb-admin__form-tab-content-desc__link" href="<?php echo esc_url( $content['read_more_url'] ); ?>" target="_blank"><?php echo esc_html( $content['read_more_text'] ); ?></a> <?php
									}   ?>
								</div>   <?php
							}   ?>

							<div class="epkb-admin__form-tab-content-body">     <?php
								echo wp_kses( $content['body_html'], EPKB_Utilities::get_admin_ui_extended_html_tags() );   ?>
							</div>
						</div>  <?php
					}   ?>

				</div>  <?php
			}   ?>
		</div>  <?php
	}


	/********************************************************************************
	 *
	 *                                   VARIOUS
	 *
	 ********************************************************************************/

	/**
	 * Fill missing fields in single admin page view configuration array with default values
	 *
	 * @param $page_view
	 * @return array
	 */
	private static function admin_page_view_fill_missing_with_default( $page_view ) {

		// Do not fill empty or not valid array
		if ( empty( $page_view ) || ! is_array( $page_view ) ) {
			return $page_view;
		}

		// Default page view
		$default_page_view = array(

			// Shared
			'minimum_required_capability'   => EPKB_Admin_UI_Access::get_admin_capability(),
			'secondary_tab_access_override' => [],
			'active'                        => false,
			'list_id'                       => '',
			'list_key'                      => '',
			'kb_config_id'				    => '',

			// Top Panel Item
			'label_text'                    => '',
			'main_class'                    => '',
			'label_class'                   => '',
			'icon_class'                    => '',

			// Secondary Panel Items
			'secondary_tabs'                => array(),

			// Boxes List
			'list_top_actions_html'         => '',
			'list_bottom_actions_html'      => '',
			'boxes_list'                    => array(),
			'vertical_tabs'                 => array(),

			// List footer HTML
			'list_footer_html'              => '',
		);

		// Default secondary view
		$default_secondary = array(

			// Shared
			'active'                    => false,
			'list_key'                  => '',

			// Secondary Panel Item
			'label_text'                => '',
			'main_class'                => '',
			'label_class'               => '',
			'icon_class'                => '',

			// Secondary Boxes List
			'list_top_actions_html'     => '',
			'list_bottom_actions_html'  => '',
			'boxes_list'                => array(),
		);

		// Default box
		$default_box = array(
			'icon_class'    => '',
			'class'         => '',
			'title'         => '',
			'description'   => '',
			'html'          => '',
			'return_html'   => false,
			'extra_tags'    => [],
		);

		// Default admin form tab in vertical_tabs
		$default_admin_form_tab = array(
			'title'     => '',
			'icon'      => '',
			'key'       => '',
			'active'    => false,
			'contents'  => [],
		);

		// Default content for admin form tab
		$default_admin_form_tab_content = array(
			'title'             => '',
			'desc'              => '',
			'body_html'         => '',
			'read_more_url'     => '',
			'read_more_text'    => '',
		);

		// Set default view
		$page_view = array_merge( $default_page_view, $page_view );

		// Set default boxes
		foreach ( $page_view['boxes_list'] as $box_index => $box_content ) {

			// Do not fill empty or not valid array
			if ( empty( $page_view['boxes_list'][$box_index] ) || ! is_array( $page_view['boxes_list'][$box_index] ) ) {
				continue;
			}

			$page_view['boxes_list'][$box_index] = array_merge( $default_box, $box_content );
		}

		// Set default secondary views
		foreach ( $page_view['secondary_tabs'] as $secondary_index => $secondary_content ) {

			// Do not fill empty or not valid array
			if ( empty( $page_view['secondary_tabs'][$secondary_index] ) || ! is_array( $page_view['secondary_tabs'][$secondary_index] ) ) {
				continue;
			}

			// if minimum required capability is missed, then inherit it from upper level
			$secondary_content['minimum_required_capability'] = in_array( $secondary_content['list_key'], array_keys( $page_view['secondary_tab_access_override'] ) )
				? $page_view['secondary_tab_access_override'][$secondary_content['list_key']]
				: $secondary_content['minimum_required_capability'] = $page_view['minimum_required_capability'];

			$page_view['secondary_tabs'][$secondary_index] = array_merge( $default_secondary, $secondary_content );

			// Set default boxes
			foreach ( $page_view['secondary_tabs'][$secondary_index]['boxes_list'] as $box_index => $box_content ) {

				// Do not fill empty or not valid array
				if ( empty(  $page_view['secondary_tabs'][$secondary_index]['boxes_list'][$box_index] ) || ! is_array(  $page_view['secondary_tabs'][$secondary_index]['boxes_list'][$box_index] ) ) {
					continue;
				}

				$page_view['secondary_tabs'][$secondary_index]['boxes_list'][$box_index] = array_merge( $default_box, $box_content );
			}
		}

		if ( ! empty( $page_view['secondary_tab_access_override'] ) ) {
			$page_view['minimum_required_capability'] = reset( $page_view['secondary_tab_access_override'] );
		}

		// Set default tabs in vertical_tabs
		foreach ( $page_view['vertical_tabs'] as $tab_key => $admin_form_tab ) {
			$page_view['vertical_tabs'][$tab_key] = array_merge( $default_admin_form_tab, $admin_form_tab );

			// Set default contents in tabs
			foreach ( $page_view['vertical_tabs'][$tab_key]['contents'] as $content_index => $admin_form_tab_content ) {
				$page_view['vertical_tabs'][$tab_key]['contents'][$content_index] = array_merge( $default_admin_form_tab_content, $admin_form_tab_content );
			}
		}

		return $page_view;
	}

	/**
	 * We need to add this HTML to admin page to catch WP admin JS functionality
	 *
	 * @param false $include_no_css_message
	 * @param false $support_for_old_design
	 */
	public static function admin_page_css_missing_message( $include_no_css_message=false, $support_for_old_design=false ) {  ?>

		<!-- This is to catch WP JS garbage -->
		<div class="wrap epkb-wp-admin<?php echo ( $support_for_old_design ? ' epkb-admin-old-design-support' : '' ); ?>">
			<h1></h1>
		</div>
		<div class=""></div>  <?php

		if ( $include_no_css_message ) {    ?>
			<!-- This is for cases of CSS incorrect loading -->
			<h1 style="color: red; line-height: 1.2em; background-color: #eaeaea; border: solid 1px #ddd; padding: 20px;" class="epkb-css-working-hide-message">
				<?php esc_html_e( 'Please reload the page to refresh CSS styles. That should correctly render the page. This issue is typically caused by timeout or other plugins blocking CSS.' .
				                  'If that does not help, contact us for help.', 'echo-knowledge-base' ); ?></h1>   <?php
		}
	}

	/**
	 * Display modal form in admin area for user to submit an error to support. For example Setup Wizard/Editor encounters error.
	 */
	public static function display_report_admin_error_form() {

		$current_user = wp_get_current_user();      ?>

		<!-- Submit Error Form -->
		<div class="epkb-admin__error-form__container" style="display:none!important;">
			<div class="epkb-admin__error-form__wrap">
				<div class="epkb-admin__scroll-container">
					<div class="epkb-admin__white-box">

						<h4 class="epkb-admin__error-form__title"></h4>
						<div class="epkb-admin__error-form__desc"></div>

						<form id="epkb-admin__error-form" method="post">				<?php

							EPKB_HTML_Admin::nonce();				?>

							<input type="hidden" name="action" value="epkb_report_admin_error" />
							<div class="epkb-admin__error-form__body">

								<label for="epkb-admin__error-form__first-name"><?php esc_html_e( 'Name', 'echo-knowledge-base' ); ?>*</label>
								<input name="first_name" type="text" value="<?php echo esc_attr( $current_user->display_name ); ?>" required  id="epkb-admin__error-form__first-name">

								<label for="epkb-admin__error-form__email"><?php esc_html_e( 'Email', 'echo-knowledge-base' ); ?>*</label>
								<input name="email" type="email" value="<?php echo esc_attr( $current_user->user_email ); ?>" required id="epkb-admin__error-form__email">

								<label for="epkb-admin__error-form__message"><?php esc_html_e( 'Error Details', 'echo-knowledge-base' ); ?>*</label>
								<textarea name="admin_error" class="admin_error" required id="epkb-admin__error-form__message"></textarea>

								<div class="epkb-admin__error-form__btn-wrap">
									<input type="submit" name="submit_error" value="<?php esc_attr_e( 'Submit', 'echo-knowledge-base' ); ?>" class="epkb-admin__error-form__btn epkb-admin__error-form__btn-submit">
									<span class="epkb-admin__error-form__btn epkb-admin__error-form__btn-cancel"><?php esc_html_e( 'Cancel', 'echo-knowledge-base' ); ?></span>
								</div>

								<div class="epkb-admin__error-form__response"></div>
							</div>
						</form>

						<div class="epkb-close-notice epkbfa epkbfa-window-close"></div>

					</div>
				</div>
			</div>
		</div>      <?php
	}

	/**
	 * Display or return HTML input for wpnonce
	 *
	 * @param false $return_html
	 *
	 * @return false|string|void
	 */
	public static function nonce( $return_html=false ) {

		if ( $return_html ) {
			ob_start();
		}   ?>

		<input type="hidden" name="_wpnonce_epkb_ajax_action" value="<?php echo wp_create_nonce( '_wpnonce_epkb_ajax_action' ); ?>">	<?php

		if ( $return_html ) {
			return ob_get_clean();
		}
	}

	/**
	 * Generic admin page to display message on configuration error
	 */
	public static function display_config_error_page() {    ?>
		<div id="ekb-admin-page-wrap" class="ekb-admin-page-wrap--config-error">    <?php
			EPKB_HTML_Forms::notification_box_middle( [ 'type' => 'error', 'title' => __( 'Cannot load configuration.', 'echo-knowledge-base' ), 'desc' =>  EPKB_Utilities::contact_us_for_support() ] );  ?>
		</div>  <?php
	}
}
