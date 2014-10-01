//rscu_figure();
function rscu_aa_figure(canvas, aa_name) {

	d3.tsv("php/rscu.js.sql.php?usrID="+gp_personIDen, function(cat) {
		cat.forEach(function(rec) {
	//files[gp_rec_no]============================================================================================
			if(rec.ID==gp_files[gp_rec_no]){

				d3.text("genetic_code/"+ncbi_genetic_code_a_talbes[gp_genetic_code_no-1], function(genetic_code_line4) {
				var rscu_aa_rec = [];
				var rscu_aa_name = [];
				
				
						var lines = genetic_code_line4.split("\n");
						var start_line = lines[1].replace(/\s+/g, "").split("=");
						var starts = start_line[1].split("");
						var aa_line = lines[0].replace(/\s+/g, "").split("=");
						var aa = aa_line[1].split("");
						var base1_line = lines[2].replace(/\s+/g, "").split("=");var base1 = base1_line[1].split("");
						var base2_line = lines[3].replace(/\s+/g, "").split("=");var base2 = base2_line[1].split("");
						var base3_line = lines[4].replace(/\s+/g, "").split("=");var base3 = base3_line[1].split("");

						for(var a = 0; a<aa.length; a++){
							var key = base1[a]+base2[a]+base3[a];
							var rec_key = "RSCU("+key+")";
							if(aa_name==aa[a]){
								rscu_aa_rec.push(+rec[rec_key]);
								rscu_aa_name.push(key);
							}
						}
						//draw fig here;
						//console.log(gp_cat_file, gp_files[gp_rec_no], rscu_aa_rec.length, rscu_aa_name);
						if(rscu_aa_rec.length>1){
							rscu_aa_rec.forEach(function(d) { d = +Math.round(d*1000)/1000; });
							var margin = {top: 20, right: 30, bottom: 35, left: 60},
								width = 300 - margin.left - margin.right,
								height = 180 - margin.top - margin.bottom;
							var x = d3.scale.ordinal().rangeRoundBands([0, width], .6, .6);
							var y = d3.scale.linear().range([height, 0]);
							var svg = d3.select(canvas).append("svg")
										.attr("width", width + margin.left + margin.right)
										.attr("height", height + margin.top + margin.bottom)
										.append("g")
										.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
							x.domain(rscu_aa_name.map(function(d) { return d; }));
							y.domain([0, d3.max(rscu_aa_rec, function(d) { return d; })]);

							svg.append("g")
								.attr("class", "x axis")
								.attr("transform", "translate(0," + height + ")")
								.call(d3.svg.axis().scale(x).orient("bottom"))
								.style("font-size", "10px")
								.append("text")
								//		.attr("transform", "rotate(-90)")
								.attr("class", "label")
								.attr("dy", margin.bottom)
								.attr("dx", width)
								.style("text-anchor", "end")
								.style("font-family", "Helvetica Neue Light")
								.text("Codon");

							svg.append("g")
								.attr("class", "y axis")
						//how to specify tick numbers
								.call(d3.svg.axis().scale(y).orient("left").ticks(4))
								.style("font-size", "10px")
								.append("text")
								.attr("transform", "rotate(-90)")
								.attr("class", "label")
								.attr("dy", 0-margin.left/2)
								.style("text-anchor", "end")
								.style("font-family", "Helvetica Neue")
								.text("RSCU");

							svg.selectAll(".bar")
								.data(rscu_aa_rec)
								.enter().append("rect")
								.attr("class",  function(d, i) { return rscu_aa_name[i]; })
								.attr("x", function(d, i) { return x(rscu_aa_name[i]); })
								.attr("width", x.rangeBand())
								.attr("y", function(d) { return y(d); })
								.attr("height", function(d) { return height - y(d); })
								.style("fill", "steelblue");
						}else{
							var svg = d3.select(canvas).append("text").text("Only ONE codon for this amino acid: "+rscu_aa_name[0]);
						}
				});
			}
		});

	});
}
