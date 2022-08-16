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
		<p class="large">Sign up to our mailing list to get the latest updates on the Centre or <a href="https://centre.humdata.org/brochure" target="_blank">download our brochure</a> to learn more</p>

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
							<div class='site-info uncell col-lg-4'>
								<a href="<?php echo $homeURL ?>">
									<svg class='logo' viewBox="0 0 245 77" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								    <defs>
								      <polygon id="path-1" points="122.38455 77 244.769 77 244.769 0.148 0.0001 0.148 0.0001 77 122.38455 77"></polygon>
								    </defs>
								    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
							        <g transform="translate(0.000000, -1.000000)">
						            <path d="M20.4617,30.5366 L20.4617,30.4946 C20.4617,27.2676 22.9287,24.6106 26.3877,24.6106 C28.5177,24.6106 29.8467,25.3276 30.9007,26.5086 L28.9397,28.6176 C28.2227,27.8586 27.5057,27.3736 26.3667,27.3736 C24.7637,27.3736 23.6247,28.7866 23.6247,30.4526 L23.6247,30.4946 C23.6247,32.2236 24.7427,33.6156 26.4937,33.6156 C27.5687,33.6156 28.3067,33.1516 29.0867,32.4136 L30.9637,34.3116 C29.8677,35.5136 28.6017,36.3786 26.3457,36.3786 C22.9507,36.3786 20.4617,33.7636 20.4617,30.5366" id="Fill-1"></path>
						            <path d="M40.1606,29.5875 C39.9706,28.1535 39.1276,27.1835 37.7776,27.1835 C36.4486,27.1835 35.5846,28.1325 35.3316,29.5875 L40.1606,29.5875 Z M32.1886,30.5365 L32.1886,30.4945 C32.1886,27.2675 34.4876,24.6105 37.7776,24.6105 C41.5526,24.6105 43.2816,27.5415 43.2816,30.7475 C43.2816,31.0005 43.2606,31.2955 43.2396,31.5915 L35.3736,31.5915 C35.6896,33.0465 36.7016,33.8055 38.1356,33.8055 C39.2116,33.8055 39.9916,33.4675 40.8776,32.6455 L42.7126,34.2695 C41.6576,35.5765 40.1396,36.3785 38.0936,36.3785 C34.6986,36.3785 32.1886,33.9955 32.1886,30.5365 L32.1886,30.5365 Z" id="Fill-3"></path>
						            <path d="M45.664,24.8215 L48.87,24.8215 L48.87,26.4245 C49.608,25.4755 50.557,24.6105 52.181,24.6105 C54.606,24.6105 56.019,26.2135 56.019,28.8075 L56.019,36.1255 L52.813,36.1255 L52.813,29.8195 C52.813,28.3015 52.096,27.5205 50.873,27.5205 C49.65,27.5205 48.87,28.3015 48.87,29.8195 L48.87,36.1255 L45.664,36.1255 L45.664,24.8215 Z" id="Fill-5"></path>
						            <path d="M59.3288,32.9197 L59.3288,27.5627 L57.9788,27.5627 L57.9788,24.8217 L59.3288,24.8217 L59.3288,21.9327 L62.5348,21.9327 L62.5348,24.8217 L65.1918,24.8217 L65.1918,27.5627 L62.5348,27.5627 L62.5348,32.3927 C62.5348,33.1307 62.8508,33.4887 63.5678,33.4887 C64.1578,33.4887 64.6848,33.3417 65.1498,33.0887 L65.1498,35.6607 C64.4748,36.0617 63.6938,36.3147 62.6188,36.3147 C60.6578,36.3147 59.3288,35.5347 59.3288,32.9197" id="Fill-7"></path>
						            <path d="M67.553,24.8215 L70.759,24.8215 L70.759,27.0995 C71.412,25.5385 72.467,24.5265 74.365,24.6105 L74.365,27.9635 L74.196,27.9635 C72.066,27.9635 70.759,29.2505 70.759,31.9495 L70.759,36.1255 L67.553,36.1255 L67.553,24.8215 Z" id="Fill-9"></path>
						            <path d="M83.4769,29.5875 C83.2869,28.1535 82.4439,27.1835 81.0939,27.1835 C79.7649,27.1835 78.9009,28.1325 78.6479,29.5875 L83.4769,29.5875 Z M75.5049,30.5365 L75.5049,30.4945 C75.5049,27.2675 77.8039,24.6105 81.0939,24.6105 C84.8689,24.6105 86.5979,27.5415 86.5979,30.7475 C86.5979,31.0005 86.5769,31.2955 86.5559,31.5915 L78.6899,31.5915 C79.0059,33.0465 80.0179,33.8055 81.4519,33.8055 C82.5279,33.8055 83.3079,33.4675 84.1939,32.6455 L86.0289,34.2695 C84.9739,35.5765 83.4559,36.3785 81.4099,36.3785 C78.0149,36.3785 75.5049,33.9955 75.5049,30.5365 L75.5049,30.5365 Z" id="Fill-11"></path>
						            <path d="M95.8548,27.563 L94.5258,27.563 L94.5258,24.927 L95.8548,24.927 L95.8548,24.21 C95.8548,22.966 96.1708,22.059 96.7618,21.468 C97.3518,20.878 98.2168,20.583 99.3558,20.583 C100.3678,20.583 101.0428,20.709 101.6328,20.899 L101.6328,23.556 C101.1698,23.387 100.7268,23.282 100.1778,23.282 C99.4398,23.282 99.0178,23.662 99.0178,24.505 L99.0178,24.948 L101.6118,24.948 L101.6118,27.563 L99.0608,27.563 L99.0608,36.125 L95.8548,36.125 L95.8548,27.563 Z" id="Fill-13"></path>
						            <path d="M111.6708,30.5366 L111.6708,30.4946 C111.6708,28.8286 110.4688,27.3736 108.6968,27.3736 C106.8628,27.3736 105.7658,28.7866 105.7658,30.4526 L105.7658,30.4946 C105.7658,32.1606 106.9678,33.6156 108.7398,33.6156 C110.5738,33.6156 111.6708,32.2026 111.6708,30.5366 M102.6028,30.5366 L102.6028,30.4946 C102.6028,27.2466 105.2178,24.6106 108.7398,24.6106 C112.2398,24.6106 114.8338,27.2046 114.8338,30.4526 L114.8338,30.4946 C114.8338,33.7426 112.2188,36.3786 108.6968,36.3786 C105.1968,36.3786 102.6028,33.7846 102.6028,30.5366" id="Fill-15"></path>
						            <path d="M117.153,24.8215 L120.359,24.8215 L120.359,27.0995 C121.012,25.5385 122.067,24.5265 123.965,24.6105 L123.965,27.9635 L123.796,27.9635 C121.666,27.9635 120.359,29.2505 120.359,31.9495 L120.359,36.1255 L117.153,36.1255 L117.153,24.8215 Z" id="Fill-17"></path>
						            <path d="M132.2937,20.7304 L135.4997,20.7304 L135.4997,26.4244 C136.2377,25.4754 137.1867,24.6104 138.8107,24.6104 C141.2357,24.6104 142.6487,26.2134 142.6487,28.8074 L142.6487,36.1254 L139.4427,36.1254 L139.4427,29.8194 C139.4427,28.3014 138.7257,27.5214 137.5027,27.5214 C136.2797,27.5214 135.4997,28.3014 135.4997,29.8194 L135.4997,36.1254 L132.2937,36.1254 L132.2937,20.7304 Z" id="Fill-19"></path>
						            <path d="M145.3469,32.1393 L145.3469,24.8213 L148.5529,24.8213 L148.5529,31.1273 C148.5529,32.6453 149.2699,33.4253 150.4929,33.4253 C151.7159,33.4253 152.4959,32.6453 152.4959,31.1273 L152.4959,24.8213 L155.7019,24.8213 L155.7019,36.1253 L152.4959,36.1253 L152.4959,34.5223 C151.7579,35.4713 150.8089,36.3363 149.1849,36.3363 C146.7599,36.3363 145.3469,34.7333 145.3469,32.1393" id="Fill-21"></path>
						            <path d="M158.5691,24.8215 L161.7741,24.8215 L161.7741,26.4245 C162.5121,25.4755 163.4821,24.6105 165.1061,24.6105 C166.5831,24.6105 167.7001,25.2645 168.2911,26.4035 C169.2821,25.2435 170.4631,24.6105 172.0031,24.6105 C174.3861,24.6105 175.8191,26.0445 175.8191,28.7655 L175.8191,36.1255 L172.6141,36.1255 L172.6141,29.8195 C172.6141,28.3015 171.9391,27.5205 170.7371,27.5205 C169.5351,27.5205 168.7971,28.3015 168.7971,29.8195 L168.7971,36.1255 L165.5911,36.1255 L165.5911,29.8195 C165.5911,28.3015 164.9171,27.5205 163.7151,27.5205 C162.5121,27.5205 161.7741,28.3015 161.7741,29.8195 L161.7741,36.1255 L158.5691,36.1255 L158.5691,24.8215 Z" id="Fill-23"></path>
						            <path d="M186.806,30.4945 L186.806,30.4525 C186.806,28.5755 185.562,27.3315 184.064,27.3315 C182.567,27.3315 181.302,28.5545 181.302,30.4525 L181.302,30.4945 C181.302,32.3715 182.567,33.6155 184.064,33.6155 C185.562,33.6155 186.806,32.3715 186.806,30.4945 M178.096,30.4945 L178.096,30.4525 C178.096,26.6775 180.564,24.6105 183.242,24.6105 C184.95,24.6105 186.005,25.3905 186.764,26.2975 L186.764,20.7305 L189.969,20.7305 L189.969,36.1255 L186.764,36.1255 L186.764,34.5015 C185.984,35.5555 184.908,36.3365 183.242,36.3365 C180.606,36.3365 178.096,34.2695 178.096,30.4945" id="Fill-25"></path>
						            <path d="M199.5216,32.1393 L199.5216,31.5703 C198.9736,31.3173 198.2566,31.1483 197.4756,31.1483 C196.1056,31.1483 195.2616,31.6963 195.2616,32.7093 L195.2616,32.7513 C195.2616,33.6153 195.9786,34.1213 197.0116,34.1213 C198.5096,34.1213 199.5216,33.2993 199.5216,32.1393 M192.1616,32.8773 L192.1616,32.8353 C192.1616,30.3683 194.0386,29.2293 196.7166,29.2293 C197.8556,29.2293 198.6776,29.4183 199.4796,29.6933 L199.4796,29.5033 C199.4796,28.1743 198.6566,27.4363 197.0536,27.4363 C195.8306,27.4363 194.9666,27.6683 193.9326,28.0483 L193.1316,25.6023 C194.3756,25.0533 195.5986,24.6953 197.5186,24.6953 C199.2686,24.6953 200.5336,25.1593 201.3356,25.9603 C202.1786,26.8043 202.5586,28.0483 202.5586,29.5663 L202.5586,36.1253 L199.4586,36.1253 L199.4586,34.9023 C198.6776,35.7663 197.6026,36.3363 196.0416,36.3363 C193.9116,36.3363 192.1616,35.1133 192.1616,32.8773" id="Fill-27"></path>
						            <path d="M205.7446,32.9197 L205.7446,27.5627 L204.3946,27.5627 L204.3946,24.8217 L205.7446,24.8217 L205.7446,21.9327 L208.9506,21.9327 L208.9506,24.8217 L211.6076,24.8217 L211.6076,27.5627 L208.9506,27.5627 L208.9506,32.3927 C208.9506,33.1307 209.2666,33.4887 209.9836,33.4887 C210.5746,33.4887 211.1016,33.3417 211.5656,33.0887 L211.5656,35.6607 C210.8906,36.0617 210.1106,36.3147 209.0346,36.3147 C207.0736,36.3147 205.7446,35.5347 205.7446,32.9197" id="Fill-29"></path>
						            <path d="M220.6542,32.1393 L220.6542,31.5703 C220.1062,31.3173 219.3892,31.1483 218.6082,31.1483 C217.2382,31.1483 216.3942,31.6963 216.3942,32.7093 L216.3942,32.7513 C216.3942,33.6153 217.1112,34.1213 218.1442,34.1213 C219.6422,34.1213 220.6542,33.2993 220.6542,32.1393 M213.2942,32.8773 L213.2942,32.8353 C213.2942,30.3683 215.1712,29.2293 217.8492,29.2293 C218.9882,29.2293 219.8102,29.4183 220.6122,29.6933 L220.6122,29.5033 C220.6122,28.1743 219.7892,27.4363 218.1862,27.4363 C216.9632,27.4363 216.0992,27.6683 215.0652,28.0483 L214.2642,25.6023 C215.5082,25.0533 216.7312,24.6953 218.6512,24.6953 C220.4012,24.6953 221.6662,25.1593 222.4682,25.9603 C223.3112,26.8043 223.6912,28.0483 223.6912,29.5663 L223.6912,36.1253 L220.5912,36.1253 L220.5912,34.9023 C219.8102,35.7663 218.7352,36.3363 217.1742,36.3363 C215.0442,36.3363 213.2942,35.1133 213.2942,32.8773" id="Fill-31"></path>
						            <g id="Group-35" transform="translate(0.000000, 0.852500)">
					                <mask id="mask-2" fill="white">
					                   <use xlink:href="#path-1"></use>
					                </mask>
					                <g id="Clip-34"></g>
					                <polygon id="Fill-33" mask="url(#mask-2)" points="66.1451 77 63.9641 73.989 92.3481 53.433 241.0511 53.433 241.0511 3.865 3.7181 3.865 3.7181 53.433 58.8661 53.433 58.8661 57.151 0.0001 57.151 0.0001 0.147 244.7691 0.147 244.7691 57.151 93.5541 57.151"></polygon>
						            </g>
							        </g>
								    </g>
									</svg>
								</a>
								<h5 class='logo-tagline'>Connecting people and data to improve lives</h5>
								<p class='signup-text'>Sign up to our mailing list for latest updates on the Centre or <a href="https://centre.humdata.org/brochure" target="_blank">download our brochure</a> to learn more</p>
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
									    <div style="position: absolute; left: -5000px;" aria-hidden="true">
									    	<input type="text" name="b_ea3f905d50ea939780139789d_99796325d1" tabindex="-1" value="">
									    </div>
									  </div>
									</form>
								</div>
							</div>
							<div class='site-info uncell col-lg-5'>
								<?php echo $secondary_list ?>
							</div>
						</div>
					</div>

			     <div class="row-container style-darker-bg footer-last">
						<div class="row row-parent no-top-padding no-h-padding no-bottom-padding">
							<div class="site-info uncell col-lg-4">
		            <div class="social-footer">
		              <div class="terms">
		                <a href="<?php echo get_site_url() . '/category/blog/' ?>">Blogs</a>
		                <a href="<?php echo get_site_url() . '/contact-us' ?>">Contact Us</a>
		                <div class="social-actions">
		                  <a href="http://www.twitter.com/humdata" title="Twitter"><i class="fa fa-twitter"></i></a>
		                  <a href="https://github.com/OCHA-DAP" title="GitHub"><i class="fa fa-github"></i></a>
		                </div>
		              </div>
		              <div class="service">
		                <div class="provided-by">
		                  Service provided by
		                </div>
		                <div class="service-details">
		                  <div class="ocha-service">
		                  	<figure>
		                  		<img class="ocha-logo" src="<?php echo get_stylesheet_directory_uri() . '/assets/logo-ocha-lockup-white.png' ?>">
		                  	</figure>
		                    <div class="ocha-text">
		                      OCHA coordinates the global emergency response to save lives and protect people in humanitarian
		                      crises. We advocate for effective and principled humanitarian action by all, for all.
		                    </div>
		                  </div>
		                  <div class="license-group">
		                    <div class="license">
		                      Except where otherwise noted, content on this site is
		                      licensed under a Creative Commons Attribution 4.0
		                      International license.
		                    </div>
		                    <div class="license-cc">
		                      <svg width="40" height="40" viewBox="0 0 32 32">
		                        <path d="M15.886 28.968c-7.159 0.009-12.857-5.804-12.884-12.802-0.027-7.097 5.847-13.062 12.902-12.881 6.356-0.152 12.793 4.975 12.829 12.839 0.035 7.721-6.201 12.836-12.847 12.844zM15.907 0.254c-9.353-0.056-15.873 7.837-15.907 15.828-0.036 8.503 6.961 15.927 15.827 15.918 8.53-0.009 15.954-6.753 15.885-15.803 0.111-8.79-6.935-15.89-15.805-15.943z"></path>
		                        <path d="M25.263 18.406c-0.958 1.921-3.394 2.767-5.132 2.632-4.489-0.347-5.501-3.918-4.747-6.567 0.701-2.462 3.115-3.831 6.002-3.466 1.667 0.21 2.961 0.886 3.863 2.334-0.818 0.397-1.591 0.773-2.382 1.157-0.165-0.166-0.288-0.268-0.381-0.388-0.535-0.7-1.25-0.982-2.19-0.822-0.93 0.158-1.479 0.714-1.589 1.482-0.117 0.814-0.094 1.668 0.039 2.482 0.126 0.777 0.707 1.336 1.62 1.462 0.99 0.137 1.856-0.059 2.38-0.931 0.065-0.108 0.161-0.201 0.309-0.382 0.728 0.332 1.444 0.658 2.208 1.007z"></path>
		                        <path d="M16.842 13.347c-0.871 0.415-1.613 0.768-2.391 1.138-0.156-0.15-0.304-0.262-0.412-0.4-0.545-0.698-1.269-0.964-2.203-0.797-0.888 0.159-1.44 0.687-1.541 1.432-0.115 0.841-0.101 1.718 0.030 2.557 0.122 0.784 0.725 1.323 1.637 1.444 0.956 0.126 1.8-0.056 2.326-0.887 0.081-0.128 0.193-0.241 0.346-0.43 0.737 0.339 1.452 0.667 2.206 1.014-0.357 0.81-0.978 1.311-1.659 1.759-2.518 1.661-6.749 0.909-7.962-1.851-1.013-2.305-0.422-5.145 1.656-6.505 2.136-1.398 5.664-1.088 7.33 0.691 0.212 0.226 0.376 0.49 0.636 0.834z"></path>
		                      </svg>
		                    </div>
		                  </div>
		                </div>
		              </div>
			          </div>
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