<?php
namespace App\Traits ;

trait LaraveLikeablesSystem {

    public function likes()
    {
        return $this->morphMany('ArtinCMS\LLS\Models\Like','likeable','target_type','target_id') ;
    }

    public function disLikes()
    {
        return $this->morphMany('ArtinCMS\LLS\Models\Like','likeable','target_type','target_id') ;
    }


}
