{{-- @php
    dd($data);
@endphp --}}
{{-- @include('components.dashboard.head-tag') --}}
@extends('dash')
@section('main-content')
    {{-- <div class="card">
        <div class="card-body">
            <h1 class="">Query Title : {{ $singleQuery->query_title }}</h1>
            <p class="float-right">{{ $singleQuery->created_at }}</p>
            <br>
            <hr>
            <div class="card">
                <div class="card-body">
                    {{ $singleQuery->sql_query_string }}
                </div>
            </div>
        </div>
    </div> --}}
    <div>
        <canvas id="myChart"></canvas>
    </div>

    <div class="container overflow-auto">
        <h1 id="loader">Data is Loading Please Wait</h1>
        <table class="table  table-bordered data-table">
            <thead>
                <tr id="the-heading">
                    {{-- <th>ItemCode</th>
                    <th>Dscription</th>
                    <th>Price</th>
                    <th>ItemName</th> --}}
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    {{-- <th>ItemCode</th>
                    <th>Dscription</th>
                    <th>Price</th>
                    <th>ItemName</th> --}}
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
{{-- @extends('components.dashboard.js-includes') --}}
<script>
    @section('extra-script')
        $(document).ready(function() {
            var columns = [];
            $.ajax({
                url: "{{ route('vvv') }}",
                success: function(data) {
                    console.log('Data Success From the API');
                    // console.log(data);
                    // let textnode ; 
                    // let node ; 
                    // console.log(data);
                    // data = JSON.parse(data.data);
                    const x = data.data;
                    columnNames = data.keys;
                    // console.log('000000000000000000000000')
                    // console.log(columnNames);
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
                        dom: 'Bfrtip',
                        buttons: [
                            'csv', 'excel'
                        ],
                        deferRender: true,
                        retrieve: false,
                        // fixedHeader : true  , 
                        processing: true,
                        serverSide: false,
                        searchable: true,
                        searching: true,
                        // ajax: "{{ route('vvv') }}",
                        data: x,
                        draw: function() {
                            console.log('Drawing the Page Again');
                        },
                        columns: columns,
                        initComplete: function() {
                            // let endTime = new Date();
                            // let timeElapsed = endTime - startTime;
                            // alert(timeElapsed);
                            // console.log(this.api().rows().data()[0]);
                            $("#loader").text("Data is LOADED !!")
                            createSomeCharts(x); // Sending to Outer
                            this.api()
                                .columns()
                                .every(function() {
                                    let column = this;
                                    let title = column.header().textContent;
                                    // Create input element
                                    let input = document.createElement('input');
                                    input.placeholder = title;
                                    column.header().prepend(input);
                                    // Event listener for user input
                                    input.addEventListener('keyup', () => {
                                        if (column.search() !== this
                                            .value) {
                                            column.search(input.value)
                                                .draw();
                                        }
                                    });
                                });
                            // alert(timeElapsed);
                        }, // initComplete END 
                    }); // End Of Making the New Data Table 
                }
            })
        }); // End OF Document Ready

        function createSomeCharts(allAjaxData) {
            // Take all Ajax Data , Filter Only th3 Price Key 
            // And then Get the Top Five 
            // Then Draw the Chart n the Screen 
            const firstPrices = [];
            const prices = allAjaxData.reduce(
                (accumulator, currentObj) => {
                    accumulator.push({
                        price: currentObj.Price,
                        desc: currentObj.Dscription
                    });
                    return accumulator;
                },
                firstPrices
            );
            // console.log(prices);
            prices.sort((a, b) => b.price - a.price);
            // TODO splice For Duplicate Values 
            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [prices[0].desc, prices[1].desc, prices[2].desc, prices[3]
                        .desc, prices[4].desc
                    ],
                    datasets: [{
                        label: 'Top 5 Prices ',
                        data: [prices[0].price, prices[1].price, prices[2].price, prices[3].price,
                            prices[4].price
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    @endsection
</script>
