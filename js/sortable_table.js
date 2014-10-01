
//d3.tsv("upload/"+gp_personID+"/"+gp_cat_file, function(d) {
d3.tsv("php/sortable_table.js.sql.php?usrID="+gp_personIDen, function(d) {
		
	var cat = d;
	function high_light(d) {
				d3.select("this")
					.transition()
					.duration(250)
					.attr("opacity", "0.5");
	}

	function tabulate(data, columns) {
		var table = d3.select("div.row div.record_list").append("table").attr("align", "center"),
			thead = table.append("thead").attr("class", "header"),
			tbody = table.append("tbody").attr("class", "table_content");

		// append the header row
		thead.append("tr")
				.selectAll("th")
				.data(columns)
				.enter()
				.append("th")
					.attr("class", function(column) { return column+"\t"; })
					.attr("align", function(d, i){
						if(i==0)
						{
							return "left";
						}
						else
						{
							return "right";
						}
					})
					.attr("title", function(d, i){
						if(i==3)
						{
							return "This will change according to figures in the tag which you select.";
						}
						else
						{
							return "";
						}
					})
					.style("font-weight", "normal")
//					.style("min-width", function(column) {
//						var cell_string_length = String(column).length;
//						return 0.1*cell_string_length+"px";
//					})
					.style("cursor", "pointer")
					.attr("title", "Click to sort.")
					.text(function(column) {
						if(column=="GC")
						{
							var content = column+" (%)";
							return content;
						}
						if(column=="Length")
						{
							var content = column+" (bp)";
							return content;
						}
						else
						{
							return column;
						}
					
					})
					.on('click', function(column) {
							if(d3.selectAll("div.row div.record_list").attr("id")!="A")
							{
								if(column=="GC")
								{
									d3.selectAll("div.row div.record_list table tbody tr")
											.sort(function(a, b) {
												return d3.descending(+b.GC, +a.GC);
									});
									d3.selectAll("div.row div.record_list").attr("id", "A");
								}				
								if(column=="Length")
								{
									d3.selectAll("div.row div.record_list table tbody tr")
											.sort(function(a, b) {
												return d3.descending(+b.Length, +a.Length);
									});
									d3.selectAll("div.row div.record_list").attr("id", "A");
								}				
								if(column=="ID")
								{
									d3.selectAll("div.row div.record_list table tbody tr")
											.sort(function(a, b) {
												return d3.descending(b.ID, a.ID);
									});
									d3.selectAll("div.row div.record_list").attr("id", "A");
								}				
							}
							else
							{
								if(column=="GC")
								{
									d3.selectAll("div.row div.record_list table tbody tr")
											.sort(function(a, b) {
												return d3.ascending(+b.GC, +a.GC);
									});
									d3.selectAll("div.row div.record_list").attr("id", "D");
								}				
								if(column=="Length")
								{
									d3.selectAll("div.row div.record_list table tbody tr")
											.sort(function(a, b) {
												return d3.ascending(+b.Length, +a.Length);
									});
									d3.selectAll("div.row div.record_list").attr("id", "D");
								}				
								if(column=="ID")
								{
									d3.selectAll("div.row div.record_list table tbody tr")
											.sort(function(a, b) {
												return d3.ascending(b.ID, a.ID);
									});
									d3.selectAll("div.row div.record_list").attr("id", "D");
							}				
						}
						current_file = gp_files[gp_rec_no];
						sorted_gp_files = [];
						gp_files = [];
						d3.selectAll("div.row div.record_list table tbody tr")[0].forEach(function(d){
							gp_files.push(d3.select(d).attr("class"));
						});
						sorted_gp_files = gp_files;
						gp_files.forEach(function(d, i){
							if(d==current_file){
								gp_rec_no = i;
							}
						});
					})
	//				.on("mouseover", high_light)
					;
		// create a row for each object in the data
		var rows = tbody.selectAll("tr")
			.data(data)
			.enter()
			.append("tr")
			.attr("class", function(d, i) {
				return d.ID;
			})
			.style("font-weight", "normal")
			.style("color", function(d, i) {
				if(d.ID==gp_files[gp_rec_no])
				{
					return "red";
				}
				else
				{
					return "gray";
				}
			})
			.style("cursor", "pointer")
			.on('click', function() {
				var selected_file = d3.select(this).attr("class");
				//console.log(selected_file);
				gp_files.forEach(function(b3, b3_no) {
					if(b3==selected_file)
					{
						gp_rec_no = b3_no;
					}
				
				});
				renew_all(selected_file);
			})
			.on('mouseover', function(){
				d3.select(this).style("background", "#EAEAEA");
			})
			.on('mouseout', function(){
				d3.select(this).style("background", "");
			})
			;

		// create a cell in each row for each column
		var cells = rows.selectAll("td")
			.data(function(row) {
				return columns.map(function(column) {
					return {column: column, value: row[column]};
				});
			})
			.enter()
			.append("td")
			.attr({"class":function(d, i){
					if(i==0) return "ID" ;
					if(i==1) return "Length" ;
					if(i==2) return "GC" ;
					if(i==3) return "compare" ;
			}})
			.attr("align", function(d, i){
				if(i==0)
				{
					return "left";
				}
				if(i==3)
				{
					return "middle";
				}
				else
				{
					return "right";
				}
			})
			.style("min-width", function(d, i) {
				var cell_string_length = String(d.value).length;
				if(i==3){
					return 7*cell_string_length+"px";
				}
				else{
					return 10*cell_string_length+"px";
				}
			})
			.text(function(d, i) { 
				if(i==2)
				{
					return Math.round(d.value*10000)/100;
				}
				else
				{
					return d.value;
				}
			});
		rows.selectAll("td.compare")
				.append("input").attr({
				"type":"checkbox",
				"id"  :function(){
					
					return d3.select(this.parentNode.parentNode).attr("class");
				},
				"class":"regular-checkbox",
//				"onClick": "change(this)",
				"check": true,
				
			});
		return table;
	}

	// create some people
	// render the table
	//var CAT_Table = tabulate(people, ["name", "age", "height"]);
	var CAT_Table = tabulate(cat, ["ID", "Length", "GC", "CHECK"]);
	
/*
	CAT_Table.selectAll("tbody tr")
		.sort(function(a, b) {
			return d3.descending(+a.Length, b.Length);
	});
*/		
});

