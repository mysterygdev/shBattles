$(document).ready(function(e){
	$('#myModal').on('shown.bs.modal',function(){
		$('#myInput').trigger('focus')
	})
});