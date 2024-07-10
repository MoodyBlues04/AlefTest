<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Student::class);
    }
}
