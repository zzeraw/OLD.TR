<?php
echo get_sortable_ol_with_img($items, $images);

function get_sortable_ol_with_img ($array, $images, $child = FALSE)
{
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $item) {
            $str .= '<li id="list_' . $item->id .'">';
            $str .= '<div>';
            if (isset($images[$item->id])) {
                $str .= '<img width="50" src="' . site_url('uploads/' . $images[$item->id]) . '" alt="">';
            }
            $str .= $item->title .'</div>';

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