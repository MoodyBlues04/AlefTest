<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\CreateSchoolClassRequest;
use App\Http\Requests\Api\UpdateSchoolClassRequest;
use App\Models\SchoolClass;
use App\Repositories\SchoolClassRepository;
use Illuminate\Http\JsonResponse;

class SchoolClassController extends ApiController
{
    public function __construct(private readonly SchoolClassRepository $schoolClassRepository)
    {
    }

    public function index(): JsonResponse
    {
        $classes = $this->schoolClassRepository->getAll();
        return $this->success('Classes list', $classes);
    }

    public function show(SchoolClass $class): JsonResponse
    {
        return $this->success('Class', $class->toArray());
    }

    public function store(CreateSchoolClassRequest $request): JsonResponse
    {
        /** @var SchoolClass $created */
        $created = $this->schoolClassRepository->createFromRequest($request);
        if (null === $created) {
            return $this->error('Class creation failed');
        }
        $created->studyPlan()->create();
        return $this->success('Class created', $created->toArray());
    }

    public function update(SchoolClass $class, UpdateSchoolClassRequest $request): JsonResponse
    {
        $updated = $this->schoolClassRepository->updateFromRequest($request, $class);
        if (null === $updated) {
            return $this->error('Class update failed');
        }
        return $this->success('Class updated', $updated->toArray());
    }

    public function destroy(SchoolClass $class): JsonResponse
    {
        if (!$class->delete()) {
            return $this->error('Class deletion failed');
        }
        return $this->success('Class deleted');
    }
}
