<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Http\Requests\UpdateRequest;

class UpdateStudentRequest extends ApiRequest implements UpdateRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'class_id' => 'nullable|int|exists:school_classes,id',
        ];
    }

    public function getDataToUpdate(): array
    {
        return $this->validated();
    }
}
