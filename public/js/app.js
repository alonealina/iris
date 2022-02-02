$(function () {
  setTimeout(function(){$('.logo').removeClass('none');},1000);
  setTimeout(function(){$('.form_name').removeClass('none');},1000);
  setTimeout(function(){$('.form_item').removeClass('none');},1000);
  setTimeout(function(){$('.button_form').removeClass('none');},1000);
});
  
function clickRegistButton() {
  document.forms.app_form.submit();
}

