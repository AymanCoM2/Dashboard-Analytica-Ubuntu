@extends('dash')

<meta name="csrf-token" content="{{ csrf_token() }}">
@section('main-content')
    @foreach (App\Models\ReportCategory::all() as $category)
        <div class="card d-flex justify-content-center mx-4">
            <div class="card-body">
                <a href="#" class="categoryReport float-left" data-type="text" data-pk="{{ $category->id }}"
                    data-url="{{ route('categories.manage.update', $category->id) }}" data-title="Enter username"
                    data-csrf="{{ csrf_token() }}">{{ $category->category_name }}</a>
                <form action="{{ route('categories.manage.delete', $category->id) }}" class="form-inline float-right m-2"
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
    <a href="{{ route('categories.manage.create') }}" class="btn btn-primary">+ Create New Category</a>
@endsection

@section('extra-script')
    $.fn.editable.defaults.ajaxOptions = {
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    };

    $(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    $('.categoryReport').editable(

    );
    });
@endsection
