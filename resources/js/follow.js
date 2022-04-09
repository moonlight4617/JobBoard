
$(function () {
  let follow = $('.follow');

  follow.on('click', function () {
    let $this = $(this); //this=イベントの発火した要素を代入
    let userId = $this.data('user-id');

    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/company/hresource/follow', //通信先アドレス
      method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
      data: { //サーバーに送信するデータ
        'user_id': userId //いいねされた投稿のidを送る
      },
    })
      .done(function (data) {
        if ($(`#follow-${userId}`).text() === 'favorite_border') {
          // console.log("お気に入りにしました");
          follow.html('<span class="material-icons follow follow-toggle" data-user-id="{{ $user->id }}">favorite</span >');
        } else {
          // console.log("お気に入りから外しました");
          follow.html('<span class="material-icons follow follow-toggle" data-user-id="{{ $user->id }}">favorite_border</span >');
        }
      })
      .fail(function () {
        console.log('fail');
      });
  });
});