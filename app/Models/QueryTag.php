<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryTag extends Model
{
    use HasFactory;
    protected $fillable = ['tag'];

    public function queryofreport()
    {
        return $this->belongsTo(QueryOfReport::class);
    }
}
