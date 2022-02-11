/* const viewTicket = document.querySelector('.open_send_ticket_modal');
viewTicket.addEventListener('click', e => {
  e.preventDefault();

	const curTrgt = e.target;
  const uid = curTrgt.dataset.id;

  document.querySelector("#get_ticket_modal #dynamic-content").innerHTML = '';
  document.querySelector("#get_ticket_modal #modal-loader").style.display = "block";

            fetch('/resources/jquery/addons/ajax/blade/admin/init.ticket.php', {
                method: 'post',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: JSON.stringify({
                    id: uid
                })
            })
            .then(r => r.text())
            .then(data => {
                //console.log(data);
                document.querySelector("#get_ticket_modal #dynamic-content").innerHTML = '';
                document.querySelector("#get_ticket_modal #dynamic-content").innerHTML = data;
                document.querySelector("#get_ticket_modal #modal-loader").style.display = "none";
            })
            .catch(err => {
                document.querySelector("#get_ticket_modal #dynamic-content").innerHTML =
                    '<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...';
                document.querySelector("#get_ticket_modal #modal-loader").style.display = "none";
            })

}); */
$(document).ready(function(){
		$(document).on('click', '.open_send_ticket_modal', function (e) {
		e.preventDefault();

		var uid = $(this).data("id");

        $("#get_ticket_modal #dynamic-content").html("");
        $("#get_ticket_modal #modal-loader").show();

		$.ajax({
			type: "POST",
			url: "/resources/jquery/addons/ajax/blade/admin/init.ticket.php",
			data: "id="+uid,
			dataType: "html"
		})
		.done(function (data) {
			$('#get_ticket_modal #dynamic-content').html('');
            $('#get_ticket_modal #dynamic-content').hide().html(data).fadeIn("slow");
            $('#get_ticket_modal #modal-loader').hide("slow");
		})
		.fail(function () {
			$("#get_ticket_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
            $("#get_ticket_modal #modal-loader").hide();
		});
	});
		$(document).on('click','.open_settings_modal',function(e){
			e.preventDefault();
			var uid = $(this).data('id');

			$('#settings_modal #dynamic-content').html('');
			$('#settings_modal #modal-loader').show();

			$.ajax({
				url: "../../../../assets/includes/Addons/jQuery/AJAX/CP/ServerManagement/update_config.php",
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				$('#settings_modal #dynamic-content').html('');
				$('#settings_modal #dynamic-content').html(data);
				$('#settings_modal #modal-loader').hide();
			})
			.fail(function(){
				$('#settings_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
				$('#settings_modal #modal-loader').hide();
			});
		});
	});
	// search
	function fetchSearchData(charName) {
			fetch('/resources/themes/ap/js/fetch/sExtended/searchCharNames.php', {
				method: 'post',
        body: new URLSearchParams('charName=' + charName)
      })
      .then(r => r.json())
      .then(data => {
        viewSearchResult(data);
      })
      .catch(err => {
				console.log(err);
      })
	}
	function viewSearchResult(data) {
			const dataViewer = document.getElementById("dataViewer");
			const searchChar = document.getElementById('searchChar');

			dataViewer.innerHTML = '';

			if (searchChar.value == '') {
				dataViewer.style.display = 'none';
			} else {
				dataViewer.style.display = 'block';
			}

			if (data == null || data == '') {
				dataViewer.style.display = 'none';
			}

			for (let i = 0; i < data.length; i++) {
				const option = document.createElement('option');
				option.value = data[i]['CharName'];
				option.text = data[i]['CharName'];
				dataViewer.appendChild(option);
			}
	}
