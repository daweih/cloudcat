var amino_acids = {
					"*": {"abb": "*",   "full": "STOP",          "polarity": "NA"          ,"atomic_mass": "NA"},
					"A": {"abb": "Ala", "full": "Alanine",       "polarity": "nonpolar"    ,"atomic_mass": "89.09"},
					"C": {"abb": "Cys", "full": "Cysteine",      "polarity": "nonpolar"    ,"atomic_mass": "121.16"},
					"D": {"abb": "Asp", "full": "Aspartic",      "polarity": "acidic polar","atomic_mass": "133.10"},
					"E": {"abb": "Glu", "full": "Glutamic",      "polarity": "acidic polar","atomic_mass": "147.13"},
					"F": {"abb": "Phe", "full": "Phenylalanine", "polarity": "nonpolar"    ,"atomic_mass": "165.19"},
					"G": {"abb": "Gly", "full": "Glycine",       "polarity": "nonpolar"    ,"atomic_mass": "75.07"},
					"H": {"abb": "His", "full": "Histidine",     "polarity": "Basic polar" ,"atomic_mass": "155.16"},
					"I": {"abb": "Ile", "full": "Isoleucine",    "polarity": "nonpolar"    ,"atomic_mass": "131.17"},
					"K": {"abb": "Lys", "full": "Lysine",        "polarity": "Basic polar" ,"atomic_mass": "146.19"},
					"L": {"abb": "Leu", "full": "Leucine",       "polarity": "nonpolar"    ,"atomic_mass": "131.17"}, 
					"M": {"abb": "Met", "full": "Methionine",    "polarity": "nonpolar"    ,"atomic_mass": "149.21"},
					"N": {"abb": "Asn", "full": "Asparagine",    "polarity": "polar"       ,"atomic_mass": "132.12"},
					"P": {"abb": "Pro", "full": "Proline",       "polarity": "nonpolar"    ,"atomic_mass": "115.13"},
					"Q": {"abb": "Gln", "full": "Glutamine",     "polarity": "polar"       ,"atomic_mass": "146.15"},
					"R": {"abb": "Arg", "full": "Arginine",      "polarity": "Basic polar" ,"atomic_mass": "174.20"},
					"S": {"abb": "Ser", "full": "Serine",        "polarity": "polar"       ,"atomic_mass": "105.09"}, 
					"T": {"abb": "Thr", "full": "Threonine",     "polarity": "polar"       ,"atomic_mass": "119.12"},//Threonine	Thr	T	polar	neutral
					"V": {"abb": "Val", "full": "Valine",        "polarity": "nonpolar"    ,"atomic_mass": "117.15"},
					"W": {"abb": "Trp", "full": "Tryptophan",    "polarity": "nonpolar"    ,"atomic_mass": "204.23"},
					"Y": {"abb": "Tyr", "full": "Tyrosine",      "polarity": "polar"       ,"atomic_mass": "181.19"}//Tyrosine	Tyr	Y	polar
};
var nucleic_acids = {
"A": "Adenosine",
"C": "Cytidine",
"G": "Guanosine",
"T": "Thymidine"
};

var nucleic_acids = {
"A": "Adenosine",
"C": "Cytidine",
"G": "Guanosine",
"T": "Thymidine"
};
var nucleobase = {
"R": "Purine",
"N": "Purine and Pyrimidine",
"Y": "Pyrimidine"
}

var cell_width = 10*1.15;
var cell_height = 16.18;

var ncbi_genetic_code_a = d3.select(".ncbi_genetic_code_a").append("svg")
			.attr("width", width+470)
			.attr("height", height+120)
			.attr("class", "ncbi_genetic_code_a")
			.append("g")
			.attr("class","transform")
			.attr("transform", "translate(" + (width+150) / 2 + "," + 150 + ")");//height / 2
/*
ncbi_genetic_code_a.append("g").attr("class", "status");
ncbi_genetic_code_a.select(".status").append("text")
	.attr({
		"class": "seq_id",
		"dx": "0em",
		"dy": "-14.2em"
//		,"font-family": "Helvetica Neue UltraLight"
	})//显示序列ID
	.style({
		"text-anchor": "middle",
		"font-size": "15px"
	}).text(gp_files[gp_rec_no]);
ncbi_genetic_code_a.select(".status").append("text")
	.attr({
		"class": "name",
		"dx": "0em",
		"dy": "-15.5em"
//		,"font-family": "Arial"
	})//mouse on name
	.style({
		"text-anchor": "middle",
		"font-size": "12px"
	}).text("Name");
ncbi_genetic_code_a.select(".status").append("text")
	.attr({
		"class": "type",
		"dx": "0em",
		"dy": "-16.5em"		
	})//mouse on name
	.style({
		"text-anchor": "middle",
		"font-size": "12px"
//		,"font-family": "Arial"
	}).text("Type");
ncbi_genetic_code_a.select(".status").append("text")
	.attr({
		"class": "sta",
		"dx": "0em",
		"dy": "-14.5em"			
	})//显示所选位置的统计信息
	.style({
		"text-anchor": "middle",
		"font-size": "12px"
//		,"font-family": "Arial"
	}).text("Infor.");
//the buttons
//up
ncbi_genetic_code_a.select(".status").append("g")
	.attr({
		"class": "up",
		"opacity": "0.5"
	})
	.style("cursor", "pointer")
	.on("mouseover", function(d) {
		d3.select('div.ncbi_genetic_code_a svg g g.status g.up')
			.transition()
			.duration(10)
			.attr("opacity", "1");
	})
	.on("mouseout", function(d) {
		d3.select('div.ncbi_genetic_code_a svg g g.status g.up')
			.transition()
			.duration(250)
			.attr("opacity", "0.5");
	});
ncbi_genetic_code_a.select(".up")
.append("circle")
	.attr({
		"cy": "-240",
		"cx": "0",
		"r": "10",
		"fill": "white",
		"stroke": "black",
		"stroke-width": "0.8",
	})
ncbi_genetic_code_a.select(".up")
	.append('polygon')
	.attr({
		"points": "-3.4641016151,-238 3.4641016151,-238 0,-244",
//			"fill": "white",
		"stroke": "black",
		"stroke-width": "0.8",
	});
//down
ncbi_genetic_code_a.select(".status").append("g")
	.attr({
		"class": "down",
		"opacity": "0.5"
	})
	.style("cursor", "pointer")
	.on("mouseover", function(d) {
		d3.select('div.ncbi_genetic_code_a svg g g.status g.down')
			.transition()
			.duration(10)
			.attr("opacity", "1");
	})
	.on("mouseout", function(d) {
		d3.select('div.ncbi_genetic_code_a svg g g.status g.down')
			.transition()
			.duration(250)
			.attr("opacity", "0.5");
	});
ncbi_genetic_code_a.select(".down")
.append("circle")
	.attr({
		"cy": "-160",
		"cx": "0",
		"r": "10",
		"fill": "white",
		"stroke": "black",
		"stroke-width": "0.8"
	})
ncbi_genetic_code_a.select(".down")
	.append('polygon')
	.attr({
		"points": "-3.4641016151,-162 3.4641016151,-162 0,-156",
//		"fill": "white",
		"stroke": "black",
		"stroke-width": "0.8"
	});

//the action of up button=============================================================================================================================================================================
d3.select('div.ncbi_genetic_code_a svg g g.status .up').on('click', function() {
	if(gp_rec_no > 0)
	{
		gp_rec_no -= 1;
		var selected_file = gp_files[gp_rec_no];
		renew_all(selected_file);
	}
});
//the action of down button===============================================================================================================================================================================
d3.select('div.ncbi_genetic_code_a svg g g.status .down').on('click', function() {
	if(gp_rec_no < gp_files_length)
	{
		gp_rec_no += 1;
		var selected_file = gp_files[gp_rec_no];
		renew_all(selected_file);
	}
});
*/



var ncbi_genetic_code_a_talbes = ["The Standard Code_a.txt", "The Vertebrate Mitochondrial Code_a.txt", "The Yeast Mitochondrial Code_a.txt", "The Mold, Protozoan, and Coelenterate Mitochondrial Code and the Mycoplasma or Spiroplasma Code_a.txt", "The Invertebrate Mitochondrial Code_a.txt", "The Ciliate, Dasycladacean and Hexamita Nuclear Code_a.txt", "The Echinoderm and Flatworm Mitochondrial Code_a.txt", "The Euplotid Nuclear Code_a.txt", "The Bacterial, Archaeal and Plant Plastid Code_a.txt", "The Alternative Yeast Nuclear Code_a.txt", "The Ascidian Mitochondrial Code_a.txt", "The Alternative Flatworm Mitochondrial Code_a.txt", "Blepharisma Nuclear Code_a.txt", "Chlorophycean Mitochondrial Code_a.txt", "Trematode Mitochondrial Code_a.txt", "Scenedesmus obliquus mitochondrial Code_a.txt", "Thraustochytrium Mitochondrial Code_a.txt", "Pterobranchia mitochondrial code_a.txt", "Candidate Division SR1 and Gracilibacteria Code_a.txt"];
var ncbi_genetic_code_a_talbes_no = ["1", "2", "3", "4", "5", "6", "9", "10", "11", "12", "13", "14", "15", "16", "21", "22", "23", "24", "25"];

var ncbi_genetic_code_a_talbes_length = ncbi_genetic_code_a_talbes.length - 1;
var current_color;
var current_x;
var current_y;
var current_rx;
var current_ry;
var current_type;
var current_id;
var current_opacity;
function cell_animation(d) {

	d3.select("div.ncbi_genetic_code_a svg g g.float_cell")
		.remove();

	current_color = d3.select(this).select("rect").style("fill");
	current_x = d3.select(this).select("rect").attr("x");
	current_y = d3.select(this).select("rect").attr("y");
	current_rx = d3.select(this).select("rect").attr("rx");
	current_ry = d3.select(this).select("rect").attr("ry");

	current_type = d3.select(this).select("rect").attr("class");
	var current_type_letter = current_type.split("");
	var float_cell_width = current_type_letter.length*5;
	if(float_cell_width<cell_height*5)
	{
		float_cell_width = cell_height*5;
	}

	current_id = d3.select(this).select("rect").attr("id");
	current_opacity = d3.select(this).select("rect").attr("opacity");

	current_x  = +current_x;
	current_y  = +current_y;
	current_rx = +current_rx;
	current_ry = +current_ry;

	d3.selectAll("div.ncbi_genetic_code_a svg g g g rect")
		.transition()
		.duration(250)
	.attr("opacity", "0.5");
	var line_tag = "div.ncbi_genetic_code_a svg g g g rect#"+current_id;
	d3.selectAll(line_tag)
		.transition()
		.duration(250)
	.attr("opacity", "1");

	var current_text = d3.select(this).select("text").text();
	var current_text_color = d3.select(this).select("text").style("fill");
	var current_aa_info;
    current_aa_info = !(current_type == "Base1" || current_type == "Base2" || current_type == "Base3") ? amino_acids[current_text]["full"] : nucleic_acids[current_text];
	

	var float_cell = d3.select("div.ncbi_genetic_code_a svg g").append("g").attr("class", "float_cell")
									.attr("opacity", "1");
	float_cell.append("rect")
				.style({
					"fill": "black",
					"stroke": "white",
					"stroke-width": "0.1"
				})
				.attr("x", function(d){
                    return current_x > 0 ? current_x - cell_width + cell_width : current_x + cell_width;
				})
				.attr("y", current_y)
				.attr("rx", current_rx*2)
				.attr("ry", current_ry*2)
				.attr("width", function(){return float_cell_width+"px";})
				.attr("height", cell_height*6)
				.attr("opacity", "0.6")
				.attr("filter", "url(#cell_shadow)")
				.on("mouseout", cell_animation_reset)
				;

	float_cell.append("text")//cell type or name of the codon table
				.style("text-anchor", "left")
				.attr("x", function(d){
                    return current_x > 0 ? current_x + cell_width : current_x + cell_width + cell_width;
					
				})
				.attr("y", current_y+cell_height*0.6)
				.attr("class", "float_cell")
				.style("font-size", function(d){return 10*cell_height/18+"px";})
				.attr("fill", "white")
				.text(current_type);
				
	float_cell.append("text")//short name of cell
				.style("text-anchor", "left")
				.attr("x", function(d){
                    return current_x > 0 ? current_x + cell_width - cell_width + cell_width : current_x + cell_width + cell_width;
					
				})
				.attr("class", "float_card")
				.attr("y", current_y+cell_height*3)
				.style("font-size", function(d){return 25*cell_height/12+"px";})
				.attr("fill", "red")
				.text(current_text);//http://en.wikipedia.org/wiki/Alanine
		float_cell.append("text")//FULL Name of amino_acids or Nucleic acid
				.style("text-anchor", "left")
				.attr("x", function(d){
					if(current_x > 0)
					{
						return current_x+cell_width;
					}
					else
					{
						return current_x+cell_width+cell_width;
					}
					
				})
				.attr("y", current_y+cell_height*4)
				.attr("class", "float_cell")
				.style("font-size", function(d){return 18*cell_height/25+"px";})
				.attr("fill", function(d)
				{
					if(current_type=="Base1"||current_type=="Base2"||current_type=="Base3")
					{
						return current_color;
					}
					else
					{
						return "white";
					}
				})
				.text(current_aa_info);
	if(current_text_color=="#ffff00")
	{
		float_cell.append("text")//if it is start CODON
				.style("text-anchor", "left")
				.attr("x", function(d){
					if(current_x > 0)
					{
						return current_x+cell_width+"px";
					}
					else
					{
						return current_x+cell_width+cell_width+"px";
					}
					
				})
				.attr("y", current_y+cell_height*5+"px")
				.attr("class", "float_cell")
				.style("font-size", function(d){return 15*cell_height/25+"px";})
				.attr("fill", current_text_color)
				.text("Start codon");
	}
	d3.select('div.ncbi_genetic_code_a svg g g.status text.type').text(current_type.replace("genetic_code/", ""));
	d3.select('div.ncbi_genetic_code_a svg g g.status text.name').text("Amino Acid: "+current_aa_info);
//	d3.select('svg.ncbi_genetic_code_b g g.status text.sta').text("Codon Usage: "+Math.round(cell_usage*10000)/100+"%");

}
function cell_animation_reset(d) {
	d3.select('div.ncbi_genetic_code_a svg g g.status text.type').text("Codon table species");
	d3.select('div.ncbi_genetic_code_a svg g g.status text.name').text("Amino Acid Name");
	d3.select('svg.ncbi_genetic_code_b g g.status text.sta').text("");

	d3.select("div.ncbi_genetic_code_a svg g g.float_cell")
		.remove();
	var line_tag = "div.ncbi_genetic_code_a svg g g g rect#"+current_id;
	d3.selectAll(line_tag).attr("opacity", "0.5");

}
codon_current(ncbi_genetic_code_a_talbes);

d3.select("div.ncbi_genetic_code_a svg g")
	.append("filter")
	.attr({
		"id": "cell_shadow",
		"x": "0",
		"y": "0",
		"width": "150%",
		"height": "150%"
	});
d3.select("div.ncbi_genetic_code_a svg g filter")
	.append("feOffset")
	.attr({
		"result": "offOut",
		"in": "SourceAlpha",
		"dx": "3",
		"dy": "3"
	});
d3.select("div.ncbi_genetic_code_a svg g filter")
	.append("feGaussianBlur")
	.attr({
		"result": "blurOut",
		"in": "offOut",
		"stdDeviation": "2"
	});
d3.select("div.ncbi_genetic_code_a svg g filter")
	.append("feBlend")
	.attr({
		"in": "SourceGraphic",
		"in2": "blurOut",
		"mode": "normal"
	});
function codon_current(d) {
//	d3.select('g.status text.seq_id').text((ncbi_genetic_code_a_talbes[i].replace("_a.txt", ""));
	
	d.forEach(function(d, i) {
		var ncbi_genetic_code_a_talbe = "genetic_code/"+d;
		var g = d3.select("div.ncbi_genetic_code_a svg g").append("g").attr("class", function(d)
		{
			return "ncbi_genetic_code_"+i;
		});

	d3.text(ncbi_genetic_code_a_talbe, function(d) {
		var genetic_code_line4 = d;		
		var lines = genetic_code_line4.split("\n");
		var start_line = lines[1].replace(/\s+/g, "").split("=");
		var starts = start_line[1].split("");
		var aa_line = lines[0].replace(/\s+/g, "").split("=");
		var aa = aa_line[1].split("");
		if(i==0)
		{
		
			var line_nos = ["2","3","4","0"];
			g.append("text").text(ncbi_genetic_code_a_talbes[i].replace("_a.txt", "")+": "+ncbi_genetic_code_a_talbes_no[i])
				.style({
					"text-anchor": "left",
					"font-family": "Arial",
				})
				.style("fill", function(d){
					if(i==gp_genetic_code_no-1)
					{
						return "red";			
					}
					else
					{
						return "LightSlateGray";
					}
				})								
				.style("font-size", function(d){
					if(i==gp_genetic_code_no-1)
					{
						return 12*cell_height/16.18+"px";
					}
					else
					{
						return 10*cell_height/16.18+"px";
					}
				})
				.attr("y", function(d) {
					return i*cell_height+i*cell_height-132.46;
				})
				.attr("x", function(d) {
					return (0-32)*cell_width;
				});
			line_nos.forEach(function(d, ll) {
			var l = +d;


			if(lines[l].length > 0)
			{
//正则表达式
				var rec = lines[l].replace(/\s+/g, "").split("=");
				var type = rec[0];
				var code = rec[1].split("");
				if(l==0)
				{
					aa = code;
				}
				for (var r = 0; r < code.length; r++) {
					var cell_id = "i"+i+"l"+l+"r"+r;
					var each_code = g.append("g")
										.attr("class", cell_id)
										.on("mouseover", cell_animation);
					if(i==gp_genetic_code_no-1 && l==0)
					{
						each_code.attr("id", "current_genetic_codon_table");
					}
					each_code.append("rect")
								.style("stroke", function(d){
									if(i==gp_genetic_code_no-1 && l==0)
									{
										return "red";			
									}
									else
									{
										return "white";
									}
								})								
								.style("stroke-width", function(d){
									if(i==gp_genetic_code_no-1 && l==0)
									{
										return "1";			
									}
									else
									{
										return "0.5";
									}
								})								
								.style("fill", function(d){
									if(l==2)
									{
										return "rgb(240, 182, 182)";
									}
									if(l==3)
									{
										return "rgb(200, 220, 140)";
									}
									if(l==4)
									{
										return "rgb(116, 176, 177)";
									}
									else
									{
										return "steelblue";
									}
								})
								.attr("class", function(d){
									if(l==2)
									{
										return type;
									}
									if(l==3)
									{
										return type;
									}
									if(l==4)
									{
										return type;
									}
									else
									{
										var table_name = ncbi_genetic_code_a_talbe.replace(/_a\.txt/g, "");
										return table_name;
									}
								})
								.attr("id", function(d){
									return amino_acids[aa[r]]["full"];
								})
								.attr("y", function(d) {
									return ll*cell_height+i*cell_height-130;
								})
								.attr("x", function(d) {
									return (r-32)*cell_width;
								})
								.attr("ry", function(d){return cell_width/5;})
								.attr("rx", function(d){return cell_width/5;})
								.attr("width", cell_width)
								.attr("height", cell_height)
								.attr("opacity","0.5")
								;
					each_code.append("text")
								.style("text-anchor", "middle")
								.attr("y", function(d) {
									return ll*cell_height+i*cell_height+cell_height*0.7-130;
								})
								.attr("x", function(d) {
									return (r-32)*cell_width+cell_width*0.5;
								})
								.style("font-size", function(d){return 10*cell_height/16.18+"px";})
								.style("font-family", "Arial")
//								.attr("fill", "white")
								.text(code[r])
								.style("fill", function(d)
								{
									if(starts[r]=="M"&&l==0)
									{
										return  "yellow";
									}
									else
									{
										return "black";
									}
								});
				}
			}
			});
		}
		else
		{
		for (var l = 0; l < 1; l++) {
			if(lines[l].length > 0)
			{
//正则表达式
				var rec = lines[l].replace(/\s+/g, "").split("=");
				var type = rec[0];
				var code = rec[1].split("");
				
				g.append("text").text(ncbi_genetic_code_a_talbes[i].replace("_a.txt", "")+": "+ncbi_genetic_code_a_talbes_no[i])
					.style({
						"text-anchor": "left",
						"font-family": "Arial",
					})
					.style("fill", function(d){
						if(i==gp_genetic_code_no-1 && l==0)
						{
							return "red";			
						}
						else
						{
							return "LightSlateGray";
						}
					})								
					.style("font-size", function(d){
						if(i==gp_genetic_code_no-1)
						{
							return 12*cell_height/16.18+"px";
						}
						else
						{
							return 10*cell_height/16.18+"px";
						}
					})
					.attr("y", function(d) {
						return i*cell_height+i*cell_height-83.46;
					})
					.attr("x", function(d) {
						return (0-32)*cell_width;
					});

				for (var r = 0; r < code.length; r++) {
					var cell_id = "i"+i+"l"+l+"r"+r;
					var each_code = g.append("g")
										.attr("class", cell_id)
										.on("mouseover", cell_animation);
					if(i==gp_genetic_code_no-1 && l==0)
					{
						each_code.attr("id", "current_genetic_codon_table");
					}
					each_code.append("rect")
								.style({
									"fill": "steelblue",
								})
								.style("stroke", function(d){
									if(i==gp_genetic_code_no-1 && l==0)
									{
										return "red";			
									}
									else
									{
										return "white";
									}
								})								
								.style("stroke-width", function(d){
									if(i==gp_genetic_code_no-1 && l==0)
									{
										return "1";			
									}
									else
									{
										return "0.5";
									}
								})								
								.attr("class", function(d){
									var table_name = ncbi_genetic_code_a_talbe.replace(/_a\.txt/g, "");
									return table_name;
								})
								.attr("id", function(d){
									return amino_acids[aa[r]]["full"];
								})
								.attr("y", function(d) {
									return i*cell_height+i*cell_height-81.46;
								})
								.attr("x", function(d) {
									return (r-32)*cell_width;
								})
								.attr("ry", function(d){return cell_width/5;})
								.attr("rx", function(d){return cell_width/5;})
								.attr("width", cell_width)
								.attr("height", cell_height)
								.attr("opacity", "0.5");
								
					each_code.append("text")
								.style("text-anchor", "middle")
								.attr("y", function(d) {
									return i*cell_height+i*cell_height+cell_height*0.7-81.46;
								})
								.attr("x", function(d) {
									return (r-32)*cell_width+cell_width*0.5;
								})
								.style("font-size", function(d){return 10*cell_height/16.18+"px";})
								.style("font-family", "Arial")
//								.attr("fill", "white")
								.text(code[r])
								.style("fill", function(d)
								{
									if(starts[r]=="M")
									{
										return  "yellow";
									}
									else
									{
										return "black";
									}
								})
								;
/*
*/
				}
			}
		}
		}
	});

	});
}
//fig_download("ncbi_genetic_code_a", 750, 0, "yes");
