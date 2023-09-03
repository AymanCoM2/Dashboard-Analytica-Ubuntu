@extends('dash')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('main-content')
    @foreach (App\Models\QueryOfReport::all() as $query)
        <div class="card d-flex justify-content-center mx-4">
            <div class="card-body">
                <a href="{{ route('queries.manage.view', $query->id) }}" class="mx-4">{{ $query->query_title }}</a> |
                <a href="{{ route('queries.manage.edit', $query->id) }}" class="mx-3"> Edit Query </a>
                <form action="{{ route('queries.manage.delete', $query->id) }}" class="form-inline float-right m-2"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="float-right m-2 fa fa-trash button-solid  btn btn-link border-0">
                    </button>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@section('creation-link')
    <a href="{{ route('queries.manage.create') }}" class="btn btn-primary">+ Create New Query</a>
@endsection

@section('extra-script')
@endsection
