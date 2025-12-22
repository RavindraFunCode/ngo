<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Humanity || Responsive HTML 5 Template')</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <link href="{{ asset('website/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('website/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('website/images/favicons/apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180">
    <link href="{{ asset('website/images/favicons/favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png">
    <link href="{{ asset('website/images/favicons/favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png">
    @stack('styles')
</head>

<body>
    <div class="boxed_wrapper">
        <div class="top-bar">
            <div class="container">
                <div class="clearfix">
                    <div class="top-bar-text float_left">
                        <button class="thm-btn donate-box-btn">donate</button>
                        <p>No One Has Ever Become Poor By Giving!</p>
                    </div>
                    <div class="right-column float_right">
                        <ul class="list_inline contact-info">
                            <li><span class="icon-phone"></span>Phone: {{ $settings['contact_phone'] ?? '+32 456 789012' }}</li>
                            <li><span class="icon-back"></span>Email: {{ $settings['contact_email'] ?? 'Mailus@Humanity.com' }}</li>
                        </ul>
                        <div class="" id="polyglotLanguageSwitcher">
                            <form action="#">
                                <select id="polyglot-language-options">
                                    <option id="en" selected value="en">English</option>
                                    <option id="fr" value="fr">French</option>
                                    <option id="de" value="de">German</option>
                                    <option id="it" value="it">Italian</option>
                                    <option id="es" value="es">Spanish</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="theme_menu stricky">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="main-logo">
                            <a href="{{ route('home') }}"><img alt="" src="{{ asset('website/images/logo/logo.png') }}"></a>
                        </div>
                    </div>
                    <div class="col-md-9 menu-column">
                        <nav class="defaultmainmenu" id="main_menu">
                            <ul class="defaultmainmenu-menu">
                                @if(isset($mainMenu) && count($mainMenu) > 0)
                                    @foreach($mainMenu as $item)
                                        @php
                                            $translation = $item->translations->where('language_id', $currentLanguageId)->first();
                                            $title = $translation ? $translation->label : 'No Title';
                                            
                                            $url = '#';
                                            if ($item->type === 'route') {
                                                $url = route($item->route_name);
                                            } elseif ($item->type === 'external_url') {
                                                $url = $item->url;
                                            }
                                            
                                            $isActive = request()->fullUrlIs($url) || ($url !== route('home') && request()->is(trim(parse_url($url, PHP_URL_PATH), '/') . '*'));
                                            $hasChildren = $item->children->count() > 0;
                                        @endphp
                                        <li class="{{ $isActive ? 'active' : '' }}">
                                            <a href="{{ $url }}" target="{{ $item->target ?? '_self' }}">{{ $title }}</a>
                                            @if($hasChildren)
                                                <ul class="dropdown">
                                                    @foreach($item->children as $child)
                                                        @php
                                                            $childTranslation = $child->translations->where('language_id', $currentLanguageId)->first();
                                                            $childTitle = $childTranslation ? $childTranslation->label : 'No Title';
                                                            
                                                            $childUrl = '#';
                                                            if ($child->type === 'route') {
                                                                $childUrl = route($child->route_name);
                                                            } else {
                                                                $childUrl = $child->url;
                                                            }
                                                        @endphp
                                                        <li><a href="{{ $childUrl }}" target="{{ $child->target ?? '_self' }}">{{ $childTitle }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @else
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <div class="right-column">
                        <div class="nav_side_content">
                            <ul class="social-icon">
                                @if(isset($settings['social_facebook']))
                                    <li><a href="{{ $settings['social_facebook'] }}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if(isset($settings['social_twitter']))
                                    <li><a href="{{ $settings['social_twitter'] }}"><i class="fa fa-twitter"></i></a></li>
                                @endif
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                            <div class="search_option">
                                <button aria-expanded="false" aria-haspopup="true" class="search tran3s dropdown-toggle color1_bg" data-toggle="dropdown" id="searchDropdown"><i aria-hidden="true" class="fa fa-search"></i></button>
                                <form action="#" aria-labelledby="searchDropdown" class="dropdown-menu">
                                    <input placeholder="Search..." type="text"> <button><i aria-hidden="true" class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @yield('content')

        <footer class="main-footer">
            <div class="widgets-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="footer-widget about-widget">
                                <div class="footer-logo"><a href="{{ route('home') }}"><img src="{{ asset('website/images/logo/logo.png') }}" alt=""></a></div>
                                <div class="widget-content">
                                    <div class="text">
                                        <p>{{ $settings['site_tagline'] ?? 'Lorem ipsum dolor sit amet...' }}</p>
                                    </div>
                                    <div class="link">
                                        <a href="#" class="default_link">Read More <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="footer-widget links-widget">
                                <div class="section-title">
                                    <h4>Usefull Links</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="list">
                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('campaigns.index') }}">Causes</a></li>
                                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                        <li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
                                        <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="footer-widget contact-widget">
                                <div class="section-title">
                                    <h4>Contact Us</h4>
                                </div>
                                <div class="widget-content">
                                    <ul class="contact-info">
                                        <li><span class="icon-phone"></span> Phone: {{ $settings['contact_phone'] ?? '+32 456 789012' }}</li>
                                        <li><span class="icon-back"></span> Email: {{ $settings['contact_email'] ?? 'Mailus@Humanity.com' }}</li>
                                        <li><span class="icon-map-pin"></span> Address: {{ $settings['contact_address'] ?? '123, New York, USA' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="copyright-text text-center">
                        <p>&copy; Copyright 2025 Humanity. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    @include('website.partials.donate-popup')

    <div class="scroll-to-top scroll-to-target" data-target=".top-bar"><span class="icon-up-arrow"></span></div>

    <script src="{{ asset('website/js/jquery.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.fancybox.pack.js') }}"></script>
    <script src="{{ asset('website/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('website/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('website/js/wow.js') }}"></script>
    <script src="{{ asset('website/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('website/js/menu.js') }}"></script>
    <script src="{{ asset('website/js/jquery.polyglot.language.switcher.js') }}"></script>
    <script src="{{ asset('website/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('website/js/isotope.js') }}"></script>
    <script src="{{ asset('website/js/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('website/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('website/js/validation.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap-select.min.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('website/js/custom.js') }}"></script>
</body>

</html>
