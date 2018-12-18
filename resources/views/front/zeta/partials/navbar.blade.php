	<!-- Header -->

	<header class="header d-flex flex-row justify-content-end align-items-center">

		<!-- Logo -->
		<div class="logo_container mr-auto">
			<div class="logo">
				<a href="{{ route('welcome') }}"><span>{{ GetSetting::getConfig('site-name')[0] }}</span>{{ GetSetting::getConfig('site-name') }}<span>.</span></a>
			</div>
		</div>

		<!-- Main Navigation -->
		<nav class="main_nav justify-self-end">
			<ul class="nav_items">
				<li class="{{ \App\Helpers\Common\Links::ifActive('welcome') }}"><a href="{{ route('welcome') }}"><span>Home</span></a></li>
				@if( Auth::guest())

					<li class="{{ \App\Helpers\Common\Links::ifActive('register') }}"><a href="{{ route('register') }}"><span>Register</span></a></li>
				@else

					<li class="{{ \App\Helpers\Common\Links::ifActive('login') }}"><a href="{{ route('login') }}"><span>Log in</span></a></li>

				@endif
			</ul>
		</nav>

		<!-- Hamburger -->
		<div class="hamburger_container">
			<span class="hamburger_text">Menu</span>
			<span class="hamburger_icon"></span>
		</div>

	</header>

	<!-- Menu -->

	<div class="fs_menu_overlay"></div>
	<div class="fs_menu_container">
		<div class="fs_menu_shapes"><img src="{!! asset('zeta/images/menu_shapes.png') !!}" alt=""></div>
		<nav class="fs_menu_nav">
			<ul class="fs_menu_list">
				<li class="{{ \App\Helpers\Common\Links::ifActive('welcome') }}"><a href="{{ route('welcome') }}"><span><span>H</span>Home</span></a></li>

			</ul>
		</nav>
		<div class="fs_social_container d-flex flex-row justify-content-end align-items-center">
			<ul class="fs_social">
				<li><a href="{{ GetSetting::getConfig('facebook') }}"><i class="fab fa-facebook-f trans_300"></i></a></li>
				<li><a href="{{ GetSetting::getConfig('twitter') }}"><i class="fab fa-twitter trans_300"></i></a></li>

				<li><a href="{{ GetSetting::getConfig('youtube') }}"><i class="fab fa-youtube trans_300"></i></a></li>
				

				<li><a href="{{ GetSetting::getConfig('printrest') }}"><i class="fab fa-pinterest trans_300"></i></a></li>

				<li><a href="{{ GetSetting::getConfig('linkedin') }}"><i class="fab fa-linkedin-in trans_300"></i></a></li>
			</ul>
		</div>
	</div>