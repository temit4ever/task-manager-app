<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Timestamp;

    protected $fillable = ['name', 'priority', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
