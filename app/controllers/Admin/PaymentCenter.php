<?php

namespace Controllers\Admin;

use Core\CoreController;
use Models;
use Utils;
use Sys\LogSys;

class PaymentCenter extends CoreController
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->logSys = new LogSys;
        $this->user = new Utils\User;
    }

    public function addDonation()
    {
        $donations = $this->model(Models\Admin\PaymentCenter\Donations::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'donations' => $donations
        ];

        $this->view('pages/ap/paymentCenter/addDonation', $data);
    }

    public function editDonation($id)
    {
        $donations = $this->model(Models\Admin\PaymentCenter\Donations::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'donations' => $donations,
            'id'    => $id
        ];

        $this->view('pages/ap/paymentCenter/editDonation', $data);
    }

    public function manageDonations()
    {
        $donations = $this->model(Models\Admin\PaymentCenter\Donations::class);

        $data = [
            'user' => $this->user,
            'logSys' => $this->logSys,
            'donations' => $donations
        ];

        $this->view('pages/ap/paymentCenter/manageDonations', $data);
    }

    public function payments()
    {
        $payments = $this->model(Models\Admin\PaymentCenter\Payments::class);

        $data = [
            'data' => $this->data,
            'user' => $this->user,
            'logSys' => $this->logSys,
            'payments' => $payments
        ];

        $this->view('pages/ap/paymentCenter/payments', $data);
    }

    /* Post Methods */

    public function editDonationOpt()
    {
        $donations = $this->model(Models\Admin\PaymentCenter\Donations::class);
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $id = isset($decoded['id']) ? $this->data->purify(trim($decoded['id'])) : false;
                $reward = isset($decoded['reward']) ? $this->data->purify(trim($decoded['reward'])) : false;
                $bonus = isset($decoded['bonus']) ? $this->data->purify(trim($decoded['bonus'])) : false;
                $price = isset($decoded['price']) ? $this->data->purify(trim($decoded['price'])) : false;
                $errors = [];

                // Error Checking
                if (isset($reward)) {
                    // Validate Code
                    if (empty($reward)) {
                        $errors[] .= 'Reward can not be empty.';
                    } elseif (!is_numeric($reward)) {
                        $errors[] .= 'Reward must be a number/integer.';
                    }
                    if (isset($bonus) && !empty($bonus) && $bonus != 'NULL') {
                        if (!is_numeric($bonus)) {
                            $errors[] .= 'Bonus must be a number/integer.';
                        }
                    }
                    if (empty($price)) {
                        $errors[] .= 'Price can not be empty.';
                    } elseif (!preg_match("/^[-]{0,2}\d{1,3}(?:,?\d{3})*(?:\.\d{0,2})?$/", $price)) {
                        $errors[] .= 'Price must be a valid currency amount.';
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        // Create Donation Item
                        //$donations->createDonation($reward, $price, $bonus);
                        if ($donations->getRewardById($id) !== $reward || $donations->getBonusById($id) != $bonus || $donations->getPriceById($id) !== $price) {
                            $donations->updateDonationById($id, $reward, $bonus, $price);
                        } else {
                            echo 'No changes found. No update made.';
                        }
                    }
                    // Display errors
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

    public function submitDonation()
    {
        $donations = $this->model(Models\Admin\PaymentCenter\Donations::class);
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $reward = isset($decoded['reward']) ? $this->data->purify(trim($decoded['reward'])) : false;
                $bonus = isset($decoded['bonus']) ? $this->data->purify(trim($decoded['bonus'])) : false;
                $price = isset($decoded['price']) ? $this->data->purify(trim($decoded['price'])) : false;
                $errors = [];

                // Error Checking
                if (isset($reward)) {
                    // Validate Code
                    if (empty($reward)) {
                        $errors[] .= 'Reward can not be empty.';
                    } elseif (!is_numeric($reward)) {
                        $errors[] .= 'Reward must be a number/integer.';
                    }
                    if (isset($bonus) && !empty($bonus)) {
                        if (!is_numeric($bonus)) {
                            $errors[] .= 'Bonus must be a number/integer.';
                        }
                    }
                    if (empty($price)) {
                        $errors[] .= 'Price can not be empty.';
                    } elseif (!preg_match("/^[-]{0,2}\d{1,3}(?:,?\d{3})*(?:\.\d{0,2})?$/", $price)) {
                        $errors[] .= 'Price must be a valid currency amount.';
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        // Create Donation Item
                        $donations->createDonation($reward, $price, $bonus);
                    }
                    // Display errors
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
