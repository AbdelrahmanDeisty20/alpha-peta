@extends('web.layouts.app')
@section('title', __('Home'))
@section('content')
    <div class="container">
        <section class="about__company">
            <div class="main-container">
                <div class="about__company__content">
                    <div class="about__company__text">
                        <a href="{{route('web.about')}}" class="about__company__text__header">
                            <div class="img">
                                {{-- <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" /> --}}
                            </div>
                            <h2>{{ __('نبذة عن الشركة') }}</h2>
                            
                        </a>
                        <p>
                            {{ $setting->{'about_desc_two_' . app()->getLocale()} }}
                        </p>
                        <div class="about__company__btn">
                            <div class="text">{{ __('معرفة المزيد') }}</div>
                            <div class="icons">
                                <i class="fa-solid fa-chevron-left"></i>
                                <i class="fa-solid fa-chevron-left"></i>
                            </div>
                        </div>
                    </div>
                    <div class="about__company_img">
                        <img src="{{ asset('storage/' . $setting->about_image_two) }}" alt="img-about" />
                    </div>
                </div>
            </div>
        </section>
        <!-- Services Section -->
        <section class="services">
            <div class="main-container">
                <div class="services_content">
                    <a href="{{route('web.service')}}" class="about__company__text__header">
                        <div class="img">
                            <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                        </div>
                        <h2>{{ __('الخدمات التي نقدمها') }}</h2>
                    </a>
                    <div class="services__slider">
                        @if($services->count() > 0)
                        <div class="owl-carousel">
                            @foreach ($services as $service)
                            <div class="item">
                                <div class="services__item">
                                    <a href="{{route('web.aboutService',$service->id)}}" class="services__card">
                                        <div class="img">
                                            <img src="{{ $service->image_path }}" alt="" />
                                        </div>
                                        <h3>{{ $service->{'title_' . app()->getLocale()} }}</h3>
                                        <p>
                                            {{ $service->{'content_' . app()->getLocale()} }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="no-data">
                            <p>{{ transWord('لا توجد خدمات متاحة حالياً') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section class="projects">
            <div class="main-container">
                <div class="projects__content">
                    <a href="{{route('web.project')}}" class="about__company__text__header">
                        <div class="img">
                            <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                        </div>
                        <h2>{{ __('المشاريع') }}</h2>
                    </a>
                    <div class="projects__slider">
                        @if($projects->count() > 0)
                        <div class="owl-carousel">
                            @foreach ($projects as $project)
                            <div class="item">
                                <a href="{{route('web.projectDetails', $project->id)}}" class="project__card">
                                    <div class="img">
                                        <img src="{{ $project->image_path }}" alt="">
                                    </div>
                                    <h3>{{ $project->{'title_' . app()->getLocale()} }}</h3>
                                    <p>{{ $project->{'content_' . app()->getLocale()} }}</p>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="no-data">
                            <p>{{ transWord('لا توجد مشاريع متاحة حالياً') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <!-- Partners Section -->
        <section class="partners">
            <div class="main-container">
                <div class="partners__content">
                    <a href="{{ route('web.partner') }}" class="about__company__text__header">
                        <div class="img">
                            <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                        </div>
                        <h2>{{ __('شركاء النجاح') }}</h2>
                    </a>
                    <div class="partners__slider">
                        @if($partners->count() > 0)
                        <div class="owl-carousel">
                            @foreach ($partners as $partner)
                            <div class="item">
                                <div class="img">
                                    <img src="{{ $partner->image_path }}" alt="">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="no-data">
                            <p>{{ transWord('لا يوجد شركاء متاحين حالياً') }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

    <!-- Blog Section -->
    <section class="blogs">
        <div class="main-container">
            <a href="{{route('web.blog')}}" class="about__company__text__header">
                <div class="img">
                    <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                </div>
                <h2>{{ __('المدونة') }}</h2>
            </a>
            <div class="blogs__content">
                @if($blogs->count() > 0)
                    @foreach ($blogs as $blog)
                    <a href="{{route('web.blogDetails',$blog->id)}}" class="blog__card">
                        <div class="img">
                            <img src="{{ $blog->image_path }}" alt="">
                        </div>
                        <div class="blog__tex">
                            <h3>{{ $blog->title }}</h3>
                            <p>{{ $blog->content }}</p>
                            <div class="blog__text__date">
                                <div class="icon">
                                    <img src="{{ asset('web/images/calendar.png') }}" alt="">
                                </div>
                                <div class="date__text">{{ $blog->date }}</div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div class="no-data">
                        <p>{{ transWord('لا توجد مقالات متاحة حالياً') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- contact us section -->
    <section class="contact-us">
        <div class="main-container">
            <a href="{{route('web.contact')}}" class="about__company__text__header">
                <div class="img">
                    <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                </div>
                <h2> {{ __('تواصل معنا') }}</h2>
            </a>

            <div class="contact-us-content">
                <div class="contact-us-info">
                    <h3>
                        <div class="icon"> <img src="{{ asset('web/images/location-1.png') }}" alt=""> </div>
                        <p> {{ $setting->address }}</p>
                    </h3>
                    <p class="description"> {{ $setting->address }}</p>
                    <div class="mail">
                        <div class="img"> <img src="./images/mail.png" alt=""> </div>
                        <a href="mailto:support@alphabeta.com"> {{ $setting->email }} </a>
                    </div>
                    <div class="call">
                        <div class="img"> <img src="./images/call.png" alt=""> </div>
                        <a href="https://wa.me/+974 512 55 777  "> {{ $setting->whatsapp }} </a>
                    </div>
                    <a class="direction-btn"> {{ __('الاتجاهات') }} </a>
                </div>
                <div class="contact-us-map">
                    <section class="map">
                        {{-- @dd( $setting->address) --}}
                        <div id="map" style="height: 100%; width: 100%;" data-address="{{ $setting->address }}">
                        </div>

                        <input type="hidden" name="lat" value="{{ $setting->location['lat'] }}">
                        <input type="hidden" name="lng" value="{{ $setting->location['lng'] }}">
                    </section>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
@push('js')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language={{ app()->getLocale() }}"
        async></script>
    <script src="{{ asset('web/js/map.js') }}"></script>
@endpush
