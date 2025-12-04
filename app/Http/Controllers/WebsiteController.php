<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Campaign;
use App\Models\BlogPost;
use App\Models\Menu;

class WebsiteController extends Controller
{
    public function index()
    {
        $urgentCause = Campaign::where('status', 'active')->latest()->first();
        $latestPosts = BlogPost::where('status', 'published')->latest()->take(3)->get();
        
        $sliders = \App\Models\Slider::where('is_active', true)->orderBy('order')->get();
        $features = \App\Models\Feature::where('is_active', true)->orderBy('order')->get();
        $team = \App\Models\TeamMember::where('is_active', true)->orderBy('order')->take(4)->get(); // Limit to 4 for homepage
        $testimonials = \App\Models\Testimonial::where('is_active', true)->latest()->get();
        $partners = \App\Models\Partner::orderBy('order')->get();
        $gallery = \App\Models\GalleryItem::where('is_active', true)->latest()->take(6)->get(); // Limit to 6 for homepage

        return view('website.home.index', compact('urgentCause', 'latestPosts', 'sliders', 'features', 'team', 'testimonials', 'partners', 'gallery'));
    }

    public function about()
    {
        return view('website.pages.about');
    }

    public function campaigns()
    {
        $campaigns = Campaign::where('status', 'active')->latest()->paginate(9);
        return view('website.campaigns.index', compact('campaigns'));
    }

    public function campaignShow($slug)
    {
        $campaign = Campaign::where('slug', $slug)->where('status', 'active')->firstOrFail();
        return view('website.campaigns.show', compact('campaign'));
    }

    public function blog()
    {
        $posts = BlogPost::where('status', 'published')->latest()->paginate(9);
        return view('website.blog.index', compact('posts'));
    }

    public function blogShow($slug)
    {
        $post = BlogPost::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('website.blog.show', compact('post'));
    }

    public function contact()
    {
        return view('website.pages.contact');
    }

    public function volunteer()
    {
        return view('website.pages.volunteer');
    }

    public function team()
    {
        return view('website.pages.team');
    }

    public function faq()
    {
        return view('website.pages.faq');
    }

    public function testimonials()
    {
        return view('website.pages.testimonials');
    }

    public function gallery()
    {
        return view('website.pages.gallery');
    }

    public function partner()
    {
        return view('website.pages.partner');
    }

    public function career()
    {
        return view('website.pages.career');
    }

    public function privacy()
    {
        return view('website.pages.privacy');
    }

    public function terms()
    {
        return view('website.pages.terms');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('website.pages.show', compact('page'));
    }
}
