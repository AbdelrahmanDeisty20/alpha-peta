<footer>
    <div class="main-container">
        <div class="top-footer">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 d-flex flex-column gap-3">
                    <div class="footer-logo">
                        <img src="{{asset('storage/'.$setting->footer_logo)}}" alt="">
                    </div>
                    <p>
                        {{__('مؤسسة ألفا بيتا هي مؤسسة تقنية تعمل في مجال تقنية المعلومات وتتمثل في شبكات الاتصالات والإنترنت السلكية واللاسلكية و كاميرات المراقبة و أنظمة الحماية من السرقة والحريق ')}}
                    </p>
                    <ul class="social">
                        <li><a href="{{$setting->instagram}}"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="{{$setting->linkedin}}"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a href="{{$setting->facebook}}"><i class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="https://wa.me/+974 512 55 777  "> <i class="fa-brands fa-whatsapp"></i></a></li>
                        <li><a href="{{$setting->twitter}}"><i class="fa-brands fa-x-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-6">
                            <h4>{{__('معلومات')}}</h4>
                            <div class="footer-links">

                            <ul>
                                <li><a href="{{route('web.about')}}">{{__('من نحن')}}</a></li>
                                <li><a href="{{route('web.about')}}"> {{transWord('فريق العمل')}}</a></li>
                                <li><a href="{{route('web.blog')}}">{{__('المشاريع')}}</a></li>
                                <li><a href="{{route('web.contact')}}">{{__('اتصل بنا')}}</a></li>
                            </ul>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4>{{__('روابط مهمة')}}</h4>
                            <div class="footer-links">
                                <ul>
                                    <li><a href="{{route('web.service')}}">{{__('الخدمات')}}</a></li>
                                    <li><a href="{{route('web.blog')}}">{{__('المدونة')}}</a></li>
                                    <li><a href="{{route('web.regulation')}}">{{__('اللوائح والسياسات')}}</a></li>
                                    <li><a href="{{route('web.home')}}">{{__('منصة العقود')}}</a></li>
                                    <li><a href="{{route('web.partner')}}">{{__('شركاء النجاح')}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy__write">
        <p> {{__('جميع الحقوق محفوظة لشركة الفا بيتا @ 2024 ')}}</p>
        <a href="{{'https://jaadara.com/'}}" target="_blank" >{{ __('صنع بكل حب ')}}<span>  {{__('❤')}} </span> {{__('في معامل جدارة')}}</a>
    </div>
</footer>
@include('web.layouts.script')
</body>

</html>
