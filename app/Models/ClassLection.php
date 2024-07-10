<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $study_plan_id
 * @property int $lection_id
 * @property int $order
 * @property string $status
 *
 * @property-read Lection $lection
 * @property-read StudyPlan $studyPlan
 */
class ClassLection extends Model
{
    use HasFactory;

    public const STATUS_CREATED = 'created';
    public const STATUS_LEARNT = 'learnt';


    protected $fillable = [
        'order',
        'status',
        'study_plan_id',
        'lection_id',
    ];

    public function lection(): BelongsTo
    {
        return $this->belongsTo(Lection::class, 'lection_id');
    }

    public function studyPlan(): BelongsTo
    {
        return $this->belongsTo(StudyPlan::class, 'study_plan_id');
    }
}
