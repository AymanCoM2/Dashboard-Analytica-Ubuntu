@extends('dash')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('main-content')
    @foreach ($allRoles as $role)
        <div class="card d-flex justify-content-center mx-4">
            <div class="card-body">
                <a href="{{ route('roles.manage.view', $role->id) }}" class="mx-3">{{ $role->role_name }}</a>
                <a href="{{ route('roles.manage.edit', $role->id) }}" class="mx-3"> | Edit Role </a>
                <form action="{{ route('roles.manage.delete', $role->id) }}" class="form-inline float-right m-2"
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
    <a href="{{ route('roles.manage.create') }}" class="btn btn-primary">+ Create New Role</a>
@endsection

@section('extra-script')
@endsection
