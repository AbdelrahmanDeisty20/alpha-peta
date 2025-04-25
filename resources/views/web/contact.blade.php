@extends('web.layouts.app')
@section('title', __('تواصل معنا'))
@section('content')
    <section class="contact-us">
        <div class="main-container">
            <div class="about__company__text__header">
                <div class="img">
                    <img src="{{ asset('web/images/about-us-img.png') }}" alt="logo" />
                </div>
                <h2> {{ __('تواصل معنا ') }}</h2>
            </div>

            <div class="contact-us-content">
                <div class="contact-us-info">
                    <h3>
                        <div class="icon"> <img src="{{ asset('web/images/location-1.png') }}" alt=""> </div>
                        <p> {{ $setting->address }}</p>
                    </h3>
                    <p class="description"> {{ $setting->address }}</p>
                    <div class="mail">
                        <div class="img"> <img src="{{ asset('web/images/mail.png') }}" alt=""> </div>
                        <a href="mailto:support@alphabeta.com"> {{ $setting->email }} </a>
                    </div>
                    <div class="call">
                        <div class="img"> <img src="{{ asset('web/images/call.png') }}" alt=""> </div>
                        <a href="https://wa.me/+974 512 55 777  "> {{ $setting->whatsapp }} </a>
                    </div>
                    <a class="direction-btn"> {{ __('الاتجاهات') }} </a>
                </div>
                <div class="contact-us-map">
                    <section class="map">
                        <div id="map" style="height: 100%; width: 100%;" data-address="{{ $setting->address }}">
                        </div>

                        <input type="hidden" name="lat" value="{{ $setting->location['lat'] }}">
                        <input type="hidden" name="lng" value="{{ $setting->location['lng'] }}">
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section class="contact__us__form">
        <p class="line"> {{ __('او يمكنك التواصل معانا من خلال ') }}</p>

        <form action="{{ route('web.store') }}" method="post" id="contactForm">
            @csrf
            <h3> {{ _('راسلنا') }} </h3>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="input-container">

                <div class="input">
                    <input type="text" placeholder="{{ __('الاسم') }}" name="name"
                        class=" @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    <span class="text-danger error-name" style="margin-top: 20px;">
                    </span>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="img"> <img src="{{ asset('web/images/user.png') }}" alt=""> </div>
                </div>
                <div class="input">
                    <input type="text" placeholder="البريد الإلكتروني" name="email"
                        class=" @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    <span class="text-danger error-email" style="margin-top: 20px;">
                    </span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="img"><img src="{{ asset('web/images/mail-form.png') }}" alt=""> </div>
                </div>
            </div>
            <div class="input">
                <textarea name="message" id="message" placeholder="رسالتك" class=" @error('message')is-invalid @enderror"
                    value="{{ old('message') }}"></textarea>
                <span class="text-danger error-message" style="margin-top: 20px;">
                </span>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="img"> <img src="{{ asset('web/images/message.png') }}" alt=""> </div>
            </div>
            <input type="submit" value="{{ __('ارسال') }}">
        </form>
    </section>
@endsection

@push('js')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdarVlRZOccFIGWJiJ2cFY8-Sr26ibiyY&libraries=places&callback=initAutocomplete&language={{ app()->getLocale() }}"
        async></script>

    <script src="{{ asset('web/js/map.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("validName", function(value, element) {
                return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/.test(value);
            }, "لا تسمح بالحروف الخاصة أو الأرقام");

            $("#contactForm").validate({
                rules: {
                    name: {
                        required: true,
                        validName: true,
                        minlength: 2,
                        maxlength: 50
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    }
                },
                messages: {
                    name: {
                        required: "{{ __('الاسم مطلوب') }}",
                        minlength: "{{ __('الاسم يجب أن يحتوي على الأقل على حرفين') }}",
                        maxlength: "{{ __('الاسم يجب ألا يتجاوز 50 حرفاً') }}",
                        arabicEnglishOnly: "{{ __('يجب أن يحتوي الاسم على أحرف عربية أو إنجليزية فقط') }}"
                    },
                    email: {
                        required: "{{ __('البريد الإلكتروني مطلوب') }}",
                        email: "{{ __('من فضلك أدخل بريد إلكتروني صالح') }}"
                    },
                    message: {
                        required: "{{ __('الرسالة مطلوبة') }}",
                        minlength: "{{ __('الرسالة يجب أن تحتوي على 3 أحرف على الأقل') }}",
                        maxlength: "{{ __('الرسالة يجب ألا تتجاوز 255 حرفاً') }}"
                    }
                },
                errorElement: "span",
                errorPlacement: function(error, element) {
                    var name = element.attr("name");
                    error.appendTo(".error-" + name);
                },
                submitHandler: function(form, event) {
                    console.log("Submitting form..."); // تأكد من تنفيذ هذه الدالة
                    event.preventDefault();

                    $('input[type="submit"]').prop('disabled', true);

                    // إضافة مؤشر تحميل
                    $('input[type="submit"]').after(`
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
`);

                    $.ajax({
                        url: form.action,
                        method: 'POST',
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('.alert-success').remove();
                            Swal.fire({
                                icon: 'success',
                                title: '{{ __('تم الإرسال بنجاح') }}',
                                text: response.message,
                                confirmButtonText: '{{ __('حسناً') }}',
                                timer: 3000, // يختفي بعد 3 ثواني (اختياري)
                                timerProgressBar: true // شريط تقدم (اختياري)
                            });
                            form.reset();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('.error-' + key).text(value[0]);
                                });
                            } else {
                                alert('حدث خطأ، الرجاء المحاولة لاحقاً');
                            }
                        },
                        complete: function() {
                            $('input[type="submit"]').prop('disabled', false);
                            $('.spinner-border').remove();
                        }
                    });

                    return false;
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush
