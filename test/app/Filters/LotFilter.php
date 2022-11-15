<?php

namespace App\Filters;

class LotFilter extends QueryFilter
{
    public function categories($ids)
    {
        return $this->builder->whereKey($ids);
    }
}
