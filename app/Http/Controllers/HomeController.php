<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Regulation;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = Service::take(6)->get();
        $projects = Project::take(6)->get();
        $blogs = Blog::all();
        $partners = Partner::all();
        return view('web.home', compact('services', 'projects', 'blogs', 'partners'));
    }

    public function about()
    {
        $customers = Customer::take(4)->get();
        return view('web.about', compact('customers'));
    }






    public function partner()
    {
        $partners = Partner::all();
        return view('web.partner', compact('partners'));
    }


    public function regulation()
    {
        $regulations = Regulation::with('category')
            ->withCount('category')
            ->get();
        return view('web.regulationspolicies', compact('regulations'));
    }
    public function lang($lang)
    {

        session()->put('lang', $lang);
        app()->setLocale($lang);
        return redirect()->back();
    }

}
