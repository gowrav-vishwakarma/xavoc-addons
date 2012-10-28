$.each(
{
	this_chart: undefined,
	draw: function(container,json_options,debug){
		var options=new Object();
		options =jQuery.parseJSON( json_options );
		if(debug)
			console.log(options);
		this.this_chart = new Highcharts.Chart(options);
	},

	addSeries: function(options){
		this.this_chart.addSeries(options,true);
	},

	addPercentage: function(){
		this.this_chart.options.plotOptions.pie.dataLabels.formatter = function(){
			return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
		}
	},

	printOptions: function(){
		console.log(this.this_chart.options);
	}

},$.univ._import);