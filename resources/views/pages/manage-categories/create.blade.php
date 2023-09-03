@extends('dash')
@section('main-content')
    <form method="POST" action="{{ route('categories.manage.store') }}">
        @csrf
        <div class="form-group">
            <label for="">Category Name :</label>
            <input type="text" name="f_category_name" class="form-control" required
                placeholder="Enter Name Of Report Category">
        </div>
        <button type="submit" class="btn btn-primary">Save New Category</button>
    </form>
@endsection