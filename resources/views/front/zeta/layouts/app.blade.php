<!DOCTYPE html>
<html lang="en">
<head>
<title>{{ GetSetting::getConfig('site-name') }} | @yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Zeta Template Project">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="{!! asset('zeta/styles/bootstrap4/bootstrap.min.css') !!}" type="text/css">

<link rel="stylesheet" href="{!! asset('zeta/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') !!}" type="text/css">
<link rel="stylesheet" href="{!! asset('zeta/plugins/OwlCarousel2-2.2.1/owl.carousel.css') !!}" type="text/css">
<link rel="stylesheet" href="{!! asset('zeta/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') !!}" type="text/css">
<link rel="stylesheet" href="{!! asset('zeta/plugins/OwlCarousel2-2.2.1/animate.css') !!}" type="text/css">
<link rel="stylesheet" href="{!! asset('zeta/styles/main_styles.css') !!}" type="text/css">
<link rel="stylesheet" href="{!! asset('zeta/styles/responsive.css') !!}" type="text/css">

@yield('styles')

</head>

<body>

<div class="super_container">
	
	@include('front.zeta.partials.navbar')

	<!-- Hero Slider -->
	
	<div class="home">
		<div class="hero_slider_container slider_prlx">
			<div class="owl-carousel owl-theme hero_slider">

				<!-- Slider Item -->
				<div class="owl-item main_slider_item">
					<div class="main_slider_item_bg" style="background-image:url({!! asset('zeta/images/main_slider_1.jpg') !!})"></div>
					<div class="main_slider_shapes"><img src="{!! asset('zeta/images/main_slider_shapes.png') !!}" alt="" style="width: 100% !important;"></div>
					<div class="container">
						<div class="row">
							<div class="col slider_content_col">
								<div class="main_slider_content">
									<h1>Do you need</h1>
									<h1> <span>free clicks</span> at your shorten link ?</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur leo est, feugiat nec elementum id, suscipit id nulla. </p>
									<div class="button discover_button">
										<a href="{{ route('register') }}" class="d-flex flex-row align-items-center justify-content-center">Sign up<img src="images/arrow_right.svg" alt=""></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slider Item -->
				<div class="owl-item main_slider_item">
					<div class="main_slider_item_bg" style="background-image:url({!! asset('zeta/images/main_slider_1.jpg') !!})"></div>
					<div class="main_slider_shapes"><img src="{!! asset('zeta/images/main_slider_shapes.png') !!}" alt="" style="width: 100% !important;"></div>
					<div class="container">
						<div class="row">
							<div class="col slider_content_col">
								<div class="main_slider_content">
									<h1>Do you need</h1>
									<h1>a <span>modern</span> website?</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur leo est, feugiat nec elementum id, suscipit id nulla. </p>
									<div class="button discover_button">
										<a href="#" class="d-flex flex-row align-items-center justify-content-center">discover<img src="images/arrow_right.svg" alt=""></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Slider Item -->
				<div class="owl-item main_slider_item">
					<div class="main_slider_item_bg" style="background-image:url({!! asset('zeta/images/main_slider_1.jpg') !!})"></div>
					<div class="main_slider_shapes"><img src="{!! asset('zeta/images/main_slider_shapes.png') !!}" alt="" style="width: 100% !important;"></div>
					<div class="container">
						<div class="row">
							<div class="col slider_content_col">
								<div class="main_slider_content">
									<h1>Do you need</h1>
									<h1>a <span>modern</span> website?</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur leo est, feugiat nec elementum id, suscipit id nulla. </p>
									<div class="button discover_button">
										<a href="#" class="d-flex flex-row align-items-center justify-content-center">discover<img src="images/arrow_right.svg" alt=""></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Slider Dots -->

			<div class="main_slider_dots">
				<div class="container">
					<div class="row">
						<div class="col">
							<ul id="main_slider_custom_dots" class="main_slider_custom_dots">
								<li class="main_slider_custom_dot active">01.</li>
								<li class="main_slider_custom_dot">02.</li>
								<li class="main_slider_custom_dot">03.</li>
							</ul>
						</div>
					</div>
				</div>		
			</div>

			<!-- Slider Dots -->

			<div class="main_slider_nav_left main_slider_nav">
				<i class="fas fa-chevron-left trans_300"></i>
			</div>

			<div class="main_slider_nav_right main_slider_nav">
				<i class="fas fa-chevron-right trans_300"></i>
			</div>

		</div>
	</div>

	<div class="home_social_container d-flex flex-row justify-content-end align-items-center">
		<ul class="home_social">
			<li><a href="#"><i class="fab fa-pinterest trans_300"></i></a></li>
			<li><a href="#"><i class="fab fa-facebook-f trans_300"></i></a></li>
			<li><a href="#"><i class="fab fa-twitter trans_300"></i></a></li>
			<li><a href="#"><i class="fab fa-dribbble trans_300"></i></a></li>
			<li><a href="#"><i class="fab fa-behance trans_300"></i></a></li>
			<li><a href="#"><i class="fab fa-linkedin-in trans_300"></i></a></li>
		</ul>
	</div>
		
	<!-- Features -->

	<div class="features">
		<div class="container">
			<div class="row align-items-end">

				<!-- Features Item -->
				<div class="col-lg-4 features_col">
					<div class="features_item d-flex flex-column align-items-center justify-content-end text-center">
						<!-- <div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
						<div class="icon_container d-flex flex-column justify-content-end">
							<img src="{!! asset('zeta/images/icon_1.svg') !!}" alt="">
						</div>
						<h3>modern design</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt venen atis ultrices.</p>
					</div>
				</div>
				
				<!-- Features Item -->
				<div class="col-lg-4 features_col">
					<div class="features_item d-flex flex-column align-items-center justify-content-center text-center">
						<!-- <div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
						<div class="icon_container d-flex flex-column justify-content-end">
							<img src="{!! asset('zeta/images/icon_2.svg') !!}" alt="">
						</div>
						<h3>easy to use</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt venen atis ultrices.</p>
					</div>
				</div>
				
				<!-- Features Item -->
				<div class="col-lg-4 features_col">
					<div class="features_item d-flex flex-column align-items-center justify-content-center text-center">
						<!-- <div>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
						<div class="icon_container d-flex flex-column justify-content-end">
							<img src="{!! asset('zeta/images/icon_3.svg') !!}" alt="">
						</div>
						<h3>well documented</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt venen atis ultrices.</p>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- About {!! asset('zeta/') !!}-->

	<div class="about prlx_parent">
		<!-- https://unsplash.com/@nativemello -->
		<div class="about_background prlx" style="background-image:url({!! asset('zeta/images/about_background.jpg') !!})"></div>
		<div class="about_shapes"><img src="{!! asset('zeta/images/about_shapes.png') !!}" alt=""></div>

		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3 text-center section_title">
					<h2>about our project<span>{{ GetSetting::getConfig('site-name')[0] }}</span></h2>
				</div>
			</div>
			<div class="row">

				<div class="col-lg-6">
					<div class="about_text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt venenatis ultrices, est libero mattis ante, ac consectetur diam neque eget quam. Etiam feugiat augue et varius blandit. Praesent mattis, eros a sodales commodo, justo ipsum rutrum mauris, sit amet egestas metus.</p>
						<img src="{!! asset('zeta/images/signiture.png') !!}" alt="">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="skills_container">
						<ul class="progress_bar_container col_12 clearfix">
							<li class="pb_item">
								<div id="skill_1_pbar" class="skill_bars" data-perc="0.85" data-name="skill_1_pbar"></div>
								<h5>management</h5>
							</li>
							<li class="pb_item">
								<div id="skill_2_pbar" class="skill_bars" data-perc="1" data-name="skill_2_pbar"></div>
								<h5>design</h5>
							</li>
							<li class="pb_item">
								<div id="skill_3_pbar" class="skill_bars" data-perc="0.75" data-name="skill_3_pbar"></div>
								<h5>projects</h5>
							</li>
							<li class="pb_item">
								<div id="skill_4_pbar" class="skill_bars" data-perc="0.95" data-name="skill_4_pbar"></div>
								<h5>inspiration</h5>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
		
	</div>

	<!-- Testimonials -->

	<div class="testimonials">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 offset-lg-3 text-center section_title section_title_dark">
					<h2>testimonials<span>{{ GetSetting::getConfig('site-name')[0] }}</span></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="testimonials_container">
						<div class="testimonials_container_inner"></div>

						<!-- Testimonials Slider -->

						<div class="owl-carousel owl-theme testimonials_slider">

							<!-- Testimonials Item -->
							<div class="owl-item testimonials_item d-flex flex-column align-items-center justify-content-center text-center">
								<div class="testimonials_content">
									<div class="test_user_pic"><img src="{!! asset('zeta/images/blog_post_comment_1.jpg') !!}" alt="https://unsplash.com/@michaeldam"></div>
									<div class="test_name">maria williams</div>
									<div class="test_title">Company CEO</div>
									<div class="test_quote">"</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, olor sit amet, consectetur adipiscing eli quam tincidunt venen atis ultrices, est libero olor sit amet, consectetur adipiscing eli mattis ante.</p>
								</div>
							</div>

							<!-- Testimonials Item -->
							<div class="owl-item testimonials_item d-flex flex-column align-items-center justify-content-center text-center">
								<div class="testimonials_content">
									<div class="test_user_pic"><img src="{!! asset('zeta/images/blog_post_comment_1.jpg') !!}" alt="https://unsplash.com/@michaeldam"></div>
									<div class="test_name">maria williams</div>
									<div class="test_title">Company CEO</div>
									<div class="test_quote">"</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, olor sit amet, consectetur adipiscing eli quam tincidunt venen atis ultrices, est libero olor sit amet, consectetur adipiscing eli mattis ante.</p>
								</div>
							</div>

							<!-- Testimonials Item -->
							<div class="owl-item testimonials_item d-flex flex-column align-items-center justify-content-center text-center">
								<div class="testimonials_content">
									<div class="test_user_pic"><img src="{!! asset('zeta/images/blog_post_comment_1.jpg') !!}" alt="https://unsplash.com/@michaeldam"></div>
									<div class="test_name">maria williams</div>
									<div class="test_title">Company CEO</div>
									<div class="test_quote">"</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, olor sit amet, consectetur adipiscing eli quam tincidunt venen atis ultrices, est libero olor sit amet, consectetur adipiscing eli mattis ante.</p>
								</div>
							</div>
						</div>

					</div>
				</div>

				<!-- Testimonials Slider Navigation -->

				<div class="test_slider_nav test_slider_nav_left d-flex flex-column justify-content-center align-items-center trans_200">
					<i class="fas fa-chevron-left trans_200"></i>
				</div>

				<div class="test_slider_nav test_slider_nav_right d-flex flex-column justify-content-center align-items-center trans_200">
					<i class="fas fa-chevron-right trans_200"></i>
				</div>

			</div>
		</div>
	</div>

	<!-- Services -->

	<div class="services prlx_parent">
		<!-- artist: https://unsplash.com/@nativemello -->
		<div class="services_background prlx" style="background-image:url({!! asset('zeta/images/services_background.jpg') !!})"></div>
		<div class="services_shapes"><img src="{!! asset('zeta/images/services_shapes.png') !!}" alt=""></div>

		<div class="container">
			<div class="row">

				<div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
					<div class="icon_container d-flex flex-column justify-content-end">
						<img src="images/icon_1.svg" alt="">
					</div>
					<h3>modern design</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum.</p>
				</div>

				<div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
					<div class="icon_container d-flex flex-column justify-content-end">
						<img src="images/icon_2.svg" alt="">
					</div>
					<h3>easy to use</h3>
					<p>Dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt.</p>
				</div>

				<div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
					<div class="icon_container d-flex flex-column justify-content-end">
						<img src="images/icon_3.svg" alt="">
					</div>
					<h3>well documented</h3>
					<p>Adipiscing elit. Phasellus vestibulum, quam tincidunt venen atis ultrices.</p>
				</div>

				<div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
					<div class="icon_container d-flex flex-column justify-content-end">
						<img src="images/icon_4.svg" alt="">
					</div>
					<h3>smart structure</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum.</p>
				</div>

				<div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
					<div class="icon_container d-flex flex-column justify-content-end">
						<img src="images/icon_5.svg" alt="">
					</div>
					<h3>elements</h3>
					<p>Dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt.</p>
				</div>

				<div class="col-lg-4 service_item text-left d-flex flex-column align-items-start justify-content-start">
					<div class="icon_container d-flex flex-column justify-content-end">
						<img src="images/icon_6.svg" alt="">
					</div>
					<h3>bold colors</h3>
					<p>Adipiscing elit. Phasellus vestibulum, quam tincidunt venen atis ultrices.</p>
				</div>

			</div>

			<div class="row">
				<div class="col text-center">
					<div class="button services_button">
						<a href="services.html" class="d-flex flex-row align-items-center justify-content-center">
							discover<img src="{!! asset('zeta/images/arrow_right.svg') !!}" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Clients -->

	<div class="clients">
		<div class="container">

			<div class="row">
				<div class="col-lg-6 offset-lg-3 text-center section_title section_title_dark">
					<h2>our clients<span>{{ GetSetting::getConfig('site-name')[0] }}</span></h2>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, olor sit amet, consectetur adipiscing eli quam tincidunt venen atis ultrices, est libero olor sit amet, consectetur adipiscing eli mattis ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt venenatis ultrices, est libero mattis quam tincidun ante, ac consectetur diam neque eget quam. </p>
				</div>
				<div class="col-lg-6">
					<p>Amet, consectetur adipiscing elit. Phasellus vestibulum, olor sit amet, consectetur adipiscing eli quam tincidunt venen atis ultrices, quam tincidunest libero olor sit amet, consectetur adipiscing eli mattis ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt venenatis ultrices, est libero mattis quam tincidun ante, ac cquam tincidunonsectetur diam neque eget quam.</p>
				</div>
			</div>

			<div class="row">
				<div class="col">
					
					<!-- Clients Slider -->

					<div class="clients_slider_container">
						<div class="owl-carousel owl-theme clients_slider">

							<!-- Slider Item -->
							<div class="owl-item clients_item">
								<img src="{!! asset('zeta/images/client_1.png') !!}" alt="">
							</div>

							<!-- Slider Item -->
							<div class="owl-item clients_item">
								<img src="{!! asset('zeta/images/client_2.png') !!}" alt="">
							</div>

							<!-- Slider Item -->
							<div class="owl-item clients_item">
								<img src="{!! asset('zeta/images/client_3.png') !!}" alt="">
							</div>

							<!-- Slider Item -->
							<div class="owl-item clients_item">
								<img src="{!! asset('zeta/images/client_4.png') !!}" alt="">
							</div>

							<!-- Slider Item -->
							<div class="owl-item clients_item">
								<img src="{!! asset('zeta/images/client_5.png') !!}" alt="">
							</div>

						</div>
					</div>

				</div>
			</div>

		</div>
	</div>

	<!-- Contact -->

	<div class="contact prlx_parent">
		<!-- <div class="contact_background parallax-window" data-parallax="scroll" data-speed="0.7" data-image-src="images/contact_background.jpg"></div> -->
		<div class="contact_background prlx" style="background-image: url({!! asset('zeta/images/contact_background.jpg') !!});"></div>
		<div class="contact_shapes"><img src="{!! asset('zeta/images/contact_shape.png') !!}" alt=""></div>
		<div class="container">
			
			<div class="row">
				<div class="col-lg-6 offset-lg-3 text-center section_title contact_title">
					<h2>let's work together<span>{{ GetSetting::getConfig('site-name')[0] }}</span></h2>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center contact_text">
					<p>Dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt venen atis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vestibulum, quam tincidunt venenatis ultrices, est libero mattis ante, ac consectetur diam neque eget quam.</p>
					<div class="button contact_button">
						<a href="contact.html" class="d-flex flex-row align-items-center justify-content-center">contact<img src="{!! asset('zeta/images/arrow_right.svg') !!}" alt=""></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	@include('front.zeta.partials.footer')

</div>

<script src="{!! asset('zeta/js/jquery-3.2.1.min.js') !!}"></script>
<script src="{!! asset('zeta/styles/bootstrap4/popper.js') !!}"></script>
<script src="{!! asset('zeta/styles/bootstrap4/bootstrap.min.js') !!}"></script>
<script src="{!! asset('zeta/plugins/greensock/TweenMax.min.js') !!}"></script>
<script src="{!! asset('zeta/plugins/greensock/TimelineMax.min.js') !!}"></script>
<script src="{!! asset('zeta/plugins/scrollmagic/ScrollMagic.min.js') !!}"></script>
<script src="{!! asset('zeta/plugins/greensock/animation.gsap.min.js') !!}"></script>
<script src="{!! asset('zeta/plugins/greensock/ScrollToPlugin.min.js') !!}"></script>
<script src="{!! asset('zeta/plugins/progressbar/progressbar.min.js') !!}"></script>
<script src="{!! asset('zeta/plugins/OwlCarousel2-2.2.1/owl.carousel.js') !!}"></script>
<script src="{!! asset('zeta/plugins/easing/easing.js') !!}"></script>
<script src="{!! asset('zeta/js/custom.js') !!}"></script>


@yield('scripts')
</body>

</html>