<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->{'web_name_' . app()->getLocale()} }}</title>
    <link rel="stylesheet" href="{{ asset('web/css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/header.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('storage') . '/' . $setting->favicon }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('web/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/footer.css') }}">
    {{-- <link rel="stylesheet" href="css/ar.css"> --}}
    <link rel="stylesheet" href="{{ asset('web/css/responsive.css') }}">
    {{-- <link rel="stylesheet" href="css/res.css"> --}}

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- fontawesome -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Owl Carousel -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <!-- aos -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @if (app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('web/css/ar.css') }}">
    @endif
    @if (app()->getLocale() === 'en')
        <link rel="stylesheet" href="{{ asset('web/css/en.css') }}">
    @endif

    <style>
        #header {
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            position: relative;
        }

        #landing {
            height: calc(100vh - 120px);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* رسائل عدم وجود بيانات */
        .no-data {
            text-align: center;
            padding: 40px 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin: 20px 0;
        }

        .empty-icon {
            width: 120px;
            height: auto;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .no-data h3 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        .no-data p {
            color: #666;
            font-size: 16px;
        }

        /* تحسينات عامة */
        .accordion-body a {
            display: inline-flex;
            align-items: center;
            color: #3b82f6;
            text-decoration: none;
        }

        .accordion-body a:hover {
            text-decoration: underline;
        }

        .project__card p,
        .services__card p {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #landing #landing-text {
            color: white;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            gap: 30px;

        }

        .about__service__slider .owl-carousel .item__slider__service {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            gap: 20px;
            color: var(--main-color);
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.25);
            padding: 10px;
        }

        #about__service__slider .owl-carousel .item__slider__service h3 {
            font-size: 16px;
            font-weight: 500;
        }

        #about__service__slider .owl-carousel .item__slider__service h6 {
            font-size: 14px;
            font-weight: 500;
        }

        #about__service__slider .owl-carousel .item__slider__service .img {
            width: 70px;
            height: 70px;
            background-color: #bae6ff;
            border-radius: 50%;
            padding: 15px;
        }

        #about__service__slider .owl-carousel .item__slider__service .img img {
            width: 100%;
            height: 100%;
        }

        #landing-text h4 {
            line-height: 1.6;
        }

        /* للصفحة الرئيسية فقط */
        #owl-carousel {

            height: calc(100vh - 80px);
        }

        /* للصفحات الأخرى */
        #page-title-container {
            position: absolute;
            top: 35%;
            /* تباعد من الأعلى */
            right: 20px;
            /* تباعد من اليمين */
            text-align: right;
            /* محاذاة لليمين */
            color: white;
            padding: 15px 25px;
            /* background-color: rgba(0, 0, 0, 0.5); */
            /* خلفية شبه شفافة */
            border-radius: 5px;
            max-width: 50%;
        }

        .is-invalid {
            border: 1px solid red;
            background-color: #ffe6e6;
        }

        .invalid-feedback {
            color: red;
            font-size: 14px;
        }


        .breadcrumb-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: white;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
        }

        .breadcrumb-link:hover {
            text-decoration: underline;
        }

        .breadcrumb-link span {
            font-weight: bold;
        }

        .landing-text.ar {
            text-align: right;
        }

        /* اللغة الإنجليزية أو لغات أخرى */
        .landing-text.en {
            text-align: left;
        }
        .justify-content-flex-end {
    justify-content: flex-end !important;
}
    </style>
</head>

<body>
