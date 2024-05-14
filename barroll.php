<?php  

include ('includes/header.php');
require('admin/includes/database/db_controllers.php');


if (!isset($_SESSION['users'])) {
    header('location:login.php');
 }


 $bar;
if(isset($_GET['bar'])){
    $bar = $_GET['bar'];
}

 $barId = $_SESSION['users'];
 
 $row = selectOne('users', ['BarId' => $barId]);

 $name = $row['Lastname'];



?>

<section class="main">
    <div class="row">
        <div class="col-md-6 col-sm-12" style="background-color: #fafafa">
            <div class="container p-5">
                <div class="logo">
                    <a href="index.php"> <img src="assets/images/logo.png" alt="" style='width: 50%' /></a>
                </div>
                <div class="text mt-5">
                    <h2 class="text-3xl mb-1 font-semibold">Hi <?php echo $name ?> 👋</h2>
                    <h2>Welcome to barroll , Please select a slice</h2>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 col-lg-6 mb-4">
                        <?php  
                        
                        $current_time = date('y-m-d');
                        $check = selectAll('saved_data', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar ]);
                        $num = count($check);

                        if($num >= 1):
                        ?>
                        <a href="beers.php?bar=<?php echo $bar ?>&status=saved&date=<?php echo $current_time ?>">
                            <div class="p-3 bg-white rounded-lg shadow-md flex flex-col items-center">
                                <h1 class="mb-4 font-bold text-2xl">Beer</h1>
                                <img src="assets/images/beer2.png" alt="" width="40%" />
                            </div>
                        </a>
                        <?php else: ?>
                        <a href="beers.php?bar=<?php echo $bar ?>">
                            <div class="p-3 bg-white rounded-lg shadow-md flex flex-col items-center">
                                <h1 class="mb-4 font-bold text-2xl">Beer</h1>
                                <img src="assets/images/beer2.png" alt="" width="40%" />
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 col-lg-6 mb-4">
                        <?php  
                        
                        $current_time = date('y-m-d');
                        $check = selectAll('saved_data_liquor', ['DateReg' => $current_time, 'BarID' => $barId, 'Bar' => $bar]);
                        $num = count($check);

                        if($num >= 1):
                        ?>
                        <a
                            href="liquor.php?bar=<?php echo $bar ?>&status=saved&date=<?php echo $current_time ?>&measurement=ounce">
                            <div class="p-3 bg-white rounded-lg shadow-md flex flex-col items-center">
                                <h1 class="mb-4 font-bold text-2xl">Liquor</h1>
                                <img src="assets/images/liquor.png" alt="" width="40%" />
                            </div>
                        </a>

                        <?php else: ?>
                        <a href="liquor.php?bar=<?php echo $bar ?>&measurement=ounce">
                            <div class="p-3 bg-white rounded-lg shadow-md flex flex-col items-center">
                                <h1 class="mb-4 font-bold text-2xl">Liquor</h1>
                                <img src="assets/images/liquor.png" alt="" width="40%" />
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div>
                    <a href="logout.php">
                        <button class="btn bg-teal-600 font-bold text-white"><i class="fa fa-sign-out"></i>
                            &nbspLogout</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 background-barrol hidden sm:block" style="height: 100vh; overflow: hidden">
            <div style="position: fixed; bottom: 7%" class="p-5">
                <h2 class="text-white text-3xl font-bold">
                    Barbucks: A one-stop destination for all your beverage needs.
                </h2>
                <p class="text-gray-100 text-lg">
                    offering a wide variety of drinks in a fun and lively atmosphere.
                </p>
            </div>
        </div>


    </div>
</section>
</body>

</html>