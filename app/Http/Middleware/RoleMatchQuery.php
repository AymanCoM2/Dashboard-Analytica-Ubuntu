<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RoleMatchQuery
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()) {
            // if t
            $userRoleId = $request->user()->role_id;
            $allIds = [];
            $allRelatedQueryIds = [];
            $allRelatedQueryIds = DB::select('select query_id from roles_queries where (role_id) = (?)', [$userRoleId]);
            foreach ($allRelatedQueryIds as $key => $value) {
                array_push($allIds, $value->query_id);
            }
            // Now we Have All IDs of Queries  For this Users 
            // 
            if (in_array($request->id, $allIds)) {
                return $next($request);
            } else {
                return redirect()->route('dash.index');
            }
        } else {
            return redirect()->route('login');
        }
    }
}