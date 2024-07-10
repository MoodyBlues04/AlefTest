<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $theme
 * @property ?string $description
 *
 * @property-read Collection $classLections
 */
class Lection extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'description',
    ];

    public function classLections(): HasMany
    {
        return $this->hasMany(ClassLection::class, 'lection_id');
    }

    protected function learntByClasses(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getLearntClasses()->all()
        );
    }

    protected function learntByStudents(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getLearntClasses()
                ->reduce(function (array $carry, SchoolClass $schoolClass) {
                    return $carry + $schoolClass->students->all();
                }, []),
        );
    }

    public function getLearntClasses(): Collection
    {
        return $this->classLections()
            ->select('study_plan_id')
            ->where('status', ClassLection::STATUS_LEARNT)
            ->distinct()
            ->get()
            ->map(fn (int $classId) => SchoolClass::query()->find($classId));
    }
}
