<?php

namespace Controllers;

use Core\CoreController as Controller;
use Models;
use Utils;
use Utils\Session;
use Illuminate\Database\Capsule\Manager as DB;

class Community extends Controller
{
    public $chars = null;
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->user = new Utils\User;
        $this->pagination = new Utils\Pagination;
        Session::setReferer();
    }

    public function discord()
    {
        $data = [
            'user' => $this->user
        ];

        $this->view('pages/cms/community/discord', $data);
    }

    public function downloads()
    {
        $data = [
            'user' => $this->user
        ];

        $this->view('pages/cms/community/downloads', $data);
    }

    public function events()
    {
        $events = $this->model(Models\Community\Events::class);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'events' => $events,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/community/events', $data);
    }

    public function guildrankings()
    {
        $guildRankingsModel = $this->model(Models\Community\GuildRankings::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'guildrankings' => $guildRankingsModel->getGuildRankings(),
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/community/guildrankings', $data);
    }

    public function news()
    {
        $newsModel = $this->model(Models\Community\News::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'news' => $newsModel->getNews(),
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/community/news', $data);
    }

    public function patchnotes()
    {
        $patchNotesModel = $this->model(Models\Community\PatchNotes::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'patchnotes' => $patchNotesModel->getPatchNotes(),
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/community/patchnotes', $data);
    }

    public function polls()
    {
        $polls = $this->model(Models\Community\Polls::class);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'polls' => $polls,
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/community/polls', $data);
    }

    public function rankings()
    {
        $rankings = $this->model(Models\Community\Rankings::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user);

        $data = [
            'user' => $this->user,
            'Rankings' => $rankings,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/community/rankings', $data);
    }

    public function staffteam()
    {
        $this->user->fetchUser();

        $data = [
            'user' => $this->user
        ];

        $this->view('pages/cms/community/staffteam', $data);
    }

    // POST

    // Patch Notes
    public function getPatchNotes()
    {
        $records_per_page = 1;
        $page = '';
        $output = '';

        $content = trim(file_get_contents('php://input'));

        $decoded = json_decode($content, true);

        if (is_array($decoded)) {
            if (isset($decoded['page'])) {
                $page = $decoded['page'];
            } else {
                $page = 1;
            }
            $prevPage = $page - 1;
            $nextPage = $page + 1;

            $start_from = ($page - 1) * $records_per_page;

            $query = DB::table(table('patchNotes'))
                    ->select('RowID', 'Title', 'Detail', 'Date')
                    ->orderBy('Date', 'DESC')
                    ->get();

            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);

            try {
                $news = DB::table(table('patchNotes'))
                    ->select('RowID', 'Title', 'Detail', 'Date')
                    ->offset($start_from)
                    ->limit($records_per_page)
                    ->orderBy('Date', 'DESC')
                    ->get();

                if ($news) {
                    $this->view('fetch/patch_notes/patchNotes', $news);
                }
            } catch (\Exception $e) {
                // query failed
            }
            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);
        }
    }

    // Rankings
    public function rankings1()
    {
        $records_per_page = 15;
        $page = '';
        $output = '';

        $content = trim(file_get_contents('php://input'));

        $decoded = json_decode($content, true);

        if (is_array($decoded)) {
            if (isset($decoded['page'])) {
                $page = $decoded['page'];
            } else {
                $page = 1;
            }
            $prevPage = $page - 1;
            $nextPage = $page + 1;

            $start_from = ($page - 1) * $records_per_page;
            $RankNum = ($page - 1) * $records_per_page;

            $query = DB::table(table('shCharData'))
                    ->select('CharID', 'CharName', 'Level', 'Family', 'Job', 'K1', 'K2')
                    ->orderBy('K1', 'DESC')
                    ->get();

            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);

            try {
                $users = DB::table(table('shUserData'))
                    ->select('UserUID', 'UserID')
                    ->orderBy('UserUID', 'ASC')
                    ->get();

                foreach($users as $user)
                {
                    //var_dump($user->UserUID);
                    $chars = DB::table(table('shCharData'))
                        ->select('UserUID', 'CharID', 'CharName', 'Level', 'Family', 'Job', 'K1', 'K2')
                        ->where('UserUID', $user->UserUID)
                        ->where('del', 0)
                        ->orderBy('CharName', 'ASC')
                        ->get();
                    /* if (count($chars) > 0) {
                        //echo 'UserUID: '.$chars[0]->UserUID.' Name: '.$chars[0]->CharName.'<br>';
                        for($x = 1; $x < count($chars); $x++) {
                            //echo 'UserUID: '.$chars[$x]->UserUID.' Name: '.$chars[$x]->CharName.'<br>';
                        }
                    } */
                }


                /* $rankings = DB::table(table('shCharData'))
                    ->select('UserUID', 'CharID', 'CharName', 'Level', 'Family', 'Job', 'K1', 'K2')
                    ->offset($start_from)
                    ->limit($records_per_page)
                    ->orderBy('CharName', 'ASC')
                    ->get(); */

                if ($users) {
                    $model = $this->model(Models\Community\Rankings::class);
                    $guild = new \Shaiya\Guild;
                    $arr = [
                        'users' => $users,
                        'rankNum' => $RankNum,
                        'rank' => $model,
                        'guild' => $guild
                    ];
                    $this->view('fetch/cms/rankings/rankings', $arr);
                }
            } catch (\Exception $e) {
                // query failed
            }
            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);
        }
    }
}
