@extends('web.layouts.app')
@section('title', __('اللوائح والسياسات'))
@section('content')
    <section class="main__accordion">
        <div class="main-container">
            @if($regulations->count() > 0)
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach ($regulations as $regulation)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse-{{ $loop->index }}" aria-expanded="false"
                                    aria-controls="flush-collapse-{{ $loop->index }}">
                                    {{ $regulation->category->name }} / عددها {{ $regulation->category_count }}
                                </button>
                            </h2>
                            <div id="flush-collapse-{{ $loop->index }}" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="{{ $regulation->file_path }}" download>
                                        <i class="fas fa-download me-2"></i>
                                        {{ $regulation->file_name_without_extension }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-data text-center">
                    <h3>{{ __('لا توجد لوائح أو سياسات متاحة حالياً') }}</h3>
                    <p>{{ __('سيتم تحديث اللوائح قريباً') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection