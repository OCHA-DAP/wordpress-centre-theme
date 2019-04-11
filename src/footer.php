<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package uncode
 */


/**
/* BUILD SIGNUP
*/
if (is_front_page()) { ?>
	<section class="contact-module bg-pattern-green">
		<h2>Stay in touch</h2>
		<p class="large">Sign up to our mailing list to get the latest updates on the Centre or <a href="https://centre.humdata.org/wp-content/uploads/2019/04/Centre_handout_April2019.pdf" target="_blank">download</a> our brochure to learn more</p>

			<!-- Begin MailChimp Signup Form -->
			<div id="mc_embed_signup">
				<form action="//humdata.us14.list-manage.com/subscribe/post?u=ea3f905d50ea939780139789d&amp;id=99796325d1" method="post" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				    <div id="mc_embed_signup_scroll">
						<div class="mc-field-group">
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Your email address"><input type="submit" value="submit" name="subscribe" id="mc-embedded-subscribe" class="btn submit-btn">
						</div>
						
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
					    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ea3f905d50ea939780139789d_99796325d1" tabindex="-1" value=""></div>
				    </div>
				</form>
			</div>
			<!--End mc_embed_signup-->
	</section>
<?php } 


/**
/* BUILD FOOTER LINKS
*/
$secondary_list = uncode_get_menu_list('secondary');

$menu_items = wp_get_nav_menu_items('footer-list-menu');
$menu_list .= '<ul id="menu-primary">';
foreach( $menu_items as $menu_item ) {
	$menu_list .= '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
}
$menu_list .= '</ul>';
?>

				<footer id='colophon' class='site-footer'>
					<div class='row-container style-dark-bg footer-last'>
						<div class='row row-parent style-dark no-top-padding no-h-padding no-bottom-padding'>
							<div class='site-info uncell col-lg-3'>
								<?php echo $menu_list ?>	
							</div>
							<div class='site-info uncell col-lg-5'>
								<?php echo $secondary_list ?>
							</div>
							<div class='site-info uncell col-lg-4'>
								<h2>Stay in touch</h2>
								<p>Sign up to our mailing list for latest updates on the Centre</p><div id="mc_embed_signup">
								<form action="//humdata.us14.list-manage.com/subscribe/post?u=ea3f905d50ea939780139789d&amp;id=99796325d1" method="post" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								    <div id="mc_embed_signup_scroll">
										<div class="mc-field-group">
											<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Your email address"><input type="submit" value="submit" name="subscribe" id="mc-embedded-subscribe" class="btn submit-btn">
										</div>
										
										<div id="mce-responses" class="clear">
											<div class="response" id="mce-error-response" style="display:none"></div>
											<div class="response" id="mce-success-response" style="display:none"></div>
										</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
									    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ea3f905d50ea939780139789d_99796325d1" tabindex="-1" value=""></div>
								    </div>
								</form>
								<p>or <a href="https://centre.humdata.org/wp-content/uploads/2019/04/Centre_handout_April2019.pdf" target="_blank">download</a> our brochure to learn more</p>
							</div>
						</div>
					</div>
				</footer>

			</div><!-- main container -->
		</div><!-- main wrapper -->
	</div><!-- box container -->
</div><!-- box wrapper -->


<?php
/**
/* INCLUDE OVERLAYS
*/
?>
<div class="slideshow-modal-overlay" id="slideshowModal">
	<span class="close">&times;</span>
	<div class="slideshow-modal">
		<a class="slideshow-btn prev" data-dir="prev">&#10094;</a>
		<a class="slideshow-btn next" data-dir="next">&#10095;</a>
		<div class="slides">
		</div>
	</div>
</div>

<div class="overlay overlay-<?php echo $search_animation; ?> style-dark style-dark-bg overlay-search" data-area="search" data-container="box-container">
	<div class="mmb-container"><div class="menu-close-search mobile-menu-button menu-button-offcanvas mobile-menu-button-dark lines-button x2 overlay-close close" data-area="search" data-container="box-container"><span class="lines"></span></div></div>
	<div class="search-container"><?php get_search_form( true ); ?></div>
</div>

<?php wp_footer(); ?>

</body>
</html>