<?php

namespace Raffles\Models\Traits;

trait AddressTrait {
    /**
     * Get the address's location.
     *
     * @return string
     */
    public function getLocationAttribute()
    {
        return $this->attributes['location'] = $this->sublocality ? $this->sublocality.', '.$this->state : $this->locality.', '.$this->state;
;
    }
}
