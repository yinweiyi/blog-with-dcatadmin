<?php

namespace App\Admin\Repositories;

use App\Models\About as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class About extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
