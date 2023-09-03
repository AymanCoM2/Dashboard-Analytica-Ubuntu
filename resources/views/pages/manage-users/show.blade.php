@extends('dash')
@section('main-content')
    <div class="form-group">
        <label for="" class=""> User Name :</label>
        <input type="text" class="form-control" value="{{ $singleUser->name }}" disabled>
    </div>

    <div class="form-group">
        <label for=""> User Email :</label>
        <input type="text" class="form-control" value="{{ $singleUser->email }}" disabled>
    </div>

    <div class="form-group">
        <label for=""> User Role :</label>
        <select class="form-select" name="f_role_id" disabled>
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


    @if (!$singleUser->email_verified_at)
        <button type="submit" disabled class="btn btn-danger">Not Verified</button>
    @else
        <button type="submit" disabled class="btn btn-success">Verified User</button>
    @endif

    @if (!$singleUser->approved)
        <button type="submit" disabled class="btn btn-danger">Not Approved</button>
    @else
        <button type="submit" disabled class="btn btn-success">Approved User</button>
    @endif

    <a href="{{ route('users.manage.edit', $singleUser->id) }}" class="mx-3">Edit User</a>
@endsection
