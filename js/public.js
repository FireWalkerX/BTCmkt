(function(){$(function(){$('#register input[type="button"]').click(function(){var c,b,a,e,d;d=$('#register input[name="user"]');c=$('#register input[name="email"]');a=$('#register input[name="pass"]');b=$('#register input[name="pass_conf"]');e=!0;/^([\w_-]{4,15})$/.test(d.val())||(d.addClass("error"),d.popover({placement:"right",trigger:"focus",title:user_not_valid_title,content:user_not_valid,container:"body"}),e=!1);/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(c.val())||
(c.addClass("error"),c.popover({placement:"right",trigger:"focus",title:email_not_valid_title,content:email_not_valid,container:"body"}),e=!1);/^.*(?=.{8,25})(?=.*\d)(?=.*[a-zA-Z]).*$/.test(a.val())||(a.addClass("error"),a.popover({placement:"right",trigger:"focus",title:pass_not_valid_title,content:pass_not_valid,container:"body"}),e=!1);a.val()!==b.val()&&(b.addClass("error"),e=!1);if(e)return $.post("login/register",{user:d.val(),email:c.val(),pass:a.val()},function(b){return $.each(b,function(b,
a){if("user"===b&&!a)return d.addClass("error"),d.popover({placement:"right",trigger:"focus",title:user_in_use_title,content:user_in_use,container:"body"}),e=!1;if("email"===b&&0!==a)return c.addClass("error"),c.popover({placement:"right",trigger:"focus",title:1===a?email_in_use_title:email_check_error_title,content:1===a?email_in_use:email_check_error,container:"body"}),e=!1})},"json")});$('#login input[type="button"]').click(function(){var c,b;b=$('#login input[name="user"]');c=$('#login input[name="pass"]');
return $.post("login",{user:b.val(),pass:c.val()},function(a){return $.each(a,function(a,d){if("user"===a&&!d)return b.addClass("error"),b.popover({placement:"right",trigger:"focus",title:user_not_exist_title,content:user_not_exist,container:"body"}),!1;if("pass"===a&&!d)return c.addClass("error"),c.popover({placement:"right",trigger:"focus",title:incorrect_pass_title,content:incorrect_pass,container:"body"}),!1})},"json")});$('#register input[name="user"], #register input[name="email"], #register input[name="pass"],\t\t#register input[name="pass_conf"], #login input[name="user"], #login input[name="pass"]').focus(function(){return $(this).removeClass("error")});
return $('#register input[name="user"], #register input[name="email"], #register input[name="pass"],\t\t#register input[name="pass_conf"], #login input[name="user"], #login input[name="pass"]').focusout(function(){return $(this).popover("destroy")})})}).call(this);
