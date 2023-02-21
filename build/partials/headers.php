<?php

/*****************
 *
 *   HEADER BUILDER
 *
 ******************/

if(!class_exists('unheader')) {
	class unheader
	{

		function __construct($args, $page_title = '')
		{

			$this->html = '';
			$height_style = '';

			if(isset($args['_uncode_header_height'][0]) && $args['_uncode_header_height'][0] !== '') {
				$height = $args['_uncode_header_height'][0];
				if($height[1] == '%') {
					$data_height = ' data-height="'.$height[0].'"';
				}
				if($height[1] == 'px') {
					$data_height = ' data-height="fixed"';
				}
			}

			if(isset($args['_uncode_header_min_height'][0]) && $args['_uncode_header_min_height'][0] !== '') {
				$min_height = intval(preg_replace('/[^0-9]+/', '', $args['_uncode_header_min_height'][0]), 10);
				$height_style .= 'min-height: '.$min_height.'px;';
			}
			if($height_style !== '') $height_style = ' style="'.$height_style.'"';

			$header_style = (isset($args['_uncode_header_style'])) ? $args['_uncode_header_style'][0] : 'light';
			$header_align = (isset($args['_uncode_header_align'])) ? $args['_uncode_header_align'][0] : 'center';

			$header_scroll_opacity = (isset($args['_uncode_header_scroll_opacity'])) ? $args['_uncode_header_scroll_opacity'][0] : '';

			$header_type = (isset($args['_uncode_header_type'][0])) ? $args['_uncode_header_type'][0] : 'none';

			switch($header_type) {

				case 'header_basic':

					$header_parallax = (isset($args['_uncode_header_parallax'][0]) && $args['_uncode_header_parallax'][0] == 'on') ? ' header-parallax' : '';
					$header_position = (isset($args['_uncode_header_position'][0])) ? ' '.$args['_uncode_header_position'][0] : '';

					$header_background_array = uncode_get_back_html([], '', '', '', 'header');

					//show breadcrumbs
					$content_html = uncode_breadcrumbs();

					//moved post info to position above header title
					$get_post_type = get_post_type();
					if($get_post_type === 'post' && is_single()) $content_html .= uncode_custom_post_info();
					if($get_post_type === 'portfolio' && is_single()) $content_html .= uncode_portfolio_info();

					$content_html .= apply_filters('uncode_before_header_title', '');

					//show featured image if post type is page
					if(has_post_thumbnail() && $get_post_type === 'page') {
						if(basename(get_page_template()) === 'impactstory.php') {
							$content_html .= '<img src="'.get_stylesheet_directory_uri().'/assets/impactstory-pattern.jpg" />';
							// $country_id = get_field('map_id');
							// $content_html .= '<iframe height="350" width="1024" frameborder="0" src="https://data.humdata.org/worldmap?id='.$country_id. '" style="height: 350px; width: 1024px; border: none;" class="featured-image"></iframe>';
						} else {
							$feat_image_url = wp_get_attachment_url(get_post_thumbnail_id());
							$image_credit = get_media_credit(get_post_thumbnail_id());
							$content_html .= '<img class="featured-image" src="'.$feat_image_url.'"><div class="photo-credit">Photo: '.$image_credit.'</div>';
						}
					}

					//show header title
					if($page_title === 'Article') $page_title = 'Articles';
					if($page_title === 'Blog') $page_title = 'Blogs';
					if($page_title === 'Case Study') $page_title = 'Case Studies';
					if($page_title === 'Impact Story') $page_title = 'Impact Stories';
					if($page_title === 'Slideshow') $page_title = 'Slideshows';
					if($page_title === 'Video') $page_title = 'Videos';

					if(basename(get_page_template()) === 'impactstory.php') {
						$content_html .= '<div class="header-container"><h5 class="header-category">Impact Story</h5>';
					}
					$content_html .= '<h1 class="header-title entryid-'.get_the_ID().' 1 "><span>'.$page_title.'</span></h1><div class="search-container">'.get_search_form(false).'</div>';
					if(basename(get_page_template()) === 'impactstory.php') {
						$content_html .= '</div>';
					}

					// $get_post_type = get_post_type();
					// if ($get_post_type === 'post' && is_single()) $content_html .= uncode_post_info();
					// if ($get_post_type === 'portfolio' && is_single()) $content_html .= uncode_portfolio_info();

					//show featured image
					if(has_post_thumbnail() && $get_post_type != 'page') {
						$feat_image_url = wp_get_attachment_url(get_post_thumbnail_id());
						$image_credit = get_media_credit(get_post_thumbnail_id());
						$content_html .= '<img class="featured-image" src="'.$feat_image_url.'"><div class="photo-credit">Photo: '.$image_credit.'</div>';
					}

					$content_html .= apply_filters('uncode_after_header_title', '');

					$this->html = '
	<div class="header-basic style-'.$header_style.'">
	    <div class="background-element header-wrapper'.($header_scroll_opacity === 'on' ? ' header-scroll-opacity' : '').$header_parallax.$header_background_array['back_color'].(($header_background_array['content_html'] === '' || $header_background_array['content_only_text']) ? ' header-only-text' : '').'" '.$data_height.$height_style.'>
		    <div id="particles-js"></div>
		    <div class="header-main-container limit-width">
		    	<div class="header-content'.$header_position.' header-align-'.$header_align.'">
		            <div class="header-content-inner">
		                '.$content_html.'
		            </div>
		        </div>
		    </div>
		</div>
	</div>
			';
					break;

				// homepage?
				case 'header_uncodeblock':
					$uncodeblock_id = (isset($args['_uncode_blocks_list']) && $args['_uncode_blocks_list'][0] !== '') ? $args['_uncode_blocks_list'][0] : '';
					if($uncodeblock_id !== '') $uncodeblock_id = apply_filters('wpml_object_id', $uncodeblock_id, 'post');
					$uncode_block = ($uncodeblock_id !== '') ? get_post_field('post_content', $uncodeblock_id) : '';
					$uncode_block = str_replace('[vc_row ', '[vc_row is_header="yes" ', $uncode_block);
					$uncode_block = str_replace('[uncode_slider ', '[uncode_slider is_header="yes" ', $uncode_block);
					preg_match_all('/\[vc_custom_heading(.*?)\](.*?)\[(.*?)]/', $uncode_block, $matches, PREG_SET_ORDER);
					foreach($matches as $key => $value) {
						$title_found = false;
						$last_key = count($value) - 2;
						foreach($value as $key_sc => $value_sc) {
							preg_match_all('/(.*?)=\"(.*?)\"/', trim($value_sc), $matches_attr, PREG_SET_ORDER);
							if(isset($matches_attr[0])) {
								foreach($matches_attr[0] as $key_attr => $value_attr) {
									if($value_attr === 'auto_text') {
										if($matches_attr[0][$key_attr + 1] === 'yes') {
											$value[$last_key] = $page_title;
											$title_found = true;
											break;
										}
									}
								}
							}
						}
						if($title_found) {
							$replacement = '[vc_custom_heading'.$value[1].']'.$page_title.'[/vc_custom_heading]';
							$uncode_block = str_replace($value[0], $replacement, $uncode_block);
						}
					}

					$this->html = '<div id="particles-js"></div><div class="header-wrapper header-uncode-block">'.$uncode_block.'</div>';

					break;
			}
		}
	}
}
