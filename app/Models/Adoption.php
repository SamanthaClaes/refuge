<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adoption extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'started_at',
        'adopter_id',
        'animal_id',
        'closed_at',
    ];

    public function adopter(): BelongsTo
    {
        return $this->belongsTo(Adopter::class);
    }

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    #[Scope]
    protected function ongoing(Builder $query): void
    {
        $query
            ->whereNotNull('started_at')
            ->whereNull('closed_at');
    }

    #[Scope]
    protected function finished(Builder $query): void
    {
        $query
            ->whereNotNull('closed_at');
    }

    protected function closedAsString(): Attribute
    {
        return Attribute::make(

            get: function (mixed $value, array $attributes) {
                if (is_null($attributes['closed_at'])) {
                    return 'en cours';

                }
                $date = Carbon::parse($attributes['closed_at'])->format('d F Y');
                return 'adoption cloturée, le '.$date;
            }
        );
    }

    protected function casts(): array
    {
        return [
            'started_at' => 'timestamp',
            'closed_at' => 'timestamp',
        ];
    }
}
