<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Menu;
use App\Models\Language;

class WebsiteComposer
{
    public function compose(View $view)
    {
        $mainMenu = Menu::where('identifier', 'main-menu')->first();
        $menuItems = [];

        if ($mainMenu) {
            $menuItems = $mainMenu->items()
                ->whereNull('parent_id')
                ->where('is_active', true)
                ->with(['children' => function ($query) {
                    $query->where('is_active', true)->orderBy('sort_order');
                }, 'translations', 'children.translations'])
                ->get();
        }
        
        // Fetch current language ID
        $locale = session('locale', 'en');
        $currentLanguage = Language::where('code', $locale)->first();
        $languageId = $currentLanguage ? $currentLanguage->id : null;

        // Fetch all settings
        $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

        $view->with('mainMenu', $menuItems);
        $view->with('currentLanguageId', $languageId);
        $view->with('settings', $settings);
    }
}
