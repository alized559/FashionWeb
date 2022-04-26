<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Products</title>

    <?php include('header.php') ?>
    <link href="css/products.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="flexbox">
        <div class="filter">
            <form>
                <div class="filter-header1">
                    <a onclick="controlFilter('collapseFilter1')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter1">
                        <i id="collapseFilter1Icon" class="fa fa-chevron-down"></i>
                        By Brand
                    </a>
                </div>
                <div class="filter-child collapse" id="collapseFilter1">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Nike</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Adidas</label>
                    </div>
                </div>

                <div class="filter-header">
                    <a onclick="controlFilter('collapseFilter2')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter2">
                        <i id="collapseFilter2Icon" class="fa fa-chevron-down"></i>
                        By Name
                    </a>
                </div>
                <div class="filter-child collapse" id="collapseFilter2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Nike</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Adidas</label>
                    </div>
                </div>

                <div class="filter-header">
                    <a onclick="controlFilter('collapseFilter3')" style="text-decoration: none;" data-toggle="collapse" href="#collapseFilter3">
                        <i id="collapseFilter2Icon" class="fa fa-chevron-down"></i>
                        By Price
                    </a>
                </div>
                <div class="filter-child collapse" id="collapseFilter3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Ascending</label>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check">
                        <label class="form-check-label" for="check">Descending</label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include('footer.php') ?>
</body>
</html>

<script>
    function controlFilter(id) {
        if($('#' + id).is('.collapse:not(.show)')) {
            document.getElementById(id + 'Icon').className = "fa fa-chevron-up";
        } else if ($('#' + id).is('.collapse:not(.hidden)')) {
            document.getElementById(id + 'Icon').className = "fa fa-chevron-down";
        }
    }
</script>