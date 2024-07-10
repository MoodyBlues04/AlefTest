<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateStudyPlanRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'lections' => 'required|array',
            'lections.*.lection_id' => 'required|int|' . Rule::exists('lections', 'id'),
            'lections.*.order' => 'required|int|min:1',
        ];
    }

    protected function extraValidation(Validator $validator): void
    {
        $lectionIds = [];
        foreach ($this->post('lections') as $lectionData) {
            if (in_array($lectionData['lection_id'], $lectionIds)) {
                $validator->errors()->add('lections', 'Lection ids not unique');
                break;
            }
            $lectionIds[]= $lectionData['lection_id'];
        }
    }
}
