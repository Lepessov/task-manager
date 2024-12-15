<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'importance',
        'deadline',
    ];

    protected $dates = [
        'deadline',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'importance' => 'integer',
    ];

    public function scopeStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }

        return $query;
    }

    public function getPriorityAttributes()
    {
        if ($this->deadline < Carbon::now())
        {
            return 0;
        }

        $daysUntilDeadline = abs(Carbon::parse($this->deadline)->diffInDays(Carbon::now()));

        if ($daysUntilDeadline == 0) {
            return $this->importance;
        }

        return round($this->importance * (1 / $daysUntilDeadline), 2);
    }

    public function getIsOverdueAttribute()
    {
        return $this->deadline < Carbon::now();
    }
}
