<?php include 'head.php';?>
<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="../images/site/fayeed.png" alt="">
                <img class="logo-compact" src="../images/site/fayeed.png" alt="">
                <h4 class="brand-title"><?php echo $settings['System_Name']?></h4>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <?php include 'header.php'; include 'sidebar.php';
            // Monthly data query
            if (isset($_POST['shoyear'])) {
                $transayear = $_POST['yearc'];
                $sql = "SELECT month, SUM(amount_payment) AS Total FROM checkout WHERE year = '$transayear' GROUP BY month";
            } else {
                // Default to the current year if the "shoyear" form is not submitted
                $transayear = date("Y");
                $sql = "SELECT month, SUM(amount_payment) AS Total FROM checkout WHERE year = '$transayear' GROUP BY month";
            }

            $result = $con->query($sql);
            $months = [];
            $totals = [];
            while ($row = $result->fetch_assoc()) {
                $months[] = $row["month"];
                $totals[] = $row["Total"];
            }

            // Yearly data query
            $sql2 = "SELECT year, SUM(amount_payment) AS Total FROM checkout GROUP BY year";
            $result2 = $con->query($sql2);
            $year = [];
            $totals2 = [];
            while ($row = $result2->fetch_assoc()) {
                $year[] = $row["year"];
                $totals2[] = $row["Total"];
            }

            $con->close();
        ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/1.1.1/chartjs-plugin-annotation.min.js"></script>

    <style>
        /* Custom CSS styling */
        #chartContainer {
            position: relative;
            width: 100%;
            height: 100%;
        }
        #yearly {
            display: none;
        }

        canvas {
            position: relative;
            width: 100% !important;
            height: 100% !important;
            background-color: transparent;
        }
    </style>

     <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid mt-5">
                <div class="col-12"></div>
                <div class="row mt-5">
                    <div class="col-lg-9" id="monthly">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">General Monthly Amount of Year : <?php echo $transayear ?>
                                    <form action="#monthly" method="post">
                                        <input type="number" name="yearc" placeholder="Year" value="<?php echo $transayear; ?>">
                                        <button type="submit" style="background-color: var(--primary-color); color: white;" name="shoyear">Show</button>
                                    </form>
                                </h3>
                                <h4 class="card-title"><a href="#yearly" class="btn" style="background-color: var( --primary-color); color : white;" onclick="showYearly()">Show Statistic Yearly</a></h4>
                            </div>
                            <div class="card-body">
                                <canvas id="areaChart"></canvas>

                                <script>
                                    var months = <?php echo json_encode($months); ?>;
                                    var totals = <?php echo json_encode($totals); ?>;
                                    var ctx = document.getElementById('areaChart').getContext('2d');
                                    var areaChart = new Chart(ctx, {
                                        type: 'line', // Use "line" type for Area chart
                                        data: {
                                            labels: months,
                                            datasets: [{
                                                label: 'Total income per Month of The Year <?php echo $transayear;?>',
                                                data: totals,
                                                borderColor: '#ff6a00',
                                                backgroundColor: 'rgba(255, 106, 0, 0.2)',
                                                borderWidth: 2,
                                                pointRadius: 5,
                                                pointBackgroundColor: '#ff6a00',
                                                pointBorderColor: 'white',
                                                pointBorderWidth: 2,
                                                fill: true
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            },
                                            plugins: {
                                                annotation: {
                                                    annotations: {
                                                        line1: {
                                                            type: 'line',
                                                            mode: 'horizontal',
                                                            scaleID: 'y',
                                                            value: 0,
                                                            borderColor: 'rgba(255, 106, 0, 0.2)',
                                                            borderWidth: 2,
                                                            label: {
                                                                enabled: true,
                                                                content: 'Area Chart with Curvier Lines'
                                                            }
                                                        }
                                                    }
                                                }
                                            },
                                            elements: {
                                                line: {
                                                    tension: 0.4 // Set the line tension to add curvier lines (0.4 or any value between 0 and 1)
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9" id="yearly">
                        <div class="card">
                            <div class="card-header">
                            <h3 class="card-title">General Yearly Statistic</h3>
                            <h4 class="card-title"><a href="#monthly" class="btn" style="background-color: var( --primary-color); color : white;" onclick="showMonthly()">Back</a></h4>
                            </div>
                            <div class="card-body">
                                <canvas id="areaChart2"></canvas>

                                <script>
                                    var year = <?php echo json_encode($year); ?>;
                                    var totals2 = <?php echo json_encode($totals2); ?>;
                                    var ctx = document.getElementById('areaChart2').getContext('2d');
                                    var areaChart = new Chart(ctx, {
                                        type: 'line', // Use "line" type for Area chart
                                        data: {
                                            labels: year,
                                            datasets: [{
                                                label: 'Total income Yearly',
                                                data: totals2,
                                                borderColor: '#ff6a00', // Set the line color to orange
                                                backgroundColor: 'rgba(255, 69, 0, 0.2)', // Set the area below the line fill color
                                                borderWidth: 2,
                                                pointRadius: 5,
                                                pointBackgroundColor: '#ff6a00', // Customize the data point fill color
                                                pointBorderColor: 'white', // Customize the data point border color
                                                pointBorderWidth: 2, // Customize the data point border width
                                                fill: true
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            },
                                            plugins: {
                                                annotation: {
                                                    annotations: {
                                                        line1: {
                                                            type: 'line',
                                                            mode: 'horizontal',
                                                            scaleID: 'y',
                                                            value: 0,
                                                            borderColor: 'rgba(255, 69, 0, 0.2)',
                                                            borderWidth: 2,
                                                            label: {
                                                                enabled: true,
                                                                content: 'Yearly Data as Area Chart'
                                                            }
                                                        }
                                                    }
                                                }
                                            },
                                            elements: {
                                                line: {
                                                    tension: 0.4 // Set the line tension to add curvier lines (0.4 or any value between 0 and 1)
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>


        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    <script src="../vendor/global/global.min.js"></script>
    <script src="../js/quixnav-init.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="../vendor/gaugeJS/dist/gauge.min.js"></script>
    <script src="../vendor/flot/jquery.flot.js"></script>
    <script src="../vendor/flot/jquery.flot.resize.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="../vendor/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="../js/dashboard/dashboard-1.js"></script>

    <script>
        function showYearly() {
            var monthlyCard = document.getElementById("monthly");
            var yearlyCard = document.getElementById("yearly");

            // Toggle the display of the cards
            if (monthlyCard.style.display === "none") {
                monthlyCard.style.display = "block";
                yearlyCard.style.display = "none";
            } else {
                monthlyCard.style.display = "none";
                yearlyCard.style.display = "block";
            }
        }
        function showMonthly() {
            var monthlyCard = document.getElementById("monthly");
            var yearlyCard = document.getElementById("yearly");

            // Toggle the display of the cards
            monthlyCard.style.display = "block";
            yearlyCard.style.display = "none";
        }

    </script>

</body>
</html>