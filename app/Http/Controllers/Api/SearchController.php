<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Metas;
use App\Models\Relationships;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->post('keyword');
        $table_contents = DB::table('typecho_contents')
            ->where('status', '=', 'publish')
            ->where('type','=','post')
            ->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%" . $keyword . "%")
                ->orWhere('text', 'like', "%" . $keyword . "%");
        });

        return $table_contents->get(['cid', 'title']);
    }

    public function tag(Request $request)
    {
        $keyword = $request->post('keyword');

        $metas = Metas::where('name', $keyword)->first();

        if (isset($metas->mid)) {
            $relation = Relationships::where('mid', $metas->mid)->get('cid');
        }
        $array = [];
        if (empty($relation)) {
            return [];
        }

        foreach ($relation as $k => $v) {
            $array[$k]['cid'] = $v->cid;
            $array[$k]['title'] = $v->content['title'];
        }

        return $array;

    }
}