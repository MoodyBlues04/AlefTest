<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\UpdateStudyPlanRequest;
use App\Models\SchoolClass;
use App\Repositories\StudyPlanRepository;
use Illuminate\Http\JsonResponse;

class StudyPlanController extends ApiController
{
    public function __construct(private readonly StudyPlanRepository $studyPlanRepository)
    {
    }

    public function show(SchoolClass $class): JsonResponse
    {
        return $this->success('Class study plan', $class->studyPlan->getLectionsOrdered());
    }

    public function update(SchoolClass $class, UpdateStudyPlanRequest $request): JsonResponse
    {
        $this->studyPlanRepository->updateStudyPlan($request, $class->studyPlan);
        return $this->success('Class study plan updated');
    }
}
