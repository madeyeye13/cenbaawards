<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;

#[Layout('components.layouts.admin')]
#[Title('Settings')]
class Settings extends Component
{
    public string $tab = 'home';
    public bool $sitemapExists = false;
    public ?string $sitemapGeneratedAt = null;

    // ── HOME PAGE ──────────────────────────────────────────────
    public ?string $home_hero_slide_1 = null;
    public ?string $home_hero_slide_1_url = null;
    public ?string $home_hero_slide_2 = null;
    public ?string $home_hero_slide_2_url = null;
    public ?string $home_hero_slide_3 = null;
    public ?string $home_hero_slide_3_url = null;
    public ?string $home_about_image = null;
    public ?string $home_about_image_url = null;

    // ── ABOUT PAGE ─────────────────────────────────────────────
    public ?string $about_hero_image = null;
    public ?string $about_hero_image_url = null;
    public ?string $about_image_1 = null;
    public ?string $about_image_1_url = null;
    public ?string $about_image_2 = null;
    public ?string $about_image_2_url = null;
    public ?string $about_history_image = null;
    public ?string $about_history_image_url = null;
    public ?string $about_institute_image_1 = null;
    public ?string $about_institute_image_1_url = null;
    public ?string $about_institute_image_2 = null;
    public ?string $about_institute_image_2_url = null;

    // ── CATEGORIES PAGE ────────────────────────────────────────
    public ?string $categories_hero_image = null;
    public ?string $categories_hero_image_url = null;

    // ── CRITERIA PAGE ──────────────────────────────────────────
    public ?string $criteria_hero_image = null;
    public ?string $criteria_hero_image_url = null;

    // ── JUDGES PAGE ────────────────────────────────────────────
    public ?string $judges_hero_image = null;
    public ?string $judges_hero_image_url = null;

    // ── PARTNERS PAGE ──────────────────────────────────────────
    public ?string $partners_hero_image = null;
    public ?string $partners_hero_image_url = null;

    // ── CONTACT PAGE ───────────────────────────────────────────
    public ?string $contact_hero_image = null;
    public ?string $contact_hero_image_url = null;

    // Track which media picker field is active
    public ?string $activePickerField = null;

    public function mount(): void
    {
        $this->loadAll();
        $this->checkSitemap();
    }

    protected function loadAll(): void
    {
        $keys = [
            'home_hero_slide_1', 'home_hero_slide_2', 'home_hero_slide_3', 'home_about_image',
            'about_hero_image', 'about_image_1', 'about_image_2', 'about_history_image',
            'about_institute_image_1', 'about_institute_image_2',
            'categories_hero_image', 'criteria_hero_image',
            'judges_hero_image', 'partners_hero_image', 'contact_hero_image',
        ];

        foreach ($keys as $key) {
            $value = Setting::get($key);
            $this->{$key} = $value;
            $this->{$key . '_url'} = $value ? asset('storage/' . $value) : null;
        }
    }

    public function switchTab(string $tab): void
    {
        $this->tab = $tab;
    }

    #[On('mediaPicked')]
    public function onMediaPicked(string $name, array $media): void
    {
        if (empty($media) || !$this->activePickerField) return;

        $field = $this->activePickerField;
        if (!property_exists($this, $field)) return;

        $this->{$field} = $media[0]['path'];
        $this->{$field . '_url'} = $media[0]['url'];
        $this->activePickerField = null;
    }

    public function openPicker(string $field): void
    {
        $this->activePickerField = $field;
        $this->dispatch('openMediaPicker', name: 'settings-picker', multiple: false);
    }

    public function removeImage(string $field): void
    {
        $this->{$field} = null;
        $this->{$field . '_url'} = null;
    }

    public function save(): void
    {
        $fields = match ($this->tab) {
            'home'       => ['home_hero_slide_1', 'home_hero_slide_2', 'home_hero_slide_3', 'home_about_image'],
            'about'      => ['about_hero_image', 'about_image_1', 'about_image_2', 'about_history_image', 'about_institute_image_1', 'about_institute_image_2'],
            'categories' => ['categories_hero_image'],
            'criteria'   => ['criteria_hero_image'],
            'judges'     => ['judges_hero_image'],
            'partners'   => ['partners_hero_image'],
            'contact'    => ['contact_hero_image'],
            default      => [],
        };

        $group = 'page_images';
        foreach ($fields as $field) {
            Setting::set($field, $this->{$field}, $group);
        }
        Setting::clearGroup($group);

        $this->dispatch('toast', type: 'success', title: 'Saved', message: 'Page images updated.');
    }

    protected function checkSitemap(): void
    {
        $path = public_path('sitemap.xml');
        $this->sitemapExists = file_exists($path);
        $this->sitemapGeneratedAt = $this->sitemapExists
            ? \Carbon\Carbon::createFromTimestamp(filemtime($path))->diffForHumans()
            : null;
    }

    public function generateSitemap(): void
    {
        Artisan::call('sitemap:generate');
        $this->checkSitemap();
        $this->dispatch('toast', type: 'success', title: 'Done', message: 'Sitemap generated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}