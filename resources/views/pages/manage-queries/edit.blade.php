@extends('dash')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main-content')
    <form method="POST" action="{{ route('queries.manage.update', $singleQuery->id) }}">
        @csrf
        <div class="form-group">
            <label for="">Query Title :</label>
            <input type="text" name="f_query_title" class="form-control" value="{{ $singleQuery->query_title }}">
        </div>
        <div class="form-group">
            <label for="">Query Category :</label>
            <select class="form-select" aria-label="Default select example" name="f_report_category_id">
                @foreach (App\Models\ReportCategory::all() as $category)
                    <option value="{{ $category->id }}"
                        {{ $x = $singleQuery->report_category_id == $category->id ? 'selected' : '' }}>
                        {{-- $result = condition ? value1 : value2; --}}
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Enter SQL Query Here : </label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="f_sql_query_string">{{ $singleQuery->sql_query_string }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Updates</button>
    </form>
    <div class="row m-5">
        <a href="" class="btn btn-danger float-right" id="testingQuery">Test Query</a>
    </div>
    <div class="container overflow-auto">
        <h1 id="loader" class="text-center">
            <div class="spinner-border visually-hidden" role="status" id="realLoader">
                <span class="visually-hidden">Loading...</span>
            </div>
        </h1>
        <table class="table  table-bordered data-table">
            <thead>
                <tr id="the-heading">

                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>

                </tr>
            </tfoot>
        </table>
    </div>
@endsection
<script>
    @section('extra-script')
        $(document).ready(function() {
            // WRAP BELOW CODE if a is Clicked !!!
            $('#testingQuery').click(function(e) {
                $("#loader").text("")
                $("#loader").html(`<div class="spinner-border visually-hidden" role="status" id="realLoader">
                <span class="visually-hidden">Loading...</span>
            </div>`)
                $("#realLoader").removeClass("visually-hidden")
                $('.filterClass').remove();
                console.log(e.target);
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var columns = [];
                $.ajax({
                    type: 'POST',
                    url: "{{ route('vvv') }}",
                    data: {
                        que: $("#exampleFormControlTextarea1").val(),
                    },
                    success: function(data) {
                        console.log('Data Success From the API');
                        const x = data.data;
                        columnNames = data.keys;
                        for (var i of columnNames) {
                            columns.push({
                                data: i,
                                name: i
                            });
                            // HERE IN THE LOOP
                            // TODO try thr innerHTML instead Of Nodes ? 
                            // node = document.createElement("td");
                            // textnode = document.createTextNode(i);
                            // node.innerText = i ; 
                            document.getElementById("the-heading").innerHTML = data.row;
                        }
                        // Create TH elements and Put the Text 

                        $('.data-table').DataTable({
                            deferRender: true,
                            retrieve: false,
                            processing: true,
                            serverSide: false,
                            searchable: true,
                            searching: true,
                            "bDestroy": true,
                            data: x,

                            columns: columns,
                            initComplete: function() {

                                $("#loader").text("");

                                // alert(timeElapsed);
                            }, // initComplete END 
                        }); // End Of Making the New Data Table 
                    },
                    error: function() {
                        $("#loader").text("Error Running the SQL query !!");
                    },
                })
            });

        }); // End OF Document Ready
    @endsection
</script>
