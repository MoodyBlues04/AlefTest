<?php
declare(strict_types=1);


namespace App\Repositories;

use App\Http\Requests\Api\UpdateStudyPlanRequest;
use App\Models\StudyPlan;

class StudyPlanRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(StudyPlan::class);
    }

    public function updateStudyPlan(UpdateStudyPlanRequest $request, StudyPlan $studyPlan): void
    {
        $studyPlan->classLections()->delete();
        foreach ($request->lections as $lectionData) {
            $studyPlan->classLections()->create($lectionData);
        }
    }
}
