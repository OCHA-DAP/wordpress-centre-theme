<div class='modal-support-form'>
	<section class="content-width">
		<div class="form-header">
			<?php
				$page = get_posts(
			    array(
		        'name'      => 'request-support',
		        'post_type' => 'page',
						'hierarchical' => 0
			    )
				);

				if ($page) {
				  $form = $page[0]->post_content;
				}
			?>
			<h2 class="section-header">OCHA Support</h2>
			<a href="#" class="close-btn"><i class="humanitarianicons-Exit-Cancel"></i></a>
		</div>
		<div class="form-container">
			<?php echo do_shortcode($form); ?>
		</div>
	</section>
</div>