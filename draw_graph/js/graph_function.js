function draw_a_graph(json){
	//$(function() {
		var chart;
		//$(document).ready(function() {
			chart = new Highcharts.Chart({
			chart: {
				renderTo: json.render
			},
			title: {
				text: json.title
			},
			subtitle: {
				text: json.subtitle
			},
			xAxis: {
				categories: json.category,
				labels: {
					align : 'center',
					rotation: 0,
					style: {
						fontSize: '13px'
					}
				}
			},
			yAxis: {
				title: {
					text: json.unitName
				}
			},
			credits: {
				enabled: false
			},
			legend: {
				backgroundColor: '#FFFFFF',
				shadow: true
			},
			tooltip: {
				formatter: function(){
					google = this.series.name;
					return ' Click Here to Have a look<br> Time: ' + this.x + '<br>' + this.series.name + ' : ' + this.y;
				}
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					boderWidth: 0
				}
			},
			series: json.series
			});
			$('.highcharts-tooltip').click(function(){
				window.open('http://www.p3db.org/browse.php?stype=pro_s&org=0&ref=0&acc='+ google + '&desc=');
			});
		//});
	//});
}

function makeNum(series){
	for(var i = 0; i < series.length; i++){
		for(var j = 0; j < series[i].data.length; j++)
			series[i].data[j] = parseFloat(series[i].data[j]);
	}
	return series;
}