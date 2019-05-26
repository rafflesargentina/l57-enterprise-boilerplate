<?php

namespace Raffles\Repositories;

use Raffles\Models\Contact;

use Caffeinated\Repository\Repositories\EloquentRepository;

class ContactRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = Contact::class;

    /**
     * @var array
     */
    public $tag = ['Contact'];
}
