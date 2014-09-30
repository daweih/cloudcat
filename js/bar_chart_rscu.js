

var x = d3.scale.linear().range([0, w]),
    y = d3.scale.ordinal().rangeRoundBands([0, h], .4, .4);

var xAxis = d3.svg.axis().scale(x).orient("top").tickSize(-h),
    yAxis = d3.svg.axis().scale(y).orient("left").tickSize(0);

var bar_cdc_svg = d3.select(".bar_chart_cdc").style({
	"font-family":"sans-serif",
	"font-size":"10px",
	})
.append("svg")
.attr("width", w + m[1] + m[3])
    .attr("height", h + m[0] + m[2])
  .append("g")
    .attr("transform", "translate(" + m[3] + "," + m[0] + ")");

d3.tsv("upload/"+gp_personID+"/"+gp_cat_file, function(data) {

  // Parse numbers, and sort by value.
  data.forEach(function(d) { d.CDC = +Math.round(d.CDC*1000)/1000; });

  data.sort(function(a, b) { return b.CDC - a.CDC; });

  // Set the scale domain.
  x.domain([0, d3.max(data, function(d) { return d.CDC; })]);
  
  y.domain(data.map(function(d) { return d.ID; }));

  var bar = bar_cdc_svg.selectAll("g.bar")
      .data(data)
    .enter().append("g")
      .attr("class", "bar")
      .attr("transform", function(d) { return "translate(0," + y(d.ID) + ")"; });

  bar.append("rect")
      .attr("class", function(d) { return "bar_chart_cdc_"+d.ID; })
      .attr("width", function(d) { return x(d.CDC); })
      .attr("height", y.rangeBand())
      .attr("opacity", "0.8")
      .style("fill", function (d)
      {
          return d.ID == gp_files[gp_rec_no] ? "red" : "gray";
      })
      
      ;

  bar.append("text")
      .attr("class", "GC")
      .attr("x", function(d) { return x(d.CDC); })
      .attr("y", y.rangeBand() / 2)
      .attr("dx", -3)
      .attr("dy", ".35em")
      .attr("text-anchor", "end")
      .text(function(d) { return d.CDC; })
      .style("font-size", 10)
      .style("fill", "white");

  bar_cdc_svg.append("g")
      .attr("class", "x axis")
      .call(xAxis.tickSubdivide(0).ticks(5))
		.append("text")
//		.attr("transform", "rotate(-90)")
		.attr("class", "label")
		.attr("y", 0-m[0]/2)
		.attr("x", w)
		.style("text-anchor", "end")
		.text("CDC");

	bar_cdc_svg.selectAll(".x.axis path").style({
	  "display": "none"
	});
	bar_cdc_svg.selectAll(".axis path").style({
	  "fill": "white",
	  "stroke": "white",
	  "shape-rendering": "crispEdges"
	});
	bar_cdc_svg.selectAll(".axis line").style({
	  "fill": "white",
	  "stroke": "white",
	  "shape-rendering": "crispEdges"
	});

  bar_cdc_svg.append("g")
      .attr("class", "y axis")
      .call(yAxis);
	bar_cdc_svg.selectAll("text").style({
	  "font-family": "Helvetica Neue",
	  "font-size": "10px"
	});
});
fig_download("bar_chart_cdc", 310, 0);
