<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $class_id
 *
 * @property-read SchoolClass $schoolClass
 * @property-read Collection $classLections
 */
class StudyPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function classLections(): HasMany
    {
        return $this->hasMany(ClassLection::class, 'study_plan_id');
    }
}
