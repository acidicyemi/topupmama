<?php

namespace App\Filters;

use Illuminate\Support\Str;

class CharactersFilter extends QueryFilter
{
    public function sortBy($sort = "")
    {
        if (in_array($sort, ["gender", "name"])) {
            return $this->builder->orderBy($sort, "ASC");
        }
    }

    public function gender($gender = "")
    {
        if (in_array(Str::lower($gender), ["female", "male"])) {
            return $this->builder->where("gender", $gender);
        }
    }
}
