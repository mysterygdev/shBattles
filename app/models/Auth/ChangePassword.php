<?php

namespace App\Models\Auth;

use Classes\Utils as Utils;
use Classes\Sys\MailSys as Mail;

class ChangePassword
{
    public function __construct($user, $session)
    {
        $this->data = new \Classes\Utils\Data;
        $this->session = $session;
        $this->user = $user;
    }

    public function getEmailBody($displayName)
    {
        $msgBody = 'Hi, ' . $displayName . '<br>';
        $msgBody .= 'Your password change was successful.<br>';
        $msgBody .= 'If you did not change your password, your password may be compromised.<br>';
        $msgBody .= 'If this is the case please contact an administrator or support team immediately.<br>';
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
