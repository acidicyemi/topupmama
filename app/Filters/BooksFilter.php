<?php

namespace App\Filters;

class BooksFilter extends QueryFilter
{

    public function orderByReleaseDate($order)
    {
        return $this->builder->orderBy('released_date', $order);
    }
}
