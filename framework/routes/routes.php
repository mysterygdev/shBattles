<?php

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

Router::setDefaultNamespace('App\Controllers');

// Default Route
Router::get('/', 'Home@Index');
// Downloads
Router::get('/download', 'Home@downloads');

// Community
Router::group(['prefix' => '/community'], function () {
    // GET
    Router::get('/discord', 'Community@discord');
    Router::get('/events', 'Community@events');
    Router::get('/news', 'Community@news');
    Router::get('/patchnotes', 'Community@patchnotes');
    Router::get('/polls', 'Community@polls');
    Router::get('/rankings', 'Community@rankings');
    Router::get('/guildrankings', 'Community@guildrankings');
    Router::get('/staffteam', 'Community@staffteam');
    // POST
    Router::post('/getRankings', 'Community@rankings1');
    Router::post('/getPatchNotes', 'Community@getPatchNotes');
});
// Info
Router::group(['prefix' => '/server'], function () {
    // GET
    Router::get('/about', 'Server@about');
    Router::get('/drops', 'Server@drops');
    Router::get('/download', 'Server@download');
    Router::get('/bossrecords', 'Server@bossrecords');
    //Router::get('/terms', 'Server@terms');
});
// Help
Router::group(['prefix' => '/help'], function () {
    // GET
    Router::get('/policy', 'Help@policy');
    Router::get('/support', 'Help@support');
    Router::get('/support/ticket/{id}', 'Help@ticket');
    Router::get('/support/newTicket', 'Help@newTicket');
    Router::get('/rules', 'Help@rules');
});

// Auth
Router::group(['prefix' => '/auth'], function () {
    // GET
    Router::get('/captcha', 'Auth@captcha');
    Router::get('/forgotPassword', 'Auth@forgotPassword');
    Router::get('/verify/{name?}', 'Auth@verify');
    // POST
    Router::post('/changePassword', 'Auth@changePassword');
    Router::post('/forgotPasswordPost', 'Auth@forgotPasswordPost');
    Router::post('/login', 'Auth@login');
    //Router::post('/logout', 'Auth@logout');
    Router::post('/register', 'Auth@register');
    Router::post('/verifyDisplayName', 'Auth@verifyDisplayName');
    Router::post('/verifyUserName', 'Auth@verifyUserName');

    // Mixed
    Router::match(['get', 'post'], '/logout', 'Auth@logout');
});

// User
Router::group(['prefix' => '/user'], function () {
    // GET
    Router::get('/donateProcess', 'User@donateProcess');
    Router::get('/donateComplete', 'User@donateComplete');
    Router::get('/getRecoveryKey', 'User@getRecoveryKey');
    Router::get('/login', 'User@login');
    Router::get('/register', 'User@register');
    Router::get('/panel', 'User@panel');
    Router::get('/panel/{id}', 'User@panel');
    Router::get('/settings', 'User@settings');
    Router::get('/shareDp', 'User@shareDp');
    // POST
    Router::post('/getShareDp', 'User@shareDpPost');
    // Mixed
    Router::match(['get', 'post'], '/donate', 'User@donate');
    Router::match(['get', 'post'], '/move2Terra', 'User@moveTerra');
    Router::match(['get', 'post'], '/paypal/listenerAdv', 'User@listenerAdv');
});

// User
Router::group(['prefix' => '/game'], function () {
    Router::group(['prefix' => '/webmall'], function () {
        // GET
        Router::get('', 'WebMall@webmall');
        Router::get('/category/{name}', 'WebMall@webmall');
        Router::get('/cart', 'WebMall@cart');
        Router::get('/checkout', 'WebMall@checkout');
        Router::get('/orders', 'WebMall@orders');
        Router::get('/orderSuccess', 'WebMall@orderSuccess');
        Router::get('/orderFail', 'WebMall@orderFail');
        Router::get('/tieredSpender', 'WebMall@tieredSpender');
        // POST
        Router::post('/couponAdd', 'WebMall@couponAdd');
        // Mixed
        Router::match(['get', 'post'], '/cartAction', 'WebMall@cartAction');
    });
    // GET
    Router::get('/rewards/claim/{id}', 'Game@claimReward');
    // POST
    Router::post('/getPromotions', 'Game@pPromotions');
    // Mixed
    Router::match(['get', 'post'], '/promotions', 'Game@promotions');
    Router::match(['get', 'post'], '/rewards', 'Game@rewards');
    Router::match(['get', 'post'], '/vote', 'Game@vote');
});

// Admin
Router::group(['prefix' => '/admin'], function () {
    // Default
    Router::get('', 'Admin\Admin@Index');
    // Admin
    Router::get('/accessLogs', 'Admin\Admin@accessLogs');
    Router::get('/commandLogs', 'Admin\Admin@commandLogs');
    // Auth
    Router::group(['prefix' => '/auth'], function () {
        // GET
        Router::get('/signup', 'Admin\Admin@Index');
        Router::get('/logout', 'Admin\Admin@Index');
        // Mixed
        Router::match(['get', 'post'], '/login', 'User@donate');
    });
    Router::group(['prefix' => '/site'], function () {
        // GET
        Router::get('/events', 'Admin\Site@events');
        Router::get('/newEvent', 'Admin\Site@newEvent');
        Router::get('/tickets', 'Admin\Site@tickets');
        // POST
        Router::post('/createEvent', 'Admin\Site@pCreateEvent');
        Router::post('/deleteEvent', 'Admin\Site@pDeleteEvent');
        Router::post('/updateEvent', 'Admin\Site@pEvents');
    });
    Router::group(['prefix' => '/webmall'], function () {
        // GET
        //Router::get('/addProduct', 'Admin\Webmall@addProduct');
        Router::get('/editProduct', 'Admin\Webmall@editProduct');
        Router::get('/manageProducts', 'Admin\Webmall@manageProducts');
        Router::get('/removeProduct', 'Admin\Webmall@removeProduct');
        // POST
        Router::match(['get', 'post'], '/addProduct', 'Admin\Webmall@addProduct');
    });
    // Account
    Router::group(['prefix' => '/account'], function () {
        // GET
        Router::get('/bannedUsers', 'Admin\Account@bannedUsers');
        // Mixed
        Router::match(['get', 'post'], '/ban', 'Admin\Account@ban');
        Router::match(['get', 'post'], '/dpHandout', 'Admin\Account@dpHandout');
        Router::match(['get', 'post'], '/edit', 'Admin\Account@edit');
        Router::match(['get', 'post'], '/ipSearch', 'Admin\Account@ipSearch');
        Router::match(['get', 'post'], '/search', 'Admin\Account@search');
        Router::match(['get', 'post'], '/unban', 'Admin\Account@unban');
    });
    // Player
    Router::group(['prefix' => '/player'], function () {
        // GET
        Router::get('/sendGiftPlayer', 'Admin\Player@sendGiftPlayer');
        Router::get('/sendGiftPlayers', 'Admin\Player@sendGiftPlayers');
        Router::get('/sendGiftAll', 'Admin\Player@sendGiftAll');
        // POST
        Router::post('/getSendGiftPlayer', 'Admin\Player@sgpPost');
        Router::post('/verifySendGiftPlayer', 'Admin\Player@sgpVerifyPost');
        Router::post('/submitSendGiftPlayer', 'Admin\Player@sgpSubmitPost');
        Router::post('/getSendGiftAll', 'Admin\Player@sgaPost');
        Router::post('/verifySendGiftAll', 'Admin\Player@sgaVerifyPost');
        Router::post('/submitSendGiftAll', 'Admin\Player@sgaSubmitPost');
        // Mixed
        Router::match(['get', 'post'], '/chatSearch', 'Admin\Player@chatSearch');
        Router::match(['get', 'post'], '/edit', 'Admin\Player@edit');
        Router::match(['get', 'post'], '/editWhItems', 'Admin\Player@editWhItems');
        Router::match(['get', 'post'], '/deleteWhItems', 'Admin\Player@deleteWhItems');
        Router::match(['get', 'post'], '/itemDelete', 'Admin\Player@itemDelete');
        Router::match(['get', 'post'], '/itemEdit', 'Admin\Player@itemEdit');
        Router::match(['get', 'post'], '/jail', 'Admin\Player@jail');
        Router::match(['get', 'post'], '/linkedGear', 'Admin\Player@linkedGear');
        Router::match(['get', 'post'], '/restore', 'Admin\Player@restore');
        Router::match(['get', 'post'], '/unJail', 'Admin\Player@unJail');
    });
    // Misc
    Router::group(['prefix' => '/misc'], function () {
        // GET
        Router::get('/itemList', 'Admin\Misc@itemList');
        Router::get('/mobList', 'Admin\Misc@mobList');
        Router::get('/playersOnline', 'Admin\Misc@playersOnline');
        Router::get('/statPadders', 'Admin\Misc@statPadders');
        Router::get('/worldChat', 'Admin\Misc@worldChat');
        // Mixed
        Router::match(['get', 'post'], '/actionLog', 'Admin\Misc@actionLog');
        Router::match(['get', 'post'], '/disbandGuild', 'Admin\Misc@disbandGuild');
        Router::match(['get', 'post'], '/guildLeaderChange', 'Admin\Misc@guildLeaderChange');
        Router::match(['get', 'post'], '/guildNameChange', 'Admin\Misc@guildNameChange');
        Router::match(['get', 'post'], '/guildSearch', 'Admin\Misc@guildSearch');
        Router::match(['get', 'post'], '/itemSearchCat', 'Admin\Misc@itemSearchCat');
        Router::match(['get', 'post'], '/itemSearchName', 'Admin\Misc@itemSearchName');
        Router::match(['get', 'post'], '/manageGuilds', 'Admin\Misc@manageGuilds');
    });
    // SExtended
    Router::group(['prefix' => '/sExtended'], function () {
        // Mixed
        Router::match(['get', 'post'], '/sendNotice', 'Admin\SExtended@sendNotice');
        Router::match(['get', 'post'], '/sendPlayerNotice', 'Admin\SExtended@sendPlayerNotice');
        Router::match(['get', 'post'], '/sendPlayerPM', 'Admin\SExtended@sendPlayerPM');
        Router::match(['get', 'post'], '/sendTradeChat', 'Admin\SExtended@sendTradeChat');
    });
    // Game Sage
    Router::group(['prefix' => '/gs'], function () {
        // GET
        Router::get('/playersOnline', 'Admin\Misc@mobList');
        Router::get('/worldChat', 'Admin\Misc@playersOnline');
    });
});

// Error Handling

Router::get('/errors/404', 'Errors@error404');

Router::error(function (Request $request, \Exception $exception) {
    if ($exception instanceof NotFoundHttpException && $exception->getCode() === 404) {
        abort(404);
    }
    if ($exception instanceof BadMethodCallException && $exception->getCode() === 405) {
        abort(405);
    }
    if ($exception instanceof BadRequestException && $exception->getCode() === 400) {
        abort(400);
    }
});
