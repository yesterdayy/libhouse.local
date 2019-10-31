<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\HelperAdminController;
use App\Http\Controllers\UploadController;
use App\Orchid\Screens\BusinessCards\BusinessCardsEdit;
use App\Orchid\Screens\BusinessCards\BusinessCardsList;
use App\Orchid\Screens\Cats\CatsList;
use App\Orchid\Screens\Cats\CatsEdit;
use App\Orchid\Screens\Comments\CommentstList;
use App\Orchid\Screens\Menu\MenuEdit;
use App\Orchid\Screens\Pages\PagesEdit;
use App\Orchid\Screens\Pages\PagesList;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Posts\PostsEdit;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Settings\SettingsScreen;
use App\Orchid\Screens\SiteReviews\SiteReviewsEdit;
use App\Orchid\Screens\SiteReviews\SiteReviewsList;
use App\Orchid\Screens\Tags\TagsEdit;
use App\Orchid\Screens\Tags\TagsList;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\Comments\CommentsEdit;
use App\Orchid\Screens\Posts\PostsList;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// ХЕЛПЕР РОУТЫ - вспомогательные роуты для работы с админкой

$this->router->post('menu/order', [HelperAdminController::class, 'menu_order'])
    ->name('platform.menu.order');

$this->router->get('menu/search/{term?}', [HelperAdminController::class, 'search_entry'])
    ->name('platform.menu.search');

// Перезаписываем системные роуты с админки

$this->router->post('systems/files', [UploadController::class, 'admin_photo'])
    ->name('systems.files.upload');

$this->router->post('systems/avatar', [UploadController::class, 'admin_avatar'])
    ->name('systems.files.avatar');

$this->router->get('systems/tags/{tags?}', [HelperAdminController::class, 'search'])
    ->name('systems.tag.search');



// Main
$this->router->screen('/main', PlatformScreen::class)->name('platform.main');

// Users...
$this->router->screen('users/{users}/edit', UserEditScreen::class)->name('platform.systems.users.edit');
$this->router->screen('users', UserListScreen::class)->name('platform.systems.users');

// Roles...
$this->router->screen('roles/{roles}/edit', RoleEditScreen::class)->name('platform.systems.roles.edit');
$this->router->screen('roles/create', RoleEditScreen::class)->name('platform.systems.roles.create');
$this->router->screen('roles', RoleListScreen::class)->name('platform.systems.roles');

// Posts
$this->router->screen('posts/create', PostsEdit::class)->name('platform.screens.posts.create');
$this->router->screen('posts/{blog_entry}/edit', PostsEdit::class)->name('platform.screens.posts.edit');
$this->router->screen('posts', PostsList::class)->name('platform.screens.posts.list');

// Pages
$this->router->screen('pages/create', PagesEdit::class)->name('platform.screens.pages.create');
$this->router->screen('pages/{blog_entry}/edit', PagesEdit::class)->name('platform.screens.pages.edit');
$this->router->screen('pages', PagesList::class)->name('platform.screens.pages.list');

// Business Cards
$this->router->screen('business_cards/create', BusinessCardsEdit::class)->name('platform.screens.business.create');
$this->router->screen('business_cards/{blog_entry}/edit', BusinessCardsEdit::class)->name('platform.screens.business.edit');
$this->router->screen('business_cards', BusinessCardsList::class)->name('platform.screens.business.list');

// Site Reviews
$this->router->screen('site_reviews/create', SiteReviewsEdit::class)->name('platform.screens.reviews.create');
$this->router->screen('site_reviews/{blog_entry}/edit', SiteReviewsEdit::class)->name('platform.screens.reviews.edit');
$this->router->screen('site_reviews', SiteReviewsList::class)->name('platform.screens.reviews.list');

// Cats
$this->router->screen('cats/create', CatsEdit::class)->name('platform.screens.cats.create');
$this->router->screen('cats/{cat}/edit', CatsEdit::class)->name('platform.screens.cats.edit');
$this->router->screen('cats', CatsList::class)->name('platform.screens.cats.list');

// Tags
$this->router->screen('tags/create', TagsEdit::class)->name('platform.screens.tags.create');
$this->router->screen('tags/{tag}/edit', TagsEdit::class)->name('platform.screens.tags.edit');
$this->router->screen('tags', TagsList::class)->name('platform.screens.tags.list');

// Comments
$this->router->screen('comments/create', CommentsEdit::class)->name('platform.screens.comments.create');
$this->router->screen('comments/{comment}/edit', CommentsEdit::class)->name('platform.screens.comments.edit');
$this->router->screen('comments', CommentstList::class)->name('platform.screens.comments.list');

// Menu
$this->router->screen('menu/create', MenuEdit::class)->name('platform.screens.menu.create');
$this->router->screen('menu/{menu}/edit', MenuEdit::class)->name('platform.screens.menu.edit');
$this->router->screen('menu', App\Orchid\Screens\Menu\MenuList::class)->name('platform.screens.menu.list');

// Settings
$this->router->screen('settings', SettingsScreen::class)->name('platform.screens.settings');