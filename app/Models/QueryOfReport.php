<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryOfReport extends Model
{
    use HasFactory;

    protected $fillable = ['report_cateogry_id', 'query_title', 'sql_query_string', 'db_name', 'query_pivot'];

    public function category()
    {
        return $this->belongsTo(ReportCategory::class);
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'roles_queries');
    // }

    public function querytags()
    {
        return $this->hasMany(QueryTag::class , 'query_id');
    }

    public function querypivots()
    {
        return $this->hasMany(QueryPrivot::class);
    }
}
