jQuery(document).ready(function($) {

	$('button#chart').click(function() {

		var link = $(this).attr('chart');
		write_chart(link);
		return false;

	});

	write_chart("daysused");
});

function write_chart(link)
{
	var so = new SWFObject(base_url+"assets/swf/open-flash-chart.swf", "ofc", "98%", "300", "9", "#FFFFFF");
	so.addVariable("data", "statistic/"+link);
	so.addParam("allowScriptAccess", "always" );//"sameDomain");
	so.addParam("onmouseout", "void(0);" );
	so.write("statistic_graph");
}
		