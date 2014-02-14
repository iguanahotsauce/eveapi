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
		var cheezburger = {};
	$.each(names, function(i, name) {

		$.getJSON('../apps/getPriceInfo.php?id='+ name[1],	function(data) {
			cheezburger[name[0]] = {};
			cheezburger[name[0]]['quantity'] = data.quantity;
			cheezburger[name[0]]['buy_price'] = data.buy_price;
			seriesOptions[i] = {
				name : name[0],
				data : data['data'],
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
			console.log(cheezburger);
		$('#container').highcharts('StockChart', {
			chart: {
				
			},

		    rangeSelector: {
		        selected: 4
		    },
		   
		    legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0,
                enabled: true
            },
		    
		    tooltip: {
		    	valueDecimals: 2,
		    	shared: true,
		    	formatter: function() {
			    	var s = '';
					s += '<b>' + Highcharts.dateFormat('%b %e, %Y, %H:%M',this.x) +'</b><br/>';
					$.each(this.points, function(i, series){
					s += '<span style="color:' + this.series.color + '">' + this.series.name + '</span>: ' + this.y + '<br/><br/>';
					s += '<span style="color:'+this.series.color+'">Quantity:</span> ' + cheezburger[this.series.name]['quantity'][this.x]+'<br/>';
					s += '<span style="color:'+this.series.color+'">Buy Price:</span> ' + cheezburger[this.series.name]['buy_price'][this.x];
					});
					
					return s;
		    	}
		    },
		    
		    series: seriesOptions
		});
	}

});