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
        $ids = $this->classLections()
            ->where('status', ClassLection::STATUS_LEARNT)
            ->get()
            ->map(fn (ClassLection $classLection) => $classLection->studyPlan->schoolClass->id)
            ->unique()
            ->all();
        return SchoolClass::query()->whereIn('id', $ids)->get();
    }
}
