<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models;
use Illuminate\Database\Capsule\Manager as DB;
use Classes\Utils as Utils;

class Auth extends Controller
{
    private $arr = [];

    public function __construct()
    {
        $this->browser = new Utils\Browser;
        $this->session = new Utils\Session;
        $this->auth = new Utils\Auth($this->session);
        $this->data = new Utils\Data;
        $this->user = new Utils\User($this->session);
    }

    /* Get Methods */
    public function captcha()
    {
        $this->view('pages/cms/auth/captcha/captcha');
    }

    public function forgotPassword()
    {
        $verify = $this->model(Models\Auth\Verify::class);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'verify' => $verify,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/auth/forgotPassword', $data);
    }

    public function logout()
    {
        /* $data = [
            'pageData' => [
                'index' => 'index',
                'title' => 'Home',
                'zone' => 'CMS',
                'nav' => true
            ],
        ];
        Auth::logout(); */

        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $arr = [
                    'loggedOut' => true
                ];

                $this->auth->logout();
            }
            echo json_encode($arr);
        } else {
            $this->auth->logout();
        }
    }

    public function verify($name)
    {
        $verify = $this->model(Models\Auth\Verify::class, $this->user, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'verify' => $verify,
            'user' => $this->user,
            'widgets' => $widgets,
            'id' => $name,
        ];

        $this->view('pages/cms/auth/verify', $data);
    }

    /* Post Methods */

    public function changePassword()
    {
        //post to logout
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                // Declare Required Variables
                $Password = isset($decoded['pw']) ? $this->data->purify(trim($decoded['pw'])) : false;
                $newPassword = isset($decoded['new_pass']) ? $this->data->purify(trim($decoded['new_pass'])) : false;
                $confirmNewPassword = isset($decoded['conf_pass']) ? $this->data->purify(trim($decoded['conf_pass'])) : false;
                $errors = [];
                // Error Checking
                if (isset($decoded['pw'])) {
                    // Validate Current Password
                    if (empty($Password)) {
                        $errors[] .= 'Please provide a current password.';
                    } else {
                        $fet = DB::table(table('shUserData'))
                            ->select('PwPlain')
                            ->where('UserID', $_SESSION['User']['UserID'])
                            ->where('PwPlain', $Password)
                            ->limit(1)
                            ->get();
                        if (count($fet) == 0) {
                            $errors[] .= 'Password is incorrect.';
                        }
                    }

                    // Validate New Passwords
                    if (empty($newPassword)) {
                        $errors[] .= 'Please provide a new password.';
                    } elseif ($newPassword != $confirmNewPassword) {
                        $errors[] .= 'New passwords do not match.';
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
                        $update = DB::table(table('webPresence'))
                            ->where('UserID', $_SESSION['User']['UserID'])
                            ->update(['Pw' => $hash]);
                        $update2 = DB::table(table('shUserData'))
                            ->where('UserID', $_SESSION['User']['UserID'])
                            ->update(['Pw' => $newPassword]);
                        if ($update && $update2) {
                            echo 'Password for : User: ' . $_SESSION['User']['UserID'] . ' Has been changed to: ' . $newPassword . ' successfully';
                        } else {
                            echo 'Could not successfully change password.';
                        }
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

    public function forgotPasswordPost()
    {
        $cPw = $this->model(Models\Auth\ChangePassword::class, $this->user, $this->session);
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $userId = isset($decoded['user']) ? $this->data->purify(trim($decoded['user'])) : false;
                $email = isset($decoded['email']) ? $this->data->purify(trim($decoded['email'])) : false;
                $recKey = isset($decoded['recKey']) ? $this->data->purify(trim($decoded['recKey'])) : false;
                $pw = isset($decoded['pw']) ? $this->data->purify(trim($decoded['pw'])) : false;
                $pw2 = isset($decoded['pw2']) ? $this->data->purify(trim($decoded['pw2'])) : false;
                $captcha = isset($decoded['captcha']) ? $this->data->purify(trim($decoded['captcha'])) : false;
                $captchaUser = filter_var($decoded['captcha'], FILTER_SANITIZE_STRING);
                // Error Checking
                $errors = [];

                if (isset($userId)) {
                    // Validate Username
                    if (empty($userId)) {
                        $errors[] .= 'Please provide a UserID.';
                    } elseif (ctype_alnum($userId) === false) {
                        $errors[] .= 'UserID must consist of numbers and letters only.';
                    }
                    if (!empty($userId)) {
                        $chkUser = DB::table(table('shUserData'))
                            ->select('UserID')
                            ->where('UserID', $userId)
                            ->limit(1)
                            ->get();
                        if (count($chkUser) < 1) {
                            $errors[] .= 'UserID doesn\'t exist.';
                        }
                    }
                    // Validate Email
                    if (empty($email)) {
                        $errors[] .= 'Please provide your e-mail.';
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] .= 'Invalid e-mail format.';
                    }
                    if (!empty($email)) {
                        $chkEmail = DB::table(table('webPresence'))
                            ->select('Email')
                            ->where('Email', $email)
                            ->limit(1)
                            ->get();
                        if (count($chkEmail) < 1) {
                            $errors[] .= 'The e-mail address provided doesn\'t match.';
                        }
                    }
                    // Validate Recovery Key
                    if (empty($recKey)) {
                        $errors[] .= 'Recovery key can not be empty.';
                    } elseif (ctype_alnum($recKey) === false) {
                        $errors[] .= 'Please provide a valid Recovery Key.';
                    }
                    if (!empty($recKey)) {
                        $chkKey = DB::table(table('webPresence'))
                            ->select()
                            ->where('RecoveryKey', $recKey)
                            ->where('UserID', $userId)
                            ->limit(1)
                            ->get();
                        if (count($chkKey) < 1) {
                            $errors[] .= 'Recovery Key doesn\'t exist.';
                        }
                    }
                    // Validate Password
                    if (empty($pw)) {
                        $errors[] .= 'Please provide a password.';
                    } elseif ($pw != $pw2) {
                        $errors[] .= 'Passwords do not match.';
                    }
                    // Validate Captcha
                    if (AUTH['recaptchaEnabled'] == true && AUTH['recaptcha'] == 'code') {
                        if (empty($captcha)) {
                            $errors[] .= 'Please enter the captcha.';
                        } elseif ($_SESSION['CAPTCHA_CODE'] !== $captchaUser) {
                            $errors[] .= 'Captcha is invalid.';
                        }
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        $hash = password_hash($pw, PASSWORD_DEFAULT);
                        $update = DB::table(table('webPresence'))
                            ->where('UserID', $userId)
                            ->update(['Pw' => $hash]);
                        $update2 = DB::table(table('shUserData'))
                            ->where('UserID', $userId)
                            ->update(['Pw' => $pw]);
                        if ($update && $update2) {
                            echo 'Password for : User: ' . $userId . ' Has been changed to: ' . $pw . ' successfully.<br>';
                            // send email when change password success
                            if (AUTH['sendEmail']) {
                                // Send Email
                                $msgBody = $cPw->getEmailBody(
                                    $userId
                                );
                                $cPw->sendEmail(
                                    'gmail',
                                    $email,
                                    'Your password has been changed',
                                    $msgBody
                                );
                            }
                        } else {
                            echo 'Could not successfully change password.';
                        }
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

    public function login()
    {
        //post to logout
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                // Declare Required Variables
                $userName = isset($decoded['user']) ? $this->data->purify(trim($decoded['user'])) : false;
                $Password = isset($decoded['pw']) ? $this->data->purify(trim($decoded['pw'])) : false;
                $captcha = isset($decoded['captcha']) ? $this->data->purify(trim($decoded['captcha'])) : false;
                //$captchaUser = filter_var($decoded['captcha'], FILTER_SANITIZE_STRING);
                $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
                $errors = [];
                // Error Checking
                if (isset($decoded['user'])) {
                    // Validate Username
                    if (empty($userName)) {
                        $errors[] .= 'A Username or Email is required. How else would you be able to log in?';
                    }
                    // Validate Password
                    if (empty($Password)) {
                        $errors[] .= 'A password is required for all accounts.<br>Please provide a password.';
                    } elseif (strlen($Password) < 3 || strlen($Password) > 16) {
                        $errors[] .= 'Your password must be between 3 and 16 characters in length.';
                    }
                    // Validate Captcha
                    /* if (AUTH['recaptchaEnabled'] == true && AUTH['recaptcha'] == 'code') {
                        if (empty($captcha)) {
                            $errors[] .= 'Please enter the captcha.';
                        } elseif ($_SESSION['CAPTCHA_CODE'] !== $captchaUser) {
                            $errors[] .= 'Captcha is invalid.';
                        }
                    } */
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        $fet = DB::table(table('webPresence') . ' as Web')
                            ->select(['[User].UserUID', 'Web.UserID', 'Web.Pw', 'Web.Email', '[User].Status', 'Web.RestrictIP'])
                            ->join(table('shUserData') . ' as  [User]', '[User].UserID', '=', 'Web.UserID')
                            ->where('Web.UserID', $userName)
                            ->orWhere('Web.Email', $userName)
                            ->get();
                        if ($fet) {
                            foreach ($fet as $userInfo) {
                                if (password_verify($Password, $userInfo->Pw)) {
                                    if ($userInfo->Status == 0 || $userInfo->Status == 16 || $userInfo->Status == 32 || $userInfo->Status == 48 || $userInfo->Status == 64 || $userInfo->Status == 80 || $userInfo->Status == 128) {
                                        $this->session->put('User', $userInfo->UserUID, 'UserUID');
                                        $this->session->put('User', $userInfo->UserID, 'UserID');
                                        $this->session->put('User', $userInfo->Status, 'Status');
                                        $this->user->updateLoginStatus(1);
                                        $errors[] .= 'Login successful.<br>Loading your homepage now...';
                                        redirect_html('/', 3);
                                    } else {
                                        $errors[] .= 'Your account has been banned due to rules infractions.<br>To find out what infraction you were banned for, as well as ban period,<br>please ask a GM or GS.';
                                    }
                                } else {
                                    $errors[] .= 'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.';
                                }
                            }
                        } else {
                            $errors[] .= 'Unable to locate an account with the information that you provided.<br>If you believe this to be in error, please notify an Admin so that this issue can be resolved.';
                        }
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

    public function register()
    {
        $register = $this->model(Models\Auth\Register::class, $this->user, $this->session);

        //post to logout
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                // Declare Required Variables
                $displayName = isset($decoded['display']) ? $this->data->purify(trim($decoded['display'])) : false;
                $userName = isset($decoded['user']) ? $this->data->purify(trim($decoded['user'])) : false;
                $Password = isset($decoded['pw']) ? $this->data->purify(trim($decoded['pw'])) : false;
                $confirmPassword = isset($decoded['pw2']) ? $this->data->purify(trim($decoded['pw2'])) : false;
                $email = isset($decoded['email']) ? $this->data->purify(trim($decoded['email'])) : false;
                $captcha = isset($decoded['captcha']) ? $this->data->purify(trim($decoded['captcha'])) : false;
                $sQuestion = isset($decoded['sQuestion']) ? $this->data->purify(trim($decoded['sQuestion'])) : false;
                $sAnswer = isset($decoded['sAnswer']) ? $this->data->purify(trim($decoded['sAnswer'])) : false;
                $terms = isset($decoded['terms']) ? $this->data->purify(trim($decoded['terms'])) : false;
                //$captchaUser = filter_var($decoded['captcha'], FILTER_SANITIZE_STRING);
                $activationKey = $this->data->randStr();
                // 22 length string
                $recoveryKey = $this->data->randBytes(11);
                //$SecurId = mt_rand(100000, 999999);
                //$SecondarySecurId = mt_rand(100000, 999999) . mt_rand(100000, 999999) . mt_rand(100000, 999999);
                $date = \Carbon\Carbon::now();
                $errors = [];
                // Error Checking
                if (isset($decoded['display'])) {
                    // Validate Display Name
                    if (empty($displayName)) {
                        $errors[] .= 'Please provide a display name.';
                    } elseif (ctype_alnum($displayName) === false) {
                        $errors[] .= 'Display name must consist of numbers and letters only.';
                    }
                    $chkDisplay = DB::table(table('webPresence'))
                        ->select('DisplayName')
                        ->where('DisplayName', $displayName)
                        ->limit(1)
                        ->get();
                    if (count($chkDisplay) > 0) {
                        $errors[] .= 'Display name is already in use.';
                    }

                    // Validate Username
                    if (empty($userName)) {
                        $errors[] .= 'Please provide a UserID.';
                    } elseif (strlen($userName) > 18) {
                        $errors[] .= 'UserID can not contain more than 18 characters.';
                    } else if(preg_match('/[^a-zA-Z0-9*+\/]+$/', $userName)) {
                        $errors[] .= 'UserID must consist of numbers and letters only.';
                    }
                    $chkUser = DB::table(table('shUserData'))
                        ->select('UserID')
                        ->where('UserID', $userName)
                        ->limit(1)
                        ->get();
                    if (count($chkUser) > 0) {
                        $errors[] .= 'UserID already exists, please choose a different UserID.';
                    }
                    // Validate Password
                    if (empty($Password)) {
                        $errors[] .= 'Please provide a password.';
                    } elseif (empty($confirmPassword)) {
                        $errors[] .= 'Confirmation password can not be empty.';
                    } elseif ($Password != $confirmPassword) {
                        $errors[] .= 'Passwords do not match.';
                    } elseif (strlen($Password) > 12 || strlen($confirmPassword) > 12) {
                        $errors[] .= 'Passwords can not contain more than 12 characters.';
                    }
                    // Validate Email
                    if (empty($email)) {
                        $errors[] .= 'Please provide your e-mail.';
                    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] .= 'Invalid e-mail format.';
                    }
                    $chkEmail = DB::table(table('webPresence'))
                        ->select('Email')
                        ->where('Email', $email)
                        ->limit(1)
                        ->get();
                    if (count($chkEmail) > 0) {
                        $errors[] .= 'The e-mail address provided has already been used. Please choose a different e-mail address.';
                    }
                    // Validate Security Question
                    if (empty($sQuestion)) {
                        $errors[] .= 'Please provide a security question.';
                    }
                    // Validate Security Answer
                    if (empty($sAnswer)) {
                        $errors[] .= 'Please provide a security answer.';
                    } elseif (strlen($sAnswer) > 50) {
                        $errors[] .= 'Security answer can not contain more than 50 characters.';
                    }
                    // Validate Terms of Use
                    if ($terms == 'off') {
                        $errors[] .= 'You must agree to our terms of use.';
                    }
                    // Validate Captcha
                    /* if (AUTH['recaptchaEnabled'] == true && AUTH['recaptcha'] == 'code') {
                        if (empty($captcha)) {
                            $errors[] .= 'Please enter the captcha.';
                        } elseif ($_SESSION['CAPTCHA_CODE'] !== $captchaUser) {
                            $errors[] .= 'Captcha is invalid.';
                        }
                    } */
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        $hash = password_hash($Password, PASSWORD_DEFAULT);
                        // check Accounts per IP
                        $fet = DB::table(table('shUserData'))
                            ->select()
                            ->where('UserIP', $this->browser->ip())
                            ->get();
                        $count = count($fet);
                        if ($count > REGISTER['accLimit']) {
                            echo 'It looks like you have created too many accounts! please contact a staff member!';
                        } else {
                            // Insert into shaiya users
                            $register->insertUserData($userName, $Password, $date, $this->browser->ip());
                            if (AUTH['recoveryKey']) {
                                // Check if Recovery Key has been used already
                                if ($register->countRecoveryKey($recoveryKey) < 1) {
                                    // If Recovery Key doesn't exist
                                    // Insert into Web users
                                    $register->insertWebData($userName, $hash, $displayName, $sQuestion, $sAnswer, $email, $this->browser->ip(), $recoveryKey);
                                /* if (AUTH['sendEmail']) {
                                    // Send Email
                                    $msgBody = $register->getEmailBody(
                                        $displayName,
                                        $userName,
                                        $Password,
                                        $recoveryKey,
                                        $activationKey
                                    );
                                    $register->sendEmail(
                                        'gmail',
                                        'brandonjm033@gmail.com',
                                        'Email Confirmation',
                                        $msgBody
                                    );
                                } */
                                } else {
                                    // Insert into Web users
                                    $register->insertWebData($userName, $hash, $displayName, $sQuestion, $sAnswer, $email, $this->browser->ip(), $recoveryKey);

                                    /* if (AUTH['sendEmail']) {
                                        // Send Email
                                        $msgBody = $register->getEmailBody(
                                            $displayName,
                                            $userName,
                                            $Password,
                                            $recoveryKey,
                                            $activationKey
                                        );
                                        $register->sendEmail(
                                            'gmail',
                                            'brandonjm033@gmail.com',
                                            'Email Confirmation',
                                            $msgBody
                                        );
                                    } */
                                }
                            }
                            if (REGISTER['autoLogin'] == true) {
                                //echo 'lets auto login';
                                // select new user and insert session
                                $fet = DB::table(table('shUserData'))
                                    ->select()
                                    ->where('UserID', $userName)
                                    ->where('PwPlain', $Password)
                                    ->get();
                                if ($fet) {
                                    foreach ($fet as $userInfo) {
                                        $this->session->put('User', $userInfo->UserUID, 'UserUID');
                                        $this->session->put('User', $userInfo->UserID, 'UserID');
                                        $this->session->put('User', $userInfo->Status, 'Status');
                                        $this->user->updateLoginStatus(1);
                                        redirect_html('/', 2);
                                    }
                                }
                            }
                        }
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

    public function verifyDisplayName()
    {
        //post to logout
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                // Declare Required Variables
                $displayName = isset($decoded['display']) ? $this->data->purify(trim($decoded['display'])) : false;
                $errors = [];
                // Error Checking
                if (isset($decoded['display'])) {
                    // Validate Current Password
                    if (empty($displayName)) {
                        $errors[] .= 'Cannot verify a empty display name.';
                    } elseif (ctype_alnum($displayName) === false) {
                        $errors[] .= 'Display name must consist of numbers and letters only.';
                    } else {
                        $fet = DB::table(table('webPresence'))
                            ->select('DisplayName')
                            ->where('DisplayName', $displayName)
                            ->limit(1)
                            ->get();
                        if (count($fet) == 1) {
                            $errors[] .= 'Display name is <strong>taken</strong>.';
                        } else {
                            $errors[] .= 'Display name is <strong>not taken</strong>.';
                        }
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        //
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

    public function verifyUserName()
    {
        //post to logout
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                // Declare Required Variables
                $userName = isset($decoded['user']) ? $this->data->purify(trim($decoded['user'])) : false;
                $errors = [];
                // Error Checking
                if (isset($decoded['user'])) {
                    // Validate Current Password
                    if (empty($userName)) {
                        $errors[] .= 'Cannot verify a empty user name.';
                    } elseif (ctype_alnum($userName) === false) {
                        $errors[] .= 'User name must consist of numbers and letters only.';
                    } else {
                        $fet = DB::table(table('shUserData'))
                            ->select('UserID')
                            ->where('UserID', $userName)
                            ->limit(1)
                            ->get();
                        if (count($fet) == 1) {
                            $errors[] .= 'User name is <strong>taken</strong>.';
                        } else {
                            $errors[] .= 'User name is <strong>not taken</strong>.';
                        }
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        //
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
