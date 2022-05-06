<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Orders</title>

    <link href="css/orders.css" rel="stylesheet" media="screen">

    <?php include 'header.php' ?>
</head>
<body>

    <div class="container-fluid">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Order State
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Pending</a>
                <a class="dropdown-item" href="#">Delivered</a>
                <a class="dropdown-item" href="#">On It's Way</a>
                <a class="dropdown-item" href="#">Returned</a>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Items</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">#1</th>
                    <td>
                        <i class="fa fa-user-alt"></i>
                        Ali Zein Al Dine<br>
                        <i class="fa fa-globe"></i>
                        United States<br>
                        <i class="fa fa-mobile"></i>
                        +961 70156042<br>
                        <i class="fa fa-envelope"></i>
                        alized559@gmail.com
                    </td>
                    <td>
                        <span class="price">108$</span><br>
                        <i class="fa fa-money"></i>
                        Cash On Delivery
                    </td>
                    <td>
                        <a href="#">Women’s High-Rise Woven Pants </a>(Pink Orange) - <span class="status">Pending</span><br>
                    </td>
                    <td>
                    <div class="menu-nav">
                        <div class="drop-container" tabindex="-1">
                        <div class="three-dots"></div>
                        <div class="drop">
                            <a href="#" style="text-decoration: none; color: inherit"><div>Change State</div></a>
                            <a href="#" style="text-decoration: none; color: inherit"><div>Delete</div></a>
                        </div>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">#1</th>
                    <td>
                        <i class="fa fa-user-alt"></i>
                        Ali Zein Al Dine<br>
                        <i class="fa fa-globe"></i>
                        United States<br>
                        <i class="fa fa-mobile"></i>
                        +961 70156042<br>
                        <i class="fa fa-envelope"></i>
                        alized559@gmail.com
                    </td>
                    <td>
                        <span class="price">LBP 2,209,740</span><br>
                        <i class="fa fa-money"></i>
                        Cash On Delivery
                    </td>
                    <td>
                        <a href="#">Women’s High-Rise Woven Pants </a>(Pink Orange) - <span class="status">Pending</span><br>
                        <a href="#">Nike Zoom Freak 3 </a>(Aqua) - <span class="status">Pending</span><br>
                        <a href="#">Women’s High-Rise Woven Pants </a>(Pink Orange) - <span class="status">Pending</span><br>
                    </td>
                    <td>
                    <div class="menu-nav">
                        <div class="drop-container" tabindex="-1">
                        <div class="three-dots"></div>
                        <div class="drop">
                            <a href="#" style="text-decoration: none; color: inherit"><div>Change State</div></a>
                            <a href="#" style="text-decoration: none; color: inherit"><div>Delete</div></a>
                        </div>
                        </div>
                    </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">#1</th>
                    <td>
                        <i class="fa fa-user-alt"></i>
                        Ali Zein Al Dine<br>
                        <i class="fa fa-globe"></i>
                        United States<br>
                        <i class="fa fa-mobile"></i>
                        +961 70156042<br>
                        <i class="fa fa-envelope"></i>
                        alized559@gmail.com
                    </td>
                    <td>
                        <span class="price">108$</span><br>
                        <i class="fa fa-money"></i>
                        Cash On Delivery
                    </td>
                    <td>
                        <a href="#">Women’s High-Rise Woven Pants </a>(Pink Orange) - <span class="status">Pending</span><br>
                        <a href="#">Women’s High-Rise Woven Pants </a>(Pink Orange) - <span class="status">Pending</span><br>
                    </td>
                    <td>
                    <div class="menu-nav">
                        <div class="drop-container" tabindex="-1">
                        <div class="three-dots"></div>
                        <div class="drop">
                            <a href="#" style="text-decoration: none; color: inherit"><div>Change State</div></a>
                            <a href="#" style="text-decoration: none; color: inherit"><div>Delete</div></a>
                        </div>
                        </div>
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php include 'footer.php' ?>
</body>

<script>
    
</script>
</html>