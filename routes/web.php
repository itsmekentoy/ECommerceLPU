
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerAuthentication;
use App\Http\Controllers\CustomerInformation;
use App\Http\Controllers\LandinPageController;
use App\Http\Controllers\ProductItemController;
use Illuminate\Support\Facades\Route;

Route::controller(CustomerAuthentication::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'store')->name('register.store');
    Route::get('/confirmation', 'confirmEmail')->name('confirm.email');
    Route::post('/updateProfile', 'updateProfile')->name('customer.update.profile');
});

Route::controller(LandinPageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/contact', 'contact')->name('contact');

});
Route::controller(AddtoCart::class)->group(function () {
    Route::get('/cart/items', 'fetchCartItems')->name('cart.items');
    Route::post('/add-to-cart', 'addtoCart')->name('add.to.cart');
    Route::post('/cart/remove', 'removeItemFromCart')->name('cart.remove');
    Route::post('/cart/update', 'updateCartItem')->name('cart.update');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/dashboard', 'index')->name('admin.index');

    Route::get('/admin/users', 'users')->name('admin.users');
});

Route::controller(ProductItemController::class)->group(function () {
    Route::get('/admin/inventory', 'inventory')->name('admin.inventory');
    Route::post('/admin/addItem', 'CreateProduct')->name('admin.add.item');
    Route::delete('admin/{id}/deleteItem', 'DeleteItem')->name('admin.delete.item');
    Route::post('admin/{id}/updateItem', 'UpdateItem')->name('admin.update.item');
});

Route::controller(CustomerInformation::class)->group(function () {
    Route::get('/admin/customers', 'index')->name('admin.customers');
});

// Conversation message AJAX routes
use App\Http\Controllers\ConversationMessageController;

Route::post('/conversation/messages/fetch', [ConversationMessageController::class, 'fetch'])->name('conversation.fetch');
Route::post('/conversation/messages/send', [ConversationMessageController::class, 'send'])->name('conversation.send');
use App\Http\Controllers\UserConversationWithAdminController;

Route::post('/conversation/get-or-create', [UserConversationWithAdminController::class, 'getOrCreate'])->name('conversation.getOrCreate');
