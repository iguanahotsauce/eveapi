$(function() {
	var seriesOptions = [],
		yAxisOptions = [],
		seriesCounter = 0,
		names = [
			['Tritanium', 34],
			['Pyerite', 35],
			['Mexallon', 36],
			['Isogen', 37],
			['Nocxium', 38],
			['Zydrine', 39],
			['Megacyte', 40],
			['PLEX', 29668]
		],
		colors = Highcharts.getOptions().colors;

	$.each(names, function(i, name) {

		$.getJSON('../apps/getPriceInfo.php?id='+ name[1],	function(data) {

			seriesOptions[i] = {
				name : name[0],
				data : data,
				marker : {
					enabled : true,
					radius : 3
				},
				shadow : true,
				tooltip : {
					valueDecimals : 2
				}
			}

			seriesCounter++;

			if (seriesCounter == names.length) {
				createChart();
			}
		});
	});
	
	function createChart() {

		$('#container').highcharts('StockChart', {

		    rangeSelector: {
		        selected: 3
		    },
		    
		    legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0,
                enabled: true
            },
		    
		    tooltip: {
		    	valueDecimals: 2
		    },
		    
		    series: seriesOptions
		});
	}

});