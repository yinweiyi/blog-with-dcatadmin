<?php

namespace App\Admin\Repositories;

use App\Models\Guestbook as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Guestbook extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
