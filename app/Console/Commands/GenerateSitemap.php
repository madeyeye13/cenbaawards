<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use App\Models\GalleryAlbum;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the public sitemap.xml';

    public function handle(): void
    {
        $sitemap = Sitemap::create();

        // ── STATIC PAGES ──────────────────────────────────────
        $staticPages = [
            ['url' => route('home'),             'priority' => 1.0,  'freq' => 'weekly'],
            ['url' => route('about'),            'priority' => 0.9,  'freq' => 'monthly'],
            ['url' => route('contact'),          'priority' => 0.8,  'freq' => 'monthly'],
            ['url' => route('winners'),          'priority' => 0.9,  'freq' => 'monthly'],
            ['url' => route('award.categories'), 'priority' => 0.85, 'freq' => 'monthly'],
            ['url' => route('award.criteria'),   'priority' => 0.8,  'freq' => 'monthly'],
            ['url' => route('award.judges'),     'priority' => 0.75, 'freq' => 'monthly'],
            ['url' => route('blog.index'),       'priority' => 0.85, 'freq' => 'weekly'],
            ['url' => route('events.gallery'),   'priority' => 0.8,  'freq' => 'monthly'],
            ['url' => route('events.partners'),  'priority' => 0.7,  'freq' => 'monthly'],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($page['url'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['freq'])
                    ->setLastModificationDate(Carbon::now())
            );
        }

        // ── BLOG POSTS ─────────────────────────────────────────
        Post::published()
            ->ordered()
            ->each(function (Post $post) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('blog.show', $post->slug))
                        ->setPriority(0.7)
                        ->setChangeFrequency('monthly')
                        ->setLastModificationDate($post->updated_at)
                );
            });

        // ── GALLERY ALBUMS ─────────────────────────────────────
        GalleryAlbum::where('is_active', true)
            ->orderBy('year', 'desc')
            ->each(function (GalleryAlbum $album) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('events.gallery.album', $album->slug))
                        ->setPriority(0.6)
                        ->setChangeFrequency('yearly')
                        ->setLastModificationDate($album->updated_at)
                );
            });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated at public/sitemap.xml');
    }
}