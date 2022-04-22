<?php

namespace Controllers;

use Core\CoreController as Controller;
use Models;
use Utils;
use Utils\{
    Arrays,
    Session
};
use Illuminate\Database\Capsule\Manager as DB;

class Community extends Controller
{
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

            $users = DB::table(table('shUserData'))
                    ->select('UserUID', 'UserID')
                    ->get();

            echo '<table>';
                echo '<thead>';
                    echo '<th>CharName</th>';
                    echo '<th>Level</th>';
                    echo '<th>CharID</th>';
                    echo '<th>Family</th>';
                    echo '<th>Job</th>';
                    echo '<th>K1</th>';
                    echo '<th>K2</th>';
                echo '</thead>';
                echo '<tbody>';
                    foreach ($users as $user) {
                        // where do you get your db tables list from?
                        $query = DB::table(table('shCharData')  . ' as C')
                                    ->join(table('shUserData')  . ' as  U', 'U.UserUID', '=', 'C.UserUID')
                                    ->select('C.*','C.CharID', 'C.CharName', 'C.Level', 'C.Family', 'C.Job', 'C.K1', 'C.K2')
                                    ->where('U.UserUID', $user->UserUID)
                                    ->orderBy('C.K1', 'DESC')
                                    ->get();

                        echo '<tr class="dropdown">';
                            echo '<td class="dropdown-item">'.$query[0]->CharName.'<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></button></td>';
                            echo '<td>'.$query[0]->Level.'</td>';
                            echo '<td>'.$query[0]->Family.'</td>';
                            echo '<td>'.$query[0]->Job.'</td>';
                            echo '<td>'.$query[0]->K1.'</td>';
                            echo '<td>'.$query[0]->K2.'</td>';
                        echo '</tr>';
                        unset($query[0]);

                        foreach ($query as $q) {
                            echo '<tr class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
                                echo '<td class="dropdown-item">'.$q->CharName.'</td>';
                                echo '<td class="dropdown-item">'.$q->Level.'</td>';
                                echo '<td class="dropdown-item">'.$q->Family.'</td>';
                                echo '<td class="dropdown-item">'.$q->Job.'</td>';
                                echo '<td class="dropdown-item">'.$q->K1.'</td>';
                                echo '<td class="dropdown-item">'.$q->K2.'</td>';
                            echo '</tr>';
                        }
                        die;
                    }
                echo '</tbody>';
            echo '</table>';

            $this->pagination->sp($query, $records_per_page, $prevPage, $nextPage, $page);

            try {
                $rankings = DB::table(table('shCharData'))
                    ->select('UserUID', 'CharID', 'CharName', 'Level', 'Family', 'Job', 'K1', 'K2')
                    ->offset($start_from)
                    ->limit($records_per_page)
                    ->orderBy('CharName', 'ASC')
                    ->get();

                echo '<pre>';
                $array=Arrays::objToArray($rankings);
                var_dump($array);

#                $first = array_key_first($array);

 #               var_dump($array[$first]);

                if ($rankings) {
                    $model = $this->model(Models\Community\Rankings::class);
                    $guild = new \Shaiya\Guild;
                    $arr = [
                        'rankings' => $rankings,
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
