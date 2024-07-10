<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Lection;

class LectionRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Lection::class);
    }
}
