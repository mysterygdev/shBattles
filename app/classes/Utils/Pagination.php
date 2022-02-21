<?php

namespace Classes\Utils;

class Pagination
{
    public function sp($query, $perPage, $prevPage, $nextPage, $page)
    {
        $total_records = count($query);

        // build array containing all pages
        $tmp = [];
        for ($p = 1, $i = 0; $i < $total_records; $p++, $i += $perPage) {
            if ($page == $p) {
                // assign current page to specific class
                $tmp[] = '<li class="active"><a class="current pagination_link" id="' . $p . '">' . $p . '</a></li>';
            } else {
                $tmp[] = '<li><a class="pagination_link" id="' . $p . '">' . $p . '</a></li>';
            }
        }
        // thin out the pages
        for ($i = count($tmp) - 3; $i > 1; $i--) {
            if (abs($page - $i - 1) > 2) {
                unset($tmp[$i]);
            }
        }
        // display page navigation if data covers more than one page
        echo '<ul class="pagination">';
        if (count($tmp) > 1) {
            if ($page > 1) {
                // display 'Prev' page
                echo '<li><a class="prev pagination_link pag-pn" id="' . $prevPage . '">
                    <i class="fas fa-chevron-circle-left" id="' . $prevPage . '"></i>
                </a></li>';
            } else {
                echo '<li><a class="prev disabled">
                    <i class="fas fa-chevron-circle-left"></i>
                </a></li>';
            }
            $lastPage = 0;
            foreach ($tmp as $i => $link) {
                if ($i > $lastPage + 1) {
                    echo '<li><span>... </span></li>'; // where one or more page have been omitted
                }
                echo $link;
                $lastPage = $i;
            }

            if ($page <= $lastPage) {
                // display 'Next' page
                echo '<li><a class="next pagination_link pag-pn" id="' . $nextPage . '">
                    <i class="fas fa-chevron-circle-right" id="' . $nextPage . '"></i>
                </a></li>';
            } else {
                echo '<li><a class="next disabled">
                    <i class="fas fa-chevron-circle-right"></i>
                </a></li>';
            }
        }
        echo '</ul>';
    }
}
