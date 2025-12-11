(function () {
    "use strict";

    /* line&column chart */
    var options1 = {
        series: [{
            name: 'Fire Danger',
            type: 'column',
            data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
        }, {
            name: 'Average',
            type: 'line',
            data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
        }],
        chart: {
            height: 350,
            type: 'line',
        },
        plotOptions: {
            bar: {
                borderRadius: 3
            },
        },
        stroke: {
            width: [0, 4]
        },
        grid: {
            borderColor: '#f2f5f7',
        },
        title: {
            text: 'Average Of Predicted Fire Danger',
            align: 'left',
            style: {
                fontSize: '13px',
                fontWeight: 'bold',
                color: '#8c9097'
            },
        },
        dataLabels: {
            enabled: true,
            enabledOnSeries: [1]
        },
        colors: ["#f6c264", "#23b7e5"],
        labels: ['01 Jan 2023', '02 Jan 2023', '03 Jan 2023', '04 Jan 2023', '05 Jan 2023', '06 Jan 2023', '07 Jan 2023', '08 Jan 2023', '09 Jan 2023', '10 Jan 2023', '11 Jan 2023', '12 Jan 2023'],
        xaxis: {
            type: 'datetime',
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            }
        },
        yaxis: [{
            // title: {
            //     text: 'Website Blog',
            //     style: {
            //         color: "#8c9097",
            //     }
            // },
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-yaxis-label',
                },
            }
        }, {
            opposite: true,
            title: {
                // text: 'Social Media',
                style: {
                    color: "#8c9097",
                }
            }
        }]
    };
    var chart1 = new ApexCharts(document.querySelector("#mixed-linecolumn"), options1);
    chart1.render();

    /* multiple ys-axis chart */
    var options2 = {
        series: [{
            name: 'Task',
            type: 'column',
            data: [10, 24, 25, 15, 28, 33, 38, 46]
        }, {
            name: 'Tactical Goals',
            type: 'column',
            data: [11, 38, 31, 49, 41, 49, 65, 85]
        }, {
            name: 'Operational Goals',
            type: 'column',
            data: [11, 37, 38, 74, 82, 54, 74, 50]
        }, {
            name: 'Strategic Goal',
            type: 'line',
            data: [8, 9, 37, 36, 44, 45, 50, 58]
        }],
        chart: {
            height: 320,
            type: 'line',
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            width: [1, 1, 1, 2]
        },
        title: {
            text: 'Raising Employee Performance',
            align: 'left',
            // offsetX: 110,
            style: {
                fontSize: '13px',
                fontWeight: 'bold',
                color: '#8c9097'
            },
        },
        grid: {
            borderColor: '#f2f5f7',
        },
        colors: ["#845adf", "#23b7e5", "#f5b849", "#26e7a5"],
        xaxis: {
            categories: [2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023],
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            }
        },
        yaxis: {
            min: 0,
            max: 100
        },

        tooltip: {
            fixed: {
                enabled: true,
                position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                offsetY: 30,
                offsetX: 60
            },
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " %";
                    }
                    return y;
                }
            }
        },
        legend: {
            horizontalAlign: 'center',
            offsetX: 40
        },
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 5,
            }
        }
    };
    var chart2 = new ApexCharts(document.querySelector("#mixed-multiple-y"), options2);
    chart2.render();

    /* line and area chart */
    var options3 = {
        series: [{
            name: 'TEAM A',
            type: 'area',
            data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33]
        }, {
            name: 'TEAM B',
            type: 'line',
            data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43]
        }],
        chart: {
            height: 320,
            type: 'line',
        },
        stroke: {
            curve: 'smooth'
        },
        colors: ["#845adf", "#23b7e5"],
        grid: {
            borderColor: '#f2f5f7',
        },
        fill: {
            type: 'solid',
            opacity: [0.35, 1],
        },
        labels: ['Dec 01', 'Dec 02', 'Dec 03', 'Dec 04', 'Dec 05', 'Dec 06', 'Dec 07', 'Dec 08', 'Dec 09 ', 'Dec 10', 'Dec 11'],
        markers: {
            size: 0
        },
        xaxis: {
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            }
        },
        yaxis: [
            {
                title: {
                    text: 'Series A',
                    style: {
                        color: "#8c9097",
                    }
                },
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                }
            },
            {
                opposite: true,
                title: {
                    text: 'Series B',
                    style: {
                        color: "#8c9097",
                    }
                },
                labels: {
                    show: true,
                    style: {
                        colors: "#8c9097",
                        fontSize: '11px',
                        fontWeight: 600,
                        cssClass: 'apexcharts-yaxis-label',
                    },
                }
            },
        ],
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " points";
                    }
                    return y;
                }
            }
        }
    };
    var chart3 = new ApexCharts(document.querySelector("#mixed-linearea"), options3);
    chart3.render();

    /* line column and area chart */
    var options4 = {
        series: [{
            name: 'Defects',
            type: 'column',
            data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
        }, {
            name: 'Predict Defect',
            type: 'area',
            data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
        }, {
            name: 'Predict Defects counts',
            type: 'line',
            data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
        }],
        chart: {
            height: 350,
            type: 'line',
            stacked: false,
        },
        stroke: {
            width: [0, 2, 5],
            curve: 'smooth'
        },
        plotOptions: {
            bar: {
                columnWidth: '60%',
                borderRadius: 3
            }
        },
        colors: ["#e6533c","#23b7e5","#f5b849"],
        grid: {
            borderColor: '#f2f5f7',
        },
        title: {
            text: 'Average Predicted Dangers In Basic Oxygen Line',
            align: 'left',
            style: {
                fontSize: '13px',
                fontWeight: 'bold',
                color: '#8c9097'
            },
        },
        fill: {
            opacity: [0.85, 0.25, 1],
            gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
        },
        labels: ['01/01/2023', '02/01/2023', '03/01/2023', '04/01/2023', '05/01/2023', '06/01/2023', '07/01/2023',
            '08/01/2023', '09/01/2023', '10/01/2023', '11/01/2023'
        ],
        markers: {
            size: 0
        },
        xaxis: {
            type: 'datetime',
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-xaxis-label',
                },
            }
        },
        yaxis: {
            // title: {
            //     // text: 'Points',
            //     style: {
            //         color: "#8c9097",
            //     }
            // },
            min: 0,
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: '11px',
                    fontWeight: 600,
                    cssClass: 'apexcharts-yaxis-label',
                },
            }
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " Defect";
                    }
                    return y;
                }
            }
        }
    };

    var chart4 = new ApexCharts(document.querySelector("#mixed-all"), options4);
    chart4.render();

})();