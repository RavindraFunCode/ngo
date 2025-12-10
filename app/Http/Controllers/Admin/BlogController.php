<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['translations', 'category', 'author'])->latest()->paginate(10);
        return view('admin.blog.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $languages = Language::where('is_active', true)->get();
        return view('admin.blog.posts.create', compact('categories', 'languages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:posts,slug|max:255',
            'category_id' => 'required|exists:post_categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'translations' => 'array',
            'translations.*.title' => 'nullable|string|max:255',
            'translations.*.slug' => 'nullable|string|max:255',
            'translations.*.content' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blog', 'public');
        }

        $post = BlogPost::create([
            'slug' => Str::slug($request->slug),
            'category_id' => $request->category_id,
            'status' => $request->status,
            'published_at' => $request->published_at,
            'author_id' => auth()->id(),
            'featured_image' => $imagePath,
        ]);

        $languages = Language::whereIn('code', array_keys($request->translations))->get()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (! $languages->has($locale) || empty($data['title'])) {
                continue;
            }

            $post->translations()->create([
                'language_id' => $languages[$locale]->id,
                'title' => $data['title'],
                'slug' => Str::slug($data['slug']),
                'content' => $data['content'],
                'excerpt' => $data['excerpt'] ?? null,
                'meta_title' => $data['meta_title'] ?? null,
                'meta_description' => $data['meta_description'] ?? null,
                'meta_keywords' => $data['meta_keywords'] ?? null,
            ]);
        }

        return redirect()->route('admin.blog.index')->with('success', 'Post created successfully.');
    }

    public function edit(BlogPost $blog)
    {
        $categories = Category::where('is_active', true)->get();
        $languages = Language::where('is_active', true)->get();
        return view('admin.blog.posts.edit', compact('blog', 'categories', 'languages'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $request->validate([
            'slug' => 'required|unique:posts,slug,' . $blog->id . '|max:255',
            'category_id' => 'required|exists:post_categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,published',
            'translations' => 'array',
            'translations.*.title' => 'nullable|string|max:255',
            'translations.*.slug' => 'nullable|string|max:255',
            'translations.*.content' => 'nullable|string',
        ]);

        if ($request->hasFile('featured_image')) {
            $blog->featured_image = $request->file('featured_image')->store('blog', 'public');
        }

        $blog->update([
            'slug' => Str::slug($request->slug),
            'category_id' => $request->category_id,
            'status' => $request->status,
            'published_at' => $request->published_at,
        ]);

        $languages = Language::whereIn('code', array_keys($request->translations))->get()->keyBy('code');

        foreach ($request->translations as $locale => $data) {
            if (! $languages->has($locale) || empty($data['title'])) {
                continue;
            }

            $blog->translations()->updateOrCreate(
                ['language_id' => $languages[$locale]->id],
                [
                    'title' => $data['title'],
                    'slug' => Str::slug($data['slug']),
                    'content' => $data['content'],
                    'excerpt' => $data['excerpt'] ?? null,
                    'meta_title' => $data['meta_title'] ?? null,
                    'meta_description' => $data['meta_description'] ?? null,
                    'meta_keywords' => $data['meta_keywords'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.blog.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(BlogPost $blog)
    {
        $blog->translations()->delete();
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Post deleted successfully.');
    }
    public function show($id)
    {
        //
    }
}
