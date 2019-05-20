<?php

namespace Raffles\Models\Traits;

trait ArticleTrait
{
    /**
     * Get the article extract.
     *
     * @return string
     */
    public function getExtractAttribute()
    {
        return $this->attributes['extract'] = str_limit($this->body, 200);
    }
}
