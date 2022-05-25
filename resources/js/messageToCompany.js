
$(function () {
  let post = $('.post');

  post.on('click', function () {
    let $this = $(this); //this=イベントの発火した要素を代入
    let companyId = $this.data('company-id'); //data-company-idの値を取得
    let contactUsersId = $this.data('contactusers-id'); //data-contactUsers-idの値を取得
    let contents = $('.chatMessage').val()
    // console.log(contents);
    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/messages/' + companyId + '/post', //通信先アドレス
      method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
      data: { //サーバーに送信するデータ
        'contact_users_id': contactUsersId, //contact_users_id
        'contents': contents //メッセージ内容
      },
    })
      .done(function (data) {
        // console.log("送信しました");
        let appendMessage = '<li><div class="mx-2 my-6 flex flex-col"><p class="ml-auto flex p-2 rounded bg-indigo-200 box-border lg:max-w-2xl md:max-w-lg max-w-md">' + contents + '</p><div class="ml-auto"><small>送信済み</small></div></div ></li>'
        $('.list').append(appendMessage);
        $('.chatMessage').val('');
      })
      .fail(function () {
        // console.log('fail');
      });
  });
});