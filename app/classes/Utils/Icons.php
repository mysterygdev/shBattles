<?php

namespace Classes\Utils;

class Icons
{
    public $defaultPage = 1;
    public $maxShow = 50;
    public $cPages;

    //function for showing next pages
    public function pages($page, $maxPage, $url = '', $Count = 4)
    {
        if ($Count % 2 != 0) {
            $Count++;
        }

        $a = $page - ($Count / 2);
        $b = 0;
        $blaetter = [];

        while ($b <= $Count) {
            if ($a > 0 && $a <= $maxPage) {
                $blaetter[] = $a;
                $b++;
            } elseif ($a > $maxPage && ($a - $Count - 2) >= 0) {
                $blaetter = [];
                $a -= ($Count + 2);
                $b = 0;
            } elseif ($a > $maxPage && ($a - $Count - 2) < 0) {
                break;
            }
            $a++;
        }
        $return = '';
        $return .= '<nav aria-label="Page navigation example">';
        $return .= '<ul class="pagination">';

        if (!in_array(1, $blaetter) && count($blaetter) > 1) {
            if (!in_array(2, $blaetter)) {
                $return .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}/1\" title=\"First Page\">1</a></li>";
            } else {
                $return .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}/1\" title=\"First Page\">1</a></li>";
            }
        }
        foreach ($blaetter as $blatt) {
            if ($blatt == $page) {
                $return .= "&nbsp;<li class=\"page-item active\"><a class=\"page-link\" href=\"#!\">$blatt</a></li>";
            } else {
                $return .= "&nbsp;<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}/$blatt\">$blatt</a></li>";
            }
        }
        if (!in_array($maxPage, $blaetter) && count($blaetter) > 1) {
            if (!in_array(($maxPage - 1), $blaetter)) {
                $return .= "<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}/$maxPage\" title=\"Last Page\">$maxPage</a></li>";
            } else {
                $return .= "&nbsp;<li class=\"page-item\"><a class=\"page-link\" href=\"{$url}/$maxPage\">$maxPage</a></li>";
            }
        }
        $return .= '</ul>';
        $return .= '</nav>';

        // Separator

        if (empty($return)) {
            return  '&nbsp;<b>1</b>&nbsp;';
        } else {
            return $return;
        }
    }

    public function checkPage()
    {
        //
    }

    public function OutputTable()
    {
        //
    }
}
