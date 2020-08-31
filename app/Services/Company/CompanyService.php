<?php

namespace App\Services\Company;

use App\Models\Company;

class CompanyService
{
    public function getLabels()
    {
        $columns = [];
        $fillables = (new Company())->getFillable();
        foreach ($fillables as $fillable) {
            $columns[$fillable] = ucfirst(str_replace('_', ' ', $fillable));
        }

        return $columns;
    }
}
