<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Http\Requests\CreateRequest;

class CreateLectionRequest extends ApiRequest implements CreateRequest
{
    public function rules(): array
    {
        return [
            'theme' => 'required|string|max:55|unique:lections',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function getDataToCreate(): array
    {
        return $this->validated();
    }
}
