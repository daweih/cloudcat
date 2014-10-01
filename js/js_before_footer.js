	d3.select("div.span4.bs-docs-sidebar").style("height", function(){
		add_length = d3.select("div.record_list").style("height");
		var reg  = /^\d+/;
		var output = reg.exec(add_length);
		var sidebar_height = +output[0];
		sidebar_height = sidebar_height+800;
		console.log(sidebar_height);
		return sidebar_height+"px";
	});
//$("#collapseOne").collapse();
function renew_all(selected_file)
{
		tag_name = d3.select("li#codon_table.active a").text();
//清除下载链接和下载状态
		d3.select("p#format").text("");
		d3.select("p#format a").text("");
		
		//all seq_id
		d3.selectAll('text.seq_id').transition().duration(250).text(selected_file);
		//p.pendulum_model svg g and the sortable_talbe renew
		pendulum_renew(selected_file);
		//svg.ncbi_genetic_code_b
		codon_table_renew(nt, selected_file);
		//save for ncbi_genetic_code_a renew
		//bar_chart
		bar_chart_renew(selected_file);
		check = document.getElementById(selected_file).checked;	
		if(check)
		{
			if(tag_name=="Pendulum model"){
				var svg_code = show_svg_code("pendulum_model");
				svg_code = svg_code.replace(/<g class=\"download[\s\S]+?class=\"svg[\s\S]+?<\/g\>/g, "");

				svg_code = svg_code.replace(/<text class=\"name[\s\S]+?class=\"down[\s\S]+?<g class=\"arc/g, /<g class=\"arc/);
				gp_compare_pendulum[selected_file] = svg_code;
			}
			else if(tag_name=="Partition"){
				var svg_code = show_svg_code("ncbi_genetic_code_b");
				svg_code = svg_code.replace(/<g class=\"download[\s\S]+?class=\"svg[\s\S]+?<\/g\>/g, "");

				svg_code = svg_code.replace(/<text class=\"name[\s\S]+?class=\"down[\s\S]+?<g class=\"table/g, /<g class=\"table/);
				gp_compare_ncbi_genetic_code_b[selected_file] = svg_code;
			}
		}
		else
		{
			if(tag_name=="Pendulum model"){
				gp_compare_pendulum[selected_file] = "";
			}
			else if(tag_name=="Partition"){
				gp_compare_ncbi_genetic_code_b[selected_file] = "";
			}
		}

		compare_selection_cnt = 0;
		gp_files.forEach(function(d, i){
			if(gp_compare_ncbi_genetic_code_b[d] || gp_compare_pendulum[d])
			{
						compare_selection_cnt += 1;
			}
		});
		if(compare_selection_cnt>1)
		{
			$('input#compare_selection').prop('disabled', false);
			d3.select('input#compare_selection').style("box-shadow", "0 0 6px black");
//			d3.select('input#compare_selection').style("-moz-animation", "pulse 2s infinite");
//			d3.select('input#compare_selection').style("-webkit-animation", "pulse 2s infinite");
		}else{
			$('input#compare_selection').prop('disabled', true);
			d3.select('input#compare_selection').style("box-shadow", "0 0 2px black");
//			d3.select('input#compare_selection').style("-moz-animation", "");
//			d3.select('input#compare_selection').style("-webkit-animation", "");
		}
		if(compare_selection_cnt>0)
		{
			$('input#delete_selection').prop('disabled', false);
			d3.select('input#delete_selection').style("box-shadow", "0 0 6px black");
//			d3.select('input#compare_selection').style("-moz-animation", "pulse 2s infinite");
//			d3.select('input#compare_selection').style("-webkit-animation", "pulse 2s infinite");
		}else{
			$('input#delete_selection').prop('disabled', true);
			d3.select('input#delete_selection').style("box-shadow", "0 0 2px black");
//			d3.select('input#compare_selection').style("-moz-animation", "");
//			d3.select('input#compare_selection').style("-webkit-animation", "");
		}
		

}

				$("#delete_selection").click(function(){
					var gp_fig_hash = {};
					gp_files.forEach(function(d, i) {
						if(gp_compare_pendulum[d])
						{
							gp_fig_hash[d] = "";
						}
						if(gp_compare_ncbi_genetic_code_b[d])
						{
							gp_fig_hash[d] = "";
						}
					});
					gp_fig_hash_keys = Object.keys(gp_fig_hash);
					var rec2del;
					gp_fig_hash_keys.forEach(function(del_id){rec2del = rec2del ? rec2del+del_id+"," : del_id+",";});
					console.log(rec2del,gp_personID);
					$("text.del_then_refresh")
					.load(
						"php/del.mysql.php",{ 
							rec2del: rec2del,
							gp_personID: gp_personID,
						}
					).done(function() {
						document.location.reload();
					});
					setTimeout(function(){
						//document.location.reload();
					},2000);
				});


d3.select(".up_and_down").on("click", function(){
	d3.selectAll("g.up circle").transition().duration(500).attr("r", "0").transition().duration(50).attr("r", "40").transition().duration(250).attr("r", "10");
	d3.selectAll("g.down circle").transition().duration(500).attr("r", "0").transition().duration(50).attr("r", "40").transition().duration(250).attr("r", "10");
});
d3.select(".other_information_aa").on("click", function(){
	d3.selectAll("g.arc path#aa").transition().duration(200).attr("opacity", "0.2").transition().duration(200).attr("opacity", "1");
	d3.selectAll("g.codon rect").transition().duration(200).attr("opacity", "0.2").transition().duration(200).attr("opacity", "1");
});
d3.select(".other_information_c").on("click", function(){
	d3.selectAll("g.arc path#codon").transition().duration(200).attr("opacity", "0.2").transition().duration(200).attr("opacity", "1");
	d3.selectAll("g.codon rect").transition().duration(200).attr("opacity", "0.2").transition().duration(200).attr("opacity", "1");
});


d3.select("#tabs.codon_table").style({
	"position": "fixed"
});

d3.select("input#codon_table_size").on("change", codon_table_size);
function codon_table_size(){var content = this.value;
	d3.select("div#myTabContent").style({"zoom": function(){return content/100;}});
	d3.select("div#myTabContent").style({"-moz-transform": function(){return content>=100 ? "scale(1)" : "scale("+content/100+")";}});
}

//http://d3export.cancan.cshl.edu/
function show_svg_code(select_class)
{
	// Get the d3js SVG element
	var tmp  = document.getElementById(select_class);
	var svg = tmp.getElementsByTagName("svg")[0];

	// Extract the data as SVG text string
	var svg_xml = (new XMLSerializer).serializeToString(svg);
//	console.log(svg_xml);
	return svg_xml;
}

