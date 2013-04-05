$ ->
	$('#register input[type="button"]').click(
		->
			username	= $('#register input[name="user"]')
			email		= $('#register input[name="email"]')
			password	= $('#register input[name="pass"]')
			pass_conf	= $('#register input[name="pass_conf"]')
			pass		= true

		#	if ( ! /^([\w_-]{4,15})$/.test(username.val()))
		#		username.addClass('error')
		#		#TODO add tooltip message
		#		username.tooltip('show')
		#		pass = false

		if ( ! /^([\w_-]{4,15})$/.test(username.val()))
			username.addClass('error')
			username.popover({
				'placement': 'right'
				'trigger': 'manual'
				'title': user_not_valid_title
				'content': user_not_valid
			})
			username.popover('show')
			pass = false

		#	password.popover({
		#		'placement': 'right'
		#		'trigger': 'manual'
		#		'title': user_not_valid_title
		#		'content': user_not_valid
		#	})
		#	password.popover('show')

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
			$(this).popover('hide')
	)