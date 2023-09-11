<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelIgnition\Recorders\QueryRecorder\QueryRecorder;

class ReportCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category_name'];

    public function queries()
    {
        return $this->hasMany(QueryOfReport::class);
    }
}
