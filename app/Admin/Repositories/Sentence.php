<?php

namespace App\Admin\Repositories;

use App\Models\Sentence as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Sentence extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
