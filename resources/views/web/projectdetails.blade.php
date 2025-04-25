@extends('web.layouts.app')
@section('title',__('تفاصيل المشروع'))

@section('content')
    <section class="about__project">
        <div class="main-container">
            <div class="about__project__content">
                <div class="img"> <img src="{{$project->image_path}}" alt=""> </div>
                <div class="about__project__text">
                    <h4> {{$project->{'title_'.app()->getLocale()} }}</h4>
                    <p> {{$project->{'content_'.app()->getLocale()} }} </p>
                </div>
            </div>
        </div>
    </section>
@endsection
