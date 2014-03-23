var tab = 0;

function getIt(tour_number, group_number){
	$.ajax({
		url : URL_BOARD_RESULTS,
		data : {"tour_number":tour_number, "group_number":group_number}
	}).success(function(data){
		$("#confrontation-step_"+tour_number+"_"+group_number).html(data);
	});
}

function getItAll(tour_number){
	$.ajax({
		url : URL_BOARD_RESULTS_ALL,
		data : {"tour_number":tour_number}
	}).success(function(data){
		$("#all_"+tour_number).html(data);
	});
}

function getGroupNumber(stepId){
	return stepId.substr(stepId.lastIndexOf('_')+1);
}

$(document).ready( function () {
  /*document.getElementById('step_1_1').style.visibility='hidden';*/

	for(var i=1;i<=8;i++){
		$('#step_1_'+i).click ( function () {
			if (tab>0){
				$("#confrontation-step_1_"+getGroupNumber(this.id)).fadeOut("slow");
				tab=0;}
			else{
				$("#confrontation-step_1_"+getGroupNumber(this.id)).fadeIn("slow");
				getIt(1, getGroupNumber(this.id));
				tab=1;
			}
		});
	}
	
	for(var i=1;i<=4;i++){
		$('#step_2_'+i).click ( function () {
			if (tab>0){
				$("#confrontation-step_2_"+getGroupNumber(this.id)).fadeOut("slow");
				tab=0;}
			else{
				$("#confrontation-step_2_"+getGroupNumber(this.id)).fadeIn("slow");
				getIt(2, getGroupNumber(this.id));
				tab=1;
			}
		});
	}
	
	$('#step_3_1').click ( function () {	
		if (tab>0){
			$("#confrontation-step_3_1").fadeOut("slow");
			tab=0;}
		else{
			getIt(3, 1);
			$("#confrontation-step_3_1").fadeIn("slow");
			tab=1;
		}
	});
	$('#step_3_2').click ( function () {	
		if (tab>0){
			$("#confrontation-step_3_2").fadeOut("slow");
			tab=0;}
		else{
			getIt(3, 2);
			$("#confrontation-step_3_2").fadeIn("slow");
			tab=1;
		}
	});
	$('#step_4_1').click ( function () {	
		if (tab>0){
			$("#confrontation-step_4_1").fadeOut("slow");
			tab=0;}
		else{
			getIt(4, 1);
			$("#confrontation-step_4_1").fadeIn("slow");
			tab=1;
		}
	});

	$('#8final').click ( function () {	
		if (tab>0){
			$("#all_1").fadeOut("slow");
			tab=0;}
		else{
			getItAll(1);
			$("#all_1").fadeIn("slow");
			tab=1;
		}
	});
	
	$('#4final').click ( function () {	
		if (tab>0){
			$("#all_2").fadeOut("slow");
			tab=0;}
		else{
			getItAll(2);
			$("#all_2").fadeIn("slow");
			tab=1;
		}
	});
	
	$('#2final').click ( function () {	
		if (tab>0){
			$("#all_3").fadeOut("slow");
			tab=0;}
		else{
			getItAll(3);
			$("#all_3").fadeIn("slow");
			tab=1;
		}
	});
	
} ) ;