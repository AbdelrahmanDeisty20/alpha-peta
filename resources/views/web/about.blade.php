@extends('web.layouts.app')

@section('title', __('من نحن'))

@section('content')
    <section class="about__company presedent__word">
        <div class="main-container">
            <div class="about__company__content">
                <div class="about__company__text">
                    <div class="about__company__text__header">
                        <div class="img">
                            <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                        </div>
                        <h2> {{ __('كلمة رئيس مجلس الادارة ') }}</h2>
                    </div>
                    <p> {{ $setting->{'about_desc_one_' . app()->getLocale()} }} </p>
                </div>
                <div class="about__company_img">
                    <img src="{{ asset('storage/' . $setting->about_image_one) }}" alt="img-about" />
                </div>
            </div>
        </div>
    </section>

    <!-- About Company Section -->
    <section class="about__company">
        <div class="main-container">
            <div class="about__company__content">
                <div class="about__company__text">
                    <div class="about__company__text__header">
                        <div class="img">
                            <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                        </div>
                        <h2>{{ __('نبذة عن الشركة') }}</h2>
                    </div>
                    <p>
                        {{ $setting->{'about_desc_two_' . app()->getlocaLe()} }}
                    </p>
                </div>
                <div class="about__company_img">
                    <img src="{{ asset('storage/' . $setting->about_image_two) }}" alt="img-about" />
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="team__work">
        <div class="main-container">
            <div class="about__company__text__header">
                <div class="img">
                    <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                </div>
                <h2> {{ __('team work') }}</h2>
            </div>
            <div class="team__work__content">
                @foreach ($customers as $customer)
                    <div class="team__card">
                        <div class="img"> <img src="{{$customer->image_path}}" alt=""> </div>
                        <div class="text">
                            <h3> {{$customer->name}}</h3>
                            <p> {{$customer->description}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="our__vession">
        <div class="main-container">
            <div class="our__vesion__header">
                <div class="our__vesion__title">
                    <div class="img"> <img src="{{asset('web/images/ourvesion-1.png')}}" alt=""> </div>
                    <h3> {{__('رؤيتنا')}} </h3>
                </div>
                <p> {{$setting->{'vision_'.app()->getLocale()} }} </p>
            </div>
            <div class="our__vesion__message">
                <div class="message_section">
                    <div class="our__vesion__title">
                        <div class="img"> <img src="{{asset('web/images/ourvesion-2.png')}}" alt=""> </div>
                        <h3> {{__('رسالتنا')}} </h3>
                    </div>{{($setting->{'message_'.app()->getLocale()} )}} </p>
                </div>
                <div class="message__img">
                    <img src="{{asset('web/images/messageimg.png')}}" alt="">
                </div>
            </div>
            <div class="our__vesion__values">
                <div class="image__value"> <img src="{{asset('web/images/valueimage.png')}}" alt=""> </div>
                <div class="our__value__section">
                    <div class="our__vesion__title">
                        <div class="img"> <img src="{{asset('web/images/ourvesion-3.png')}}" alt=""> </div>
                        <h3> {{__('قيمنا')}} </h3>
                    </div>
                    <ul>
                        <li> {{__('تطبيـــق وتنفيـــذ وتوعيـــة الأفـــراد والــشـركات والهيئـــات ')}}</li>
                        <li> {{__('تطبيـــق وتنفيـــذ وتوعيـــة الأفـــراد والــشـركات والهيئـــات ')}}</li>
                        <li> {{__('تطبيـــق وتنفيـــذ وتوعيـــة الأفـــراد والــشـركات والهيئـــات ')}}</li>
                        <li> {{__('تطبيـــق وتنفيـــذ وتوعيـــة الأفـــراد والــشـركات والهيئـــات ')}}</li>
                        <li> {{__('تطبيـــق وتنفيـــذ وتوعيـــة الأفـــراد والــشـركات والهيئـــات ')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
