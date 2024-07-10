<?php
declare(strict_types=1);

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
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
        return [];
    }

    public function validator(): Validator
    {
        $validator = ValidatorFacade::make($this->input(), $this->rules(), $this->messages(), $this->attributes());
        $validator->after(fn ($validator) => $this->extraValidation($validator));
        return $validator;
    }

    /**
     * Here you can specify extra validation rules
     * @param Validator $validator
     * @return void
     */
    protected function extraValidation(Validator $validator): void
    {
    }

    protected function errorMessage(): string
    {
        return 'Invalid data send';
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();

        $response = response()->json([
            'ok' => false,
            'message' => $this->errorMessage(),
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
