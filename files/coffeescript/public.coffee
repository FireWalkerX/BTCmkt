$ ->
	$('#register input[type="button"]').click(
		->
			username	= $('#register input[name="user"]')
			email		= $('#register input[name="email"]')
			password	= $('#register input[name="pass"]')
			pass_conf	= $('#register input[name="pass_conf"]')
			pass		= true

			if ( ! /^([\w_-]{4,15})$/.test(username.val()))
				username.addClass('error')
				username.popover({
					'placement': 'right'
					'trigger': 'focus'
					'title': user_not_valid_title
					'content': user_not_valid
					'container': 'body'
				})
				pass = false

			if ( ! /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val()))
				email.addClass('error')
				email.popover({
					'placement': 'right'
					'trigger': 'focus'
					'title': email_not_valid_title
					'content': email_not_valid
					'container': 'body'
				})
				pass = false

			#TODO
	)

	$('#login input[type="button"]').click(
		->
			alert('login')
			#TODO
	)

	$('#register input[name="user"], #register input[name="email"], #register input[name="pass"],
		#register input[name="pass_conf"], #login input[name="user"], #login input[name="pass"]').focus(
		->
			$(this).removeClass('error')
	)

	$('#register input[name="user"], #register input[name="email"], #register input[name="pass"],
		#register input[name="pass_conf"], #login input[name="user"], #login input[name="pass"]').focusout(
		->
			$(this).popover('destroy')
	)
