(function(){$(function(){$('#register input[type="button"]').click(function(){var c,e,a,b,d;d=$('#register input[name="user"]');c=$('#register input[name="email"]');a=$('#register input[name="pass"]');e=$('#register input[name="pass_conf"]');b=!0;/^([\w_-]{4,15})$/.test(d.val())||(d.addClass("error"),d.popover({placement:"right",trigger:"focus",title:user_not_valid_title,content:user_not_valid,container:"body"}),b=!1);/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(c.val())||
(c.addClass("error"),c.popover({placement:"right",trigger:"focus",title:email_not_valid_title,content:email_not_valid,container:"body"}),b=!1);/^.*(?=.{8,25})(?=.*\d)(?=.*[a-zA-Z]).*$/.test(a.val())||(a.addClass("error"),a.popover({placement:"right",trigger:"focus",title:pass_not_valid_title,content:pass_not_valid,container:"body"}),b=!1);a.val()!==e.val()&&(e.addClass("error"),b=!1);if(b)return $.post("login/register",{user:d.val(),email:c.val(),pass:a.val()},function(a){return $.each(a,function(a,
f){var e,g;if("user"===a&&!f)return d.addClass("error"),d.popover({placement:"right",trigger:"focus",title:user_in_use_title,content:user_in_use,container:"body"}),b=!1;if("email"===a&&0!==f)return c.addClass("error"),c.popover({placement:"right",trigger:"focus",title:null!=(e=1===f)?e:{email_in_use_title:email_check_error_title},content:null!=(g=1===f)?g:{email_in_use:email_check_error},container:"body"}),b=!1})},"json"),document.location.reload(b)});$('#login input[type="button"]').click(function(){return alert("login")});
$('#register input[name="user"], #register input[name="email"], #register input[name="pass"],\t\t#register input[name="pass_conf"], #login input[name="user"], #login input[name="pass"]').focus(function(){return $(this).removeClass("error")});return $('#register input[name="user"], #register input[name="email"], #register input[name="pass"],\t\t#register input[name="pass_conf"], #login input[name="user"], #login input[name="pass"]').focusout(function(){return $(this).popover("destroy")})})}).call(this);
