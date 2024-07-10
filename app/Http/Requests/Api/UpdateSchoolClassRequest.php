<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\UpdateRequest;

class UpdateSchoolClassRequest extends ApiRequest implements UpdateRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string'
        ];
    }

    public function getDataToUpdate(): array
    {
        return $this->validated();
    }
}
