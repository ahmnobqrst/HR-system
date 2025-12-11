
/* Performance by category chart */
var options1 = {
    series: [{
        name: 'Strategic Goals',
        data: [44, 55, 41, 67, 22, 43, 44, 55, 41, 67, 22, 43]
    }, {
        name: 'Operational Goals',
        data: [13, 23, 20, 8, 13, 27, 13, 23, 20, 8, 13, 27]
    }, {
        name: 'Tactical Goals',
        data: [11, 17, 15, 15, 21, 14, 11, 17, 15, 15, 21, 14]
    }],
    chart: {
        type: 'bar',
        height: 310,
        stacked: true,
        toolbar: {
            show: true
        },
        zoom: {
            enabled: true
        }
    },
    grid: {
        borderColor: '#f1f1f1',
        strokeDashArray: 3
    },
    responsive: [{
        breakpoint: 480,
        options: {
            legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
            }
        }
    }],
    colors: ["rgb(43, 195, 210)", "rgba(43, 195, 210, 0.7)", "rgba(43, 195, 210,0.4)", "rgba(43, 195, 210,0.2)"],
    legend: {
        show: false,
        position: 'top'
    },
    plotOptions: {
        bar: {
            columnWidth: "40%",
        }
    },
    dataLabels: {
        enabled: false
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    },
    fill: {
        opacity: 1
    }
};
var chart1 = new ApexCharts(document.querySelector("#performanceReport"), options1);
chart1.render();
function hrmperformanceReport() {
    chart1.updateOptions({
        colors: ["rgba(" + myVarVal + ", 1)", "rgba(" + myVarVal + ", 0.5)", "rgba(" + myVarVal + ", 0.2)"],
    })
}
/* Performance by category chart */



/* Jobs Summary chart */
var options2 = {
    series: [1754, 544, 682, 263],
    labels: ["Inprogress", "Pending", "Done", "On Hold"],
    chart: {
        height: 300,
        type: 'donut',
    },
    dataLabels: {
        enabled: false,
    },

    legend: {
        show: false,
    },
    stroke: {
        show: true,
        curve: 'smooth',
        lineCap: 'round',
        colors: "#fff",
        width: 0,
        dashArray: 0,
    },
    plotOptions: {

        pie: {
            expandOnClick: false,
            donut: {
                size: '72%',
                background: 'transparent',
                labels: {
                    show: true,
                    name: {
                        show: true,
                        fontSize: '20px',
                        color: '#495057',
                        offsetY: -4
                    },
                    value: {
                        show: true,
                        fontSize: '18px',
                        color: undefined,
                        offsetY: 8,
                        formatter: function (val) {
                            return val + "%"
                        }
                    },
                    total: {
                        show: true,
                        showAlways: true,
                        label: 'Total',
                        fontSize: '22px',
                        fontWeight: 600,
                        color: '#495057',
                    }

                }
            }
        }
    },
    colors: ["rgb(43, 195, 210)", "rgba(43, 195, 210, 0.7)", "rgba(43, 195, 210,0.4)", "rgba(43, 195, 210,0.2)"],
};
var chart2 = new ApexCharts(document.querySelector("#jobs-summary"), options2);
chart2.render();
function JobsSummary() {
    chart2.updateOptions({
        colors: ["rgb(" + myVarVal + ")", "rgba(" + myVarVal + ", 0.7)", "rgba(" + myVarVal + ", 0.4)", "rgba(" + myVarVal + ", 0.2)"],
    })
};
/* Jobs Summary chart */