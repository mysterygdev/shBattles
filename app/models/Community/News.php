<?php

namespace App\Models\Community;

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table;
    public $firstRow;
    public $last;

    public function __construct()
    {
        $this->db = new \Classes\DB\MSSQL;
    }

    public function getNews()
    {
        //$test = news::first();
        //var_dump($test);

        $news = DB::table(table('news'))
             ->orderBy('Date', 'DESC')
             ->limit(1)
             ->value('RowID');
        $this->firstRow = $news;
        $news = DB::table(table('news'))
             ->select('RowID', 'Author', 'Title', 'Detail', 'Date')
             ->where('RowID', '!=', $this->first)
             ->orderBy('Date', 'DESC')
             ->limit(5)
             ->get();
        return $news;

        /* $news = self::all();
        return $news; */

        /* $news = Eloquent::table(table('NEWS'))
             ->select()
             ->orderBy('Date', 'DESC')
             ->get();
        return $news; */
    }
}
