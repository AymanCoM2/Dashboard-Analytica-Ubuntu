<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryOfReport extends Model
{
    use HasFactory;

    protected $fillable = ['report_cateogry_id', 'query_title', 'sql_query_string'];

    public function category()
    {
        return $this->belongsTo(ReportCategory::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_queries');
    }
}