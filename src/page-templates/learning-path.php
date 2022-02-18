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
	$homeURL = esc_url( home_url( get_current_blog_id(), '/' ) );

	$curr_page = $post->menu_order;
	$index_page_id = ($curr_page===0) ? $post->ID : $post->post_parent;
	$category_type = ($curr_page===0) ? get_field('category_type') : get_field('category_type', $post->post_parent);
	$index_page = get_page($index_page_id);

	$pages = get_pages(array(
	    'child_of' => $index_page_id,
	    'sort_order' => 'ASC',
	    'sort_column' => 'menu_order'
	));
	array_unshift($pages, $index_page); //add index page to pages array
	$num_pages = count($pages);
	$jump_menu_pages = $pages;

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

	<div class="content-width column-container">
		<div class='column column-12'>
			<ol class="breadcrumb header-subtitle" vocab="http://schema.org/" typeof="BreadcrumbList">
				<li><a href="<?php echo $homeURL ?>" itemprop="url">Home</a></li>
				<li>Resources</li>
				<li><a href="<?php echo $homeURL ?>/learning-path" itemprop="url">All Learning Paths</a></li>
				<li class="current"><?php echo get_the_title(); ?></li>
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

			<article class="learning-path">
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

					if ($columns): ?>
						<section class="column-module content-width">
							<?php if ($column_module['title']!=''): ?><h2 class="section-header"><?php echo $column_module['title']; ?></h2><?php endif; ?>
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
					if ($free_module && ($free_module['title']!='' || $free_module['content']!='')): ?>
						<section class="free-module content-width">
							<?php if ($free_module['title']!=''): ?><h2 class="section-header"><?php echo $free_module['title']; ?></h2><?php endif; ?>
							<?php if ($free_module['content']!=''): ?><?php echo $free_module['content']; ?><?php endif; ?>
						</section>
				<?php endif; ?>

				<?php $faq = get_field('faq');
					if ($faq['category_id']): ?>
					<section class="section-faq content-width">
						<h2 class="section-header"><?php echo $faq['title']; ?></h2>
						<div class="accordion overview-accordion" id="faqAccordion">

						<?php 
						$id = $faq['category_id'];
						$url = get_site_url();
						$json = file_get_contents($url.'/wp-json/wp/v2/ufaq?ufaq-category='.$id);
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

	<?php if ($num_pages > 1): ?>
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
    <?php endif;
	endwhile; // end of the loop. ?>

<?php get_footer(); ?>
