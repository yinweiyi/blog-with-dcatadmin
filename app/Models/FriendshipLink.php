<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class FriendshipLink extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'friendship_links';
    
}
