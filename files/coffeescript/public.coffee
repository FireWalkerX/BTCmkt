$ ->
	$('#register input[type="button"]').click(
		->
			username	= $('#register input[name="user"]')
			email		= $('#register input[name="email"]')
			password	= $('#register input[name="pass"]')
			pass_conf	= $('#register input[name="pass_conf"]')
			test_pass = true

			if ( ! /^([\w_-]{4,15})$/.test(username.val()))
				username.addClass('error')
				username.popover({
					'placement': 'right'
					'trigger': 'focus'
					'title': user_not_valid_title
					'content': user_not_valid
					'container': 'body'
				})
				test_pass = false

			if ( ! /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val()))
				email.addClass('error')
				email.popover({
					'placement': 'right'
					'trigger': 'focus'
					'title': email_not_valid_title
					'content': email_not_valid
					'container': 'body'
				})
				test_pass = false

			if ( ! /^.*(?=.{8,25})(?=.*\d)(?=.*[a-zA-Z]).*$/.test(password.val()))
				password.addClass('error')
				password.popover({
					'placement': 'right'
					'trigger': 'focus'
					'title': pass_not_valid_title
					'content': pass_not_valid
					'container': 'body'
				})
				test_pass = false

			if (password.val() != pass_conf.val())
				pass_conf.addClass('error')
				test_pass = false

			if (test_pass)
				$.post(
					'login/register'
					{
						user: username.val()
						email: email.val()
						pass: password.val()
					}
					(data) ->
						$.each(
							data
							(key, value) ->
								if (key == 'user' && ! value)
									username.addClass('error')
									username.popover({
										'placement': 'right'
										'trigger': 'focus'
										'title': user_in_use_title
										'content': user_in_use
										'container': 'body'
									})
									test_pass = false;
								else if (key == 'email' && value != 0)
									email.addClass('error')
									email.popover({
										'placement': 'right'
										'trigger': 'focus'
										'title': if value == 1 then email_in_use_title else email_check_error_title
										'content': if value == 1 then email_in_use else email_check_error
										'container': 'body'
									})
									test_pass = false
						)
					'json'
				)

			#	if (test_pass)
			#		document.location.reload(true)
	)

	$('#login input[type="button"]').click(
		->
			username = $('#login input[name="user"]')
			password = $('#login input[name="pass"]')
			test_pass = true

			$.post(
				'login'
				{
					user: username.val()
					pass: password.val()
				}
				(data) ->
					$.each(
						data
						(key, value) ->
							if (key == 'user' && ! value)
								username.addClass('error')
								username.popover({
									'placement': 'right'
									'trigger': 'focus'
									'title': user_not_exist_title
									'content': user_not_exist
									'container': 'body'
								})
								test_pass = false;
							else if (key == 'pass' && ! value)
								password.addClass('error')
								password.popover({
									'placement': 'right'
									'trigger': 'focus'
									'title': incorrect_pass_title
									'content': incorrect_pass
									'container': 'body'
								})
								test_pass = false
					)
				'json'
			)

		#	if (test_pass)
		#		document.location.reload(true)
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
