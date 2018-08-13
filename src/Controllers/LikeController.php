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
        $isActiveLike = $request->isActiveLike;
        $isActiveDislike = $request->isActiveDislike;
        $ip=$request->ip();
        if($type =='like')
        {
            $type_id= '1';
            if($isActiveLike)
            {
                $this->deleteLike($model,$id,$type_id) ;
                $result['action']='deccreamentLike';
            }
            elseif ($isActiveDislike)
            {
                $this->deleteLike($model,$id,'-1','disLikes') ;
                $this->setLike($model,$id,$type_id,$ip);
                $result['action']='increamentLike';
            }
            else
            {
                $this->setLike($model,$id,$type_id,$ip);
                $result['action']='increamentLike';
            }

        }
        else
        {
           $type_id = '-1';
            if($isActiveDislike)
            {
                $this->deleteLike($model,$id,$type_id,'disLikes') ;
                $result['action']='deccreamentDislike';
            }
            elseif ($isActiveLike)
            {
                $this->deleteLike($model,$id,'1') ;
                $this->setLike($model,$id,$type_id,$ip);
                $result['action']='increamentDislike';
            }
            else
            {
                $this->setLike($model,$id,$type_id,$ip);
                $result['action']='increamentDislike';
            }
        }

        $result['success']=true ;
        $result['type']=$type ;
        return $result;
    }

    public function setLike($model,$id,$type,$ip)
    {
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
        $item->target_type = $model;
        $item->type = $type;
        $item->save();
        $result = [
            'success'  => true,
        ];
        return $result;
    }

    public function deleteLike($model,$id,$type,$relation_name='likes')
    {
        $item=$model::find($id);
        $likes=$item->$relation_name()->where('type',$type)->orderBy('id','desc')->first();
        $likes->delete();
        return true ;
    }
}
