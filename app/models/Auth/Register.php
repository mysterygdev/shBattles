<?php

namespace App\Models\Auth;

use Illuminate\Database\Capsule\Manager as DB;
use Classes\Sys\MailSys as Mail;

class Register
{
    public function __construct($user, $session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->user = $user;
    }

    public function insertUserData($userId, $pw, $date, $userIp)
    {
        $stmt = DB::table(table('shUserData'))
        ->insert([
            'UserID' => $userId,
            'Pw' => $pw,
            'JoinDate' => $date,
            'Admin' => 0,
            'AdminLevel' => 0,
            'UseQueue' => 0,
            'Status' => 0,
            'Leave' => 0,
            'LeaveDate' => $date,
            'UserType' => 'N',
            'Point' => 0,
            'UserIp' => $userIp,
        ]);
        if ($stmt) {
            echo 'Your account, <font class="b_i">' . $userId . ',</font> has been successfully created!<br>';
        } else {
            echo 'Game account creation has failed. Please contact an admin for assistance.<br>';
        }
    }

    public function insertWebData($userId, $pw, $displayName, $sQuestion, $sAnswer, $email, $userIp, $recoveryKey = null)
    {
        $stmt = DB::table(table('webPresence'))
        ->insert([
            'UserID' => $userId,
            'Pw' => $pw,
            'DisplayName' => $displayName,
            'DOB' => null,
            'Gender' => null,
            'Referer' => null,
            'SecQuestion' => $sQuestion,
            'SecAnswer' => $sAnswer,
            'ActivationKey' => null,
            'Email' => $email,
            'Admin' => 0,
            'Status' => 0,
            'UserIP' => $userIp,
            'RecoveryKey' => $recoveryKey
        ]);
        if ($stmt) {
            echo 'Your web account, <font class="b_i">' . $displayName . ' for ' . $userId . ',</font> has been successfully created!<br>';
        } else {
            echo 'Web account creation has failed. Please contact an administrator for assistance.<br>';
        }
    }

    public function getRecoveryKey($recoveryKey)
    {
        $res = DB::table(table('webPresence'))
            ->select()
            ->where('RecoveryKey', $recoveryKey)
            ->get();
        return $res;
    }

    public function countRecoveryKey($recoveryKey)
    {
        return count($this->getRecoveryKey($recoveryKey));
    }

    public function doAutoLogin()
    {
        //
    }

    public function getEmailBody($displayName, $userId, $pw, $recoveryKey, $activationKey)
    {
        $activationLink = APP['domain'] . 'auth/verify/' . $activationKey;
        $msgBody = 'If you haven\'t registered an account on ' . APP['title'] . ', you can ignore this email.<br><br>';
        $msgBody .= 'Your email address has been used to register an account on Shaiya Abyss. To complete your registration, click <a href="' . $activationLink . '">here</a>.<br<br>';
        $msgBody .= 'If you cannot click the above link, simply copy and paste the following link into your address bar.<br>';
        $msgBody .= $activationLink . '<br><br>';
        $msgBody .= 'Your display name is ' . $displayName . '<br>';
        $msgBody .= 'Your username is ' . $userId . '<br>';
        $msgBody .= 'Your password is ' . $pw . '<br>';
        $msgBody .= 'Your security key is ' . $recoveryKey . '<br><br>';
        $msgBody .= 'Please save your security key a safe place since you will need it to confirm your identity if you ever lose access to your account.<br><br>';
        $msgBody .= 'Please do not reply to this email as it is not monitored.<br><br>';
        $msgBody .= 'Regards,<br>';
        $msgBody .= APP['title'] . ' Team';
        $msgBody = preg_replace('/\\\\/', '', $msgBody);
        return $msgBody;
    }

    public function sendEmail($host, $toEmail, $subject, $body)
    {
        $this->mailSys = new Mail($host);
        $this->mailSys->addMailAddress($toEmail);
        $this->mailSys->addMessageSubjectToMail($subject);
        $this->mailSys->addMessageBodyToMail($body);
        if ($this->mailSys->sendMail()) {
            echo 'Confirmation email has been successfully sent.<br>';
            echo 'If you cannot find the email please check your spam folder.';
        } else {
            echo 'Confirmation email could not be sent. Please contact an staff member.';
        }
    }
}
