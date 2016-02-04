$(function () {
    
	console.log($("#services option:selected").text());

	$('#service').change(function() {
        
        console.log(this.value);
    });

});
