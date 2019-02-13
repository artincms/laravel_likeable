<?php

namespace ArtinCMS\LLS\Controllers;

use ArtinCMS\LLS\Models\Like;
use ArtinCMS\LMM\Models\Morph;
use Yajra\DataTables\Facades\DataTables;
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
        $pack = $request->pack;
        $type = $request->type;
        $isActiveLike = $request->isActiveLike;
        $isActiveDislike = $request->isActiveDislike;
        $ip=$request->ip();
        if($type =='like')
        {
            $type_id= '1';
            if($isActiveLike)
            {
                $this->deleteLike($model,$id,$type_id,'likes',$pack) ;
                $result['action']='deccreamentLike';
            }
            elseif ($isActiveDislike)
            {
                $this->deleteLike($model,$id,'-1','disLikes',$pack) ;
                $this->setLike($model,$id,$type_id,$ip,$pack);
                $result['action']='increamentLike';
            }
            else
            {
                $this->setLike($model,$id,$type_id,$ip,$pack);
                $result['action']='increamentLike';
            }

        }
        else
        {
           $type_id = '-1';
            if($isActiveDislike)
            {
                $this->deleteLike($model,$id,$type_id,'disLikes',$pack) ;
                $result['action']='deccreamentDislike';
            }
            elseif ($isActiveLike)
            {
                $this->deleteLike($model,$id,'1','likes',$pack) ;
                $this->setLike($model,$id,$type_id,$ip,$pack);
                $result['action']='increamentDislike';
            }
            else
            {
                $this->setLike($model,$id,$type_id,$ip,$pack);
                $result['action']='increamentDislike';
            }
        }

        $result['success']=true ;
        $result['type']=$type ;
        return $result;
    }

    public function setLike($model,$id,$type,$ip,$pack)
    {
        $target_type = Morph::where([
            ['pck_name',$pack],
            ['dev_name',$model]
        ])->first();
        $item = new Like;
        if (Auth::user())
        {
            if (isset(Auth::user()->id))
            {
                $item->user_id = Auth::user()->id;
            }

        }
        $item->ip = $ip ;
        $item->target_id = $id;
        $item->target_type = $target_type->model_name;
        $item->type = $type;
        $item->save();
        $result = [
            'success'  => true,
        ];
        return $result;
    }

    public function deleteLike($model,$id,$type,$relation_name='likes',$pack)
    {
        $target = Morph::where([
            ['pck_name',$pack],
            ['dev_name',$model]
        ])->first();
        $item=$target->model_name::find($id);
        $likes=$item->$relation_name()->where('type',$type)->orderBy('id','desc')->first();
        $likes->delete();
        return true ;
    }

    public function manageLls(Request $request)
    {
        return view('laravel_likeable_system::backend.index');
    }

    public function getLikesGrid(Request $request)
    {
        $like = Like::with('user');

        return Datatables::eloquent($like)
            ->editColumn('id', function ($data) {
                return LLS_getEncodeId($data->id);
            })
            ->editColumn('created_at', function ($data) {
                return LLS_Date_GtoJ($data->created_at);
            })
            ->addColumn('target_type_name', function ($data) {
                return $data->target_type_name;
            })
            ->addColumn('target_value_name', function ($data) {
                return $data->target_value_name;
            })
            ->make(true);
    }
}
