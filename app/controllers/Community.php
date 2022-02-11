<?php

namespace App\Controllers;

use Framework\Core\CoreController as Controller;
use App\Models as Models;
use Classes\Utils as Utils;
use Illuminate\Database\Capsule\Manager as DB;

class Community extends Controller
{
    public function __construct()
    {
        $this->data = new Utils\Data;
        $this->session = new Utils\Session;
        $this->user = new Utils\User($this->session);
        $this->pagination = new Utils\Pagination;
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
        $events = $this->model(Models\Community\Events::class, $this->session);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

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

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

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

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

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

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

        $data = [
            'patchnotes' => $patchNotesModel->getPatchNotes(),
            'user' => $this->user,
            'widgets' => $widgets
        ];

        $this->view('pages/cms/community/patchnotes', $data);
    }

    public function rankings()
    {
        $rankings = $this->model(Models\Community\Rankings::class, $this->user);

        $widgets = $this->model(Widgets::class, $this->user, $this->session);

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
                $rankings = DB::table(table('shCharData'))
                    ->select('CharID', 'CharName', 'Level', 'Family', 'Job', 'K1', 'K2')
                    ->offset($start_from)
                    ->limit($records_per_page)
                    ->orderBy('CharName', 'ASC')
                    ->get();

                if ($rankings) {
                    $model = $this->model(Models\Community\Rankings::class);
                    $arr = [
                        'rankings' => $rankings,
                        'rankNum' => $RankNum,
                        'rank' => $model
                    ];
                    $this->view('fetch/rankings/rankings', $arr);
                }
            } catch (\Exception $e) {
                // query failed
            }
            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);
        }
    }
}
