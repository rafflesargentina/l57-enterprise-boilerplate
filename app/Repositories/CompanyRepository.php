<?php

namespace Raffles\Repositories;

use Raffles\Models\Company;

use Caffeinated\Repository\Repositories\EloquentRepository;

class CompanyRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = Company::class;

    /**
     * @var array
     */
    public $tag = ['Company'];
}
