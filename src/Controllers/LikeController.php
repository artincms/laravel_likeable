<?php

namespace ArtinCMS\LLS\Controllers;

use ArtinCMS\LLS\Models\Like;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LikeController extends Controller
{
    public function chnageLike(Request $request)
    {
        $id = LFM_GetDecodeId($request->encode_id);
        $model = $request->model;
        $type = $request->type;
        $item = new Like;
        if (Auth::user())
        {
            if (isset(Auth::user()->id))
            {
                $item->user_id = Auth::user()->id;
            }

        }
        $item->ip = $request->ip() ;
        $item->target_id = $id;
        $item->target_type = $model;
        if($request->type =='like')
        {
            $item->type = '1';
        }
        elseif($request->type =='disLike')
        {
            $item->type = '-1';
        }

        $item->save();
        $result = [
            'success'  => true,
            'type'     => $type,
        ];
        return $result;
    }
}
