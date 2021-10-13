$(document).ready(function() {
    $.ajax({
        url: "includes/sf_pending_graph.php",
        method: "GET",
        success: function(data) {
            var data = JSON.parse(data);
            var Month = [];
            var amount = [];

            for (var i in data) {
                Month.push(data[i].Month);
                amount.push(data[i].amount);
            }

            var chartdata = {
                labels: Month,
                datasets: [{
                    label: "No of offences:",
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.3)",
                        "rgba(255, 159, 64, 0.3)",
                        "rgba(255, 205, 86, 0.3)",
                        "rgba(75, 192, 192, 0.3)",
                        "rgba(54, 162, 235, 0.3)",
                        "rgba(153, 102, 255, 0.3)",
                        "rgba(201, 203, 207, 0.3)",
                    ],
                    borderColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                        "rgb(201, 203, 207)",
                    ],
                    hoverBackgroundColor: "rgba(200, 200, 200, 1)",
                    hoverBorderColor: "rgba(200, 200, 200, 1)",
                    data: amount,
                }, ],
            };

            var canvas = $("#spotfine_by_month");

            var spotfine_by_month = new Chart(canvas, {
                type: "bar",
                data: chartdata,
            });
        },
        error: function(data) {
            console.log(data);
        },
    });
});
//offence details bar chart
$(document).ready(function() {
    $.ajax({
        url: "includes/offenceDetailGraph.php",
        method: "GET",
        success: function(data) {
            var data = JSON.parse(data);
            var offence_name = [];
            var amount = [];

            for (var i in data) {
                amount.push(data[i].amount);
                offence_name.push(data[i].offence_name);
            }

            var chartdata = {
                labels: offence_name,
                datasets: [{
                    label: "Fine amount:",
                    backgroundColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 159, 64)",
                        "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)",
                        "rgb(54, 162, 235)",
                        "rgb(153, 102, 255)",
                        "rgb(201, 203, 207)",
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 0.3)",
                        "rgba(255, 159, 64, 0.3)",
                        "rgba(255, 205, 86, 0.3)",
                        "rgba(75, 192, 192, 0.3)",
                        "rgba(54, 162, 235, 0.3)",
                        "rgba(153, 102, 255, 0.3)",
                        "rgba(201, 203, 207, 0.3)",
                    ],
                    hoverBackgroundColor: "rgba(0, 0, 0, 1)",
                    hoverBorderColor: "rgba(200, 200, 200, 1)",
                    data: amount,
                }, ],
            };

            var canvas = $("#fine_amounts");

            var fine_amounts = new Chart(canvas, {
                type: "bar",
                data: chartdata,
            });
        },
        error: function(data) {
            console.log(data);
        },
    });
});
//spotfine status pie chart
$(document).ready(function() {
    $.ajax({
        url: "includes/sf_paymentStatusGraph.php",
        method: "GET",
        success: function(data) {
            var data = JSON.parse(data);
            var offence_name = [];
            var amount = [];

            for (var i in data) {
                offence_name.push(data[i].offence_name);
                amount.push(data[i].amount);
            }

            var chartdata = {
                labels: offence_name,
                datasets: [{
                    label: "fine amounts:",
                    backgroundColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 205, 86)",
                        "rgb(153, 102, 255)",
                    ],
                    borderColor: ["rgba(201, 203, 207, 0.3)"],
                    hoverBackgroundColor: "rgb(0, 0, 0, 0.7)",
                    hoverBorderColor: "rgba(255, 255, 255, 1)",
                    data: amount,
                }, ],
            };

            var pie_canvas = $("#pie_canvas");

            var pie_canvas = new Chart(pie_canvas, {
                type: "pie",
                data: chartdata,
            });
        },
        error: function(data) {
            console.log(data);
        },
    });
});
//vehicle lost pie chart
$(document).ready(function() {
    $.ajax({
        url: "includes/vehicleLost.php",
        method: "GET",
        success: function(data) {
            var data = JSON.parse(data);
            var found_status = [];
            var vehicles = [];

            for (var i in data) {
                found_status.push(data[i].found_status);
                vehicles.push(data[i].vehicles);
            }

            var chartdata = {
                labels: ["Found", "Not found"],
                datasets: [{
                    label: "fine amounts:",
                    backgroundColor: ["rgb(255, 99, 132)", "rgb(0, 0, 0, 0.7)"],
                    borderColor: ["rgba(201, 203, 207, 0.3)"],
                    hoverBackgroundColor: "rgba(201, 203, 207, 0.3)",
                    hoverBorderColor: "rgba(255, 255, 255, 1)",
                    data: vehicles,
                }, ],
            };

            var pie_canvas1 = $("#pie_canvas1");

            var pie_canvas1 = new Chart(pie_canvas1, {
                type: "doughnut",
                data: chartdata,
            });
        },
        error: function(data) {
            console.log(data);
        },
    });
});
//vehicle found pie chart
$(document).ready(function() {
    $.ajax({
        url: "includes/sf_pending_graph5.php",
        method: "GET",
        success: function(data) {
            var data = JSON.parse(data);
            var hand_over = [];
            var veh = [];

            for (var i in data) {
                hand_over.push(data[i].hand_over);
                veh.push(data[i].veh);
            }

            var chartdata = {
                labels: ["Hand overed", ["Under custody"]],
                datasets: [{
                    label: "fine amounts:",
                    backgroundColor: ["rgb(255, 99, 132)", "rgb(0, 0, 0, 0.7)"],
                    borderColor: ["rgba(201, 203, 207, 0.3)"],
                    hoverBackgroundColor: "rgba(201, 203, 207, 0.3)",
                    hoverBorderColor: "rgba(255, 255, 255, 1)",
                    data: veh,
                }, ],
            };

            var pie_canvas2 = $("#pie_canvas2");

            var pie_canvas2 = new Chart(pie_canvas2, {
                type: "doughnut",
                data: chartdata,
            });
        },
        error: function(data) {
            console.log(data);
        },
    });
});
//user request pie chart
$(document).ready(function() {
    $.ajax({
        url: "includes/userReqGraph.php",
        method: "GET",
        success: function(data) {
            var data = JSON.parse(data);
            var off_ass = [];
            var request = [];

            for (var i in data) {
                off_ass.push(data[i].off_ass);
                request.push(data[i].request);
            }

            var chartdata = {
                labels: ["Not responded", "Responded"],
                datasets: [{
                    label: "fine amounts:",
                    backgroundColor: [
                        "rgb(255, 99, 132)",
                        "rgb(255, 205, 86)",
                        "rgb(153, 102, 255)",
                    ],
                    borderColor: ["rgba(201, 203, 207, 0.3)"],
                    hoverBackgroundColor: "rgb(0, 0, 0, 0.7)",
                    hoverBorderColor: "rgba(255, 255, 255, 1)",
                    data: request,
                }, ],
            };

            var pie_canvas4 = $("#pie_canvas4");

            var pie_canvas4 = new Chart(pie_canvas4, {
                type: "pie",
                data: chartdata,
            });
        },
        error: function(data) {
            console.log(data);
        },
    });
});