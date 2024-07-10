<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Http\Requests\CreateRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateStudentRequest extends FormRequest implements CreateRequest
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:students',
            'class_id' => 'nullable|int|exists:school_classes',
        ];
    }

    public function getDataToCreate(): array
    {
        return $this->validated();
    }
}
