<?php

use App\Events\SystemActivity as SA;
function create_activity($text)
{
	return event(new SA($text));
}