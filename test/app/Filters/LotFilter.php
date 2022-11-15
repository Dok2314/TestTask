<?php

namespace App\Filters;

class LotFilter extends QueryFilter
{
    public function categories($ids)
    {
        $this->builder->whereHas(
            'categories',
            fn($q) => $q->whereKey($ids)
        );
    }

    public function withTrashed($value)
    {
        if($value) {
            $this->builder->withTrashed();
        }
    }
}
