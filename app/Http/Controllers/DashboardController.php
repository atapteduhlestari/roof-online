<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
