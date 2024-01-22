<?php  if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Query categories data in the database
 *
 * @copyright   Copyright (C) 2018, Echo Plugins
 */
class EPKB_Categories_DB {

	/**
	 * Get all top-level categories
	 *
	 * @param $kb_id
	 * @param bool $hide_empty
	 * @return array or empty array on error
	 */
	public static function get_top_level_categories( $kb_id, $hide_empty=false ) {

		if ( ! EPKB_Utilities::is_positive_int( $kb_id ) ) {
			EPKB_Logging::add_log( 'Invalid kb id', $kb_id );
			return array();
		}

		$args = array(
			'parent'     => '0',
			'hide_empty' => $hide_empty, // whether to return categories without articles
			'taxonomy'   => EPKB_KB_Handler::get_category_taxonomy_name( $kb_id )
		);

		$terms = get_terms( $args );
		if ( is_wp_error( $terms ) ) {
			EPKB_Logging::add_log( 'cannot get terms for kb_id', $kb_id, $terms );
			return array();
		} else if ( empty( $terms ) || ! is_array( $terms ) ) {
			return array();
		}

		return array_values( $terms );   // rearrange array keys
	}

	/**
	 * Get all categories that belong to given parent
	 *
	 * @param $kb_id
	 * @param int $parent_id is parent category we use to find children
	 * @param bool $hide_empty
	 * @return array or empty array on error
	 */
	public static function get_child_categories( $kb_id, $parent_id, $hide_empty=false ) {

		if ( ! EPKB_Utilities::is_positive_int( $kb_id ) ) {
			EPKB_Logging::add_log( 'Invalid kb id', $kb_id );
			return array();
		}

		if ( ! EPKB_Utilities::is_positive_int( $parent_id ) ) {
			EPKB_Logging::add_log( 'Invalid parent id', $parent_id );
			return array();
		}

		$args = array(
			'child_of'      => $parent_id,
			'parent'        => $parent_id,
			'hide_empty'    => $hide_empty,
			'taxonomy'   => EPKB_KB_Handler::get_category_taxonomy_name( $kb_id )
		);

		$terms = get_terms( $args );
		if ( is_wp_error( $terms ) ) {
			EPKB_Logging::add_log( 'failed to get terms for kb_id: ' . $kb_id . ', parent_id: ' . $parent_id, $terms );
			return array();
		}

		if ( empty( $terms ) || ! is_array( $terms ) ) {
			return array();
		}

		return array_values( $terms );
	}

	/**
	 * Top Categories Navigation Sidebar - show a list of top or sibling KB Categories, each with link to the Category Archive page and total article count
	 *
	 * @param $kb_id
	 * @param $kb_config
	 * @param $parent_id
	 * @param $active_id
	 * @return string
	 */
	public static function get_layout_categories_list( $kb_id, $kb_config, $parent_id = 0, $active_id = 0 ) {

		$category_seq_data = EPKB_Utilities::get_kb_option( $kb_id, EPKB_Categories_Admin::KB_CATEGORIES_SEQ_META, array(), true );
		if ( EPKB_Utilities::is_wpml_enabled( $kb_config ) ) {
			$category_seq_data = EPKB_WPML::apply_category_language_filter( $category_seq_data );
		}

		$articles_seq_data = EPKB_Utilities::get_kb_option( $kb_id, EPKB_Articles_Admin::KB_ARTICLES_SEQ_META, array(), true );
		if ( EPKB_Utilities::is_wpml_enabled( $kb_config ) ) {
			$articles_seq_data = EPKB_WPML::apply_article_language_filter( $articles_seq_data );
		}

		$top_categories = [];

		// determine what categories will be displayed in the Category Focused Layout list
		if ( empty( $parent_id ) || ( isset( $kb_config['categories_layout_list_mode'] ) && $kb_config['categories_layout_list_mode'] == 'list_top_categories' ) ) {

			foreach ( $category_seq_data as $box_category_id => $box_sub_categories ) {

				if ( empty( $articles_seq_data[$box_category_id] ) ) {
					continue;
				}

				$top_categories[$box_category_id] = $articles_seq_data[$box_category_id][0];
			}

		} else {

			$sub_category_seq_data = self::array_search_key_recursively( $parent_id, $category_seq_data );

			if ( empty( $sub_category_seq_data ) ) {
				foreach ( $category_seq_data as $box_category_id => $box_sub_categories ) {

					if ( empty( $articles_seq_data[$box_category_id] ) ) {
						continue;
					}

					$top_categories[$box_category_id] = $articles_seq_data[$box_category_id][0];
				}

			} else {

				foreach ( $sub_category_seq_data as $box_category_id => $box_sub_categories ) {

					if ( empty( $articles_seq_data[$box_category_id] ) ) {
						continue;
					}

					$top_categories[$box_category_id] = $articles_seq_data[$box_category_id][0];
				}
			}
		}

		if ( empty( $top_categories ) ) {
			return '';
		}

		ob_start();

		$categories_box_typography_styles = EPKB_Utilities::get_typography_config( $kb_config['categories_box_typography'] );   ?>

		<style>
			.eckb-acll__title {
				color:<?php echo $kb_config['category_box_title_text_color']; ?>;
			}
			.eckb-article-cat-layout-list {
				background-color:<?php echo $kb_config['category_box_container_background_color']; ?>;
				<?php echo $categories_box_typography_styles; ?>
				
			}
			.eckb-article-cat-layout-list a {
				<?php echo $categories_box_typography_styles; ?>
			}
			body .eckb-acll__cat-item__name {
				color:<?php echo $kb_config['category_box_category_text_color']; ?>;
				<?php echo $categories_box_typography_styles; ?>
			}
			.eckb-acll__cat-item__count {
				color:<?php echo $kb_config['category_box_count_text_color']; ?>;
				background-color:<?php echo $kb_config['category_box_count_background_color']; ?>;
				border:solid 1px <?php echo $kb_config['category_box_count_border_color']; ?>;
			}
		</style>

		<div class="eckb-article-cat-layout-list eckb-article-cat-layout-list-reset">
			<div class="eckb-article-cat-layout-list__inner">
				<div class="eckb-acll__title"><?php echo $kb_config['category_focused_menu_heading_text']; ?></div>
				<ul>						<?php

					// display each category in a list
					$tax_name = EPKB_KB_Handler::get_category_taxonomy_name( $kb_id );
					foreach ( $top_categories as $top_category_id => $top_category_name ) {
						$term_link = EPKB_Utilities::get_term_url( $top_category_id, $tax_name );
						$active = ! empty( $active_id ) && $active_id == $top_category_id;
						$count = self::get_category_count( $kb_id, $top_category_id ); ?>

						<li class="eckb--acll__cat-item <?php echo $active ? 'eckb--acll__cat-item--active' : ''; ?>">
							<a href="<?php echo $term_link; ?>">
								<div>
									<span class="eckb-acll__cat-item__name">
										<?php echo $top_category_name; ?>
									</span>
								</div>
								<div>
									<span class="eckb-acll__cat-item__count">
										<?php echo $count; ?>
									</span>
								</div>
							</a>
						</li>						<?php
					}	?>

				</ul>
			</div>
		</div>			<?php

		return ob_get_clean();
	}

	/**
	 * Search for value in array by key recursively
	 * @param $needle_key
	 * @param $array
	 * @return array
	 */
	private static function array_search_key_recursively( $needle_key, $array ) {
		foreach ( $array as $key => $value ) {
			if ( $key == $needle_key ) {
				return $value;
			}

			if ( is_array( $value ) ) {
				$result = self::array_search_key_recursively( $needle_key, $value );
				if ( ! empty( $result ) ) {
					return $result;
				}
			}
		}

		return [];
	}

	/**
	 * Count articles in category and sub-category
	 *
	 * @param $kb_id
	 * @param $category_id
	 * @return int
	 */
	public static function get_category_count( $kb_id, $category_id ) {

		$article_db = new EPKB_Articles_DB();

		$articles = $article_db->get_articles_by_sub_or_category( $kb_id, $category_id, 'date', -1, true, false );

		return count( $articles );
	}
}