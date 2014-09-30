function form_sub()
{
	d3.select("div.err").text("");
	if(!document.login.file.value)
	{
//		alert("Upload a fasta file at least.");
		d3.select("div.err").text("Upload a FASTA file at least. ")
		.append("a")
		.attr("class", "example_fasta_file")
//		.attr("href", "http://apple.com")
		.style({
			"cursor": "pointer",
			"color": "white",
			"font-family": "Helvetica Neue UltraLight",
		})
		.text("Example.")
		.on("click", function(){
			$.fileDownload("test_data/example.fasta.zip")
				.done(function () {})
				.fail(function () {});
		});

		return false; 
	}
	else if(!document.login.email.value)
	{
//		d3.select("div.err").text("Using without email?");
		alert("Using without Email? You are using anonymous account with an unique ID. Tell NO one your ID to secure your data's safety. We will keep your data for ONE day.");
		return true; 
	}
	else if(!test_email(document.login.email.value))
	{
		d3.select("div.err").text("Your email is not valid!");
		return false; 
	}
	else if(!document.login.loginPass.value)
	{
		d3.select("div.err").text("Please enter your password.");
		return false; 
	}
	else
	{
		return true;
	}
}
function form_sub_batch()
{
	d3.select("div.batch_err").text("");
	if(!document.batch.batchFile.value)
	{
		d3.select("div.batch_err").text("Upload a file of batch IDs, please.");
		return false; 
	}
	else
	{
		d3.select("div.batch_err").text("Service will available soon.");
		return false; 
	}
}
function test_email(str_email){
	var pattern = /^[a-zA-Z0-9_.]+@([a-zA-Z0-9_]+.)+[a-zA-Z]{2,3}$/;
	if(pattern.test(str_email))
	return true;
	else
	return false;
}

function test_password(str_p1, str_p2){
	if(str_p1==str_p2)
	return true;
	else
	return false;
}
/*


			else if(document.login.loginPass.value!=data)
			{
				alert("Wrong Password!");
				return false; 
			}
			else if(document.login.loginPass.value==data && document.login.loginPass.value!="")
			{
				pass = 0;
				alert("correct password!");
				return true;
			}

	else if($.get("php/check_usr.php", {email: document.login.email.value, password: document.login.loginPass.value}))
	{
		d3.select("div.err").text("aa");
		return false;
	}


*/