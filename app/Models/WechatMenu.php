<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WechatMenu extends Model
{
    protected $table = 'wechat_menu';
    //可修改的字段
    protected $fillable = [
        'name',
        'type',
        'key',
        'url',
        'media_id',
        'parent_id',
    ];
    const Types = ['click', 'view', 'media_id'];

    public function children()
    {
        return $this->hasMany(WechatMenu::class, 'parent_id');
    }
}
