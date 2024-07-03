<?php

namespace App\Filters\V1;
use App\Filters\V1\QueryFilter;

class AuthorFilter extends QueryFilter
{

    protected $sortable = [
        'id',
        'email',
        'name',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at'
    ];


    public function include($value) {
        return $this->builder->with($value);
    }

    public function id($value){
        return $this->builder->whereIn('id', explode(',', $value));
    }

    public function email($value) {
        return $this->builder->where('email', 'like', '%'.$value.'%');
    }

    public function name($value) {
        return $this->builder->where('name', 'like', '%'.$value.'%');
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
