<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\SchoolClass;
use App\Repositories\SchoolClassRepository;
use Illuminate\Http\JsonResponse;

class SchoolClassController extends ApiController
{
    public function __construct(private readonly SchoolClassRepository $schoolClassRepository)
    {
    }

//    public function index(): JsonResponse
//    {
//        $classes = $this->schoolClassRepository->getAll();
//        return $this->success('Classes list', $classes);
//    }
//
//    public function show(SchoolClass $class): JsonResponse
//    {
//        return $this->success('Class', $class->toArray()); // todo with students
//    }
//
//    public function create($request): JsonResponse
//    {
//
//    }
//
//    public function update(SchoolClass $class, $request): JsonResponse
//    {
//
//    }
//
//    public function destroy(SchoolClass $class): JsonResponse
//    {
//
//    }
}
