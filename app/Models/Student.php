<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property ?int $class_id
 * @property string $name
 * @property string $email
 *
 * @property-read ?SchoolClass $schoolClass
 */
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'name',
        'email',
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    protected function learntLections(): Attribute
    {
        return new Attribute(
            get: fn () => $this->schoolClass
                ? $this->schoolClass->studyPlan->getLectionsByStatus(ClassLection::STATUS_LEARNT)
                : [],
        );
    }
}
