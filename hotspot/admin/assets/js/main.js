$(document).ready(function() {
	var previousPoint = null;
	var row = null; var rowx = 0;
    $("#choices").find("input").click(plotAccordingToChoices);
    $("#types").find("input").click(plotAccordingToChoices);
	plotAccordingToChoices();

	$("#placeholder").bind("plothover", function (event, pos, item) {
		if (item) {
			if (previousPoint != item.datapoint) {
				previousPoint = item.datapoint;
				$("#tooltip").remove();
			    if (row) row.removeClass('highlight');
				var x = Math.floor(item.datapoint[0].toFixed(2)),
					y = Math.floor(item.datapoint[1].toFixed(2));
				if (key == "top10") {
					showTooltip(item.pageX, item.pageY,	'Place #'+x+': '+y+' MB');
				} else {
					showTooltip(item.pageX, item.pageY,	x+' '+key+' ago: '+y+' '+item.series.label);
				}
				row = $('#'+key+'_'+item.datapoint[0]).addClass('highlight');
				rowx = Math.floor(x);
				if (key == "top10") {rowx += 1;}
			}
		}
		else {
			$("#tooltip").remove();
			if (row) row.removeClass('highlight');
			previousPoint = null;
		}
	});
});

function plotAccordingToChoices() {
    var data = [];

    $("#choices").find("input:checked").each(function () {
        key = $(this).attr("value");
        data.push(datasets[key+"tx"]);
        data.push(datasets[key+"rx"]);
    });

    $("#types").find("input:checked").each(function () {
        graph_type = $(this).attr("value");
    });

    if (graph_type != "bars") {
        var plot = $.plot($("#placeholder"), data, {
            lines: { show: true },
            points: { show: true },
            grid: { hoverable: true },
            xaxis: { tickDecimals: 0 },
            yaxis: { tickDecimals: 0, min: 0 }
        });
    } else {
        $.plot($("#placeholder"), data, {
            bars: { show: true },
            grid: { hoverable: true },
            xaxis: { tickDecimals: 0 },
            yaxis: { tickDecimals: 0, min: 0 }
        });
    }

    // show corresponding table
    $('#hours_table, #days_table, #months_table, #top10_table').hide();
    $('#'+key+'_table').show();
}

function showTooltip(x, y, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({top: y + -20, left: x + 10}).appendTo("body").fadeIn(200);
}