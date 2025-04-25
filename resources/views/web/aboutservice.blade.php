@extends('web.layouts.app')
@section('title', __('عن الخدمة'))
@section('content')
    <section class="about__services">
        <div class="main-container">
            <div class="about__services__text">
                <h3>{{ $service->title }}</h3>
                <p>
                    {{ $service->content }}
                </p>
                <a href="{{route('web.orde-Service',$service->id)}}" class="btn__text">
                    <p>{{ __('طلب خدمة') }}</p>
                    <div class="icon"><i class="fa-solid fa-arrow-left-long"></i></div>
                </a>
            </div>
            <div class="services__img__container">

                @foreach ($service->media as $image)
                    <div class="img"><img src="{{ $image->image_path }}" alt="" /></div>
                @endforeach
            </div>

            <div class="about__service__slider">
                <div class="about__service__slider__header">
                    <h3>{{ __('خدمات اخري') }}</h3>
                </div>
                <div class="about__service__slider__owl">
                    <div class="owl-carousel">

                        @foreach ($otherServices as $ser)
                            <div class="item">
                                <a href="{{ route('web.aboutService',$ser->id) }}" class="item__slider__service">
                                    <div class="img">
                                        <img src="{{ $ser->image_path }}" alt="" />
                                    </div>
                                    <h3>{{ $ser->title }}</h3>
                                    <h6>
                                        {{ $ser->content }}
                                    </h6>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
