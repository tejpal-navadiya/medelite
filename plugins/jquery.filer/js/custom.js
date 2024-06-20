$(document).ready(function() {
	
	// enable fileuploader plugin
	$('#inputfile').fileuploader({
        addMore: true,
	    extensions: ['jpg', 'jpeg', 'png', 'gif'] // allowed extensions or types {Array}
    });
	
	
	$('#inputfile1').fileuploader({
        addMore: true,
    });
	
});

function check_source_change(str)
{
	if(str == "5")
	{
		document.getElementById("source_reference").style.display = "block";
	} else {
		document.getElementById("source_reference").style.display = "none";
	}
	if(str == "4")
	{
		document.getElementById("source_associate_reference").style.display = "block";
	} else {
		document.getElementById("source_associate_reference").style.display = "none";
	}
}
