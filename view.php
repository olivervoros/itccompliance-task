<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>
<div class="container mt-3">
    <h1 class="my-3">Welcome to ITC Compliance!</h1>
    <img src="insurance.jpg" alt="ITC Compliance Insurance"/>
    <h3 class="my-4">Insurance types</h3>
    <div class="mt-3">
        <?php foreach($productsWithDetail as $productId => $product) : ?>
            <?php $name = $productsWithDetail[$productId]['detail']['name'] ?? "N/A"; ?>
            <?php $description = $productsWithDetail[$productId]['detail']['description'] ?? "N/A"; ?>
            <?php $type = $productsWithDetail[$productId]['detail']['type'] ?? "N/A"; ?>
            <?php $suppliers = $productsWithDetail[$productId]['detail']['suppliers'] ?? array("Sorry, there are no suppliers available...") ?>
            <div class="border-bottom my-3">
                <p class="text-uppercase font-weight-bold">Name: <?php echo h($name) ?></p>
                <p>Description: <?php echo h($description) ?></p>
                <p>Type: <?php echo h($type) ?></p>
                <h6>Suppliers</h6>
                <ul>
                <?php foreach($suppliers as $supplier) : ?>
                <li><?php echo h($supplier) ?></li>
                <?php endforeach ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</div>
</body>
</html>
