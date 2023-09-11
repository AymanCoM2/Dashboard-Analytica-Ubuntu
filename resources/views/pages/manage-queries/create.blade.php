@extends('dash')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main-content')
    {{--  --}}
    <form method="POST" action="{{ route('queries.manage.store') }}">
        @csrf
        <div class="form-group">
            <label for="">Query Name :</label>
            <input type="text" name="f_query_title" class="form-control" required
                placeholder="Enter Name Of Report Category">
        </div>
        <div class="form-group">
            <label for="">Query Category :</label>
            <select class="form-select" aria-label="Default select example" name="f_report_category_id">
                @foreach (App\Models\ReportCategory::all() as $category)
                    <option value="{{ $category->id }}" selected>{{ $category->category_name }} </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Enter SQL Query Here : </label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="f_sql_query_string" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit and Create</button>

    </form>
    <div class="row m-5">
        <div class="col-9"></div> <!-- Create 9 empty columns -->
        <div class="col-3">
            <a href="" class="btn btn-danger float-right" id="testingQuery">Test Query</a>
        </div>
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
            $('#testingQuery').click(function(e) {
                $("#loader").text("")
                $("#loader").html(`<div class="spinner-border visually-hidden" role="status" id="realLoader">
                <span class="visually-hidden">Loading...</span>
            </div>`)
                $("#realLoader").removeClass("visually-hidden");
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
                        console.log(data);
                        const x = data.data;
                        columnNames = data.keys;
                        for (var i of columnNames) {
                            columns.push({
                                data: i,
                                name: i
                            });
                            document.getElementById("the-heading").innerHTML = data.row;
                        }

                        $('.data-table').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'csv', 'excel'
                            ],
                            deferRender: true,
                            retrieve: false,
                            processing: true,
                            serverSide: false,
                            searchable: true,
                            searching: true,
                            "bDestroy": true,
                            data: x,
                            draw: function() {
                                console.log('Drawing the Page Again');
                            },
                            columns: columns,
                            initComplete: function() {
                                $("#loader").text("")
                                this.api()
                                    .columns()
                                    .every(function() {
                                        let column = this;
                                        let title = column.header()
                                            .textContent;
                                        let input = document.createElement(
                                            'input');
                                        column.header().prepend(input);
                                        input.addEventListener('input',
                                            () => {
                                                if (column.search() !==
                                                    this
                                                    .value) {
                                                    column.search(input
                                                            .value)
                                                        .draw();
                                                }
                                            });
                                        input.addEventListener('keyup',
                                            () => {
                                                if (column.search() !==
                                                    this
                                                    .value) {
                                                    column.search(input
                                                            .value)
                                                        .draw();
                                                }
                                            });
                                        input.classList.add("filterClass");
                                        $('input').click(function(e) {
                                            e.stopPropagation();
                                        });
                                    });

                                // alert(timeElapsed);
                            }, // initComplete END 
                        }); // End Of Making the New Data Table 
                    },
                    error: function(err) {
                        $("#loader").text("Error Running the SQL query !!");
                        console.log(err);
                    },
                })
            });

        }); // End OF Document Ready
    @endsection
</script>
