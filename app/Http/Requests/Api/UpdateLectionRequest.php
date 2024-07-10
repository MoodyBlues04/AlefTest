<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Http\Requests\UpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLectionRequest extends FormRequest implements UpdateRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
