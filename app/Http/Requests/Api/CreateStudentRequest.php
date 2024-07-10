<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Http\Requests\CreateRequest;

class CreateStudentRequest extends ApiRequest implements CreateRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:students',
            'class_id' => 'nullable|int|exists:school_classes,id',
        ];
    }

    public function getDataToCreate(): array
    {
        return $this->validated();
    }
}
