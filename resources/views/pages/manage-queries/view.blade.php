@extends('dash')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('main-content')
    <div class="card">
        <div class="card-body">
            <h1 class="">Query Title : {{ $singleQuery->query_title }}</h1>
            <p class="float-right">{{ $singleQuery->created_at }}</p>
            <br>
            <hr>
            <div class="card" style="display: none;">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Enter SQL Query Here : </label>
                        <textarea class="form-control" id="er" rows="3" name="f_sql_query_string">{{ $singleQuery->sql_query_string }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="">
        <canvas id="myChart"></canvas>
    </div> --}}
    {{-- TODO --}}

    <div class="container overflow-auto">
        <h1 id="loader" class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </h1>
        {{-- <a href="" id="theHref" class="btn btn-primary">Generate Pdf File From Data</a> --}}
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
            let theTExt = $('textarea#er').val();
            console.log("Here is the Query : ");
            console.log(`${theTExt}`)
            afterDocumentIsReady(); //TODO
        }); // End OF Document Ready

        function afterDocumentIsReady() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); // Setting Up the Ajax # 1 
            var columns = [];
            let table;
            $.ajax({
                type: 'POST',
                url: "{{ route('vvv') }}",
                data: {
                    que: $('textarea#er').val(),
                },
                success: function(data) {
                    console.log('Data Success From the API');

                    const x = data.data;
                    const columnNames = data.keys;

                    for (var i of columnNames) {
                        columns.push({
                            data: i,
                            name: i
                        });
                        document.getElementById("the-heading").innerHTML = data.row;
                    } // 
                    // let startTime = new Date();
                    // let endTime = new Date();
                    // let timeElapsed = endTime - startTime;
                    // alert(timeElapsed);

                    pdfMake.fonts = {
                        Roboto: {
                            normal: 'Roboto-Italic.ttf',
                            bold: 'Roboto-Italic.ttf',
                            italics: 'Roboto-Italic.ttf',
                            bolditalics: 'Roboto-Italic.ttf'
                        }
                    }; // Setting Up the Fonts For the Pdf  Report 


                    table = $('.data-table').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'csv',
                                className: 'btn btn-primary shadow rounded-pill'
                            }, {
                                extend: 'excelHtml5',
                                className: 'btn btn-success shadow  rounded-pill',
                                title: null
                            },
                            {
                                extend: 'pdfHtml5',
                                className: ' btn btn-warning shadow  rounded-pill',
                                charset: "utf-8",
                                pageSize: 'A0',
                                bom: true,
                                orientation: 'landscape',
                                customize: function(doc) {
                                    doc.defaultStyle.font = "Roboto";
                                }
                            },
                        ],
                        order: [],
                        paging: true,
                        deferRender: true,
                        retrieve: false,
                        processing: true,
                        serverSide: false,
                        searchable: true,
                        searching: true,
                        data: x,
                        columns: columns,
                        initComplete: function() {

                            // console.log(this.api().rows().data()[0]);
                            $("#loader").text("")
                            // createSomeCharts(x); // Sending to Outer
                            // TODO
                            this.api()
                                .columns()
                                .every(function() {
                                    let column = this;
                                    // let title = column.header().textContent;
                                    // Create input element
                                    let input = document.createElement('input');
                                    input.classList.add("rounded");
                                    input.classList.add("d-block");
                                    input.classList.add("border-primary");
                                    input.classList.add("shadow");

                                    // input.placeholder = title;
                                    column.header().append(input);
                                    // Event listener for user input
                                    input.addEventListener('input', () => {
                                        if (column.search() !== this
                                            .value) {
                                            column.search(input.value)
                                                .draw();
                                        }
                                    });
                                    // input.addEventListener('keyup', () => {
                                    //     if (column.search() !== this
                                    //         .value) {
                                    //         column.search(input.value)
                                    //             .draw();
                                    //     }
                                    // });
                                    $('input').click(function(e) {
                                        e.stopPropagation();
                                    });
                                });
                            // alert(timeElapsed);
                        }, // initComplete END 
                    }); // End Of Making the New Data Table 

                    addBtnEvent(); // After Making Table and Buttons , Adding Events to Buttons
                },
                error: function() {
                    $("#loader").text("Error Running the SQL query !!");
                }, // End of Error Option 
            }) // End Of Ajax call 

            // document.getElementById('theHref').addEventListener(
            //     'click',
            //     (e) => {
            //         // TODO making the Server-Side Export Not Client Side 
            //         e.preventDefault();
            //         console.log('clicked');
            //         let searchedData = table.rows({
            //             search: 'applied'
            //         }).data().toArray();

            //         $.ajax({
            //             type: 'get',
            //             url: "{{ route('pdf-generate') }}",
            //             data: {
            //                 que: searchedData,
            //             },
            //             success: function(data) {
            //                 console.log("Request Done");
            //                 console.log(data);
            //             },
            //             error: function(res) {}
            //         });
            //     }
            // );

            function addBtnEvent() {
                let buttonsArr = document.getElementsByClassName(
                    'dt-button buttons-html5');
                for (btn of buttonsArr) {
                    btn.addEventListener(
                        'click',
                        (e) => {
                            // TODO making the Server-Side Export Not Client Side 
                            e.preventDefault();
                            console.log('clicked');
                            console.log(table.rows({
                                search: 'applied'
                            }).data().toArray());
                            Toastify({
                                text: "Done ! Once the File Created , It will Download Automatically",
                                duration: 3000
                            }).showToast();
                        });
                } // End Of the For Loop 
            } // End of addBtnEvent Function; 
        } // End Of afterDocumentIsReady Function;  

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
                        data: [prices[0].price, prices[1].price, prices[2].price, prices[3]
                            .price,
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