/*
- svg.ncbi_genetic_code_b
    - g
        - g.status
            - .up

*/
function aa_info_b(d){
		d3.select('a#aa_infor_head').selectAll("img").remove();
		if(d3.select('div#collapseOne').attr("class")=="accordion-body collapse")
		{
			d3.select('a#aa_infor_head').append("img").attr("src", "img/on.gif").attr("align", "right");
		}
		d3.select('a#aa_infor_head').on("click", function(){
			d3.select('a#aa_infor_head').select("img").remove();
		});

		d3.select('a#rscu_head').selectAll("img").remove();
		if(d3.select('div#collapseTwo').attr("class")=="accordion-body collapse"){
			d3.select('a#rscu_head').append("img").attr("src", "img/on.gif").attr("align", "right");
		}
		d3.select('a#rscu_head').on("click", function(){
			d3.select('a#rscu_head').select("img").remove();
		});

		d3.selectAll("div.aa_infor text, div.aa_infor img, div.aa_infor br, div.aa_infor a, div.rscu text,  div.rscu br").remove();
		d3.selectAll("div.rscu text, div.rscu div, div.rscu br, div.rscu a").remove();

			d3.selectAll("div.aa_infor").append("a").style("font-size", "14px").text(amino_acids[cell_class].full+" ("+cell_class+")").attr("href", "http://en.wikipedia.org/wiki/"+amino_acids[cell_class].full);
			d3.selectAll("div.aa_infor").append("br");

			if(cell_class=="*"){
				d3.selectAll("div.aa_infor text").text("");
			}
			else{
				d3.select("div.aa_infor").append("text").text("Structure: ");
				d3.select("div.aa_infor").append("img").attr("src", "aa_infor_img/"+amino_acids[cell_class].full+".png").attr("width", 150).attr("height", 150);
				d3.selectAll("div.aa_infor").append("br");
				d3.select("div.aa_infor").append("text").text("Side_chain Polarity: "+amino_acids[cell_class].polarity);
				d3.selectAll("div.aa_infor").append("br");
				d3.select("div.aa_infor").append("text")
						.text("Atomic Mass: "+amino_acids[cell_class].atomic_mass+" g mol")
						.append("tspan").text("-1").attr({"baseline-shift":"super"});
				d3.selectAll("div.aa_infor").append("br");
			}
			d3.selectAll("div.aa_infor").append("br");

			d3.selectAll("div.rscu").append("a").style("font-size", "14px").text(amino_acids[cell_class].full+" ("+cell_class+")").attr("href", "http://en.wikipedia.org/wiki/"+amino_acids[cell_class].full);
			d3.select("div.rscu").append("br");
			if(cell_class=="*"){
				d3.selectAll("div.rscu text").text("");
			}
			else{
				d3.select("div.rscu").append("div").attr("class",cell_class);
				var canvas = "div.rscu div."+cell_class;
				var rec_name = gp_files[gp_rec_no];
				var aa_name = cell_class;
//				console.log("canvas:"  ,canvas ,"ec_name:",rec_name,"aa_name:" ,aa_name );
				rscu_aa_figure(canvas, aa_name);
				d3.selectAll("div.rscu").append("br");
			}


}
var cell_fill;
var cell_id;
function cell_animation_b(d) {
	cell_fill = d3.select(this).style("fill");
	cell_id = d3.select(this).attr("ID");	
	cell_class = d3.select(this).attr("class");	
	cell_usage = d3.select(this).attr("usage");	
	d3.select(this).transition().duration(150).attr("opacity", "0.5");
	d3.select('svg.ncbi_genetic_code_b g g.status text.type').text("Codon: "+cell_id);
	d3.select('svg.ncbi_genetic_code_b g g.status text.name').text("Amino Acid: "+amino_acids[cell_class].full);
	d3.select('svg.ncbi_genetic_code_b g g.status text.sta').text("Codon Usage: "+Math.round(cell_usage*100000)/1000+"%");
}
function cell_animation_reset_b(d) {
	d3.select(this).transition().duration(150).attr("opacity", 1);
//	d3.select('svg.ncbi_genetic_code_b g g.status text.type').text("Select a cell...");
//	d3.select('svg.ncbi_genetic_code_b g g.status text.name').text("...");
//	d3.select('svg.ncbi_genetic_code_b g g.status text.sta').text("...");
}
var code_b = d3.select(".ncbi_genetic_code_b").append("svg")
			.attr("class", "ncbi_genetic_code_b")
			.attr("width", width)
			.attr("height", height)
			.append("g")
			.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")")
			.attr("class", "transform");
code_b.append("g").attr("class", "status");
code_b.select(".status").append("text")
	.attr({
		"class": "seq_id",
		"dx": "0em",
		"dy": "-14.2em",
	})//显示序列ID
	.style({
		"text-anchor": "middle",
		"font-size": "15px"
	}).text(gp_files[gp_rec_no]);
code_b.select(".status").append("text")
	.attr({
		"class": "name",
		"dx": "0em",
		"dy": "-15.5em",
	})//mouse on name
	.style({
		"text-anchor": "middle",
		"font-size": "12px"
	}).text("Name");
code_b.select(".status").append("text")
	.attr({
		"class": "type",
		"dx": "0em",
		"dy": "-16.5em"		
	})//mouse on name
	.style({
		"text-anchor": "middle",
		"font-size": "12px",
	}).text("Type");
code_b.select(".status").append("text")
	.attr({
		"class": "sta",
		"dx": "0em",
		"dy": "-14.5em"			
	})//显示所选位置的统计信息
	.style({
		"text-anchor": "middle",
		"font-size": "12px",
	}).text("Infor.");
//the buttons
//up
code_b.select(".status").append("g")
	.attr({
		"class": "up",
		"opacity": "0.5"
	})
	.style("cursor", "pointer")
	.on("mouseover", function(d) {
		d3.select('svg.ncbi_genetic_code_b g g.status .up')
			.transition()
			.duration(10)
			.attr("opacity", "1");
	})
	.on("mouseout", function(d) {
		d3.select('svg.ncbi_genetic_code_b g g.status .up')
			.transition()
			.duration(250)
			.attr("opacity", "0.5");
	});
code_b.select(".up")
.append("circle")
	.attr({
		"cy": "-240",
		"cx": "0",
		"r": "10",
		"fill": "white",
		"stroke": "black",
		"stroke-width": "0.8",
	})
code_b.select(".up")
	.append('polygon')
	.attr({
		"points": "-3.4641016151,-238 3.4641016151,-238 0,-244",
//			"fill": "white",
		"stroke": "black",
		"stroke-width": "0.8"
	});
//down
code_b.select(".status").append("g")
	.attr({
		"class": "down",
		"opacity": "0.5"
	})
	.style("cursor", "pointer")
	.on("mouseover", function(d) {
		d3.select('svg.ncbi_genetic_code_b g g.status .down')
			.transition()
			.duration(10)
			.attr("opacity", "1");
	})
	.on("mouseout", function(d) {
		d3.select('svg.ncbi_genetic_code_b g g.status .down')
			.transition()
			.duration(250)
			.attr("opacity", "0.5");
	});
code_b.select(".down")
.append("circle")
	.attr({
		"cy": "-160",
		"cx": "0",
		"r": "10",
		"fill": "white",
		"stroke": "black",
		"stroke-width": "0.8"
	})
code_b.select(".down")
	.append('polygon')
	.attr({
		"points": "-3.4641016151,-162 3.4641016151,-162 0,-156",
		"stroke": "black",
		"stroke-width": "0.8"
	});

var nt = ["T", "C", "A", "G"];
var nt_new = ["A", "T", "G", "C"];
var table_cell_width = 100;
var table_cell_height = 25;
codon_table(nt_new);
//the action of up button=============================================================================================================================================================================
d3.select('svg.ncbi_genetic_code_b g g.status .up').on('click', function() {
	if(gp_rec_no > 0)
	{
		gp_rec_no -= 1;
		var selected_file = gp_files[gp_rec_no];
		renew_all(selected_file);
	}
});
//the action of down button===============================================================================================================================================================================
d3.select('svg.ncbi_genetic_code_b g g.status .down').on('click', function() {
	if(gp_rec_no < gp_files_length)
	{
		gp_rec_no += 1;
		var selected_file = gp_files[gp_rec_no];
		renew_all(selected_file);
	}
});



function codon_table (nt){
	//
	var halfandhalf = d3.select("svg.ncbi_genetic_code_b g").append("g").attr("class", "halfandhalf");
			halfandhalf.append("g")
						.attr("class", "test");
	for(var x = 0; x<4; x++)
	{
		for(var y = 0; y<16; y++)
		{
			halfandhalf.select("g")
						.append("rect")
						.attr("x", x*40-width/2)
						.attr("y", y*8-height/2)
						.attr("rx", function(d){return table_cell_height/3;})
						.attr("ry", function(d){return table_cell_height/3;})
						.attr("width", 40)
						.attr("height", 8)
						.attr("stroke", "gray")
						.attr("stroke-width", 1)
						.style("fill", "LightBlue")
						.attr("opacity", 0.5);
		}
	}
			halfandhalf.select("g")
						.append("polygon")
						.attr("class", "Pro_robustness")
						.attr({
							"points": "-300,-204 -300,-172 -140,-172 -140,-268 -220,-268 -220,-204",
						})
						.attr({
							"stroke": "gray",
							"stroke-linejoin": "round"
						})
						
						.attr("stroke-width", 1)
						.style("fill", "gray")
						.attr("opacity", 0.3);
			halfandhalf.select("g")
						.append("text")
						.style("text-anchor", "middle")
						.attr("x", -220)
						.attr("y", -180)
						.style("font-size", "15px")
						.style("fill", "white")
						.style("font-family", "Helvetica Neue UltraLight")
						.text("Pro-robustness");
						
			halfandhalf.select("g")
						.append("polygon")
						.attr("class", "Pro_diversity")
						.attr({
							"points": "-300,-204 -300,-300 -140,-300 -140,-268 -220,-268 -220,-204",
						})
						.attr({
							"stroke": "gray",
							"stroke-linejoin": "round"
						})
						.attr("stroke-width", 2)
						.style("fill", "white")
						.attr("opacity", 0.3);
			halfandhalf.select("g")
						.append("text")
//						.attr("class", "Pro_diversity")
						.style("text-anchor", "middle")
						.attr("x", -220)
						.attr("y", -276)
						.style("font-size", "15px")
						.style("fill", "black")
						.style("font-family", "Helvetica Neue UltraLight")
						.text("Pro-diversity");



	//
	var quarters4 = d3.select("svg.ncbi_genetic_code_b g").append("g").attr("class", "quarters4");
			quarters4.append("g")
						.attr("class", "test");
	for(var x = 0; x<4; x++)
	{
		for(var y = 0; y<16; y++)
		{
			quarters4.select("g")
						.append("rect")
						.attr("x", x*40+width/2-40*4)
						.attr("y", y*8-height/2)
						.attr("rx", function(d){return table_cell_height/3;})
						.attr("ry", function(d){return table_cell_height/3;})
						.attr("width", 40)
						.attr("height", 8)
						.attr("stroke", "gray")
						.attr("stroke-width", 1)
						.style("fill", "LightBlue")
						.attr("opacity", 0.5);
		}
	}
			quarters4.select("g")
						.append("polygon")
						.attr("class", "AU_rich")
						.attr({
							"points": "140,-236 220,-236 220,-300 140,-300",
						})
						.attr({
							"stroke": "gray",
							"stroke-linejoin": "round"
						})
						.attr("stroke-width", 2)
						.style("fill", "white")
						.attr("opacity", 0.3);
			quarters4.select("g")
						.append("text")
						.style("text-anchor", "middle")
						.attr("x", 180)
						.attr("y", -258)
						.style("font-size", "15px")
						.style("fill", "black")
						.style("font-family", "Helvetica Neue UltraLight")
						.text("AU-rich");
						
			quarters4.select("g")
						.append("polygon")
						.attr("class", "GCp2")
						.attr({
							"points": "140,-236 220,-236 220,-172 140,-172",
						})
						.attr({
							"stroke": "gray",
							"stroke-linejoin": "round"
						})
						.attr("stroke-width", 2)
						.style("fill", "gray")
						.attr("opacity", 0.3);
			quarters4.select("g")
						.append("text")
						.style("text-anchor", "middle")
						.attr("x", 180)
						.attr("y", -198)
						.style("font-size", "15px")
						.style("fill", "white")
						.style("font-family", "Helvetica Neue UltraLight")
						.text("GCp2");
						
			quarters4.select("g")
						.append("polygon")
						.attr("class", "GCp1")
						.attr({
							"points": "220,-236 220,-300 300,-300, 300,-236",
						})
						.attr({
							"stroke": "gray",
							"stroke-linejoin": "round"
						})
						.attr("stroke-width", 2)
						.style("fill", "gray")
						.attr("opacity", 0.3);
			quarters4.select("g")
						.append("text")
						.style("text-anchor", "middle")
						.attr("x", 260)
						.attr("y", -258)
						.style("font-size", "15px")
						.style("fill", "white")
						.style("font-family", "Helvetica Neue UltraLight")
						.text("GCp1");

			quarters4.select("g")
						.append("polygon")
						.attr("class", "GC_rich")
						.attr({
							"points": "220,-236 220,-172 300,-172, 300,-236",
						})
						.attr({
							"stroke": "gray",
							"stroke-linejoin": "round"
						})
						.attr("stroke-width", 2)
						.style("fill", "white")
						.attr("opacity", 0.3);
			quarters4.select("g")
						.append("text")
						.style("text-anchor", "middle")
						.attr("x", 260)
						.attr("y", -198)
						.style("font-size", "15px")
						.style("fill", "red")
						.style("font-family", "Helvetica Neue UltraLight")
						.text("GC-rich");
	
	
d3.tsv("php/partition.js.sql.php?usrID="+gp_personIDen, function(error, data) {
	data.forEach(function(rec) {
//files[gp_rec_no]============================================================================================
		if(rec.ID==gp_files[gp_rec_no])
		{
			var usage_all = [];
			d3.text("genetic_code/"+ncbi_genetic_code_a_talbes[gp_genetic_code_no-1], function(d) {
					var codon2aa = {};
					var genetic_code_line4 = d;		
					var lines = genetic_code_line4.split("\n");
					var start_line = lines[1].replace(/\s+/g, "").split("=");
					var starts = start_line[1].split("");
					var aa_line = lines[0].replace(/\s+/g, "").split("=");
					var aa = aa_line[1].split("");
					var base1_line = lines[2].replace(/\s+/g, "").split("=");var base1 = base1_line[1].split("");
					var base2_line = lines[3].replace(/\s+/g, "").split("=");var base2 = base2_line[1].split("");
					var base3_line = lines[4].replace(/\s+/g, "").split("=");var base3 = base3_line[1].split("");

					for(var a = 0; a<aa.length; a++)
					{
						var key = base1[a]+base2[a]+base3[a];
						codon2aa[key] = aa[a];
						var rec_key = "Observed "+key;
						usage_all.push(+rec[rec_key]);
					}
					var color = d3.scale.linear()
									.domain([0, Math.max.apply(Math, usage_all)])
									.range(["white", "steelblue"])
									.interpolate(d3.interpolateLab);
				codon_current(ncbi_genetic_code_a_talbes);
				function codon_current(d) {
					var table = d3.select("svg.ncbi_genetic_code_b g").append("g").attr("class", "table");
					d3.select("svg.ncbi_genetic_code_b").attr({"id":rec.ID,});
					nt.forEach(function(b1, b1_no) {
					var codon_l_header = table.append("g")
								.attr("class", "l_h_"+b1);
					var codon_c_header = table.append("g")
								.attr("class", "c_h_"+b1);
					codon_l_header.append("rect")
						.attr("x", function(d) {
							return 0-table_cell_width*2.5;
						})
						.attr("y", function(d) {
							return b1_no*table_cell_height*4+table_cell_height-height/4+20;
						})
						.attr("rx", function(d){return table_cell_height/2;})
						.attr("ry", function(d){return table_cell_height/2;})
						.attr("width", table_cell_width/2)
						.attr("height", table_cell_height*4)
						.attr("stroke", "white")
						.attr("stroke-width", "0.5")
						.style("fill", "rgb(240, 182, 182)");
					codon_l_header.append("text")
						.style("text-anchor", "middle")
						.attr("x", function(d) {
							return table_cell_width/4-table_cell_width*2.5;
						})
						.attr("y", function(d) {
							return b1_no*table_cell_height*4+table_cell_height*3.5-height/4+20;
						})
						.style("font-size", "15px")
						.style("font-family", "Helvetica Neue UltraLight")
						.text(b1)
						.append("tspan")
						.text("2nd")
						.attr({"baseline-shift":"super"})
						.style("font-size", "12px")
						;

					codon_c_header.append("rect")
						.attr("y", function(d) {
							return 0-height/4+20;
						})
						.attr("x", function(d) {
							return b1_no*table_cell_width+table_cell_width/2-table_cell_width*2.5;
						})
						.attr("rx", function(d){return table_cell_height/2;})
						.attr("ry", function(d){return table_cell_height/2;})
						.attr("width", table_cell_width)
						.attr("height", table_cell_height)
						.attr("stroke", "white")
						.attr("stroke-width", "0.5")
						.style("fill", "rgb(200, 220, 140)");
					codon_c_header.append("text")
						.style("text-anchor", "middle")
						.attr("y", function(d) {
							return table_cell_height*0.75-height/4+20;
						})
						.attr("x", function(d) {
							return b1_no*table_cell_width+table_cell_width/2+table_cell_width/2-table_cell_width*2.5;
						})
						.style("font-size", "15px")
						.style("font-family", "Helvetica Neue UltraLight")
						.text(b1)
						.append("tspan")
						.text("1st")
						.attr({"baseline-shift":"super"})
						.style("font-size", "12px")
						;

				nt.forEach(function(b2, b2_no) {
//the codon line========================================================================================================================================
					var base12 = b2+b1;
					var font_color;

					var codon = "";
					var g = table.append("g")
									.attr("class", base12);
					var base12_aa_hash = {};
					var base12_g_ref = "g."+base12;
					if(base12=="AA"||base12=="AT"||base12=="TA"||base12=="TT")
					{
						font_color = "blue";
						table.select(base12_g_ref).on("mouseover", function(d) {
							d3.select(".AU_rich").transition().duration(250).style("opacity",1);
						});
						table.select(base12_g_ref).on("mouseout", function(d) {
							d3.select(".AU_rich").transition().duration(250).style("opacity",0.3);
						});
						
					}
					if(base12=="AG"||base12=="AC"||base12=="TG"||base12=="TC"||base12=="GA"||base12=="GT"||base12=="CA"||base12=="CT")
					{
						font_color = "black";
						if(base12=="AG"||base12=="AC"||base12=="TG"||base12=="TC")
						{
							table.select(base12_g_ref).on("mouseover", function(d) {
								d3.select(".GCp2").transition().duration(250).style("opacity",1);
							});
							table.select(base12_g_ref).on("mouseout", function(d) {
								d3.select(".GCp2").transition().duration(250).style("opacity",0.3);
							});
						}
						if(base12=="GA"||base12=="GT"||base12=="CA"||base12=="CT")
						{
							table.select(base12_g_ref).on("mouseover", function(d) {
								d3.select(".GCp1").transition().duration(250).style("opacity",1);
							});
							table.select(base12_g_ref).on("mouseout", function(d) {
								d3.select(".GCp1").transition().duration(250).style("opacity",0.3);
							});
						}

					}
					if(base12=="GG"||base12=="CC"||base12=="CG"||base12=="GC")
					{
						font_color = "red";
						table.select(base12_g_ref).on("mouseover", function(d) {
							d3.select(".GC_rich").transition().duration(250).style("opacity",1);
						});
						table.select(base12_g_ref).on("mouseout", function(d) {
							d3.select(".GC_rich").transition().duration(250).style("opacity",0.3);
						});
					}

				nt.forEach(function(b3, b3_no) {
//the codon line========================================================================================================================================
					codon = b2+b1+b3;
					base12_aa_hash[codon2aa[codon]] = 1;
					draw_codon_cell(b1_no, b2_no, b3_no, codon, "steelblue", table_cell_width);
					if(b2_no==3)
					{
						draw_codon_cell(b1_no, b2_no+1, b3_no, b3, "rgb(116, 176, 177)", 30);
					}
		
					function draw_codon_cell(b1_no, b2_no, b3_no, codon, codon_cell_color, current_width) {
						var codon_cell = g.append("g")
									.attr("class", function(d){
										if(codon.length==1)
										{
											return "base3";
										}
										else
										{
											return "codon";
										}
									})
									.attr("id", codon)
									;
						codon_cell.append("rect")
							.attr("ID", codon)
							.attr("class", function(d){
								if(codon.length==3)
								{
									return codon2aa[codon];
								}
								else
								{
									return codon;				
								}
							})
							.attr("usage", function(d){
								if(codon.length==3)
								{
									var rec_key = "Observed "+codon;
									return rec[rec_key];
								}
								else
								{
									return 1;				
								}
							})
							.attr("x", function(d) {
								return b2_no*table_cell_width+table_cell_width/2-table_cell_width*2.5;
							})
							.attr("y", function(d) {
								return b1_no*table_cell_height*4+b3_no*table_cell_height+table_cell_height-height/4+20;
							})
							.attr("ry", function(d){if(codon.length==1){return table_cell_height/3;}else{return table_cell_height/2;}})
							.attr("rx", function(d){if(codon.length==1){return table_cell_height/3;}else{return table_cell_height/2;}})
							.attr("width", current_width)
							.attr("height", table_cell_height)
							.attr("stroke", "gray")
							.attr("stroke-width", "0.2")
							.style("fill", function(d) {
								if(codon.length==3)
								{
									var rec_key = "Observed "+codon;
									return color(+rec[rec_key]);
								}
								else
								{
									return "rgb(116, 176, 177)";				
								}
							})
							.on("mouseover", cell_animation_b)
							.on("mouseout", cell_animation_reset_b)
							.on('click', aa_info_b)
							;
						codon_cell.append("text")
							.style("text-anchor", "middle")
							.attr("x", function(d) {
								return b2_no*table_cell_width+table_cell_width/2+current_width/2-table_cell_width*2.5;
							})
							.attr("y", function(d) {
								return b1_no*table_cell_height*4+b3_no*table_cell_height+table_cell_height/2+table_cell_height*1.25-height/4+20;
							})
							.style("font-size", function(d){
								if(codon.length==3)
								{
									return "12px";
								}
								else
								{
									return "15px";
								}
							})
							.style("fill", function(d){
								if(codon.length==3){
									return font_color;
								}
								else{return "black"}

							})
							.style("font-family", function(d){
								if(codon.length==3)
								{
									return "Helvetica Neue";
								}
								else
								{
									return "Helvetica Neue UltraLight";
								}
							})
							.text(function(d){
								if(codon.length==3)
								{
									return codon+" ("+codon2aa[codon]+")";
								}
								else
								{
									return codon;				
								}
							})
							.on('click', aa_info_b)
							.append("tspan")
							.text(function(d){
								if(codon.length==1)
								{
									return "3rd";
								}
							})
							.attr({"baseline-shift":"super"})
							.style("font-size", "12px");
					}
				});
				var base12_aa_hash_keys = Object.keys(base12_aa_hash);
//the mouseover and mouseout function part				
					if(base12_aa_hash_keys.length==1)
					{
						g.selectAll("g.codon").selectAll("rect").attr("stroke", "black");
						g.selectAll("g.codon").selectAll("rect").attr("stroke-width", "0.8");
						g.selectAll("g.codon").on("mouseover", function(d) {
							d3.select(".Pro_robustness").transition().duration(250).style("opacity",1);
						});
						g.selectAll("g.codon").on("mouseout", function(d) {
							d3.select(".Pro_robustness").transition().duration(250).style("opacity",0.3);
						});

					}
					else{
						g.selectAll("g.codon").on("mouseover", function(d) {
						d3.select(".Pro_diversity").transition().duration(250).style("opacity",1);
						});
						g.selectAll("g.codon").on("mouseout", function(d) {
						d3.select(".Pro_diversity").transition().duration(250).style("opacity",0.3);
						});
					}
				});
				});
				}
			});

			
		}
	});
});


}


function codon_table_renew (nt, selected_file) {
//console.log(selected_file);
		d3.select('div.ncbi_genetic_code_b svg').attr({"id":selected_file});
		var plot_id = 'circle.'+selected_file;
		d3.selectAll('div.plot svg g circle').attr('r','3').attr('opacity','1').style('fill','steelblue');
		var color = d3.select(plot_id).attr('r','6').attr('opacity','0.5').style('fill','red');

		if(gp_compare_ncbi_genetic_code_b[selected_file])
		{
//			console.log("ForCompare.");
			d3.select('div.ncbi_genetic_code_b svg g.download g.compare').attr({"id": "on",});
			d3.select('div.ncbi_genetic_code_b svg g.download').selectAll("path#yang").style({"opacity": 1,"fill": "black"});
			d3.select('div.ncbi_genetic_code_b svg g.download').selectAll("path#yin").style({"opacity": 1,"fill": "white"});
		}
		else
		{
//			console.log("NotInCompare.");
			d3.select('div.ncbi_genetic_code_b svg g.download g.compare').attr({"id": "off",});
			d3.select('div.ncbi_genetic_code_b svg g.download').selectAll("path#yang").style({"opacity": 0.5,"fill": "white",});
			d3.select('div.ncbi_genetic_code_b svg g.download').selectAll("path#yin").style({"opacity": 0.5,"fill": "gray"});
		}		
		
		for (var i = 0; i < gp_files.length; i++) {
			var d3_select_id = "tr." + gp_files[i];
			if(gp_files[i] == selected_file)
			{
				d3.select(d3_select_id).style("color", "red");
			}
			else
			{
				d3.select(d3_select_id).style("color", "gray");
			}
		}


d3.tsv("php/partition.js.sql.php?usrID="+gp_personIDen+"&ID="+selected_file, function(error, data) {
//console.log(data);
	data.forEach(function(rec) {
		if(rec.ID==selected_file)
		{
			var usage_all = [];
			d3.text("genetic_code/"+ncbi_genetic_code_a_talbes[gp_genetic_code_no-1], function(d) {
					var codon2aa = {};
					var genetic_code_line4 = d;		
					var lines = genetic_code_line4.split("\n");
					var start_line = lines[1].replace(/\s+/g, "").split("=");
					var starts = start_line[1].split("");
					var aa_line = lines[0].replace(/\s+/g, "").split("=");
					var aa = aa_line[1].split("");
					var base1_line = lines[2].replace(/\s+/g, "").split("=");var base1 = base1_line[1].split("");
					var base2_line = lines[3].replace(/\s+/g, "").split("=");var base2 = base2_line[1].split("");
					var base3_line = lines[4].replace(/\s+/g, "").split("=");var base3 = base3_line[1].split("");

					for(var a = 0; a<aa.length; a++)
					{
						var key = base1[a]+base2[a]+base3[a];
						codon2aa[key] = aa[a];
						var rec_key = "Observed "+key;
						usage_all.push(+rec[rec_key]);
					}
					var color = d3.scale.linear()
									.domain([0, Math.max.apply(Math, usage_all)])
									.range(["white", "steelblue"])
									.interpolate(d3.interpolateLab);
					
				codon_current(ncbi_genetic_code_a_talbes);
				function codon_current(d) {
					var table = d3.select("svg.ncbi_genetic_code_b g g.table");

					nt.forEach(function(b1, b1_no) {
					nt.forEach(function(b2, b2_no) {
						var base12 = "g."+b2+b1;

//the codon line========================================================================================================================================
				nt.forEach(function(b3, b3_no) {
//the codon line========================================================================================================================================
					codon = b2+b1+b3;
					var id = base12+" g#"+codon+" rect";
						var g = table.select(id).transition().duration(250).style("fill", function(d) {
									var rec_key = "Observed "+codon;
									return color(+rec[rec_key]);
							})
							.attr("usage", function(d){
									var rec_key = "Observed "+codon;
									return rec[rec_key];
							});
				});
				});
				});
				}
			});
		}
	});
});


}

fig_download("ncbi_genetic_code_b", width,150, "yes");
