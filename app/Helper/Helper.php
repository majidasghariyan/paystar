<?php

use App\Models\City;
use App\Models\Option;
use App\Models\Option_value_product;
use App\Models\Product;
use Carbon\Traits\Options;
use Illuminate\Support\Facades\Session;

function alert_message($message,$level='info')
{
    Session::flash('alert_message', $message);
    Session::flash('alert_level', $level);
}



