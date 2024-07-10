<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Http\Requests\UpdateRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateLectionRequest extends ApiRequest implements UpdateRequest
{
    public function rules(): array
    {
        return [
            'theme' => 'required|string|max:55',
            'description' => 'nullable|string|max:255',
        ];
    }

    public function getDataToUpdate(): array
    {
        return $this->validated();
    }
}
