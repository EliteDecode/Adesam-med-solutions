<?php 
session_start();
require('admin/includes/database/db_controllers.php');

$posts;
$total_profit;

$date = date('y-m-d');
$formated_date;




if(isset($_GET['status']) && isset($_GET['date'])){
    $status = $_GET['status'];
    $date = $_GET['date'];
 
    if($status == 'saved'){
        $posts = selectAll('night_bottle_serviceHide', ['DateReg' => $date, 'FullName' => 'Ese Jonathan', 'Bar' => $bar ]);

     
        $total_profit = selectOne('saved_data', ['DateReg' => $date]);
        $formated_date = date("F jS, Y", strtotime($date));
    }
}else{
    $posts = selectAll2('beers');
    $formated_date = date("F jS, Y", strtotime($date));
}






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barbucks</title>
    <link rel="icon" href="assets/images/logo-nav.png" type="image/x-icon">
    <!--Bootstrap css-->
    <link rel="stylesheet" href="lib/css/bootstrap.min.css" />

    <!--Tailwind css-->
    <link rel="stylesheet" href="lib/css/tailwind.min.css" />

    <!--Carousel-->
    <link rel="stylesheet" href="lib/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="lib/css/owl.theme.default.min.css" />
    <!--DataTables --->

    <!--fonts-->
    <link rel="stylesheet" href="lib/fonts/css/all.min.css" />
    <!--css-->
    <link rel="stylesheet" href="styles/css/global.css" />
    <link rel="stylesheet" href="styles/css/index.css" />
    <link rel="stylesheet" href="lib/css/jquery.dataTables.min.css" />
</head>

<body>
    <div style="background-color: #fafafa" class="min-h-screen">
        <div class="container">
            <div class="header flex justify-between items-center py-2">
                <a href="index.php">
                    <div class="logo">
                        <img src="assets/images/logo.png" alt="" width="15px" />
                    </div>
                </a>
                <div class="flex space-x-4 items-center">

                    <a href="bottle_service.php?">
                        <div class="flex items-center space-x-2">
                            <img src="assets/images/back-arrow.png" alt="" width="25px" />
                            <h3 class="font-semibold text-lg">Back</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row flex justify-center">
                <div class="col-md-12 col-lg-12 col-xl-12 " style="padding: 0% 2%">
                    <div class="p-3 mb-2 flex bg-white items-center justify-between shadow-md rounded-lg">
                        <div class="flex items-center space-x-2">
                            <img src="assets/images/beer2.png" alt="" width="40px" />
                            <h3 class="font-semibold text-xl uppercase">Pre-sale Bottles</h3>
                        </div>
                        <div>
                            <input type="hidden" id='current_date' value='<?php echo $date; ?>'>

                            <?php  
                        if(isset($_GET['status']) && isset($_GET['date'])){
                            $getDate = $_GET['date'];
                            $cur = date('y-m-d');
                            $difference = strtotime( $getDate ) - strtotime( $cur );
                          
                            if($difference != 0){
                                echo "<button class='btn btn-secondary font-bold text-sm uppercase' onclick='refreshdata()'>Refresh
                                <i class='fa fa-refresh'></i></button>";
                            }else{
                                echo "<button class='btn btn-secondary font-bold text-sm uppercase' onclick='savedata()'>Save
                                Data <i class='fa fa-save'></i></button>";
                            }
                          }else{
                            echo "<button class='btn btn-secondary font-bold text-sm uppercase' onclick='savedata()'>Save
                                Data <i class='fa fa-save'></i></button>";
                          }
                          ?>
                            <button class='btn btn-warning font-bold text-sm uppercase' data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Fetch Data <i class="fa fa-cloud-download"></i></button>
                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Fetch previous data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="date" class='form-control' id='date_input'>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"
                                                onclick='fetchdata()'>Fetch</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="px-5 py-3 shadow-md bg-white rounded-lg border-2 border-green-100" id='msg'>
                        <h2 class='pb-3 text-md font-bold'>Data recorded on <?php echo $formated_date; ?></h2>
                        <form action="" id='post-form' onsubmit='return false'>
                            <table class="table table-hover border" id="postTable" width="100%">
                                <thead class="" style="border: 1px solid gray !important">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Product</th>
                                        <th scope="col" class=''>Price of drink($)</th>
                                        <th scope="col">Bottles at default</th>
                                        <th scope="col" class=''>Bottles on deal</th>
                                        <th scope="col" class=''>Price of deal</th>
                                        <th scope="col" class=''>Total/B</th>
                                        <th scope="col" class=''>Total/A</th>
                                        <th scope="col" class=''>Profit/A</th>
                                        <th scope="col" class=''>Profit/C</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($posts as $key=>$post): ?>
                                    <tr>
                                        <th scope="row"><?php echo $key + 1  ?></th>
                                        <td><input type="text" readonly class='form-control font-semibold' value='<?php if(isset($_GET['status'])) {
                                                echo $post['Product'];
                                              }else{
                                                    echo $post['Product'];
                                                }  ?>' id='product' name='product[]'>
                                        </td>
                                        <td class="">
                                            <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['price_of_drink'];
                                              }else{
                                                    echo $post['price_of_drink'];
                                                }  ?>' placeholder="$2" readonly id='price_of_drink'
                                                name='price_of_drink[]' />
                                        </td>
                                        <td class="">
                                            <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Bottles_sold_default'];
                                              }else{
                                                    echo '0';
                                                }  ?>' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                onkeypress="calculateQuantity(event)" id='Bottles_sold_default'
                                                name='bottles_sold_default[]' />
                                        </td>
                                        <td class="">
                                            <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Bottles_sold_deal'];
                                              }else{
                                                    echo '0';
                                                }  ?>' placeholder="Bottles sold" onblur="calculateQuantityblur(event)"
                                                onkeypress="calculateQuantity(event)" id='Bottles_sold_deal'
                                                name='bottles_sold_deal[]' />
                                        </td>

                                        <td class="">
                                            <input type="number" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['price_of_deal'];
                                              }else{
                                                echo $post['price_of_deal'];
                                                }  ?>' placeholder="$6.8" readonly id='price_of_deal'
                                                name='price_of_deal[]' />
                                        </td>


                                        <td class="">
                                            <input type="number" name="Total_bottles[]" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Total_bottles'];
                                              }else{
                                                echo '0';
                                                }  ?>' readonly id='Total_bottles' />
                                        </td>
                                        <td class="">
                                            <input type="number" name="Total_amount[]" class="form-control" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Total_amount'];
                                              }else{
                                                echo '0';
                                                }  ?>' readonly id='Total_amount' />
                                        </td>
                                        <td class="">
                                            <input type="number" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Profit_company'];
                                              }else{
                                                echo '0';
                                                }  ?>' name="Profit_company[]" class="form-control  total_input"
                                                readonly id='Profit_company' />
                                        </td>
                                        <td class="">
                                            <input type="number" value='<?php if(isset($_GET['status'])) {
                                                echo $post['Profit_attendant'];
                                              }else{
                                                echo '0';
                                                }  ?>' name="Profit_attendant[]" class="form-control  total_input"
                                                readonly id='Profit_attendant' />
                                        </td>
                                        <td class='hidden'>
                                            <input type="number" value='<?php if(isset($_GET['status'])) {
                                                echo $post['id'];
                                              }else{
                                                echo '0';
                                                }  ?>' name="id[]" class="form-control  " readonly id='' />
                                        </td>

                                    </tr>

                                    <?php endforeach; ?>
                                    <td colspan='8' class='font-bold '></td>
                                    <td colspan='' class='font-bold  aliign-right'>Total Profit:</td>
                                    <td colspan='' class='font-bold  aliign-right flex border'>
                                        $<div id='TotalValue' class='  w-100'>
                                            <?php if(isset($_GET['status'])){ echo $total_profit['Total_profit']; }else{ echo '0';}?>
                                        </div>
                                    </td>

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php') ?>
    <script src="styles/js/beers.js"></script>

    <script>
    jQuery(document).ready(function($) {
        $("#postTable").DataTable({
            scrollX: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "E.g. John Doe",
            },
        });
    });

    function calculateQuantity(event) {
        if (event.keyCode === 13) {
            calculateTotal(event);
            calculateProfit(event);
            calculateTotalProfit(event);
            calculateTotalProfit()
        }
    }

    function calculateQuantityblur(event) {
        calculateTotal(event);
        calculateProfit(event);
        calculateTotalProfit(event);
        calculateTotalProfit()
    }

    function calculateTotal(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;
        var pricePerCan = tr.getElementsByTagName("input")[1].value;
        var priceOfDrink = tr.getElementsByTagName("input")[3].value;
        var totalDrinks = tr.getElementsByTagName("input")[2].value;

        var grossSale = tr.getElementsByTagName("input")[4];
        var cogUsed = tr.getElementsByTagName("input")[5];
        grossSale.value = totalDrinks * priceOfDrink;
        cogUsed.value = totalDrinks * pricePerCan;
    }

    function calculateProfit(event) {
        var target = event.target;
        var td = target.parentNode;
        var tr = td.parentNode;

        var grossSale = parseFloat(tr.getElementsByTagName("input")[4].value);
        var cogUsed = parseFloat(tr.getElementsByTagName("input")[5].value);

        tr.getElementsByTagName("input")[6].value = (grossSale - cogUsed).toFixed(2);
    }

    function calculateTotalProfit(event) {

        const inputs = document.querySelectorAll('.total_input');
        let sum = 0;

        for (let i = 0; i < inputs.length; i++) {
            sum += parseFloat(inputs[i].value);
        }


        document.getElementById("TotalValue").innerHTML = sum.toFixed(2);


    }



    function savedata() {
        var currentTime = $('#current_date').val();
        Swal.fire({
            title: 'Do you want to save this data?',
            showCancelButton: true,
            confirmButtonText: 'Save',

        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                var tableData = [];
                var totalProfit = $('#TotalValue').text();



                $("#postTable tr").each(function(rowIndex, r) {
                    var cols = [];
                    $(this).find("td").each(function(colIndex, c) {
                        cols.push($(c).find("input").val());
                    });
                    tableData.push(cols);
                });
                $.ajax({
                    type: 'post',
                    url: 'admin/ajax_controls/saveData.php',
                    data: {
                        table_data: tableData,
                        totalProfit,

                    },
                    success: function(response) {
                        console.log(response)
                        if (response.includes('success')) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Congratulations',
                                text: 'This Data has been Saved Successfully',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            }).then(function() {
                                window.location =
                                    `presakes_bottles_service.php?bar=${bar}&status=saved&date=${currentTime}`;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong...',
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        }
                    }
                });
            }
        })
    }


    function fetchdata() {
        var date_input = $('#date_input').val();

        if (date_input != "") {
            var bar = $('#bar').val()
            window.location =
                `presakes_bottles_service.php?bar=${bar}&status=saved&date=${date_input}`;

        } else {
            $("#date_input").removeClass('form-control').addClass('form-control is-invalid');
        }
    }

    function refreshdata() {
        var bar = $('#bar').val()
        window.location =
            `presakes_bottles_service.php?bar=${bar}`;
    }
    </script>

</body>

</html>