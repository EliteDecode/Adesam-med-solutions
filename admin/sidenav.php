<?php
include('includes/header.php');

/* Getting the current page name and storing it in a variable. */
$activePage = basename($_SERVER['PHP_SELF'], ".php");


$date = date('y-m-d');


?>
<style>
:root {
    --red: #0d9488;
    --blue: #171d64;
    --white: #f4f3ea;
}

a:hover {
    text-decoration: none !important;
}

.sidenav {
    border: 1px solid #085e79;
    height: 820px;
    background-color: var(--white);
    z-index: 2;
    display: block;
    position: fixed;
    left: 0%;
    width: 16%;
}

.sidenav ul a li {
    list-style-type: none;
}

.show {
    display: block;
}

.sidenav ul {
    text-align: center;

}

.sidenav ul a {
    display: flex;
    flex-direction: row;
    border-bottom: 1px solid #f2f7f4;
    padding: 5% 0% 5% 12%;
    color: var(--white);
    font-size: 13px;
    text-decoration: none;
    /* background: #f2f7f4; */

    text-transform: capitalize;
    margin: 14px 8px;

}

.sidenav ul a:hover {
    background-color: var(--red);
    color: var(--white) !important;
    border-radius: 10px;
    text-decoration: none !important;
}

.active {
    background-color: var(--red);
    color: var(--white) !important;
    border-radius: 10px;
}



#open,
#close {
    display: none;
    margin: 3%;
    position: absolute;
    z-index: 2;
    right: 0%;
}

@media (min-width: 0px) and (max-width: 767px) {
    .sidenav {
        display: none;
        width: 65%;
        z-index: 1;
        height: 820px;
        background-color: #fff;
        position: fixed;
        left: 0%;
    }

    #open {
        display: block;
    }

    .sidenav ul {
        text-align: center;
        margin-top: 20% !important;
        padding-top: 0% !important;
    }

    .sidenav ul a {
        font-size: 13px !important;
    }
}
</style>

<body>
    <i class="fa fa-bars py-3 px-3 border-2 text-xl bg-blue-700 rounded-md text-white rounded-full"
        style="color: #085e79; z-index:2; position:fixed; bottom: 0%; right:0%" id='open'></i>

    <div class="sidenav" style="background-color:#fff; border:1px solid #f0efed " id="nav">
        <i class="fa fa-close py-1 px-2 border-2 text-xl  bg-blue-700 rounded-md text-white"
            style="color: #085e79; z-index:2;  " id='close'></i>
        <ul class="">
            <a href="index.php" style="color: #181818;  text-decoration:none"
                class="<?= ($activePage == 'index') ? 'active':''; ?> flex space-x-2  items-center">
                <img src="../assets/images/ras-layout.png" class='cursor-pointer' alt="" style="width: 17px;">
                <span>Dashboard
                </span>
            </a>



            <a href="beers.php" style="color: #181818;  text-decoration:none"
                class="flex space-x-2 items-center <?= ($activePage == 'beers') ? 'active':''; ?>">
                <img src="../assets/images/beer2.png" class='cursor-pointer' alt="" style="width: 20px;">
                <span>Manage Beers</span>
            </a>

            <a href="liquors.php" style="color: #181818;  text-decoration:none"
                class="flex space-x-2 items-center <?= ($activePage == 'queries') ? 'active':''; ?>">
                <img src="../assets/images/liquor.png" class='cursor-pointer' alt="" style="width: 20px;">
                <span>Manage Liquors</span>
            </a>

            <br>
            <hr class='border-2'>


            <a href="beer_sales.php?date=<?php echo $date ?>" style="color: #181818;  text-decoration:none"
                class="flex space-x-2 items-center <?= ($activePage == 'beer_sales') ? 'active':''; ?>">
                <img src="../assets/images/ras-tag.png" class='cursor-pointer' alt="" style="width: 20px;">
                <span>Beer Sales</span>
            </a>
            <a href="liquor_sales.php?date=<?php echo $date ?>" style="color: #181818;  text-decoration:none"
                class="flex space-x-2 items-center <?= ($activePage == 'liquor_sales') ? 'active':''; ?>">
                <img src="../assets/images/ras-tag.png" class='cursor-pointer' alt="" style="width: 20px;">
                <span>Liquor Sales</span>
            </a>
            <a href="presales.php?date=<?php echo $date ?>" style="color: #181818;  text-decoration:none"
                class="flex space-x-2 items-center <?= ($activePage == 'presales') ? 'active':''; ?>">
                <img src="../assets/images/ras-tag.png" class='cursor-pointer' alt="" style="width: 20px;">
                <span>Presales Record</span>
            </a>

            <br>
            <hr class='border-2'>

            <a href="inventory.php" style="color: #181818;  text-decoration:none"
                class="flex space-x-2 items-center <?= ($activePage == 'inventory' ) ? 'active':''; ?>">
                <img src="../assets/images/inventory.png" class='cursor-pointer' alt="" style="width: 20px;">
                <span>Inventory
                    <?php  $empty = selectAll('inventory', ['Quantity' => '0']);  
                    $counted = count($empty);
                    if($counted > 0): ?>

                    <span class='px-1 py-0 rounded-full bg-red-400 text-white text-xs'>
                        <?php echo $counted ?></span>
                    <?php else:  ?>
                    <?php endif; ?>

                </span>
            </a>






        </ul>
    </div>
    <script>
    var open = document.getElementById('open').addEventListener('click', e => {
        var nav = document.getElementById('nav');
        nav.style.display = 'block';
        document.getElementById('open').style.display = 'none';
        document.getElementById('close').style.display = 'block';

    })

    var close = document.getElementById('close').addEventListener('click', e => {
        var nav = document.getElementById('nav');
        nav.style.display = 'none';
        document.getElementById('open').style.display = 'block';
        document.getElementById('close').style.display = 'none';

    })
    </script>
</body>

</html>