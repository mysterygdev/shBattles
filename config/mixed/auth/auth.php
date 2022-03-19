<?php
    return [
        // how many accounts can a user create?
        'accLimit' => 3,
        'recoveryKey' => true,
        'sendEmail' => false,
        // auto login user after register?
        'autoLogin' => true,
        // options: google, lapis, code, ONLY GOOGLE WORKING AMT
        // change recaptcha to recaptchaMethod?
        'recaptcha' => 'google',
        // would you like to use recaptcha? true/false
        'recaptchaEnabled' => false,
        // for future, v2,v3
        'googleRecaptchaType' => '',
        // google site/client key
        'googleSiteKey' => '6LfVT-0eAAAAAGJJzqlXlo1stVPUtskbD3m_ERel',
        // google secret/server key
        'googleSecretKey' => '6LfVT-0eAAAAAJFleUIRhsvBf6HAWJ6f2Qi78UBO',
        'passwordReqmnts' => false
    ];
