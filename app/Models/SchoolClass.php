<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 *
 * @property-read StudyPlan $studyPlan
 * @property-read Collection $students
 */
class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function studyPlan(): HasOne
    {
        return $this->hasOne(StudyPlan::class, 'class_id');
    }
}
