var gp_rec_no = 0;
var gp_files_length = gp_files.length - 1;
var file = gp_files[gp_rec_no];

var width = 600,
	height = 600,
	radius = Math.min(width, height) / 2;
var pie = d3.layout.pie()
	.sort(null)
	.value(function(d) { return d.size; });
var max_color = ['rgb(240, 182, 182)', 'rgb(200, 220, 140)', 'rgb(116, 176, 177)', 'steelblue'];

//update info and change color
function aa_info_p(d) {
	if(d.data.type=="AA"||d.data.type=="Base"){
		//information collapsed indicator
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
		
		var current_name = d.data.name.split("/");
		var type = d.data.type;
		d3.text("genetic_code/"+ncbi_genetic_code_a_talbes[gp_genetic_code_no-1], function(d) {
		var codon2aa = {};
		var genetic_code_line4 = d;		
		var lines = genetic_code_line4.split("\n");
		var aa_line = lines[0].replace(/\s+/g, "").split("=");
		var aa = aa_line[1].split("");
		var base1_line = lines[2].replace(/\s+/g, "").split("=");var base1 = base1_line[1].split("");
		var base2_line = lines[3].replace(/\s+/g, "").split("=");var base2 = base2_line[1].split("");
		var base3_line = lines[4].replace(/\s+/g, "").split("=");var base3 = base3_line[1].split("");
		for(var a = 0; a<aa.length; a++){codon2aa[base1[a]+base2[a]+base3[a]] = aa[a];}
//###################################
		d3.selectAll("div.aa_infor text, div.aa_infor img, div.aa_infor br, div.aa_infor a, div.rscu text,  div.rscu br").remove();
		d3.selectAll("div.rscu text, div.rscu div, div.rscu br, div.rscu a").remove();
		current_name.forEach(function(cell_class){
		if(type=="Base")
		{
			cell_class = codon2aa[cell_class];
		}
			
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
		});
		});

	}
	else
	{
//###################################
		d3.selectAll("div.aa_infor text, div.aa_infor img, div.aa_infor br, div.aa_infor a").remove();
		d3.selectAll("div.rscu text, div.rscu div, div.rscu br, div.rscu a").remove();
		d3.select("div.aa_infor").append("text").style("color", "red").text("Please select Amino Acids.");
		d3.select("div.rscu").append("text").style("color", "red").text("Please select Amino Acids.");
	}
}
function mouse_info(d, i) {
	current_color = d3.select(this).style("fill");
	this_usage = 	d3.select(this).attr("usage");

	var a_id_reg  = /^a\d+/;
	var a_id = a_id_reg.exec(d3.select(this).attr("class"));
//	if(a_id!="a3"){
	d3.select(this)
		.attr("opacity", "0.2");
	
//	}
	d3.select('g.status text.type').text("Type: "+d.data.type);
	d3.select('g.status text.name').text(function(){
		if(d.data.type=="AA")
		{
			var aa_infor = [];
			var current_name = d.data.name.split("/");
			current_name.forEach(function(each_name){
				aa_infor.push(amino_acids[each_name].full);
			});
		
			return "Name: "+aa_infor;
		}
		if(d.data.type=="Base1"||d.data.type=="Base2")
		{
			return "Name: "+nucleic_acids[d.data.name];
		}
		if(d.data.type=="Base3")
		{
			return "Name: "+nucleobase[d.data.name];
		}
		else
		{
			return "Name: "+d.data.name;
		}
	});
	if(d.data.type != "Base1" && d.data.type != "Base2" && d.data.type != "Base3")
	{
		d3.select('g.status text.sta').text("Usage: "+Math.round(this_usage*100000)/1000+"%");
	}
	else
	{
		d3.select('g.status text.sta').text("Usage: NA");	
	}
}
//change the color back when mouse moves out.
function mouse_info_reset(d, i) {
	d3.select(this)
		.transition()
		.duration(250)
		.attr("opacity", "1");
}
//add the main fig frame.
var svg = d3.select("div.pendulum_model").append("svg")
			.attr("class", "pendulum_model")
			.attr("width", width).attr("height", height).append("g").attr("transform", "translate(" + width / 2 + "," + height / 2 + ")").attr("class", "transform");
	svg.append("g").attr("class", "status");
	svg.select(".status").append("text")
		.attr({
			"class": "seq_id",
			"dx": "0em",
			"dy": "-1em"			
		})//显示序列ID
		.style({
			"text-anchor": "middle",
			"font-size": "15px"
		}).text(gp_files[gp_rec_no]);
	svg.select(".status").append("text")
		.attr({
			"class": "name",
			"dx": "0em",
			"dy": "1em"			
		})//mouse on name
		.style({
			"text-anchor": "middle",
				"font-size": "11px"
		}).text("Name");
	svg.select(".status").append("text")
		.attr({
			"class": "type",
			"dx": "0em",
			"dy": "0em"			
		})//mouse on name
		.style({
			"text-anchor": "middle",
			"font-size": "11px"
		}).text("Type");
	svg.select(".status").append("text")
		.attr({
			"class": "sta",
			"dx": "0em",
			"dy": "2em"			
		})//显示所选位置的统计信息
		.style({
			"text-anchor": "middle",
			"font-size": "11px"
		}).text("Infor.");
//the buttons
	//up
	svg.select(".status").append("g")
		.attr({
			"class": "up",
			"opacity": "0.5"
		})
		.style("cursor", "pointer")
		.on("mouseover", function(d) {
			d3.select('div.pendulum_model svg g g.status .up')
				.transition()
				.duration(10)
				.attr("opacity", "1");
		})
		.on("mouseout", function(d) {
			d3.select('div.pendulum_model svg g g.status .up')
				.transition()
				.duration(250)
				.attr("opacity", "0.5");
		});
	svg.select(".up")
	.append("circle")
		.attr({
			"cy": "-40",
			"cx": "0",
			"r": "10",
			"fill": "white",
			"stroke": "black",
			"stroke-width": "0.8",
		})
	svg.select(".up")
		.append('polygon')
		.attr({
			"points": "-3.4641016151,-38 3.4641016151,-38 0,-44",
//			"fill": "white",
			"stroke": "black",
			"stroke-width": "0.8",
		});
	//down
	svg.select(".status").append("g")
		.attr({
			"class": "down",
			"opacity": "0.5"
		})
		.style("cursor", "pointer")
		.on("mouseover", function(d) {
			d3.select('div.pendulum_model svg g g.status .down')
				.transition()
				.duration(10)
				.attr("opacity", "1");
		})
		.on("mouseout", function(d) {
			d3.select('div.pendulum_model svg g g.status .down')
				.transition()
				.duration(250)
				.attr("opacity", "0.5");
		});
	svg.select(".down")
	.append("circle")
		.attr({
			"cy": "40",
			"cx": "0",
			"r": "10",
			"fill": "white",
			"stroke": "black",
			"stroke-width": "0.8"
		})
	svg.select(".down")
		.append('polygon')
		.attr({
			"points": "-3.4641016151,38 3.4641016151,38 0,44",
			"stroke": "black",
			"stroke-width": "0.8"
		});


		
//the action of up button=============================================================================================================================================================================
d3.select('div.pendulum_model svg g g.status .up').on('click', function() {
	if(gp_rec_no > 0)
	{
		gp_rec_no -= 1;
		var selected_file = gp_files[gp_rec_no];
		renew_all(selected_file);
	}
});
//the action of down button===============================================================================================================================================================================
d3.select('div.pendulum_model svg g g.status .down').on('click', function(d) {
	if(gp_rec_no < gp_files_length)
	{
		gp_rec_no += 1;
		var selected_file = gp_files[gp_rec_no];
		renew_all(selected_file);
	}
});



function pendulum_renew(selected_file) {
//		var selected_file = gp_files[gp_rec_no];
		figure(selected_file);
		var plot_id = 'circle.'+selected_file;
		d3.selectAll('div.plot svg g circle').attr('r','3').attr('opacity','1').style('fill','steelblue');
		var color = d3.select(plot_id).attr('r','6').attr('opacity','0.5').style('fill','red');

		if(gp_compare_pendulum[selected_file])
		{
//			console.log("ForCompare.");
			d3.select('div.pendulum_model svg g.download g.compare').attr({"id": "on",});
			d3.select('div.pendulum_model svg g.download').selectAll("path#yang").style({"opacity": 1,"fill": "black"});
			d3.select('div.pendulum_model svg g.download').selectAll("path#yin").style({"opacity": 1,"fill": "white"});
		}
		else
		{
//			console.log("NotInCompare.");
			d3.select('div.pendulum_model svg g.download g.compare').attr({"id": "off",});
			d3.select('div.pendulum_model svg g.download').selectAll("path#yang").style({"opacity": 0.5,"fill": "white",});
			d3.select('div.pendulum_model svg g.download').selectAll("path#yin").style({"opacity": 0.5,"fill": "gray"});
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
}

//draw the original figure
figure_new(file);
function figure_new(d) {
	d3.json("php/pendulum_model.js.mysql.php?ID="+d+"&usrID="+gp_personIDen, function(json){
console.log(json,gp_personIDen, d);
//	d3.json("upload/"+gp_personID+"/"+d, function(json) {
		for (var i = 0; i < json.length; i++) {
			var data = json[i].children;
			var usage_all = [];
			var size_all = 0;
			for (var j = 0; j < data.length; j++) {
				usage_all.push(data[j].usage);
				//这里重要的转化数据的方法
				data[j].size = +data[j].size;
				size_all = size_all + data[j].size;
			}
			var arc = d3.svg.arc()
						.outerRadius(function(d) { return radius - 200 + i*30; } )
						.innerRadius(radius - 230 + i*30);
//绘制最外圈柱状图形的方法
			var arc_bar = d3.svg.arc()
						.outerRadius(function(d) { return radius - 230 + i*30 + d.data.usage/Math.max.apply(Math, usage_all)* 100; } )
						.innerRadius(radius - 230 + i*30);
//主对象-----------------------------------------------------
			d3.select("div.pendulum_model svg").attr({"id":d});
			var svg = d3.select("div.pendulum_model svg g");
			var g = svg.selectAll("svg")
//主对象-----------------------------------------------------
					.data(pie(data)).enter().append("g").attr("class", "arc");
//注意渐变颜色的绘制方法
			var color = d3.scale.linear()
							.domain([0, Math.max.apply(Math, usage_all)])
							.range(["white", max_color[i]])
							.interpolate(d3.interpolateLab);
//添加扇形
			if(i>3)
			{
				g.append("path")
					.attr("d", arc_bar)
//					.attr("class", function(d){return d.data.type+"-"+d.data.name+"-"+d.data.size;})
					.attr('class', function(d, x){ return "a"+i+"b"+x})
					.attr('id', "codon")
					.attr("sector_name", function(d) { return d.data.name; })
					.attr("usage", function(d) { return d.data.usage; })
					.style({
						"fill": "darkgray",
						"stroke-width": "0.5"
					})
					.on("mouseover", mouse_info)
					.on("mouseout", mouse_info_reset)
					.on("click", aa_info_p)
					;
			}
			else
			{
				g.append("path")
					.attr("d", arc)
					.attr('class', function(d, x){ return "a"+i+"b"+x})
					.attr('id', function(){
						if(i==3){return "aa";}
						else{no = i+1;return "base"+no;}
					})
					.attr("usage", function(d) { return d.data.usage; })
					.attr("sector_name", function(d) { return d.data.name; })
					.style({
						"fill": function(d) { 
									if(i==3){
									return color(d.data.usage);
									}
									else{
										return max_color[i];
									} 
								},
						"stroke-width": "0.5"
					})
//					.attr("opacity", "0.6")
					.on("mouseover", mouse_info)
					.on("mouseout", mouse_info_reset)
					.on("click", aa_info_p)
					;
			}
			g.selectAll("path").style("stroke", "white");
//添加文字
//注意旋转的使用方法
			var size_c = 0;
			g.append("text")
				.attr('class', function(d, x){ return "a"+i+"b"+x})
				.attr("usage", function(d) { return d.data.usage; })
				.attr("transform", function(d) {
					var size_current = size_c + d.data.size/2;
					var rotate = (360*(size_current)/size_all-90);
					if(size_current>size_all/2)
					{
						rotate = rotate + 180;
					}
					size_c = size_c + d.data.size;
					return "translate(" + arc.centroid(d) + ")rotate(" + rotate  + ")";
				 })
				.attr("dy", ".35em")
				.attr("opacity", "0.6")
				.style("text-anchor", "middle")
				.style("font-family", "Helvetica Neue")
				.style("font-size", function(d){
					if(i>3)
					{
						return 64/data.length*10 + "px";
					}
					else
					{
						return 10 + "px";
					}
				})
//				.attr("class", "Base")
				.attr("text_box_name", function(d) { return d.data.name; })
				.text(function(d) { return d.data.name; })
					.on("click", aa_info_p)
					.on("mouseover", mouse_info)
					.on("mouseout", mouse_info_reset)
				;
		}
	});
}
//renew figure
function figure(d){
	d3.select("div.pendulum_model svg").attr({"id":d});
	d3.select('g.status text.seq_id').text(d);
	d3.json("php/pendulum_model.js.mysql.php?ID="+d+"&usrID="+gp_personIDen, function(json){
	//d3.json("upload/"+gp_personID+"/"+d, function(json) {
		for (var i = 3; i < json.length; i++) {
			var data = json[i].children;
			var usage_all = [];
			var size_all = 0;
			for (var j = 0; j < data.length; j++) {
				usage_all.push(data[j].usage);
				//这里重要的转化数据的方法
				data[j].size = +data[j].size;
				size_all = size_all + data[j].size;
			}
//how to scale color
			var color = d3.scale.linear()
							.domain([0, Math.max.apply(Math, usage_all)])
							.range(["white", max_color[i]])
							.interpolate(d3.interpolateLab);
			var arc = d3.svg.arc()
						.outerRadius(function(d) { return radius - 200 + i*30; } )
						.innerRadius(radius - 230 + i*30);
			var arc_bar = d3.svg.arc()
						.outerRadius(function(d) { return radius - 230 + i*30 + d.data.usage/Math.max.apply(Math, usage_all)* 100; } )
						.innerRadius(radius - 230 + i*30);
			for (var j = 0; j < data.length; j++) {
				var id = ".arc path.a"+i+"b"+j;
				var text_id = ".arc text.a"+i+"b"+j;
//path are using the function pie!
				var pie_data = pie(data);
				if(i>3)
				{
					var fill = d3.select(id).style('fill', 'darkgray');
					var d_renew = d3.select(id).transition().duration(250).attr("d", arc_bar(pie_data[j]));
					var value_renew = d3.select(id).attr('usage', function(){return data[j].usage;});
					d3.select(text_id).attr('usage', function(){return data[j].usage;});
				}
				if(i==3)
				{
					var fill_renew = d3.select(id).transition().duration(250).style('fill', color(data[j].usage));
					var value_renew = d3.select(id).attr('usage', function(){return data[j].usage;});
					d3.select(text_id).attr('usage', function(){return data[j].usage;});
				}
				if(i==0||i==1||i==2)
                                {
                                        var fill_renew = d3.select(id).transition().duration(250).style('fill', max_color[i]);
                                        var value_renew = d3.select(id).attr('usage', function(){return data[j].usage;});
                                        d3.select(text_id).attr('usage', function(){return data[j].usage;});
                                }

			}
		}
	});
}
fig_download("pendulum_model", width, 0, "yes");
