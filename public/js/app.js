$(function () {
  setTimeout(function(){$('.logo').removeClass('none');},1000);
  setTimeout(function(){$('.form_name').removeClass('none');},1000);
  setTimeout(function(){$('.form_item').removeClass('none');},1000);
  setTimeout(function(){$('.uid_explain').removeClass('none');},1000);
  setTimeout(function(){$('.check_form').removeClass('none');},1000);
  setTimeout(function(){$('.button_form').removeClass('none');},1000);
  setTimeout(function(){$('.pay_price').removeClass('none');},1000);
  setTimeout(function(){$('.qr').removeClass('none');},1000);
  setTimeout(function(){$('.pay_exp').removeClass('none');},1000);
  setTimeout(function(){$('.complete_text').removeClass('none');},1000);
  setTimeout(function(){$('.mail_address').removeClass('none');},1000);
  setTimeout(function(){$('.txid_explain').removeClass('none');},1000);
  setTimeout(function(){$('.error_message').removeClass('none');},1000);
  setTimeout(function(){$('.faq_div').removeClass('none');},1000);
});
  
function clickRegistButton() {
  if (document.getElementById("check").checked) {
    document.forms.app_form.submit();
  } else {
    alert("利用規約にチェックを入れてください");
  }
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
  // エレメントを作成
  var ele = document.createElement('input');
  // データを設定
  ele.setAttribute('type', 'hidden');
  ele.setAttribute('name', 'type');
  ele.setAttribute('value', 'delete_flg');
  // 要素を追加
  document.forms.app_list_form.appendChild(ele);

  document.forms.app_list_form.submit();
}

function clickCheckButton() {
  // エレメントを作成
  var ele = document.createElement('input');
  // データを設定
  ele.setAttribute('type', 'hidden');
  ele.setAttribute('name', 'type');
  ele.setAttribute('value', 'check_flg');
  // 要素を追加
  document.forms.app_list_form.appendChild(ele);

  document.forms.app_list_form.submit();
}

function clickCsvButton() {
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
