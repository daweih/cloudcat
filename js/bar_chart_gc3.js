//top: 20, right: 30, bottom: 60, left: 50


var x = d3.scale.linear().range([0, w]),
    y = d3.scale.ordinal().rangeRoundBands([0, h], .4, .4);

var xAxis = d3.svg.axis().scale(x).orient("top").tickSize(-h),
    yAxis = d3.svg.axis().scale(y).orient("left").tickSize(0);

var bar_gc_svg3 = d3.select(".bar_chart_gc3").style({
	"font-family":"sans-serif",
	"font-size":"10px",
	})
.append("svg")
.attr("width", w + m[1] + m[3])
    .attr("height", h + m[0] + m[2])
  .append("g")
    .attr("transform", "translate(" + m[3] + "," + m[0] + ")");

d3.tsv("php/sortable_table.js.sql.php?usrID="+gp_personIDen, function(data) {

  // Parse numbers, and sort by value.
  data.forEach(function(d) { d.GC3 = +Math.round(d.GC3*10000)/100; });
  data.sort(function(a, b) { return b.GC3 - a.GC3; });

  // Set the scale domain.
  x.domain([0, d3.max(data, function(d) { return d.GC3; })]);
  y.domain(data.map(function(d) { return d.ID; }));

  var bar = bar_gc_svg3.selectAll("g.bar")
      .data(data)
    .enter().append("g")
      .attr("class", "bar")
      .attr("transform", function(d) { return "translate(0," + y(d.ID) + ")"; });

  bar.append("rect")
      .attr("class", function(d) { return "bar_chart_gc_"+d.ID; })
      .attr("width", function(d) { return x(d.GC3); })
      .attr("height", y.rangeBand())
      .attr("opacity", "0.8")
      .style("fill", function(d)
      {
          return d.ID == gp_files[gp_rec_no] ? "red" : "gray";
      })
      
      ;

  bar.append("text")
      .attr("class", "GC")
      .attr("x", function(d) { return x(d.GC3); })
      .attr("y", y.rangeBand() / 2)
      .attr("dx", -3)
      .attr("dy", ".35em")
      .attr("text-anchor", "end")
      .text(function(d) { return d.GC3; })
      .style("fill", "white");

  bar_gc_svg3.append("g")
      .attr("class", "x axis")
      .call(xAxis.tickSubdivide(0).ticks(5))
		.append("text")
//		.attr("transform", "rotate(-90)")
		.attr("class", "label")
		.attr("y", 0-m[0]/2)
		.attr("x", w)
		.style("text-anchor", "end")
		.text("GC content, GC3 (%)");

	bar_gc_svg3.selectAll(".x.axis path").style({
	  "display": "none"
	});
	bar_gc_svg3.selectAll(".axis path").style({
	  "fill": "white",
	  "stroke": "white",
	  "shape-rendering": "crispEdges"
	});
	bar_gc_svg3.selectAll(".axis line").style({
	  "fill": "white",
	  "stroke": "white",
	  "shape-rendering": "crispEdges"
	});

  bar_gc_svg3.append("g")
      .attr("class", "y axis")
      .call(yAxis);
	bar_gc_svg3.selectAll("text").style({
	  "font-family": "Helvetica Neue",
	  "font-size": "10px"
	});
});
fig_download("bar_chart_gc3", 310, 0);
