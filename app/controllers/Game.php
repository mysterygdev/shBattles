<?php

namespace Controllers;

use Core\CoreController as Controller;
use Models;
use Utils;
use Utils\Session;

class Game extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->user = new Utils\User;
    }

    /* Get Methods */

    public function promotions()
    {
        $promotions = $this->model(Models\Game\Promotions::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'promotions' => $promotions,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/promotions', $data);
    }

    public function rewards()
    {
        $rewards = $this->model(Models\Game\Rewards::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'rewards' => $rewards,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/rewards', $data);
    }

    public function vote()
    {
        $vote = $this->model(Models\Game\Vote::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'vote' => $vote,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/game/vote', $data);
    }

    /* Post Methods */
    public function pPromotions()
    {
        $promotions = $this->model(Models\Game\Promotions::class, $this->user);
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $code = isset($decoded['code']) ? $this->data->purify(trim($decoded['code'])) : false;
                $errors = [];

                $promotions->getPromotions($code);

                // Error Checking
                if (isset($code)) {
                    // Validate Code
                    if (empty($code)) {
                        $errors[] .= 'Code can not be empty.';
                    } elseif (!$promotions->doesCodeExist($code)) {
                        $errors[] .= 'Code not found.';
                    } elseif ($promotions->isCodeMaxed($code)) {
                        $errors[] .= 'Code has reached maximum number of uses.';
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        // Update User Points
                        $promotions->updateUserPoints($code);
                        // Update Promos
                        $promotions->updatePromos($code);
                        // Insert Promo Log
                        $promotions->addPromoLog($code);
                        ///$promotions->validations();
                        echo 'Successfully redeemed code: ' . $code . ' ';
                        echo 'for ' . $promotions->getCodePoints($code) . ' Donation Points.';
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
