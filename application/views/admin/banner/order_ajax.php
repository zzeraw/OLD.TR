<?php
echo get_sortable_ol_with_img($banners);

function get_sortable_ol_with_img ($array, $child = FALSE)
{
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $item) {
            $str .= '<li id="list_' . $item->id .'">';
            $str .= '<div><img width="50" src="' . site_url('uploads/banners/' . $item->filename) . '" alt=""> '  . $item->title .'</div>';

            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ol>' . PHP_EOL;
    }

    return $str;
}

?>

<script>
$(document).ready(function(){

    $('.sortable').nestedSortable({
        handle: 'div',
        items: 'li',
        toleranceElement: '> div',
        maxLevels: 1
    });

});
</script>