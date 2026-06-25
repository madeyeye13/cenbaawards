<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', \App\Livewire\Pages\Home::class)->name('home');

Route::get('/about', \App\Livewire\Pages\About::class)->name('about');


Route::get('/contact', \App\Livewire\Pages\Contact::class)->name('contact');


Route::get('/winners', \App\Livewire\Pages\Winners::class)->name('winners');

// Award Routes
Route::prefix('award')->name('award.')->group(function () {
    Route::get('/categories', \App\Livewire\Pages\AwardCategories::class)->name('categories');
    Route::get('/criteria', \App\Livewire\Pages\AwardCriteria::class)->name('criteria');
    Route::get('/judges', \App\Livewire\Pages\Judges::class)->name('judges');
});

// Blog Routes
// Blog / News
Route::get('/blog', \App\Livewire\Pages\Blog::class)->name('blog.index');
Route::get('/blog/{post:slug}', \App\Livewire\Pages\BlogShow::class)->name('blog.show');

// Events Routes
Route::prefix('events')->name('events.')->group(function () {
        // Replace the old gallery stub with these two:
    Route::get('/gallery', \App\Livewire\Pages\Gallery::class)->name('gallery');
    Route::get('/gallery/{slug}', \App\Livewire\Pages\GalleryAlbum::class)->name('gallery.album');
    Route::get('/partners', \App\Livewire\Pages\Partners::class)->name('partners');
});

Route::get('/sitemap.xml', function () {
    $path = public_path('sitemap.xml');
    if (!file_exists($path)) {
        Artisan::call('sitemap:generate');
    }
    return response()->file($path, ['Content-Type' => 'application/xml']);
})->name('sitemap');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest only routes
    Route::middleware('guest:admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('login');
});

    // Protected admin routes
    Route::middleware('auth.admin')->group(function () {
       Route::get('/', \App\Livewire\Admin\Dashboard::class)->name('dashboard');

        // Media Library
        Route::get('/media', \App\Livewire\Admin\MediaLibrary::class)->name('media.index');

        // Posts (Blog + Press Release)
        Route::get('/posts', \App\Livewire\Admin\Posts::class)->name('posts.index');
        Route::get('/posts/create', \App\Livewire\Admin\PostEditor::class)->name('posts.create');
        Route::get('/posts/{post}/edit', \App\Livewire\Admin\PostEditor::class)->name('posts.edit');

        Route::get('/comments', \App\Livewire\Admin\Comments::class)->name('comments.index');

        // Award Categories
        Route::get('/award-categories', function () {
            return view('admin.award-categories.index');
        })->name('award-categories.index');

        // Award Criteria
        Route::get('/award-criteria', function () {
            return view('admin.award-criteria.index');
        })->name('award-criteria.index');

        // Judges
        Route::get('/judges', \App\Livewire\Admin\Judges::class)->name('judges.index');

        // Winners
        Route::get('/winners', \App\Livewire\Admin\Winners::class)->name('winners.index');

        // Gallery
        Route::get('/gallery', \App\Livewire\Admin\GalleryAlbums::class)->name('gallery.index');
        Route::get('/gallery/{slug}', \App\Livewire\Admin\GalleryAlbumImages::class)->name('gallery.album');

        // Partners & Sponsors
        Route::get('/partners-sponsors', \App\Livewire\Admin\PartnersSponsors::class)->name('partners-sponsors.index');

        // Events
        Route::get('/events', function () {
            return view('admin.events.index');
        })->name('events.index');

        // Team
        Route::get('/team', function () {
            return view('admin.team.index');
        })->name('team.index');

        // Contacts
        Route::get('/contacts', \App\Livewire\Admin\Contacts::class)->name('contacts.index');

        // Settings
        Route::get('/settings', \App\Livewire\Admin\Settings::class)->name('settings.index');
        // Logout
        Route::post('/logout', function () {
            auth('admin')->logout();
            return redirect()->route('admin.login');
        })->name('logout');
    });
});