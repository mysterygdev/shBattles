<?php

namespace Framework;

use Illuminate\Database\Capsule\Manager as DB;

class Configuration
{
    public function __construct()
    {
        $query = DB::table(table('cmsConfig'))
            ->select()
            ->get();

        foreach ($query as $data) {
            $this->data[$data->Setting]=$data->Value;
            $this->index = $data->Index;
            define($this->index, $this->data);
        }

        /* if((env("SETTINGS_DEBUG")==true) && (env("SETTINGS_DEBUG_LVL")>="5")){
                echo '<pre>';
                    var_dump($this->data);
                echo '</pre>';
                exit;
            } */

        //define('CONFIG', $this->data);
        //$this->defined[].=$setting;

        /* if(env("SETTINGS_DEBUG") && env("SETTINGS_DEBUG_LVL")>="1"){
                if(defined($setting)){echo '<b>'.$setting.'</b> is defined'.LB;}
                else{echo 'Failed to define <b>'.$setting.'</b>'.LB;}
            } */
    }
}
