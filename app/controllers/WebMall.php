<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class WebMall extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    /* Get Methods */

    public function cart()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/cart', $data);
    }

    public function checkout()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/checkout', $data);
    }

    public function orderFail()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/orderFail', $data);
    }

    public function orders()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/orders', $data);
    }

    public function orderSuccess()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/orderSuccess', $data);
    }

    public function webmall($name = false)
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user,
            'widgets' => $widgets,
            'category' => $name,
        ];

        $this->view('pages/cms/game/webmall/webmall', $data);
    }

    public function tieredSpender()
    {
        $tiered = $this->model(Models\Game\TieredSpender::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'tiered' => $tiered,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/webmall/tieredSpender/tieredspender', $data);
    }

    /* Post Methods */

    public function cartAction()
    {
        $webMall = $this->model(Models\Game\WebMall::class);

        $data = [
            'webmall' => $webMall,
            'user' => $this->user
        ];

        $this->view('pages/cms/game/webmall/cartAction', $data);
    }

    public function couponAdd()
    {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));
            $decoded = json_decode($content, true);
            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $code = isset($decoded['code']) ? $this->data->purify(trim($decoded['code'])) : false;
                $errors = [];
                // Error Checking
                if (isset($code)) {
                    // Validate Coupon Code
                    if (empty($code)) {
                        $errors[] .= 'Coupon code can not be empty.';
                    }
                    $chkCode = DB::table(table('productDiscounts'))
                        ->select()
                        ->where('CouponCode', $code)
                        ->limit(1)
                        ->get();
                    if (count($chkCode) < 1 && !empty($code)) {
                        $errors[] .= 'Coupon code doesnt exist';
                    }
                    if ($this->session->has('WebMall', 'CouponCode')) {
                        $errors[] .= 'Coupon code already added.';
                        $this->session->forget('WebMall');
                    }
                    // TODO: check if code still valid and not expired
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        // Check if coupon code is already added
                        $this->session->put('WebMall', $code, 'CouponCode');
                        //show how much off price was taken
                        echo '<div class="alert alert-success" role="alert">';
                        echo '<strong>Awesome!</strong> This coupon code has successfully been added.';
                        echo '</div>';
                        redirect_html('/game/webmall/checkout', 1);
                    }
                    if (count($errors)) {
                        echo '<ul>';
                        foreach ($errors as $error) {
                            echo '<li>' . $error . '</li>';
                        }
                        echo '</ul>';
                    }
                }
            }
        }
    }
}
