<?php

namespace Classes\Donate\Paypal;

use Illuminate\Database\Capsule\Manager as DB;

class Paypal
{
    // PayPal Debug Status
    public $paypalDebug;
    // PayPal Receiver E-mail Address
    public $paypalReceiver;
    // PayPal Sandbox URI
    public $paypalSandBoxUri;
    // PayPal Standard URI
    public $paypalStandardUri;
    // PayPal URI
    public $paypalUri;
    // PayPal Sandbox Status
    public $paypalSandBox;
    // PayPal Send Confirmation E-mail
    public $paypalConfEmail;
    // @var bool $use_local_certs
    // Indicates if the local certificates are used.
    private $useLocalCerts = false;
    // Production Postback URL
    private $verifyUri;
    // Sandbox Postback URL
    private $sandBoxVerifyUri;
    // Response from PayPal indicating validation was successful
    private $valid;
    // Response from PayPal indicating validation failed
    private $invalid;

    public function __construct()
    {
        $this->getPaypalDebug();
        $this->getPaypalReceiver();
        $this->getPaypalSandbox();
        $this->getPaypalConfEmail();
        $this->getPaypalSandBoxUri();
        $this->getPaypalStandardUri();
        $this->paypalUri();

        $this->getValid();
        $this->getInvalid();
    }

    public function getPaypalDebug()
    {
        $this->paypalDebug = PAYPAL['debug'];
    }

    public function getPaypalReceiver()
    {
        $this->paypalReceiver = PAYPAL['receiver'];
    }

    public function getPaypalSandbox()
    {
        $this->paypalSandBox = PAYPAL['sandbox'];
    }

    public function getPaypalConfEmail()
    {
        $this->paypalConfEmail = PAYPAL['conf_email'];
    }

    public function getPaypalSandBoxUri()
    {
        $this->paypalSandBoxUri = PAYPAL['sandbox_uri'];
    }

    public function getPaypalStandardUri()
    {
        $this->paypalStandardUri = PAYPAL['standard_uri'];
    }

    public function paypalUri()
    {
        if ($this->paypalSandBox) {
            $this->paypalUri = $this->paypalSandBoxUri;
        } else {
            $this->paypalUri = $this->paypalStandardUri;
        }
    }

    public function donateInfo($Key, $method)
    {
        // code here
        try {
            $res = DB::table(table('donateOptions'))
                ->select('RowID', 'Reward', 'Price')
                ->where('RowID', $Key)
                ->get();

            if (count($res) > 0) {
                foreach ($res as $data) {
                    if ($method == 'paypal') {
                        if ($this->paypalDebug) {
                            // Error Checking
                            echo '<pre>';
                            echo 'UserUID: ' . $_SESSION['User']['UserUID'] . '<br>';
                            echo 'E-Mail: ' . $this->paypalReceiver . '<br><br>';

                            echo 'RowID: ' . $data->RowID . '<br>';
                            echo 'Price: ' . $data->Price . '<br>';
                            echo 'Reward: ' . $data->Reward . '<br><br>';

                            echo 'Site URI: ' . APP['domain'] . '<br>';
                            echo 'Donation URI: ' . APP['domain'] . '/user/donate<br>';
                            echo 'Donation Return URI: ' . APP['domain'] . '/user/donateComplete<br>';
                            echo 'Notify URI: ' . APP['domain'] . '/user/paypal/listenerAdv<br>';
                            echo 'PayPal URI: ' . $this->paypalUri . '<br><br>';

                            echo 'PayPal Debug: ' . $this->paypalDebug . '<br><br>';

                            if ($this->paypalConfEmail) {
                                echo 'PayPal Confirmation Email: Enabled';
                            } else {
                                echo 'PayPal Confirmation Email: Disabled';
                            }

                            echo '</pre>';
                        } else {
                            // Submit To PayPal
                            $paypalUrl = $this->paypalUri . '/?cmd=_donations&amount=' . urlencode($data->Price) . '&business=' . urlencode($this->paypalReceiver) . '&item_name=' . urlencode($data->Reward) . '%20Points&item_number=' . urlencode($data->RowID . '_' . $_SESSION['User']['UserUID']) . '&return=' . APP['domain'] . '/user/donateComplete&rm=1&notify_url=' . APP['domain'] . '/user/paypal/listenerAdv&cancel_return=' . APP['domain'] . '/user/donate&no_note=1&currency_code=USD';
                            header('Refresh: 3;url=' . $paypalUrl);
                        }
                    }
                }
            } else {
                echo 'Reward ID does not exist! Please make sure you checked a donation option. Click <a href="/user/donate">here</a> to go back.';
            }
        } catch (\Exception $e) {
            echo 'An error has occured.';
        }
    }

    public function getValid()
    {
        $this->valid = 'VERIFIED';
    }

    public function getInvalid()
    {
        $this->invalid = 'INVALID';
    }

    // Sets the IPN verification to sandbox mode (for use when testing,
    // should not be enabled in production).
    // @return void
    public function useSandbox()
    {
        $this->paypalSandBox;
    }

    // Sets curl to use php curl's built in certs (may be required in some environments).
    // @return void
    public function usePHPCerts()
    {
        $this->useLocalCerts = false;
    }

    // Determine endpoint to post the verification data to.
    // @return string
    public function getPaypalUri()
    {
        if ($this->paypalSandBox) {
            return $this->paypalSandBoxUri;
        }
        return $this->paypalStandardUri;
    }

    // Verification Function
    // Sends the incoming post data back to PayPal using the cURL library.
    // @return bool
    // @throws Exception
    public function verifyIPN()
    {
        if (!count($_POST)) {
            throw new \Exception('Missing POST Data');
        }
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = [];
        foreach ($raw_post_array as $keyval) {
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2) {
                // Since we do not want the plus in the datetime string to be encoded to a space, we manually encode it.
                if ($keyval[0] === 'payment_date') {
                    if (substr_count($keyval[1], '+') === 1) {
                        $keyval[1] = str_replace('+', '%2B', $keyval[1]);
                    }
                }
                $myPost[$keyval[0]] = urldecode($keyval[1]);
            }
        }
        // Build the body of the verification post request, adding the _notify-validate command.
        $req = 'cmd=_notify-validate';
        $get_magic_quotes_exists = false;
        if (function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }
        // Post the data back to PayPal, using curl. Throw exceptions if errors occur.
        $ch = curl_init($this->getPaypalUri());
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // This is often required if the server is missing a global cert bundle, or is using an outdated one.
        if ($this->useLocalCerts) {
            curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . 'cert/cacert.pem');
        }
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Connection: Close']);
        $res = curl_exec($ch);
        if (!($res)) {
            $errno = curl_errno($ch);
            $errstr = curl_error($ch);
            curl_close($ch);
            throw new \Exception("cURL error: [$errno] $errstr");
        }
        $info = curl_getinfo($ch);
        $http_code = $info['http_code'];
        if ($http_code != 200) {
            throw new \Exception("PayPal responded with http code $http_code");
        }
        curl_close($ch);
        // Check if PayPal verifies the IPN data, and if so, return true.
        if ($res == $this->valid) {
            return true;
        } else {
            return false;
        }
    }
}
