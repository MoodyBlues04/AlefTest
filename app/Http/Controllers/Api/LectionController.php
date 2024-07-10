<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\CreateLectionRequest;
use App\Http\Requests\Api\UpdateLectionRequest;
use App\Models\Lection;
use App\Repositories\LectionRepository;
use Illuminate\Http\JsonResponse;

class LectionController extends ApiController
{
    public function __construct(private readonly LectionRepository $lectionRepository)
    {
    }

    public function index(): JsonResponse
    {
        $classes = $this->lectionRepository->getAll();
        return $this->success('Lections list', $classes);
    }

    public function show(Lection $lection): JsonResponse
    {
        return $this->success(
            'Lection',
            $lection->append(['learnt_by_classes', 'learnt_by_students'])->toArray()
        );
    }

    public function store(CreateLectionRequest $request): JsonResponse
    {
        $created = $this->lectionRepository->createFromRequest($request);
        if (null === $created) {
            return $this->error('Lection creation failed');
        }
        return $this->success('Lection created', $created->toArray());
    }

    public function update(Lection $lection, UpdateLectionRequest $request): JsonResponse
    {
        $updated = $this->lectionRepository->updateFromRequest($request, $lection);
        if (null === $updated) {
            return $this->error('Lection update failed');
        }
        return $this->success('Lection updated', $updated->toArray());
    }

    public function destroy(Lection $lection): JsonResponse
    {
        if (!$lection->delete()) {
            return $this->error('Lection deletion failed');
        }
        return $this->success('Lection deleted');
    }
}
