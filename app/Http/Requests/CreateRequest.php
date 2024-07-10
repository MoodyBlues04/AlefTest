<?php
declare(strict_types=1);

namespace App\Http\Requests;

interface CreateRequest
{
    public function getDataToCreate(): array;
}
