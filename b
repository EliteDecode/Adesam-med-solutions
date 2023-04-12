<?php
include('../includes/database/db_controllers.php');

$product = $_POST['product'];
$price_per_can = $_POST['price_per_can'];
$price_of_drink = $_POST['price_of_drink'];
$bottlesSold = $_POST['bottles_sold'];
$grossSale = $_POST['gross_sale'];
$cogUsed = $_POST['cog_used'];
$totalProfit = $_POST['total'];



$rows = [
    $product,
    $price_per_can,
    $price_of_drink,
    $bottlesSold,
    $grossSale,
    $cogUsed,
    $totalProfit,
];

function savedata() {
    var product = $("#product").val();
    var price_per_can = $("#Price_per_can").val();
    var bottlesSold = $("#Bottles_sold").val();
    var price_of_drink = $("#price_of_drink").val();
    var grossSale = $("#gross_sale").val();
    var cogUsed = $('#cog_used').val();
    var totalProfit = $('#total_profit').val()

    $.ajax({
        url: 'admin/ajax_controls/saveData.php',
        method: 'post',
        data: {
            product,
            price_per_can,
            bottlesSold,
            price_of_drink,
            grossSale,
            cogUsed,
            totalProfit
        },
        success: function(data) {
            console.log(data)
            if (data == 'success') {
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
                    window.location = "beers.php";
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
        },

    })


    var formData = new FormData(document.getElementById('post-form'))

    fetch('admin/ajax_controls/saveData.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {

            return response.text();
        })
        .then(function(text) {
            $('#msg').html(text);
            if (text == 'success') {

                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations',
                    text: 'Your data has been saved successfully',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                }).then(function() {
                    window.location = "posts.php";
                });
            } else {

            }
        })

}