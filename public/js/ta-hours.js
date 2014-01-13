$(function(){
	$('.accordion').accordion({header: "h3",heightStyle: "auto"});

	$('.additional').keyup(function(){
		id = this.id.split('-');
		additional = $(this).val();
		original = parseFloat($("#week-"+id[1]+"-hours-original").text(),10);

		if ( additional.length !== 0 ){
			additional = parseFloat(additional, 10);
			if (! isNaN(additional) ){
				$("#week-"+id[1]+"-hours").text(original + additional);
				$("#week-"+id[1]+"-hours-total").val(original + additional);
			}
		}
		else $("#week-"+id[1]+"-hours").text(original);
	});
});