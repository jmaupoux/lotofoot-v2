var obj = 0;

$(document).ready( function () {
  $(".menu-navigation ul.submenu-2-championnat").hide();
  $(".menu-navigation ul.submenu-3-championsleague").hide();   
  $(".menu-navigation ul.submenu-4-coupedumonde").hide();  
  $(".menu-navigation ul.submenu-6-stats").hide();   

$(".menu-navigation li.menu-2-championnat").click( function () {
	if (obj>0){
		if (obj==1){
			$(".menu-navigation ul.submenu-2-championnat").fadeOut("fast");
			obj=9;}
		else if (obj==2){
			$(".menu-navigation ul.submenu-3-championsleague").fadeOut("fast");
			obj=0;}
		else if (obj==3){
			$(".menu-navigation ul.submenu-4-coupedumonde").fadeOut("fast");
			obj=0;}
		else {
			$(".menu-navigation ul.submenu-6-stats").fadeOut("fast");
			obj=0;}
	}
	if (obj<9){	
		$(".menu-navigation ul.submenu-2-championnat").fadeIn("fast");
		obj=1;}	
	else{
		obj=0;
	}
});



$(".menu-navigation li.menu-3-championsleague").click( function () {
	if (obj>0){
		if (obj==1){
			$(".menu-navigation ul.submenu-2-championnat").fadeOut("fast");
			obj=0;}
		else if (obj==2){
			$(".menu-navigation ul.submenu-3-championsleague").fadeOut("fast");
			obj=9;}
		else if (obj==3){
			$(".menu-navigation ul.submenu-4-coupedumonde").fadeOut("fast");
			obj=0;}
		else {
			$(".menu-navigation ul.submenu-6-stats").fadeOut("fast");
			obj=0;}
	}
	if (obj<9){	
		$(".menu-navigation ul.submenu-3-championsleague").fadeIn("fast");
		obj=2;}	
	else{
		obj=0;
	}
});


$(".menu-navigation li.menu-4-coupedumonde").click( function () {
	if (obj>0){
		if (obj==1){
			$(".menu-navigation ul.submenu-2-championnat").fadeOut("fast");
			obj=0;}
		else if (obj==2){
			$(".menu-navigation ul.submenu-3-championsleague").fadeOut("fast");
			obj=0;}
		else if (obj==3){
			$(".menu-navigation ul.submenu-4-coupedumonde").fadeOut("fast");
			obj=9;}
		else {
			$(".menu-navigation ul.submenu-6-stats").fadeOut("fast");
			obj=0;}
	}
	if (obj<9){	
		$(".menu-navigation ul.submenu-4-coupedumonde").fadeIn("fast");
		obj=3;}	
	else{
		obj=0;
	}
});

$(".menu-navigation li.menu-6-stats").click( function () {
	if (obj>0){
		if (obj==1){
			$(".menu-navigation ul.submenu-2-championnat").fadeOut("fast");
			obj=0;}
		else if (obj==2){
			$(".menu-navigation ul.submenu-3-championsleague").fadeOut("fast");
			obj=0;}
		else if (obj==3){
			$(".menu-navigation ul.submenu-4-coupedumonde").fadeOut("fast");
			obj=0;}
		else {
			$(".menu-navigation ul.submenu-6-stats").fadeOut("fast");
			obj=9;}
	}
	if (obj<9){	
		$(".menu-navigation ul.submenu-6-stats").fadeIn("fast");
		obj=4;}	
	else{
		obj=0;
	}
});

$(".bg-transparent2").click( function () {
	if (obj==1){
		$(".menu-navigation ul.submenu-2-championnat").fadeOut("slow");
		obj=0;}
	else if (obj==2){
		$(".menu-navigation ul.submenu-3-championsleague").fadeOut("slow");
		obj=0;}
	else if (obj==3){	
		$(".menu-navigation ul.submenu-4-coupedumonde").fadeOut("slow");
		obj=0;}
	else if (obj==4){	
		$(".menu-navigation ul.submenu-6-stats").fadeOut("slow");
		obj=0;}
	});	



} ) ;