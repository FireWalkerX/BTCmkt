$ ->
	$('#login').click(
		->
			$('.login-form').slideDown("slow")
	)

	$(document).click(
		(e) ->
			if (e.target.id != 'login')
				$('.login-form').slideUp("slow")
	)