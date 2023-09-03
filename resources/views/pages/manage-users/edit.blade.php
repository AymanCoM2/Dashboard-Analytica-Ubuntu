@extends('dash')
@section('main-content')
    <form method="POST" action="{{ route('users.manage.update', $singleUser->id) }}">
        @csrf
        <div class="form-group">
            <label for=""> User Name :</label>
            <input type="text" class="form-control" value="{{ $singleUser->name }}" disabled>
        </div>

        <div class="form-group">
            <select class="form-select" name="f_role_id">
                @foreach (App\Models\Role::all() as $role)
                    <option value="{{ $role->id }}"
                        @php
if ($singleUser->role_id == $role->id) :
                                                echo "selected" ; 
                                                endif ; @endphp>
                        {{ $role->role_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>

    @if (!$singleUser->approved)
        <form method="POST" action="{{ route('toggleUserApproval', $singleUser->id) }}" class="float-right">
            @csrf
            <button type="submit" class="btn btn-danger">Approve User</button>
        </form>
    @else
        <form method="POST" action="{{ route('toggleUserApproval', $singleUser->id) }}" class="float-right">
            @csrf
            <button type="submit" class="btn btn-warning">Disapprove User</button>
        </form>
    @endif
@endsection
