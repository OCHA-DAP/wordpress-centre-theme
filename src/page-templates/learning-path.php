<?php
/* Template Name: Learning Path */

/**
 * The template for Learning Path pages.
 *
 * @package uncode
 */

get_header();
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		//mixpanel.track('page view', { 'page type': 'learning module', 'learning module name': '<?php echo $menu_name ?>', 'learning module template': 'overview' });
	}
</script>

<?php
	/**
	 * DATA COLLECTION - START
	 **/

	/** Init variables **/
	$limit_width = $limit_content_width = $the_content = $main_content = $layout = $bg_color = $sidebar_style = $sidebar_bg_color = $sidebar = $sidebar_size = $sidebar_sticky = $sidebar_padding = $sidebar_inner_padding = $sidebar_content = $title_content = $media_content = $page_custom_width = $row_classes = $main_classes = $footer_content = $footer_classes = $content_after_body = '';
	$with_builder = false;

	$post_type = $post->post_type;

	/** Get general datas **/
	if (isset($metabox_data['_uncode_specific_style'][0]) && $metabox_data['_uncode_specific_style'][0] !== '') {
		$style = $metabox_data['_uncode_specific_style'][0];
		if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
			$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
		}
	} else {
		$style = ot_get_option('_uncode_general_style');
		if (isset($metabox_data['_uncode_specific_bg_color'][0]) && $metabox_data['_uncode_specific_bg_color'][0] !== '') {
			$bg_color = $metabox_data['_uncode_specific_bg_color'][0];
		} else $bg_color = ot_get_option('_uncode_general_bg_color');
	}
	$bg_color = ($bg_color == '') ? ' style-'.$style.'-bg' : ' style-'.$bg_color.'-bg';

	/** Get page width info **/
	$boxed = ot_get_option('_uncode_boxed');

	$page_content_full = (isset($metabox_data['_uncode_specific_layout_width'][0])) ? $metabox_data['_uncode_specific_layout_width'][0] : '';
	if ($page_content_full === '') {
		/** Use generic page width **/
		$generic_content_full = ot_get_option('_uncode_'.$post_type.'_layout_width');
		if ($generic_content_full === '') {
			$main_content_full = ot_get_option('_uncode_body_full');
			if ($main_content_full !== 'on') $limit_content_width = ' limit-width';
		} else {
			if ($generic_content_full === 'limit') {
				$generic_custom_width = ot_get_option('_uncode_'.$post_type.'_layout_width_custom');
				if ($generic_custom_width[1] === 'px') {
					$generic_custom_width[0] = 12 * round(($generic_custom_width[0]) / 12);
				}
				if (is_array($generic_custom_width) && !empty($generic_custom_width)) {
					$page_custom_width = ' style="max-width: '.implode('', $generic_custom_width).'; margin: auto;"';
				}
			}
		}
	} else {
		/** Override page width **/
		if ($page_content_full === 'limit') {
			$limit_content_width = ' limit-width';
			$page_custom_width = (isset($metabox_data['_uncode_specific_layout_width_custom'][0])) ? unserialize($metabox_data['_uncode_specific_layout_width_custom'][0]) : '';
			if (is_array($page_custom_width) && !empty($page_custom_width) && $page_custom_width[0] !== '') {
				if ($page_custom_width[1] === 'px') {
					$page_custom_width[0] = 12 * round(($page_custom_width[0]) / 12);
				}
				$page_custom_width = ' style="max-width: '.implode("", $page_custom_width).'; margin: auto;"';
			} else $page_custom_width = '';
		}
	}


	$homeURL = esc_url( home_url( get_current_blog_id(), '/' ) );

	$curr_page = $post->menu_order;
	$index_page_id = ($curr_page===0) ? $post->ID : $post->post_parent;
	$category_type = ($curr_page===0) ? get_field('category_type') : get_field('category_type', $post->post_parent);
	$index_page = get_page($index_page_id);

	$pages = get_pages(array(
	    'child_of' => $index_page_id
	));
	array_unshift($pages, $index_page); //add index page to pages array
	$num_pages = count($pages);
	$jump_menu_pages = $pages;

	while ( have_posts() ) : the_post(); ?>

	<div id="page-header" data-imgready="true">
		<div class="header-basic">
			<div class="background-element header-wrapper header-scroll-opacity header-parallax style-color-rgdb-bg header-only-text" data-height="35">
			<div id="particles-js"><canvas width="1572" height="600" style="width: 100%; height: 100%;"></canvas></div>
			<div class="header-main-container limit-width">
				<div class="header-content header-center header-middle header-align-center">
					<div class="header-content-inner">
						<h1 class="header-title"><span>Learn With The Centre</span></h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="content-width column-container">
		<div class='column column-12'>
			<ol class="breadcrumb header-subtitle" vocab="http://schema.org/" typeof="BreadcrumbList">
				<li property="itemListElement" typeof="ListItem">
					<a href="<?php echo $homeURL ?>" itemprop="url">Home</a>
				</li>
				<li property="itemListElement" typeof="ListItem">
					<a href="<?php echo $homeURL ?>" itemprop="url">Resources</a>
				</li>
				</li>
				<li property="itemListElement" typeof="ListItem">
					<a href="<?php echo $homeURL ?>/learning-path" itemprop="url">All Learning Paths</a>
				</li>
				<li property="itemListElement" typeof="ListItem" class="current"><?php echo get_the_title(); ?></li>
			</ol>	
		</div>
	</div>

	<div class="content-width column-container">
		<div class="column column-3">	
			<ul class="jump-menu">
				<li><h4><a href="<?php echo $homeURL ?>/learning-path">&#171; Back to all learning paths</a></h4></li>
 				<?php
					foreach($jump_menu_pages as $key=>$page) {
						$page_slug = $page->post_name;
						$page_order = $page->menu_order; 
						$class = ($key===($post->menu_order)) ? 'active' : ''; ?>
							<li class="<?php echo ($key===0) ? 'primary' : 'secondary'; ?>"><a class="<?php echo $class; ?>" href="<?php echo get_permalink($page->ID); ?>"><?php echo $page->post_title; ?></a></li>
						<?php
					}
				?>
			</ul>
		</div>

		<div class="column column-9">

			<article class="learning-path page-body">
				<div class="feature-content">
					<div class="content-width">
						<div class="feature-inner">
							<div class='category-label'><?php echo $category_type; ?></div>
							<h1><?php echo get_the_title(); ?></h1>
							<?php if (get_field('introduction')): ?>
								<?php echo get_field('introduction'); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<?php $video = get_field('video');
					$videoID = $video['id'];
					if ($videoID): ?>
						<div class="feature-media content-width">
				      	<iframe id="overviewFeatureVideo" class="video-container" src="https://www.youtube.com/embed/<?php echo $video['id']; ?>
				?modestbranding=1&rel=0&enablejsapi=1"></iframe>
							<?php if ($video['title']): ?>
								<div class="feature-media-caption">
									<h3><?php echo $video['title']; ?></h3>
									<p class="attribution"><?php echo $video['attribution']; ?></p>
								</div>
							<?php endif; ?>
						</div>
				<?php endif; ?>

				<?php 
					$column_module = get_field('column_module');
					$columns = $column_module['columns'];

					if ($column_module): ?>
						<section class="column-module content-width">
							<h2 class="section-header"><?php echo $column_module['title']; ?></h2>
							<div class="column-container column-flow">
								<?php foreach( $columns as $key=>$item ): ?>
									<div class="column column-4">
										<h3 class="fixed-height"><?php echo $item['title']; ?></h3>
										<p class="border-top"><?php echo $item['description']; ?></p>
									</div>
								<?php endforeach; ?>
							</div>
						</section>
				<?php endif; ?>

				<?php $free_module = get_field('free_module');
					if ($free_module): ?>
						<section class="free-module content-width">
							<h2 class="section-header"><?php echo $free_module['title']; ?></h2>
							<?php echo $free_module['content']; ?>
						</section>
				<?php endif; ?>

				<?php $faq = get_field('faq');
					if ($faq['category_id']): ?>
					<section class="section-faq content-width">
						<h2 class="section-header"><?php echo $faq['title']; ?></h2>
						<div class="accordion overview-accordion" id="faqAccordion">

						<?php 
						$id = $faq['category_id'];
						$json = file_get_contents('https://centre.humdata.org/wp-json/wp/v2/ufaq?ufaq-category='.$id);
						$items = json_decode($json);

						foreach($items as $key=>$var) { ?>

							<div class="card">
								<div class="card-header" id="heading<?php echo $key ?>">
									<h4 class="my-0">
										<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?php echo $key ?>" aria-expanded="true" aria-controls="collapse<?php echo $key ?>">
											<?php echo $items[$key]->title->rendered ?>
										</button>
									</h4>
								</div>
								<div id="collapse<?php echo $key ?>" class="collapse" aria-labelledby="heading<?php echo $key ?>" data-parent="#faqAccordion">
									<div class="card-body">
										<?php echo $items[$key]->content->rendered ?>
									</div>
								</div>
							</div>
						<?php } ?>
									
					</section>
				<?php endif; ?>
			</article>
		</div>
	</div>
	<div class="content-width pagination-container">
        <ul class="pagination">
        	<li class="page-prev">
        		<a class="btn btn-link <?php if ($curr_page===0) echo 'disabled'; ?>" href="<?php echo get_permalink($jump_menu_pages[$curr_page-1]->ID); ?>"><i class="fa fa-angle-left"></i> <span>Previous</span></a>
        	</li>
        	<?php
				foreach($jump_menu_pages as $key=>$page) { ?>
    				<li>
		        		<span class="btn btn-link"><a class="page-numbers <?php echo ($curr_page===$key) ? 'current' : ''; ?>" href="<?php echo get_permalink($page->ID); ?>"><?php echo $key+1 ?></a></span>
		        	</li>
				<?php } ?>
        	<li class="page-next">
        		<a class="btn btn-link <?php if ($curr_page>=($num_pages-1)) echo 'disabled'; ?>" href="<?php echo get_permalink($jump_menu_pages[$curr_page+1]->ID); ?>"><span> Next</span> <i class="fa fa-angle-right"></i></a>
        	</li>
        </ul>
    </div>
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
