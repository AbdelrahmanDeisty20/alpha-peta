@extends('web.layouts.app')
@section('title',__('المدونة'))
@section('content')
    <section class="blogs">
        <div class="main-container">
            <div class="about__company__text__header">
                <div class="img">
                    <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                </div>
                <h2>{{ __('المدونة') }}</h2>
            </div>

            <div class="blogs__content">
                @if($blogs->count() > 0)
                    @foreach ($blogs as $blog)
                        <a href="{{ route('web.blogDetails', $blog->id) }}" class="blog__card">
                            <div class="img">
                                <img src="{{ $blog->image_path }}" alt="{{ $blog->title }}">
                            </div>
                            <div class="blog__tex">
                                <h3>{{ $blog->title }}</h3>
                                <p>{{ Str::limit($blog->content, 150) }}</p>
                                <div class="blog__text__date">
                                    <div class="icon">
                                        <img src="{{ asset('web/images/calendar.png') }}" alt="تاريخ النشر">
                                    </div>
                                    <div class="date__text">{{ $blog->date }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="no-blogs-message">
                        <div class="empty-state">
                            <h3>{{ __('لا توجد مقالات متاحة حالياً') }}</h3>
                            <p>{{ __('سنقوم بنشر مقالات جديدة قريباً') }}</p>
                            <a href="{{ route('web.home') }}" class="back-home-btn">
                                {{ __('العودة للصفحة الرئيسية') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection