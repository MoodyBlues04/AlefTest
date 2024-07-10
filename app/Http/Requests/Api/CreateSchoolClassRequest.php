<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\CreateRequest;

class CreateSchoolClassRequest extends ApiRequest implements CreateRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:school_classes',
        ];
    }

    public function getDataToCreate(): array
    {
        return $this->validated();
    }
}
