
$(function () {
  let delpic = $('.deletePicture');
  let picId;

  delpic.on('click', function () {
    if (confirm('削除してもいいですか？')) {
      let $this = $(this); //this=イベントの発火した要素を代入
      picId = $this.data('picture-id'); //data-picture-idの値を取得

      //ajax処理スタート
      $.ajax({
        headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
        url: '/deletepicture', //通信先アドレス
        method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
        data: { //サーバーに送信するデータ
          'pic_id': picId //画像のidを送る
        },
      })
        .done(function (data) {
          console.log("削除しました");
          // 削除した画像を非表示
          $('#picture-' + picId).remove();
        })
        .fail(function () {
          console.log('fail');
        });
    } else {
      return false
    }
  });
});