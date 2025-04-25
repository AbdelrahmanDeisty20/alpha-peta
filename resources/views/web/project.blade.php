@extends('web.layouts.app')
@section('title',__('المشاريع'))
@section('content')
    <section class="projects projects__page">
        <div class="main-container">
            <div class="projects__content">
                <div class="about__company__text__header">
                    <div class="img">
                        <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                    </div>
                    <h2>{{ __('المشاريع') }}</h2>
                </div>
                <div class="projects__slider__container">
                    @if($projects->count() > 0)
                        @foreach ($projects as $project)
                            <a href="{{ route('web.projectDetails', $project->id) }}" class="item">
                                <div class="project__card">
                                    <div class="img">
                                        <img src="{{ $project->image_path }}" alt="{{ $project->title }}">
                                    </div>
                                    <h3>{{ $project->title }}</h3>
                                    <p>{{ Str::limit($project->content, 100) }}</p>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="no-data">
                            <h3>{{ __('لا توجد مشاريع متاحة حالياً') }}</h3>
                            <p>{{ __('Nader') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection