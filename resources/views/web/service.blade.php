@extends('web.layouts.app')
@section('title',__('الخدمات'))
@section('content')
    <section class="services">
        <div class="main-container">
            <div class="services_content">
                <div class="about__company__text__header">
                    <div class="img">
                        <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                    </div>
                    <h2>{{ __('الخدمات التي نقدمها') }}</h2>
                </div>
                <div class="services__slider">
                    @if($services->count() > 0)
                        <div class="owl-carousel">
                            @foreach ($services as $service)
                                <div class="item">
                                    <div class="services__item">
                                        <a href="{{ route('web.aboutService', $service->id) }}" class="services__card">
                                            <div class="img">
                                                <img src="{{ $service->image_path }}" alt="{{ $service->title }}">
                                            </div>
                                            <h3>{{ $service->{'title_' . app()->getLocale()} }}</h3>
                                            <p>
                                                {{ Str::limit($service->{'content_' . app()->getLocale()}, 120) }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-data">
                            <h3>{{ __('لا توجد خدمات متاحة حالياً') }}</h3>
                            <p>{{ __('سيتم إضافة خدماتنا قريباً') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection