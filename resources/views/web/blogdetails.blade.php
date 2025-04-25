@extends('web.layouts.app')
@section('title',__('تفاصيل المدونة'))

@section('content')
    <section class="about_blog_section">
        <div class="main-container">
            <div class="about_blog_content">
                <div class="img"> <img src="{{$blog->image_path}}" alt=""> </div>
                <div class="blog__text">
                    <h3>{{ $blog->title }}</h3>
                    <p> {{ $blog->content }} </p>
AEDFQEaf
                    <div class="date">
                        <div class="img_date"> <img src="{{ asset('web/images/calendar.png') }}" alt=""> </div>
                        <p>{{ $blog->date }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
