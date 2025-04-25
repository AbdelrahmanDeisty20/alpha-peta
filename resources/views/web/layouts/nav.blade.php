<section class="header" id="header"
    style="background-image: url({{ asset('storage/' . $setting->big_image) }}); @if (!request()->is('/')) background-attachment: fixed; @endif">

    <nav>
        <div class="main-container">
            <a href="/" class="logo-container">
                <img src="{{ asset('storage/' . $setting->logo) }}">

                {{-- @dd(app()->getLocale) --}}
            </a>
            <div class="element">
                <ul>
                    <li><a href="/">{{ __('الرئيسية') }}</a></li>
                    <li><a href="{{ route('web.about') }}">{{ __('من نحن') }}</a></li>
                    <li><a href="{{ route('web.service') }}"> {{ __('خدماتنا ') }}</a> </li>
                    <li><a href="{{ route('web.project') }}">{{ __('المشاريع') }}</a></li>
                    <li><a href="{{ route('web.blog') }}">{{ __('المدونة') }}</a></li>
                    <li><a href="{{ route('web.regulation') }}">{{ __('اللوائح والسياسات') }}</a></li>
                    <li><a href="/contracts.html">{{ __('منصة العقود') }}</a></li>
                    <li><a href="{{ route('web.contact') }}">{{ __('تواصل معنا') }}</a></li>
                </ul>
            </div>
            <div class="language">
                <div class="dropdown">
                    <a href="#" class="dropbtn">
                        {{ app()->getLocale() == 'ar' ? 'AR' : 'EN' }} <i class="fa-solid fa-angle-down"></i>
                    </a>
                    <div class="dropdown-content">
                        @if (app()->getLocale() == 'ar')
                            <a href="{{ url('/lang/en') }}">EN</a>
                        @else
                            <a href="{{ url('/lang/ar') }}">AR</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="menu-div">
                <div class="content" id="times-ican">
                    <a href="#" title="Navigation menu" class="navicon" aria-label="Navigation">
                        <span class="navicon__item"></span>
                        <span class="navicon__item"></span>
                        <span class="navicon__item"></span>
                        <span class="navicon__item"></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    @if (request()->is('/'))
        <div class="owl-carousel" id="owl-carousel">
            <div class="item">
                <div class="landing" id="landing">
                    <div class="main-container">
                        <div class="row @if (app()->getLocale() == 'en') justify-content-flex-end @endif">
                            <div class="col-lg-7 col-md-6 col-sm-12">
                                <div class="landing-text" id="landing-text"
                                    @if (app()->getLocale() == 'en') style="text-align: left; direction: ltr;" @endif>
                                    <h2 id="title">{{ __('افضل خدمات تقنية معلومات في المملكة') }}</h2>
                                    <h4 id="small">{{ __('نحن نوفر افضل انظمة حماية من الحرائق والسرقة...') }}</h4>
                                    <a href="{{ route('web.service') }}"
                                        @if (app()->getLocale() == 'en') style="display: inline-block; margin-right: auto;" @endif>
                                        {{ __('اطلب خدمة') }}
                                    </a>
                                </div>>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- محتوى الصفحات الأخرى -->

        <div class="page-title-container" id="page-title-container"
            style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
            {{ app()->getLocale() === 'ar' ? 'right: 20px; left: auto;' : 'left: 20px; right: auto;' }}">
            <h2>@yield('title')</h2>
            <a href="{{ route('web.home') }}" class="breadcrumb-link">
                {{ app()->getLocale() === 'ar' ? 'الرئيسية /' : 'Home /' }}

            </a>
            <span>@yield('title')</span>
        </div>
    @endif
</section>
