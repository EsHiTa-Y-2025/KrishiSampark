<?php
require('private/header.php');
$marketPricePage = 'active';
$market = getMarketPriceByImage($con, $_GET['id']);
?>

<body>
    <div class="bg-white shadow-sm p-3">
        <div class="d-flex align-items-center">
            <div class="gap-3 d-flex align-items-center">
                <a href="market-price">
                    <i class="bi bi-arrow-left d-flex krishisampark-text h2 m-0 back-page"></i>
                </a>
                <h3 class="fw-bold m-0">Go Back</h3>
            </div>
        </div>
    </div>
    <div class="text-center mt-5">
        <div class="zoom-container">
            <img id="zoomImage" src="<?=$baseurl;?>media/market_prices/<?=$market->image;?>" style='width:200px;margin-top:30px'  alt="Market Price Image">
        </div>
    </div>
    <div class="p-5"></div>
    <script src="https://hammerjs.github.io/dist/hammer.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const zoomContainer = document.querySelector(".zoom-container");
            const zoomImage = document.getElementById("zoomImage");
            let currentZoom = 1;

            // Initialize Hammer.js with the zoom gesture recognizer
            const hammer = new Hammer(zoomContainer);
            hammer.get('pinch').set({ enable: true });

            hammer.on("pinch", function (e) {
                // Calculate the new scale based on the pinch gesture
                currentZoom = Math.max(1, Math.min(currentZoom * e.scale, 2));
                zoomImage.style.transform = `scale(${currentZoom})`;
            });
        });
    </script>
<?php require('private/footer.php'); ?>

