<?php

function add_meta_title ($string)
{
	$CI =& get_instance();
	$CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function btn_edit ($uri)
{
	return anchor($uri, '<i class="icon-edit"></i>');
}

function btn_delete ($uri)
{
	return anchor($uri, '<i class="icon-remove"></i>', array(
		'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
	));
}

function esc($string){
	return htmlentities($string);
}


function get_sortable_ol ($array, $child = FALSE)
{
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $item) {
            $str .= '<li id="list_' . $item->id .'">';
            $str .= '<div>' . $item->title .'</div>';

            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ol>' . PHP_EOL;
    }

    return $str;
}


function file_core_name($file_name)
	{
		$exploded = explode('.', $file_name);

		// if no extension
		if (count($exploded) == 1)
		{
			return $file_name;
		}

		// remove extension
		array_pop($exploded);

		return implode('.', $exploded);
	}