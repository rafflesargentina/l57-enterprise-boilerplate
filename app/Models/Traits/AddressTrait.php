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
        return $this->attributes['location'] = ($this->street_name ? ($this->street_number ? ' '.$this->street_number : '').'  ' : '').($this->locality ? ($this->locality.', ') : ($this->sublocality ? $this->sublocality.', ' : '')).($this->state ? ($this->country ? $this->state.', '.$this->country : $this->state) : ($this->country ?: $this->country));
    }
}
