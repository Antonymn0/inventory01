<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        //Product events
        'App\Events\ProductCreated' => [
            //
        ],
        'App\Events\ProductUpdated' => [
            //
        ],
        'App\Events\ProductDestroyed' => [
            //
        ],

        //Services events
        'App\Events\ServiceCreated' => [
            //
        ],
        'App\Events\ServiceUpdated' => [
            //
        ],
        'App\Events\ServiceDestroyed' => [
            //
        ],

        //Tag events
        'App\Events\TagCreated' => [
            //
        ],
        'App\Events\TagUpdated' => [
            //
        ],
        'App\Events\TagDestroyed' => [
            //
        ],

        //Shipping-class events
        'App\Events\ShippingClassCreated' => [
            //
        ],
        'App\Events\ShippingClassUpdated' => [
            //
        ],
        'App\Events\ShippingClassDestroyed' => [
            //
        ],

        //brand events
        'App\Events\BrandCreated' => [
            //
        ],
        'App\Events\BrandUpdated' => [
            //
        ],
        'App\Events\BrandDestroyed' => [
            //
        ],

        //Attribute events
        'App\Events\AttributeCreated' => [
            //
        ],
        'App\Events\AttributeUpdated' => [
            //
        ],
        'App\Events\AttributeDestroyed' => [
            //
        ],

        //Category events
        'App\Events\CategoryCreated' => [
            //
        ],
        'App\Events\CategoryUpdated' => [
            //
        ],
        'App\Events\CategoryDestroyed' => [
            //
        ],

        //Category events
        'App\Events\CommentCreated' => [
            //
        ],
        'App\Events\CommentUpdated' => [
            //
        ],
        'App\Events\CommentDestroyed' => [
            //
        ],

        //Coupon events
        'App\Events\CouponCreated' => [
            //
        ],
        'App\Events\CouponUpdated' => [
            //
        ],
        'App\Events\CouponDestroyed' => [
            //
        ],

        //Crossell events
        'App\Events\CrossellCreated' => [
            //
        ],
        'App\Events\CrossellUpdated' => [
            //
        ],
        'App\Events\CrossellDestroyed' => [
            //
        ],

        //Download events
        'App\Events\DownloadCreated' => [
            //
        ],
        'App\Events\DownloadUpdated' => [
            //
        ],
        'App\Events\DownloadDestroyed' => [
            //
        ],

        //Inventory events
        'App\Events\InventoryCreated' => [
            //
        ],
        'App\Events\InventoryUpdated' => [
            //
        ],
        'App\Events\InventoryDestroyed' => [
            //
        ],

        //Like events
        'App\Events\LikeCreated' => [
            //
        ],
        'App\Events\LikeUpdated' => [
            //
        ],
        'App\Events\LikeDestroyed' => [
            //
        ],

        //Media events
        'App\Events\MediaCreated' => [
            //
        ],
        'App\Events\MediaUpdated' => [
            //
        ],
        'App\Events\MediaDestroyed' => [
            //
        ],

        //Option events
        'App\Events\OptionCreated' => [
            //
        ],
        'App\Events\OptionUpdated' => [
            //
        ],
        'App\Events\OptionDestroyed' => [
            //
        ],

        //Review events
        'App\Events\ReviewCreated' => [
            //
        ],
        'App\Events\ReviewUpdated' => [
            //
        ],
        'App\Events\ReviewDestroyed' => [
            //
        ],

        //SoldWith events
        'App\Events\SoldWithCreated' => [
            //
        ],
        'App\Events\SoldWithUpdated' => [
            //
        ],
        'App\Events\SoldWithDestroyed' => [
            //
        ],

        //Unit events
        'App\Events\UnitCreated' => [
            //
        ],
        'App\Events\UnitUpdated' => [
            //
        ],
        'App\Events\UnitDestroyed' => [
            //
        ],

        //Upsell events
        'App\Events\UpsellCreated' => [
            //
        ],
        'App\Events\UpsellUpdated' => [
            //
        ],
        'App\Events\UpsellDestroyed' => [
            //
        ],

        //Register user events
        'App\Events\UserCreated' => [
            //
        ],
        'App\Events\UserUpdated' => [
            //
        ],
        'App\Events\UserDestroyed' => [
            //
        ],
        
        //Login events
        'App\Events\LoginSuccessful' => [
            //
        ],

        //Logout Event
        'App\Events\LogoutSuccessful' => [
            //
        ],
        
        

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
