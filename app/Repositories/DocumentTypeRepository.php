<?php

namespace Raffles\Repositories;

use Raffles\Models\DocumentType;

use Caffeinated\Repository\Repositories\EloquentRepository;

class DocumentTypeRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = DocumentType::class;

    /**
     * @var array
     */
    public $tag = ['DocumentType'];
}
