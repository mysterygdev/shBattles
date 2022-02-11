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

    /* Post Methods */

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
