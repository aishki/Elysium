<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_info'])) {
    header("Location: ../log-in/log-in.php");
    exit();
}

// Retrieve user information from session
$currentName = $_SESSION['user_info']['first_name'];
$access = $_SESSION['user_info']['user_type'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../Assets/css/navbar_v2.css">
    <link rel="stylesheet" href="../../Assets/css/dashb.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
</head>

<body class="default">
    <?php include '../../navbar/navbar_v2.php'; ?>

    <div class="container">
        <div class="ad_acc" style="font-size: 30px;font-weight: 900;
">Dashboard</div>

        <div class="flex">
            <div class="item_c col1" style="max-width: 350px">
                <div class="item shadow">
                    <h4>Welcome to your dashboard, <?php echo $currentName; ?>!</h4>
                    <div class="content">
                        <p>Welcome to our skill exchange marketplace, where individuals can connect to exchange their expertise and services. Explore various ranks that categorize tasks based on complexity and skill requirements. From simple errands and tasks suitable for D-Rank, to high-level positions requiring specialized expertise in S-Rank, our platform accommodates a wide range of skill levels and professions.</p>
                    </div>
                    <ul class="rank_desc">
                        <li><strong>D-Rank (Normal Jobs)</strong>: Simple tasks like grocery shopping, dog walking, and cleaning, no formal resume needed.</li>
                        <li><strong>C-Rank (Trust-Based Jobs)</strong>: Roles like babysitting and tutoring, requiring trust and credibility.</li>
                        <li><strong>B-Rank (High School Jobs)</strong>: Positions like retail associate and virtual assistant, requiring a high school diploma.</li>
                        <li><strong>A-Rank (College Jobs)</strong>: Roles like marketing coordinator and graphic designer, needing a college degree.</li>
                        <li><strong>S-Rank (Professional Jobs)</strong>: High-level roles like software developer and marketing manager, requiring CV submissions.</li>
                    </ul>
                    <p class="content">Note: Difficulty levels may vary based on employer requirements.</p>

                </div>

                <h2 style="opacity:0.5;     font-size: 30px;
">Recent Activity</h2>
                <div class="item shadow">
                    <h4>Recent activity details go here...</h4>
                    <p>More helpful information...</p>
                </div>
            </div>

            <div class="item_c col2">
                <div class="row">
                    <div class="item shadow center">
                        <h4>Total Credit Points</h4>
                        <h3 class="subtitle">Eligibility for Markup</h3>
                        <div class="chartjs-wrapper" style="width: 300px;  height:150px;">
                            <canvas class="chartjs-gauge"></canvas>
                        </div>
                        <script>
                            // Select chart canvas element
                            var gaugeCanvas = document.getElementsByClassName("chartjs-gauge");

                            // Create new Chart instance
                            var gaugeChart = new Chart(gaugeCanvas, {
                                type: "doughnut",
                                data: {
                                    labels: ["Points"],
                                    datasets: [{
                                        label: "Gauge",
                                        data: [300, 190],
                                        backgroundColor: [
                                            "#8B5CF6",
                                            "transparent"
                                        ],
                                        borderWidth: 0 // Remove the border
                                    }]
                                },
                                options: {
                                    circumference: Math.PI,
                                    rotation: Math.PI,
                                    cutoutPercentage: 80,
                                    plugins: {
                                        datalabels: {
                                            backgroundColor: 'rgba(243, 243, 243, 0.7)',
                                            color: function(context) {
                                                return context.dataset.backgroundColor;
                                            },
                                            font: function(context) {
                                                var w = context.chart.width;
                                                return {
                                                    size: w < 400 ? 18 : 20
                                                }
                                            },
                                            align: 'start',
                                            anchor: 'start',
                                            offset: 10,
                                            borderRadius: 4,
                                            borderWidth: 1,
                                            formatter: function(value, context) {
                                                var i = context.dataIndex;
                                                var len = context.dataset.data.length - 1;
                                                if (i == len) {
                                                    return null;
                                                }
                                                return value + ' mph';
                                            }
                                        }
                                    },
                                    legend: {
                                        display: false
                                    },
                                    tooltips: {
                                        enabled: false
                                    }
                                }
                            });
                        </script>
                        <div class="row" style="position: absolute; justify-content: flex-start; margin-top:100px;">
                            <h2>300pts</h2>
                            <!-- <p style="color: rgba(42, 166, 60, 1); font-size: 15px;">+13.5%</p> -->
                        </div>
                    </div>


                    <div class="item shadow center">
                        <h4>Total Jobs</h4>
                        <h3 class="subtitle">Past Month</h3>
                        <canvas id="pieChart" style="width: 400px; height: 200px"></canvas>
                        <script>
                            const labels = ["A", "B", "C"];
                            const data = [55, 30, 15];
                            const colors = ["#800080", "#9932CC", "#BA55D3"]; // Custom colors

                            new Chart("pieChart", {
                                type: "pie",
                                data: {
                                    datasets: [{
                                        data: data,
                                        backgroundColor: colors
                                    }],
                                    labels: labels
                                },
                                options: {
                                    responsive: false,
                                    maintainAspectRatio: false,
                                    // title: {
                                    //     display: true,
                                    //     text: "Total Jobs - Past Month"
                                    // }
                                }
                            });
                        </script>
                    </div>
                </div>

                <div class="item shadow">
                    <div class="row" style="margin-bottom: 15px">
                        <h4>Total Earnings</h4>
                        <svg fill=" #000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 416.979 416.979" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path d="M356.004,61.156c-81.37-81.47-213.377-81.551-294.848-0.182c-81.47,81.371-81.552,213.379-0.181,294.85 c81.369,81.47,213.378,81.551,294.849,0.181C437.293,274.636,437.375,142.626,356.004,61.156z M237.6,340.786 c0,3.217-2.607,5.822-5.822,5.822h-46.576c-3.215,0-5.822-2.605-5.822-5.822V167.885c0-3.217,2.607-5.822,5.822-5.822h46.576 c3.215,0,5.822,2.604,5.822,5.822V340.786z M208.49,137.901c-18.618,0-33.766-15.146-33.766-33.765 c0-18.617,15.147-33.766,33.766-33.766c18.619,0,33.766,15.148,33.766,33.766C242.256,122.755,227.107,137.901,208.49,137.901z"></path>
                                </g>
                            </g>
                        </svg>

                    </div>

                    <div class="row">
                        <div class="item shadow">
                            <h4>Graph</h4>
                            <canvas id="earningsChart" style="width:100%;max-width:600px"></canvas>

                            <script>
                                const exValues = [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150];
                                const eyValues = [7, 8, 8, 9, 9, 9, 10, 11, 14, 14, 15];

                                new Chart("earningsChart", {
                                    type: "line",
                                    data: {
                                        labels: exValues,
                                        datasets: [{
                                            fill: false,
                                            lineTension: 0,
                                            backgroundColor: "rgba(128,0,128,1.0)", // Dark purple
                                            borderColor: "rgba(128,0,128,0.1)", // Light purple
                                            data: eyValues
                                        }]
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        },
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    min: 6,
                                                    max: 16
                                                }
                                            }],
                                        }
                                    }
                                });
                            </script>

                            <p style="margin: 20px 0 0 0;">Last Month</p>
                            <div class="row" style="justify-content: flex-start">
                                <h2>Php 7,000</h2>
                                <p style="color: rgba(42, 166, 60, 1); font-size: 15px;">+13.5%</p>
                            </div>
                        </div>

                        <div class="item shadow">
                            <h4>Analytics</h4>
                            <p>Analytics details...</p>
                            <canvas id="myChart" width="400" height="300"></canvas>
                            <script>
                                const xValues = ["Jan", "Feb", "Mar", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
                                const yValues = [55, 49, 44, 24, 50, 35, 42, 58, 29, 37, 53, 47];
                                const barColors = ["#800080", "#9932CC", "#BA55D3", "#DA70D6", "#DDA0DD", "#800080", "#9932CC", "#BA55D3", "#DA70D6", "#DDA0DD", "#800080", "#9932CC"];

                                new Chart("myChart", {
                                    type: "bar",
                                    data: {
                                        labels: xValues,
                                        datasets: [{
                                            backgroundColor: barColors,
                                            data: yValues
                                        }]
                                    },
                                    options: {
                                        legend: {
                                            display: false
                                        },
                                        title: {
                                            display: true,
                                            // text: "World Wine Production 2018"
                                        },
                                        scales: {
                                            xAxes: [{
                                                gridLines: {
                                                    display: false // Remove x-axis gridlines
                                                }
                                            }],
                                            yAxes: [{
                                                gridLines: {
                                                    display: false // Remove y-axis gridlines
                                                },
                                                ticks: {
                                                    display: false // Hide y-axis labels
                                                }
                                            }]
                                        },
                                        layout: {
                                            padding: {
                                                left: 10,
                                                right: 10,
                                                top: 10,
                                                bottom: 10
                                            }
                                        },
                                        responsive: false // Disable responsiveness
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="item shadow">
                    <h4>Credibility Over Time</h4>
                    <p>Credibility over time details...</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>