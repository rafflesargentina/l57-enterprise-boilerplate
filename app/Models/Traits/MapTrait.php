<?php

namespace Raffles\Models\Traits;

trait MapTrait
{
    /**
     * Get the map coordinates.
     *
     * @return string
     */
    public function getCoordinatesAttribute()
    {
        return $this->attributes['coordinates'] = ['lat' => $this->lat, 'lng' => $this->lng];
    }
}
