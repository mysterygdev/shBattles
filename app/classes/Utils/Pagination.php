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
                $tmp[] = '<a class="page-numbers current pagination_link" id="' . $p . '">' . $p . '</a>';
            } else {
                $tmp[] = '<a class="page-numbers pagination_link" id="' . $p . '">' . $p . '</a>';
            }
        }
        // thin out the pages
        for ($i = count($tmp) - 3; $i > 1; $i--) {
            if (abs($page - $i - 1) > 2) {
                unset($tmp[$i]);
            }
        }
        // display page navigation if data covers more than one page
        echo '<div class="pagination-area text-center">';
        if (count($tmp) > 1) {
            if ($page > 1) {
                // display 'Prev' page
                echo '<a class="prev page-numbers pagination_link pag-pn" id="' . $prevPage . '">
                    <i class="bx bx-chevrons-left" id="' . $prevPage . '"></i>
                </a>';
            } else {
                echo '<a class="prev page-numbers disabled">
                    <i class="bx bx-chevrons-left"></i>
                </a>';
            }
            $lastPage = 0;
            echo '<span>';
            foreach ($tmp as $i => $link) {
                if ($i > $lastPage + 1) {
                    echo ' ... '; // where one or more page have been omitted
                }
                echo $link;
                $lastPage = $i;
            }
            echo '</span>';

            if ($page <= $lastPage) {
                // display 'Next' page
                echo '<a class="next page-numbers pagination_link pag-pn" id="' . $nextPage . '">
                    <i class="bx bx-chevrons-right" id="' . $nextPage . '"></i>
                </a>';
            } else {
                echo '<a class="next page-numbers disabled">
                    <i class="bx bx-chevrons-right"></i>
                </a>';
            }
        }
        echo '</div>';
    }
}
