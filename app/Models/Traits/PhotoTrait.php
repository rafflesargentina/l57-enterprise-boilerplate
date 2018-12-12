<?php

namespace Raffles\Models\Traits;

use Storage;

trait PhotoTrait
{
    /**
     * Get the photo size.
     *
     * @return string
     */
    public function getSizeAttribute()
    {
        if ($this->location && Storage::exists($this->location)) {
            return Storage::size($this->location);
        }

        return 0;
    }

    /**
     * Get the photo url.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        if ($this->location && Storage::exists($this->location)) {
            return $this->attributes['url'] = Storage::url($this->location);
        } elseif (starts_with($this->location, 'http')) {
            return $this->attributes['url'] = $this->location;
        } else {
            return $this->attributes['url'] = '';
        }
    }
}
