<?php

namespace App\Controllers\Admin;

use Framework\Core\CoreController as Controller;
use App\Models;
use Classes\Sys\LogSys;
use Classes\Utils;

class Site extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->logSys = new LogSys;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
    }

    /* Get Methods */

    public function addPvpRewards()
    {
        $rewards = $this->model(Models\Admin\Site\PvpRewards\Rewards::class);

        $data = [
            'user' => $this->user,
            'data' => $this->data,
            'rewards' => $rewards
        ];

        $this->view('pages/ap/site/pvpRewards/addReward', $data);
    }

    public function addTierRewards()
    {
        $rewards = $this->model(Models\Admin\Site\PvpRewards\Rewards::class);

        $data = [
            'user' => $this->user,
            'data' => $this->data,
            'rewards' => $rewards
        ];

        $this->view('pages/ap/site/pvpRewards/manageRewards', $data);
    }

    public function index()
    {
        $dataClass = new Utils\Data;

        $panels = new Utils\Panels;

        $data = [
            'user' => $this->user,
            'panels' => $panels,
            'data' => $dataClass,
        ];

        $this->view('pages/ap/index', $data);
    }

    public function events()
    {
        $events = $this->model(Models\Admin\Site\Events::class);

        $data = [
            'user' => $this->user,
            'events' => $events,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/site/events', $data);
    }

    public function editPvpRewards($id)
    {
        $rewards = $this->model(Models\Admin\Site\PvpRewards\Rewards::class);

        $data = [
            'user' => $this->user,
            'data' => $this->data,
            'rewards' => $rewards,
            'id' => $id,
        ];

        $this->view('pages/ap/site/pvpRewards/editRewards', $data);
    }

    public function managePvpRewards()
    {
        $rewards = $this->model(Models\Admin\Site\PvpRewards\Rewards::class);

        $data = [
            'user' => $this->user,
            'data' => $this->data,
            'rewards' => $rewards
        ];

        $this->view('pages/ap/site/pvpRewards/manageRewards', $data);
    }

    public function manageTierRewards()
    {
        $rewards = $this->model(Models\Admin\Site\PvpRewards\Rewards::class);

        $data = [
            'user' => $this->user,
            'data' => $this->data,
            'rewards' => $rewards
        ];

        $this->view('pages/ap/site/pvpRewards/manageRewards', $data);
    }

    public function newEvent()
    {
        $events = $this->model(Models\Admin\Site\Events::class);

        $data = [
            'user' => $this->user,
            'events' => $events,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/site/newEvent', $data);
    }

    public function tickets()
    {
        $tickets = $this->model(Models\Admin\Site\Tickets::class);

        $data = [
            'user' => $this->user,
            'data' => $this->data,
            'tickets' => $tickets,
            'logSys' => $this->logSys
        ];

        $this->view('pages/ap/site/tickets', $data);
    }

    /* Post Methods */

    public function editRewardOpt()
    {
        $rewards = $this->model(Models\Admin\Site\PvpRewards\Rewards::class);
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $id = isset($decoded['id']) ? $this->data->purify(trim($decoded['id'])) : false;
                $rewardType = isset($decoded['rewardType']) ? $this->data->purify(trim($decoded['rewardType'])) : false;
                $k1Req = isset($decoded['k1Req']) ? $this->data->purify(trim($decoded['k1Req'])) : false;
                $points = isset($decoded['points']) ? $this->data->purify(trim($decoded['points'])) : false;
                $errors = [];

                // Error Checking
                if (isset($rewardType)) {
                    // Validate Reward Type
                    if (empty($rewardType)) {
                        $errors[] .= 'Reward Type can not be empty.';
                    } elseif (ucfirst($rewardType) !== 'Points') {
                        $errors[] .= 'Reward type must be points.';
                    }
                    // Validate Kills Required
                    if (empty($k1Req)) {
                        $errors[] .= 'Kills Required can not be empty.';
                    } elseif (!is_numeric($k1Req)) {
                        $errors[] .= 'Kills Required must be numeric.';
                    }
                    if (empty($points)) {
                        $errors[] .= 'Points Reward can not be empty.';
                    } elseif (!is_numeric($points)) {
                        $errors[] .= 'Points Reward must be numeric.';
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        // Create Reward Option
                        if ($rewards->getRewardTypeById($id) != $rewardType || $rewards->getK1ReqById($id) !== $k1Req || $rewards->getPointsById($id) !== $points) {
                            $rewards->updateRewardById($id, $rewardType, $k1Req, $points);
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

    public function submitReward()
    {
        $rewards = $this->model(Models\Admin\Site\PvpRewards\Rewards::class);
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
        if ($contentType === 'application/json') {
            //Receive the RAW post data.
            $content = trim(file_get_contents('php://input'));

            $decoded = json_decode($content, true);

            //If json_decode succeeded, the JSON is valid.
            if (is_array($decoded)) {
                $rewardType = isset($decoded['rewardType']) ? $this->data->purify(trim($decoded['rewardType'])) : false;
                $k1Req = isset($decoded['k1Req']) ? $this->data->purify(trim($decoded['k1Req'])) : false;
                $points = isset($decoded['points']) ? $this->data->purify(trim($decoded['points'])) : false;
                $errors = [];

                // Error Checking
                if (isset($rewardType)) {
                    // Validate Reward Type
                    if (empty($rewardType)) {
                        $errors[] .= 'Reward Type can not be empty.';
                    } elseif (ucfirst($rewardType) !== 'Points') {
                        $errors[] .= 'Reward type must be points.';
                    }
                    // Validate Kills Required
                    if (empty($k1Req)) {
                        $errors[] .= 'Kills Required can not be empty.';
                    } elseif (!is_numeric($k1Req)) {
                        $errors[] .= 'Kills Required must be numeric.';
                    }
                    if (empty($points)) {
                        $errors[] .= 'Points Reward can not be empty.';
                    } elseif (!is_numeric($points)) {
                        $errors[] .= 'Points Reward must be numeric.';
                    }
                    // If No Errors Continue
                    if (count($errors) == 0) {
                        // Create Reward Option
                        $id = null;
                        $checkRewardId = $rewards->doesRewardIdExist();
                        if ($checkRewardId->isEmpty()) {
                            $id = 1;
                        } else {
                            if (!$checkRewardId) {
                                $id = 1;
                            } else {
                                $id = $checkRewardId[0]->RewardID + 1;
                            }
                        }
                        $rewards->createReward($id, $rewardType, $k1Req, $points);
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

    public function pCreateEvent()
    {
        $events = $this->model(Models\Admin\Site\Events::class);

        $eventTitle = isset($_POST['eventTitle']) ? $this->data->purify(trim($_POST['eventTitle'])) : false;
        $eventDetails = isset($_POST['eventDetails']) ? $this->data->purify(trim($_POST['eventDetails'])) : false;
        $eventStartTime = isset($_POST['eventStartTime']) ? $this->data->purify(trim($_POST['eventStartTime'])) : false;
        $eventEndTime = isset($_POST['eventEndTime']) ? $this->data->purify(trim($_POST['eventEndTime'])) : false;
        $errors = [];

        if (empty($eventTitle)) {
            $errors[] .= 'Event Title can not be empty.';
        }
        if (empty($eventDetails)) {
            $errors[] .= 'Event Details can not be empty.';
        }
        if (empty($eventStartTime)) {
            $errors[] .= 'Event Start Time can not be empty.';
        }

        if (count($errors) == 0) {
            if (!$eventEndTime) {
                $events->createEvent($eventTitle, $eventDetails, $eventStartTime);
            } else {
                $events->createEvent($eventTitle, $eventDetails, $eventStartTime, $eventEndTime);
            }
            echo '<strong>New event has been successfully created.</strong>';
        }
        if (count($errors)) {
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        }
    }

    public function pDeleteEvent()
    {
        $events = $this->model(Models\Admin\Site\Events::class);

        $eventId = isset($_POST['eventId']) ? $this->data->purify(trim($_POST['eventId'])) : false;

        $events->deleteEvent($eventId);
        echo 'Event ' . $eventId . ' deleted successfully.';
    }

    public function pEvents()
    {
        $events = $this->model(Models\Admin\Site\Events::class);

        $eventId = isset($_POST['eventId']) ? $this->data->purify(trim($_POST['eventId'])) : false;
        $eventTitle = isset($_POST['eventTitle']) ? $this->data->purify(trim($_POST['eventTitle'])) : false;
        $eventDetails = isset($_POST['eventDetails']) ? $this->data->purify(trim($_POST['eventDetails'])) : false;
        $eventStartTime = isset($_POST['eventStartTime']) ? $this->data->purify(trim($_POST['eventStartTime'])) : false;
        $eventEndTime = isset($_POST['eventEndTime']) ? $this->data->purify(trim($_POST['eventEndTime'])) : false;
        $errors = [];

        if (empty($eventTitle)) {
            $errors[] .= 'Event Title can not be empty.';
        }
        if (empty($eventDetails)) {
            $errors[] .= 'Event Details can not be empty.';
        }
        if (empty($eventStartTime)) {
            $errors[] .= 'Event Start Time can not be empty.';
        }

        if (count($errors) == 0) {
            // Update Event Title
            if ($events->getEventTitle($eventId) != $eventTitle) {
                $events->updateEventTitle($eventId, $eventTitle);
            }
            // Update Event Details
            if ($events->getEventDetails($eventId) != $eventDetails) {
                $events->updateEventDetails($eventId, $eventDetails);
            }
            // Update Event Start Time
            if ($events->getEventStartTime($eventId) != $eventStartTime) {
                $events->updateEventStartTime($eventId, $eventStartTime);
            }
            // Update Event End Time
            if ($events->getEventEndTime($eventId) != $eventEndTime) {
                $events->updateEventEndTime($eventId, $eventEndTime);
            }
            echo 'Successfully updated event: ' . $eventId;
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
