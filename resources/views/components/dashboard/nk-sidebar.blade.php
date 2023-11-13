@if (Auth::user())
    @php
        $allIds = [];
        $allRelatedQueryIds = [];
        $allRelatedQueryIds = DB::select('select query_id from roles_queries where (role_id) = (?)', [Auth::user()->role->id]);
        foreach ($allRelatedQueryIds as $key => $value) {
            array_push($allIds, $value->query_id);
        }
        // dd($allIds);
    @endphp

    <div class="nk-sidebar">
        <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
                <li class="nav-label">Dashboard</li>
                @if (Auth::user()->role_id == '1')
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Manage</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('categories.manage.index') }}">Manage Report Categories</a></li>
                            <li><a href="{{ route('queries.manage.index') }}">Manage Queries</a></li>
                            <li><a href="{{ route('roles.manage.index') }}">Manage Roles</a></li>
                            <li><a href="{{ route('users.manage.index') }}">Manage Users
                                    <span
                                        class="badge badge-danger">{{ App\Models\User::whereNotNull('email_verified_at')->where('approved', false)->count() }}</span>
                                </a></li>
                        </ul>
                    </li>
                @endif

                <li class="nav-label">Categories : </li>
                @foreach (App\Models\ReportCategory::all() as $category)
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-envelope menu-icon"></i> <span
                                class="nav-text">{{ $category->category_name }}</span>
                        </a>
                        <ul aria-expanded="false">
                            @foreach ($category->queries as $query)
                                @if (in_array($query->id, $allIds))
                                    <li><a
                                            href="{{ route('queries.manage.view', $query->id) }}">{{ $query->query_title }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
@else
    <script>
        window.location = "/login";
    </script>
@endif
