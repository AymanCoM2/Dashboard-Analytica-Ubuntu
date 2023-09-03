@extends('dash')
@section('main-content')
    <form method="POST" action="{{ route('roles.manage.update', $singleRole->id) }}">
        @csrf
        <div class="form-group">
            <label for=""> Role Name :</label>
            <input type="text" name="f_role_name" class="form-control" value="{{ $singleRole->role_name }}">
        </div>

        <div class="row">
            @foreach (App\Models\ReportCategory::all() as $category)
                <div class="col-3">
                    <p>{{ $category->category_name }}</p>
                    <ul>
                        @foreach ($category->queries as $query)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $query->id }}"
                                    name="f_query_id[]"
                                    @php
if (in_array( $query->id, $allIds)):
                                                echo "Checked" ; 
                                            endif  ; @endphp>
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{ $query->query_title }}
                                </label>
                            </div>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
