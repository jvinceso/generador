$(function(){
	// $(".chzn-select").chosen();
	$(".chzn-select").chosen(); 
	$(".chzn-select-deselect").chosen({allow_single_deselect:true});	
	//Asignamos_Eventos

	$("#cboTablas").bind({
		change:function(){
			if( $("#log").hasClass('show') ){
				$("#log").removeClass('show');		
				$("#log").addClass('hidden');		
			}			
			console.log($(this).val());
			var idcbo = $(this).val();
		}
	});

	$("#btnGenerarClases").bind({
		click:function(){
			$("#log").removeClass('hidden');
			$("#log").html("<img src='loading.gif' >");
			if( $("#cboTablas").val()!= "" ){
			//Version para generar Multiples Clases
			$.ajax({
				url  : 'core.generator.php',
				type : 'post',
				data : { act:'g' , vidTab : $("#cboTablas").val() } ,
				success : function(data){
					$("#log").addClass('show');
					// $("#log").html(data);
					$("#log").html("la Clase Ha sido creada Satisfactoriamente");
					window.location.href='zip.php';
				},
				error:function(err){
					console.log(err);
				}
			});

			}
		}
	});

});

function muestraCamposTablas(idTab){	
	if( $("fieldset").hasClass('hidden') ){
		$("fieldset").removeClass('hidden');
		$("fieldset").addClass('show');		
	}

	$.ajax({
		url  : 'core.generator.php',
		type : 'POST',
		data : { act:'c', vidTab:idTab },
		success:function(data){
			$("#CamposTabla").html(data);
		}
	});

}
function recorreTablas(){
	var arrTablas = $("#cboTablas").val();
	$.each(arrTablas,function(index,val){
		console.log(index);
		console.log(val);
	})	
}
