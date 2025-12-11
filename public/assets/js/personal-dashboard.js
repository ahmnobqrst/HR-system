/* Water Tracking Chart */
var options10 = {
    series: [
        {
            data: [98, 110, 80, 145, 105, 112, 87, 148, 102],
        },
    ],
    chart: {
        height: 100,
        type: "area",
        fontFamily: "Roboto, Arial, sans-serif",
        foreColor: "#5d6162",
        zoom: {
            enabled: false,
        },
        sparkline: {
            enabled: true,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return "";
                },
            },
        },
        marker: {
            show: false,
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "straight",
    },
    title: {
        text: undefined,
    },
    grid: {
        borderColor: "transparent",
    },
    xaxis: {
        crosshairs: {
            show: false,
        },
    },
    colors: ["rgb(43, 195, 210)"],
    stroke: {
        width: [1],
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.5,
            opacityTo: 0.2,
            stops: [0, 60],
        },
    },
};
var chart10 = new ApexCharts(document.querySelector("#waterTrack"), options10);
chart10.render();
function waterTrack() {
    chart10.updateOptions({
        colors: ["rgb(" + myVarVal + ")"],
    });
}
/* Water Tracking Chart */
/* Water Tracking Chart */
var options12 = {
    series: [
        {
            data: [98, 110, 80, 145, 105, 112, 87, 148, 102],
        },
    ],
    chart: {
        height: 100,
        type: "area",
        fontFamily: "Roboto, Arial, sans-serif",
        foreColor: "#5d6162",
        zoom: {
            enabled: false,
        },
        sparkline: {
            enabled: true,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return "";
                },
            },
        },
        marker: {
            show: false,
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "straight",
    },
    title: {
        text: undefined,
    },
    grid: {
        borderColor: "transparent",
    },
    xaxis: {
        crosshairs: {
            show: false,
        },
    },
    colors: ["rgb(245, 184, 73)"],
    stroke: {
        width: [1],
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.5,
            opacityTo: 0.2,
            stops: [0, 60],
        },
    },
};
var chart12 = new ApexCharts(document.querySelector("#fireTrack"), options12);
chart12.render();
function fireTrack() {
    chart12.updateOptions({
        colors: ["rgb(" + myVarVal + ")"],
    });
}
/* Water Tracking Chart */

/* Sleep Tracking Chart */
var options11 = {
    series: [
        {
            data: [102, 148, 87, 112, 105, 145, 80, 110, 98],
        },
    ],
    chart: {
        height: 100,
        type: "area",
        fontFamily: "Roboto, Arial, sans-serif",
        foreColor: "#5d6162",
        zoom: {
            enabled: false,
        },
        sparkline: {
            enabled: true,
        },
    },
    tooltip: {
        enabled: true,
        x: {
            show: false,
        },
        y: {
            title: {
                formatter: function (seriesName) {
                    return "";
                },
            },
        },
        marker: {
            show: false,
        },
    },
    dataLabels: {
        enabled: false,
    },
    stroke: {
        curve: "straight",
    },
    title: {
        text: undefined,
    },
    grid: {
        borderColor: "transparent",
    },
    xaxis: {
        crosshairs: {
            show: false,
        },
    },
    colors: ["#e6533c"],
    stroke: {
        width: [1],
    },
    fill: {
        type: "gradient",
        gradient: {
            opacityFrom: 0.5,
            opacityTo: 0.2,
            stops: [0, 60],
        },
    },
};
var chart11 = new ApexCharts(document.querySelector("#sleepTrack"), options11);
chart11.render();
/* Sleep Tracking Chart */
