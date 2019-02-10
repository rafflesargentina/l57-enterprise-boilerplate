<?php

namespace Raffles\Modules\Dashboard\Sorters;

class UserTrafficSorters extends BaseSorters
{
    protected static $defaultOrder = "asc";

    protected static $defaultOrderBy = "created_at";
}
