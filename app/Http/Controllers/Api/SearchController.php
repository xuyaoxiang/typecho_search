<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Content;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return $res = Content::where('title', 'like', '%' . $request->keyword . '%')
            ->orWhere('text', 'like', '%' . $request->keyword . '%')
            ->get(['cid','title']);
    }
}