<?php

namespace ArtinCMS\LLS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Like extends Model
{
    use SoftDeletes ;
    protected $table = 'lls_likes';

}
