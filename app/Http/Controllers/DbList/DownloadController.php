<?php

namespace App\Http\Controllers\DbList;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->download('storage/backup/' . $request->input('name'));
    }
}
