<?php 

function get_row($content)
{
	return '<div class="row">'.$content.'</div>';
}

function get_col_md($size=12, $content)
{
	return '<div class="col-md-'.$size.'">'.$content.'</div>';
}