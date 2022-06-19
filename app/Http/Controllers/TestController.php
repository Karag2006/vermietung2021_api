<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $currentDate = Carbon::now()->locale('de_DE');
        $currentDateString = $currentDate->isoFormat('YYYY-MM-DD');
        echo $currentDateString;
    }
}
