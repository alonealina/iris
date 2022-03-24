$(function () {
  setTimeout(function(){$('.logo').removeClass('none');},1000);
  setTimeout(function(){$('.form_name').removeClass('none');},1000);
  setTimeout(function(){$('.form_item').removeClass('none');},1000);
  setTimeout(function(){$('.uid_explain').removeClass('none');},1000);
  setTimeout(function(){$('.button_form').removeClass('none');},1000);
  setTimeout(function(){$('.pay_price').removeClass('none');},1000);
  setTimeout(function(){$('.qr').removeClass('none');},1000);
  setTimeout(function(){$('.complete_text').removeClass('none');},1000);
  setTimeout(function(){$('.mail_address').removeClass('none');},1000);
  setTimeout(function(){$('.txid_explain').removeClass('none');},1000);
  setTimeout(function(){$('.error_message').removeClass('none');},1000);
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

function copy() {
  var copy_text = document.getElementById('copy');
  copy_text.select();
  document.execCommand('copy');
}

function clickSearchButton() {
  document.forms.search_form.submit();
}

function clickDeleteButton() {
  document.forms.app_list_form.submit();
}

$(function() {
  // 1. 「全選択」する
  $('#all').on('click', function() {
    $("input[name='chk[]']").prop('checked', this.checked);
  });
  // 2. 「全選択」以外のチェックボックスがクリックされたら、
  $("input[name='chk[]']").on('click', function() {
    if ($('#boxes :checked').length == $('#boxes :input').length) {
      // 全てのチェックボックスにチェックが入っていたら、「全選択」 = checked
      $('#all').prop('checked', true);
    } else {
      // 1つでもチェックが入っていたら、「全選択」 = checked
      $('#all').prop('checked', false);
    }
  });
});
