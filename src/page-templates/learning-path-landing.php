<?php
/* Template Name: Learning Path Landing */

/**
 * The template for Learning Path Landing page.
 *
 * @package uncode
 */

get_header();
?>

<script>
	//mixpanel tracking
	window.onload = function(e) {
		//mpTrack.pageView(document.title, 'learning module');
	}
</script>

<?php

	while ( have_posts() ) : the_post(); ?>

	<div id="page-header">
		<div class="header-basic">
			<div class="header-wrapper">
			<div id="particles-js"><canvas width="1572" height="600" style="width: 100%; height: 100%;"></canvas></div>
			<div class="header-main-container limit-width">
				<div class="header-content">
					<div class="header-content-inner">
						<h1 class="header-title"><span>Learn With The Centre</span></h1>
					</div>
				</div>
			</div>
		</div>
	</div>


	<article class="learning-path landing">
		<div class="content-width">
			<?php
				$pages = get_pages(array(
					'post_type' => 'page',
				    'meta_key' => '_wp_page_template',
				    'hierarchical' => 0,
				    'meta_value' => 'page-templates/learning-path.php',
				    'sort_column' => 'post_date', 
                    'sort_order' => 'DESC'
				));
				$section_pages = $pages;
				$jump_menu_pages = $pages; 
			?>

			<div class="column-container">
				<div class="column column-3">
					<ol class="breadcrumb header-subtitle" vocab="http://schema.org/" typeof="BreadcrumbList">
						<li><a href="https://centre.humdata.org/" itemprop="url">Home</a></li>
						<li>Resources</li>
						<li class="current">All Learning Paths</li>
					</ol>
					<ul class="jump-menu">
						<li>ALL LEARNING PATHS</li>
						<?php
							foreach($jump_menu_pages as $page) {
								$page_slug = $page->post_name;
								$page_order = $page->menu_order;
								$page_query = new WP_Query('page_id=' . $page->ID);
								while ($page_query->have_posts()) : $page_query->the_post();
									if ($page_order==0): ?>
										<li><a href="<?php echo get_permalink($page->ID); ?>"><?php echo the_title(); ?></a></li>
								<?php endif;
								endwhile; 
							}
						?>
					</ul>
				</div>
				<div class="column column-9">
					<div class="column-container column-flow">
				<?php
					foreach($section_pages as $page){
						$page_slug = $page->post_name;
						$page_order = $page->menu_order;
						$page_query = new WP_Query('page_id=' . $page->ID);
						while ($page_query->have_posts()) : $page_query->the_post();
							if ($page_order==0): ?>
								<div class="column column-4 landing-item">
									<div class='thumb'>
										<div class='category-label'><?php echo get_field('category_type'); ?></div>
									</div>
									<h6 class="subtitle"><?php echo get_field('category_type'); ?></h6>
									<a href="<?php echo get_page_link(); ?>"><span class='title'><?php echo the_title(); ?></span></a>
									<p><?php echo get_field('landing_excerpt'); ?></p>
								</div>
						<?php endif;
						endwhile; 
					} 
				?>
					</div>
				</div>
			</div>
									

		</div>					
	</article>	

	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>

