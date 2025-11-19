<?php

namespace App\Providers;

use App\Models\ConversationMessage;
use App\Models\CustomerAddtoCart;
use App\Models\CustomerInformation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if(env('PRODSTATE') == 'true'){
            URL::forceScheme('https');
        }
        View::composer('*', function ($view) {
            $customer = null;
            $adminChatPreviews = [];
            $cartItems = collect();
            $countItems = 0;

            if (session()->has('customer_id')) {
                $customer = CustomerInformation::find(session('customer_id'));

                if ($customer) {
                    $adminChats = \App\Models\UserConversationWithAdmin::where('user_id', $customer->id)
                        ->with('admin')
                        ->get();

                    foreach ($adminChats as $chat) {
                        $latestMsg = ConversationMessage::where('conversation_id', $chat->id)
                            ->orderByDesc('created_at')
                            ->first();

                        $adminChatPreviews[] = [
                            'admin' => $chat->admin,
                            'conversation_id' => $chat->id,
                            'last_message' => $latestMsg ? $latestMsg->message : 'No messages yet.',
                        ];
                    }
                }

                $cartItems = CustomerAddtoCart::where('customer_id', session('customer_id'))
                    ->with('item')
                    ->get();

                $countItems = $cartItems->sum('quantity')?? 0;
            }

            $view->with('currentCustomer', $customer);
            $view->with('adminChatPreviews', $adminChatPreviews);
            $view->with('cartItems', $cartItems);
            $view->with('countItems', $countItems);
        });
    }
}
