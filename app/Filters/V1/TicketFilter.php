<?php

namespace App\Filters\V1;
use App\Filters\V1\QueryFilter;

class TicketFilter extends QueryFilter
{
    public function include($value) {
        return $this->builder->with($value);
    }

    public function status($value){
        return $this->builder->whereIn('status', explode(',', $value));
    }

    public function title($value) {
        return $this->builder->where('title', 'like', '%'.$value.'%');
    }

    public function createdAt($value) {

        $dates = explode(',', $value);

        if (count($dates) >= 2) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function updatedAt($value) {

        $dates = explode(' , ', $value);

        if (count($dates) >= 2) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

}
