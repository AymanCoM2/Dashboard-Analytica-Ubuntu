<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryPrivot extends Model
{
    use HasFactory;

    protected $fillable = ['query_pivot'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function queryofreport()
    {
        return $this->belongsTo(QueryOfReport::class);
    }
}
