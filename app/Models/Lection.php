<?php
declare(strict_types=1);

namespace App\Models;

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
}
