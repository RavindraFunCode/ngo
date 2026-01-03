<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemTranslation;
use App\Models\Language;

class WebsiteMenuSeeder extends Seeder
{
    public function run()
    {
        $menu = Menu::firstOrCreate(
            ['identifier' => 'main-menu'],
            ['name' => 'Main Menu']
        );

        // Clear existing items
        $menu->items()->delete();

        $enLang = Language::where('code', 'en')->first();
        $hiLang = Language::where('code', 'hi')->first();

        if (!$enLang) {
            $enLang = Language::create(['name' => 'English', 'code' => 'en', 'is_active' => true, 'is_default' => true]);
        }

        // 1. Home
        $home = $this->createItem($menu->id, null, 'Home', 'home', 'route', 1, $enLang, $hiLang);

        // 2. Pages (Dropdown)
        $pages = $this->createItem($menu->id, null, 'Pages', '#', 'external_url', 2, $enLang, $hiLang);
        
        $this->createItem($menu->id, $pages->id, 'About Us', 'about', 'route', 1, $enLang, $hiLang);
        $this->createItem($menu->id, $pages->id, 'Meet Our Team', 'team', 'route', 2, $enLang, $hiLang);
        $this->createItem($menu->id, $pages->id, 'Join as Volunteer', 'volunteer', 'route', 3, $enLang, $hiLang);
        $this->createItem($menu->id, $pages->id, 'Partner With Us', 'partner', 'route', 4, $enLang, $hiLang);
        $this->createItem($menu->id, $pages->id, 'Work With Us', 'career', 'route', 5, $enLang, $hiLang);
        $this->createItem($menu->id, $pages->id, 'FAQ\'s', 'faq', 'route', 6, $enLang, $hiLang);
        $this->createItem($menu->id, $pages->id, 'Testimonials', 'testimonials', 'route', 7, $enLang, $hiLang);
        $this->createItem($menu->id, $pages->id, 'Contact Us', 'contact', 'route', 8, $enLang, $hiLang);

        // 3. Causes
        $causes = $this->createItem($menu->id, null, 'Causes', 'campaigns.index', 'route', 3, $enLang, $hiLang);

        // 4. Events
        $events = $this->createItem($menu->id, null, 'Events', 'events.index', 'route', 4, $enLang, $hiLang);

        // 5. Blog
        $blog = $this->createItem($menu->id, null, 'Blog', 'blog.index', 'route', 5, $enLang, $hiLang);

        // 6. Gallery
        $gallery = $this->createItem($menu->id, null, 'Gallery', 'gallery', 'route', 6, $enLang, $hiLang);
    }

    private function createItem($menuId, $parentId, $label, $urlOrRoute, $type, $sortOrder, $enLang, $hiLang)
    {
        $item = MenuItem::create([
            'menu_id' => $menuId,
            'parent_id' => $parentId,
            'type' => $type,
            'route_name' => $type === 'route' ? $urlOrRoute : null,
            'url' => $type === 'external_url' ? $urlOrRoute : null,
            'sort_order' => $sortOrder,
            'is_active' => true,
        ]);

        MenuItemTranslation::create([
            'menu_item_id' => $item->id,
            'language_id' => $enLang->id,
            'label' => $label,
        ]);

        if ($hiLang) {
            MenuItemTranslation::create([
                'menu_item_id' => $item->id,
                'language_id' => $hiLang->id,
                'label' => $label . ' (HI)',
            ]);
        }

        return $item;
    }
}
