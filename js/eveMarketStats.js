$(function() {
	var cheezburger = {};
	var seriesOptions = [],
		names = [],
		yAxisOptions = [],
		seriesCounter = 0,
	colors = Highcharts.getOptions().colors;
	addCheckboxes();
	function addCheckboxes() {
		$.getJSON('../apps/getTypeIDs.php',	function(data) {
			$.each(data, function(name, values) {
				$('#typeids').append('<input class="typeid" type="checkbox" type_id="'+values.type_id+'" name="'+name+'"value="false"/>'+name+'<br />');
			});
			clickEvent();
		});
	}
	function clickEvent() {
		$('.typeid').click(function() {
			if($(this).val() == 'true') {
				$(this).val('false');
			}
			else {
				$(this).val('true');
			}
		});
	}
	$('#display_chart').click(function() {
		names = [];
		seriesOptions = [];
		$('.typeid').each(function() {
			if($(this).val() == 'true') {
				names.push([$(this).attr('name'), $(this).attr('type_id')]);
			}
		});
		
		getChartData();
	});

	function getChartData() {
		seriesCounter = 0;
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
	}
	function createChart() {
		$('#container').css('display','block');
		$('#select_typeids').css('display','none');
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
					s += '<span style="color:' + this.series.color + '"><b>' + this.series.name + '</b></span><br/><br/><span style="color:'+this.series.color+'">Sell Price: ' + this.y + '<br/><br/>';
					s += '<span style="color:'+this.series.color+'">Quantity:</span> ' + cheezburger[this.series.name]['quantity'][this.x]+'<br/>';
					s += '<span style="color:'+this.series.color+'">Buy Price:</span> ' + cheezburger[this.series.name]['buy_price'][this.x];
					});
					
					return s;
		    	}
		    },
		    
		    series: seriesOptions
		});
		$('#container').after('<button id="back" class="btn btn-primary">Back</button>');
		$('#back').click(function() {
			window.location.reload();
		});
	}
});