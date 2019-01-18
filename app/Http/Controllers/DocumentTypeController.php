<?php

namespace Raffles\Http\Controllers;

use Raffles\Repositories\DocumentTypeRepository;

use RafflesArgentina\ResourceController\ApiResourceController;

class DocumentTypeController extends ApiResourceController
{
    protected $repository = DocumentTypeRepository::class;

    protected $resourceName = 'document-types';
}
