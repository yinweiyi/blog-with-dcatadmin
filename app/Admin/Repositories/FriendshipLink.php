<?php

namespace App\Admin\Repositories;

use App\Models\FriendshipLink as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class FriendshipLink extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
