@extends('web.layouts.app')
@section('title',__('شركاء النجاح'))
@section('content')
    <section class="partners">
        <div class="main-container">
            <div class="partners__content">
                <div class="about__company__text__header">
                    <div class="img">
                        <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                    </div>
                    <h2>{{ __('شركاء النجاح') }}</h2>
                </div>
                <div class="partners__slider">
                    @if($partners->count() > 0)
                        <div class="partner__container">
                            @foreach ($partners as $partner)
                                <div class="item">
                                    <div class="img">
                                        <img src="{{ $partner->image_path }}" alt="{{ $partner->name }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="no-data">
                            <h3>{{ __('لا يوجد شركاء متاحين حالياً') }}</h3>
                            <p>{{ __('سنقوم بإضافة شركائنا قريباً') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection