<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Project extends Model
{
    use HasFactory;
    use Timestamp;

    protected $fillable = ['name', 'description'];

    public function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('priority')->chaperone();
    }

    /**
     * @param Builder $query
     * @return object
     */
    public function scopeGetOneProjectId(Builder $query): object
    {
        return $query->select(['id'])->limit(1)->get();
    }
}
