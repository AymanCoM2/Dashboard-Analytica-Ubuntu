@extends('dash')
@section('main-content')
    @foreach ($allUsers as $user)
        <div class="card d-flex justify-content-center mx-4">
            <div class="card-body">
                <p class="float-left mx-3 font-weight-bold"><a href="{{ route('users.manage.show', $user->id) }}"
                        class=""> {{ $user->name }}</a></p>

                <p class="float-right">{{ $user->role->role_name }}</p>

                <a href="{{ route('users.manage.edit', $user->id) }}" class="mx-3">| Edit User</a>

                @php
                    if (!$user->approved && $user->email_verified_at):
                        echo "
                    <div class='card-footer'>
                    <span class='text-success font-weight-bold'>Verified</span> <span class='font-weight-bold float-right text-danger'>Not Approved</span>
                </div>
                    ";
                    elseif (!$user->approved && !$user->email_verified_at):
                        echo "
                <div class='card-footer bg-light'>
                    <span class='text-danger font-weight-bold'>Not Verified</span> <span class='float-right font-weight-bold text-danger'>Not approved</span>
                </div>
                ";
                    endif;
                @endphp
            </div>

        </div>
    @endforeach
@endsection

@section('creation-link')
@endsection
