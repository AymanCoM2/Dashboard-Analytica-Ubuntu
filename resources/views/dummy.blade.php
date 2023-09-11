@extends('dash')
@section('main-content')
    <div>
        <canvas id="myChart"></canvas>
    </div>

    <div class="container overflow-auto">
        <h1 id="loader">Data is Loading Please Wait</h1>
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
            var columns = [];
            $.ajax({
                url: "{{ route('vvv') }}",
                success: function(data) {
                    console.log('Data Success From the API');

                    const x = data.data;
                    columnNames = data.keys;
                    for (var i of columnNames) {
                        columns.push({
                            data: i,
                            name: i
                        });
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
                        processing: true,
                        serverSide: false,
                        searchable: true,
                        searching: true,
                        data: x,
                        draw: function() {
                            console.log('Drawing the Page Again');
                        },
                        columns: columns,
                        initComplete: function() {
                            $("#loader").text("Data is LOADED !!")
                            createSomeCharts(x); // Sending to Outer
                            this.api()
                                .columns()
                                .every(function() {
                                    let column = this;
                                    let title = column.header().textContent;
                                    let input = document.createElement('input');
                                    input.placeholder = title;
                                    column.header().prepend(input);
                                    input.addEventListener('keyup', () => {
                                        if (column.search() !== this
                                            .value) {
                                            column.search(input.value)
                                                .draw();
                                        }
                                    });
                                });
                        }, // initComplete END 
                    }); // End Of Making the New Data Table 
                }
            })
        }); // End OF Document Ready

        function createSomeCharts(allAjaxData) {
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
            prices.sort((a, b) => b.price - a.price);
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
