<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\SchoolClass;

class SchoolClassRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(SchoolClass::class);
    }
}
