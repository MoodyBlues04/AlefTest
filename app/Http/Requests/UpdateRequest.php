<?php
declare(strict_types=1);


namespace App\Http\Requests;

interface UpdateRequest
{
    public function getDataToUpdate(): array;
}
