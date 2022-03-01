<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models;
use Classes\Utils;
use Illuminate\Database\Capsule\Manager as DB;

class User extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    /* Get Methods */

    public function claimReward($id)
    {
        $rewards = $this->model(Models\Game\Rewards::class, $this->user, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'rewards' => $rewards,
            'user' => $this->user,
            'widgets' => $widgets,
            'id' => $id
        ];

        $this->view('pages/cms/user/claimReward', $data);
    }

    public function donate()
    {
        $donate = $this->model(Models\User\Donate::class, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'donate' => $donate,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/user/donate/donate', $data);
    }

    public function donateProcess()
    {
        $donate = $this->model(Models\User\Donate::class, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'donate' => $donate,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/user/donate/donateProcess', $data);
    }

    public function donateComplete()
    {
        $donate = $this->model(Models\User\Donate::class, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'donate' => $donate,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/user/donate/donateComplete', $data);
    }

    public function listenerAdv()
    {
        $donate = $this->model(Models\User\Donate::class, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'donate' => $donate,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/user/donate/paypal/listenerAdv', $data);
    }

    public function login()
    {
        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/auth/login', $data);
    }

    public function moveTerra()
    {
        $terra = $this->model(Models\User\MoveTerra::class, $this->user, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'terra' => $terra,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/user/moveTerra', $data);
    }

    public function panel($page = false)
    {
        $panel = $this->model(Models\User\UserPanel::class, $this->user, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'panel' => $panel,
            'data' => $this->data,
            'user' => $this->user,
            'widgets' => $widgets,
            'page' => $page
        ];

        $this->view('pages/cms/user/panel', $data);
    }

    public function register()
    {
        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'captcha' => $this->captcha,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/auth/register', $data);
    }

    public function settings()
    {
        $settings = $this->model(Models\User\Settings::class, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'settings' => $settings,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/user/settings', $data);
    }

    public function shareDp()
    {
        $shareDp = $this->model(Models\User\ShareDP::class, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'share' => $shareDp,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/user/shareDp', $data);
    }

    /* Post Methods */

    public function getRecoveryKey()
    {
        $getKey = DB::table(table('webPresence'))
                ->where('UserID', $_SESSION['User']['UserID'])
                ->value('RecoveryKey');

        $sName = SERVER['name'];
        $data = [
            'sName' => $sName,
            'rKey' => $getKey
        ];
        echo json_encode($data);
    }

    public function shareDpPost()
    {
        $share = $this->model(Models\User\ShareDP::class);
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $dp = isset($decoded['dp']) ? $this->data->purify(trim($decoded['dp'])) : false;
                $char = isset($decoded['char']) ? $this->data->purify(trim($decoded['char'])) : false;
                $errors = [];

                // Error Checking
                if (isset($decoded['dp'])) {
                    // Validate DP
                    if (empty($dp)) {
                        $errors[] .= 'Please provide an amount of donation points to send.';
                    } elseif (!is_numeric($dp)) {
                        $errors[] .= 'DP must be numeric.';
                    }
                    // Validate Char
                    if (empty($char)) {
                        $errors[] .= 'Please provide a character to send the donation points to.';
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        //
                        $senderDp = $share->getSenderDp();
                        $receiver = $share->getReceiver($char);
                        $receiverDp = $share->getReceiverDp($receiver);
                        //echo 'sender: ' . $senderDp;
                        //echo 'receiver dp: ' . $receiverDp;
                        if (!$share->sendDp($receiverDp, $dp, $receiver)) {
                            echo 'Failed to share dp. Please try again.';
                        } else {
                            echo 'Successfully shared ' . $dp . ' dp to: ' . $char;
                        }
                    }
                    // Display errors
                    if (count($errors)) {
                        echo '<ul class="responseE">';
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
