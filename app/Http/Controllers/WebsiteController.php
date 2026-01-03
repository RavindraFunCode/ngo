<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqCategory;
use App\Models\Page;
use App\Models\Campaign;
use App\Models\BlogPost;
use App\Models\Menu;
use App\Models\Event;

class WebsiteController extends Controller
{
    public function events(Request $request)
    {
        $query = Event::where('status', 'published')->where('is_active', true);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('translations', function($t) use ($search) {
                    $t->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                })
                ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $events = $query->latest('start_date')->paginate(6);
        $upcomingEvents = Event::where('status', 'published')->where('is_active', true)->where('start_date', '>', now())->orderBy('start_date')->take(3)->get();

        return view('website.events.index', compact('events', 'upcomingEvents'));
    }

    public function eventShow($slug)
    {
        $event = Event::where('slug', $slug)->where('status', 'published')->where('is_active', true)->firstOrFail();
        $recentEvents = Event::where('status', 'published')->where('is_active', true)->where('id', '!=', $event->id)->latest('start_date')->take(3)->get();
        return view('website.events.show', compact('event', 'recentEvents'));
    }

    public function index()
    {
        $urgentCause = Campaign::where('status', 'active')->latest()->first();
        $latestPosts = BlogPost::where('status', 'published')->latest()->take(3)->get();
        
        $sliders = \App\Models\Slider::where('is_active', true)->orderBy('order')->get();
        $features = \App\Models\Feature::where('type', 'welcome')->where('is_active', true)->orderBy('order')->get();
        $aboutFeatures = \App\Models\Feature::where('type', 'about_us')->where('is_active', true)->orderBy('order')->get();
        $counters = \App\Models\Feature::where('type', 'counter')->where('is_active', true)->orderBy('order')->get();
        $team = \App\Models\TeamMember::where('is_active', true)->orderBy('order')->take(4)->get(); // Limit to 4 for homepage
        $testimonials = \App\Models\Testimonial::where('is_active', true)->latest()->get();
        $partners = \App\Models\Partner::orderBy('order')->get();
        $gallery = \App\Models\GalleryItem::where('is_active', true)->latest()->take(6)->get(); // Limit to 6 for homepage

        return view('website.home.index', compact('urgentCause', 'latestPosts', 'sliders', 'features', 'aboutFeatures', 'counters', 'team', 'testimonials', 'partners', 'gallery'));
    }

    public function about()
    {
        $settings = \App\Models\Setting::where('group', 'about_page')->pluck('value', 'key');
        
        $introFeatures = \App\Models\Feature::where('type', 'about_intro')->orderBy('order')->get();
        $whyChooseFeatures = \App\Models\Feature::where('type', 'why_choose_us')->orderBy('order')->get();
        $counters = \App\Models\Feature::where('type', 'about_counter')->orderBy('order')->get();

        return view('website.pages.about', compact('settings', 'introFeatures', 'whyChooseFeatures', 'counters'));
    }

    public function campaigns()
    {
        $campaigns = Campaign::where('status', 'published')->latest()->paginate(9);
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
        $members = \App\Models\TeamMember::where('is_active', true)->orderBy('order')->get();
        return view('website.pages.team', compact('members'));
    }

    public function faq(Request $request)
    {
        $categories = \App\Models\FaqCategory::where('is_active', true)->withCount(['faqs' => function($query) {
            $query->where('is_active', true);
        }])->with('translations')->orderBy('order')->get();

        $query = \App\Models\Faq::where('is_active', true)->with('translations')->orderBy('order');

        if ($request->has('category')) {
            $categorySlug = $request->category;
            $query->whereHas('category.translations', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $faqs = $query->get();
        return view('website.pages.faq', compact('faqs', 'categories'));
    }

    public function testimonials()
    {
        $testimonials = \App\Models\Testimonial::where('is_active', true)->latest()->get();
        return view('website.pages.testimonials', compact('testimonials'));
    }

    public function gallery()
    {
        $galleryItems = \App\Models\GalleryItem::where('is_active', true)->latest()->get();
        $categories = $galleryItems->pluck('category')->unique();
        return view('website.pages.gallery', compact('galleryItems', 'categories'));
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
        $page = Page::where('slug', 'privacy-policy')->where('is_active', true)->firstOrFail();
        return view('website.pages.privacy', compact('page'));
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms-and-conditions')->where('is_active', true)->firstOrFail();
        return view('website.pages.terms', compact('page'));
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('website.pages.show', compact('page'));
    }
    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you soon.');
    }

    public function storeEventReply(Request $request, $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\ContactSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject ? $request->subject : 'Reply to Event: ' . $event->title,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', 'Your reply has been submitted successfully.');
    }

    public function storeVolunteer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'nationality' => 'required|string|max:255',
            'gender' => 'required|string|in:Male,Female',
            'age_group' => 'required|string',
            'availability' => 'required|string',
            'interest' => 'required|string',
            'experience' => 'required|string',
            'address' => 'nullable|string',
        ]);

        \App\Models\Volunteer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'nationality' => $request->nationality,
            'gender' => $request->gender,
            'age_group' => $request->age_group,
            'availability' => $request->availability,
            'interest_areas' => [$request->interest], // Store as array
            'experience' => $request->experience,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Thank you for your interest! Your application has been submitted successfully.');
    }
}
