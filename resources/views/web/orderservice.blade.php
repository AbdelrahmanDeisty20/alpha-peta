@extends('web.layouts.app')
@section('title', __('طلب الخدمة'))
@section('content')
    <section class="form__order">
        <div class="main-container">
            <form method="post" action="{{ route('web.serviceOrdr') }}" id="contactForm">
                @csrf
                <h3> {{ __('نموذج طلب الخدمة ') }}</h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
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
                        <input type="text" placeholder="{{ __('الايميل') }}" name="email"
                            class=" @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        <span class="text-danger error-email" style="margin-top: 20px;">
                        </span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="img"> <img src="{{ asset('web/images/mail-form.png') }}" alt=""> </div>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input">
                        <input type="text" placeholder="{{ __('رقم الجوال') }}" name="phone"
                            class=" @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        <span class="text-danger error-phone" style="margin-top: 20px;">
                        </span>

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="img"> <img src="{{ asset('web/images/phone.png') }}" alt=""> </div>
                    </div>
                    <div class="input">
                        <input type="text" placeholder="{{ __('عنوان الرسالة') }}" name="subject"
                            class=" @error('subject') is-invalid @enderror" value="{{ old('subject') }}">
                        <span class="text-danger error-subject" style="margin-top: 20px;">
                        </span>

                        @error('subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="img"> <img src="{{ asset('web/images/message.png') }}" alt=""> </div>
                    </div>
                </div>
                <div class="input">
                    <input type="text" placeholder="{{ __('الاستفسارات') }}" name="message"
                        class=" @error('message') is-invalid @enderror" value="{{ old('message') }}">
                    <div class="text-danger error-message" style="margin-top: 20px;">
                    </div>
                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="img"> <img src="{{ asset('web/images/message-square-lines.png') }}" alt="">
                    </div>
                </div>
                <div class="input-container">
                    <div class="input bg-chiper" style="background-image: url('{{ asset('web/images/bg-chiper.png') }}');">
                        <input type="text" disabled value="" id="verification_code_display">
                    </div>

                    <div class="input">
                        <input type="text" placeholder="{{ __('كود التحقق') }}" name="code_vervication"
                            class=" @error('code_vervication') is-invalid @enderror" value="{{ old('code_vervication') }}">
                        <span class="text-danger error-code_vervication" style="margin-top: 20px;">
                        </span>

                        @error('code_vervication')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="img"><img src="{{ asset('web/images/verify.png') }}" alt=""></div>
                    </div>
                </div>
                <div class="refresh_btn" id="refreshBtn">
                    <div class="img"> <img src="{{ asset('web/images/refresh.png') }}" alt=""> </div>
                    <p> {{ __('كود جديد') }}</p>
                </div>

                <input type="submit" value="ارسال">
            </form>
        </div>
    </section>
@endsection
@push('js')
    <script>
        let verificationCode = '';

        function generateCode(length = 4) {
            let code = '';
            for (let i = 0; i < length; i++) {
                code += Math.floor(Math.random() * 10);
            }
            return code;
        }

        function showCode() {
            verificationCode = generateCode();
            document.getElementById('verification_code_display').value = verificationCode;
            console.log('الكود الحقيقي:', verificationCode);
        }

        document.addEventListener('DOMContentLoaded', function() {
            showCode();
        });

        document.getElementById('refreshBtn').addEventListener('click', function(e) {
            e.preventDefault();
            showCode();
        });

        $(document).ready(function() {
            $.validator.addMethod("validName", function(value, element) {
                return this.optional(element) || /^[\u0600-\u06FFa-zA-Z\s]+$/.test(value);
            }, "لا تسمح بالحروف الخاصة أو الأرقام");

            $.validator.addMethod("digitsOnly", function(value, element) {
                return this.optional(element) || /^\d+$/.test(value);
            }, "يجب أن يحتوي على أرقام فقط");

            $.validator.addMethod("equalToCode", function(value, element) {
                return this.optional(element) || value === verificationCode;
            }, "كود التحقق غير صحيح");
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
                    phone: {
                        required: true,
                        digitsOnly: true,
                        minlength: 9,
                        maxlength: 15
                    },
                    subject: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    message: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    code_vervication: {
                        required: true,
                        equalToCode: true
                    }
                },
                messages: {
                    name: {
                        required: "{{ __('الاسم مطلوب') }}",
                        minlength: "{{ __('الاسم يجب أن يحتوي على الأقل على حرفين') }}",
                        maxlength: "{{ __('الاسم يجب ألا يتجاوز 50 حرفاً') }}",
                        validName: "{{ __('يجب أن يحتوي الاسم على أحرف عربية أو إنجليزية فقط') }}"
                    },
                    email: {
                        required: "{{ __('البريد الإلكتروني مطلوب') }}",
                        email: "{{ __('من فضلك أدخل بريد إلكتروني صالح') }}"
                    },
                    phone: {
                        required: "{{ __('رقم الجوال مطلوب') }}",
                        minlength: "{{ __('رقم الجوال يجب أن يحتوي على الأقل على 9 أرقام') }}",
                        maxlength: "{{ __('رقم الجوال يجب ألا يتجاوز 15 رقماً') }}",
                        digitsOnly: "{{ __('رقم الجوال يجب أن يحتوي على أرقام فقط') }}"
                    },
                    subject: {
                        required: "{{ __('عنوان الرسالة مطلوب') }}",
                        minlength: "{{ __('العنوان يجب أن يحتوي على 3 أحرف على الأقل') }}",
                        maxlength: "{{ __('العنوان يجب ألا يتجاوز 50 حرفاً') }}"
                    },
                    message: {
                        required: "{{ __('الرسالة مطلوبة') }}",
                        minlength: "{{ __('الرسالة يجب أن تحتوي على 3 أحرف على الأقل') }}",
                        maxlength: "{{ __('الرسالة يجب ألا تتجاوز 255 حرفاً') }}"
                    },
                    code_vervication: {
                        required: "{{ __('كود التحقق مطلوب') }}",
                        equalToCode: "{{ __('كود التحقق غير صحيح') }}"
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
                                timer: 3000, 
                                timerProgressBar: true
                            });
                            form.reset();
                            showCode();
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
