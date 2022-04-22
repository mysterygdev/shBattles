function ajaxPOST(target, formData, success, error) {
  	// Variable to hold request
	var request;

  // Abort any pending request
	if (request) {
		request.abort();
	}

  	// Fire off the request
	request = $.ajax({
		url: target,
      type: "POST",
      data: formData,
		success: function(message){
         success(message);
      },
		error: function(){
			alert(error);
      }
	});
}
