<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Auth\Login;
/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', \App\Livewire\Pages\Home::class)->name('home');

Route::get('/about', \App\Livewire\Pages\About::class)->name('about');


Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/winners', function () {
    return view('pages.winners');
})->name('winners');

// Award Routes
Route::prefix('award')->name('award.')->group(function () {
    Route::get('/categories', function () {
        return view('award.categories');
    })->name('categories');

    Route::get('/criteria', function () {
        return view('award.criteria');
    })->name('criteria');

    Route::get('/judges', function () {
        return view('award.judges');
    })->name('judges');
});

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', function () {
        return view('blog.index');
    })->name('index');

    Route::get('/{slug}', function ($slug) {
        return view('blog.show', compact('slug'));
    })->name('show');
});

// Events Routes
Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', function () {
        return view('events.index');
    })->name('index');

    Route::get('/gallery', function () {
        return view('events.gallery');
    })->name('gallery');

    Route::get('/partners', function () {
        return view('events.partners');
    })->name('partners');
});

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
        Route::get('/media', function () {
            return view('admin.media.index');
        })->name('media.index');

        // Posts
        Route::get('/posts', function () {
            return view('admin.posts.index');
        })->name('posts.index');
        Route::get('/posts/create', function () {
            return view('admin.posts.create');
        })->name('posts.create');
        Route::get('/posts/{id}/edit', function ($id) {
            return view('admin.posts.edit', compact('id'));
        })->name('posts.edit');

        // Award Categories
        Route::get('/award-categories', function () {
            return view('admin.award-categories.index');
        })->name('award-categories.index');

        // Award Criteria
        Route::get('/award-criteria', function () {
            return view('admin.award-criteria.index');
        })->name('award-criteria.index');

        // Judges
        Route::get('/judges', function () {
            return view('admin.judges.index');
        })->name('judges.index');

        // Winners
        Route::get('/winners', function () {
            return view('admin.winners.index');
        })->name('winners.index');

        // Gallery
        Route::get('/gallery', function () {
            return view('admin.gallery.index');
        })->name('gallery.index');

        // Partners
        Route::get('/partners', function () {
            return view('admin.partners.index');
        })->name('partners.index');

        // Sponsors
        Route::get('/sponsors', function () {
            return view('admin.sponsors.index');
        })->name('sponsors.index');

        // Events
        Route::get('/events', function () {
            return view('admin.events.index');
        })->name('events.index');

        // Team
        Route::get('/team', function () {
            return view('admin.team.index');
        })->name('team.index');

        // Contacts
        Route::get('/contacts', function () {
            return view('admin.contacts.index');
        })->name('contacts.index');

        // Settings
        Route::get('/settings', function () {
            return view('admin.settings.index');
        })->name('settings.index');

        // Logout
        Route::post('/logout', function () {
            auth('admin')->logout();
            return redirect()->route('admin.login');
        })->name('logout');
    });
});