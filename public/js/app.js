$(function () {
  setTimeout(function(){$('.logo').removeClass('none');},1000);
  setTimeout(function(){$('.form_name').removeClass('none');},1000);
  setTimeout(function(){$('.form_item').removeClass('none');},1000);
  setTimeout(function(){$('.button_form').removeClass('none');},1000);
  setTimeout(function(){$('.pay_price').removeClass('none');},1000);
  setTimeout(function(){$('.qr').removeClass('none');},1000);
  setTimeout(function(){$('.complete_text').removeClass('none');},1000);
  setTimeout(function(){$('.mail_address').removeClass('none');},1000);
});
  
function clickRegistButton() {
  document.forms.app_form.submit();
}

function clickPaymentButton() {
  document.forms.pay_form.submit();
}

function clickTxidButton() {
  document.forms.txid_form.submit();
}

