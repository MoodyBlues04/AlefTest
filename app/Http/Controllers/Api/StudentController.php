<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\CreateStudentRequest;
use App\Http\Requests\Api\UpdateStudentRequest;
use App\Models\Student;
use App\Repositories\StudentRepository;
use Illuminate\Http\JsonResponse;

class StudentController extends ApiController
{
    public function __construct(private readonly StudentRepository $studentRepository)
    {
    }

    public function index(): JsonResponse
    {
        $students = $this->studentRepository->getAll();
        return $this->success('Students list', $students);
    }

    public function show(Student $student): JsonResponse
    {
        return $this->success('Student', $student->append('learnt_lections')->toArray());
    }

    public function store(CreateStudentRequest $request): JsonResponse
    {
        $created = $this->studentRepository->createFromRequest($request);
        if (null === $created) {
            return $this->error('Student creation failed');
        }
        return $this->success('Student created', $created->toArray());
    }

    public function update(Student $student, UpdateStudentRequest $request): JsonResponse
    {
        $updated = $this->studentRepository->updateFromRequest($request, $student);
        if (null === $updated) {
            return $this->error('Student update failed');
        }
        return $this->success('Student updated', $updated->toArray());
    }

    public function destroy(Student $student): JsonResponse
    {
        if (!$student->delete()) {
            return $this->error('Student deletion failed');
        }
        return $this->success('Student deleted');
    }
}
