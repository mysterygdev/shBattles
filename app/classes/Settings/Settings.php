<?php

namespace Classes\Settings;

use Illuminate\Database\Capsule\Manager as DB;

class Settings
{
    public function __construct()
    {
        $settings = [];
        $datas = DB::table(table('cmsMain'))
            ->select()
            ->get();
        foreach ($datas as $data) {
            $settings[$data->SETTING] = $data->VALUE;
        }
    }

    public function props()
    {
        echo '<div class="col-md-12">';
        echo '<b>Properties for class (' . get_called_class() . '):</b><br>';
        echo '<pre>';
        print_r(get_class_vars(get_called_class()));
        echo '</pre>';
        echo '</div>';
        exit();
    }
}
