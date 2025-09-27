<?php

namespace App\Providers;

use App\Models\ConversationMessage;
use App\Models\CustomerAddtoCart;
use App\Models\CustomerInformation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $customer = null;
            $adminChatPreviews = [];
            if (session()->has('customer_id')) {
                $customer = CustomerInformation::find(session('customer_id'));
                if ($customer) {
                    $adminChats = \App\Models\UserConversationWithAdmin::where('user_id', $customer->id)->with('admin')->get();
                    foreach ($adminChats as $chat) {
                        $latestMsg = ConversationMessage::where('conversation_id', $chat->id)->orderByDesc('created_at')->first();
                        $adminChatPreviews[] = [
                            'admin' => $chat->admin,
                            'conversation_id' => $chat->id,
                            'last_message' => $latestMsg ? $latestMsg->message : 'No messages yet.',
                        ];
                    }
                }
                $customerID = session('customer_id');
                $cartItems = CustomerAddtoCart::where('customer_id', $customerID)->with('item')->get();
                if (! $cartItems) {
                    $cartItems = collect();
                }
            }
            $view->with('currentCustomer', $customer);
            $view->with('adminChatPreviews', $adminChatPreviews);
            $view->with('cartItems', $cartItems);
        });

    }
}
