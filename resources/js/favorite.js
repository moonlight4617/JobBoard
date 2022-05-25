
$(function () {
  let like = $('.favorite');
  let jobId;

  like.on('click', function () {
    let $this = $(this); //this=イベントの発火した要素を代入
    jobId = $this.data('job-id'); //data-job-idの値を取得
    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/favorite', //通信先アドレス
      method: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
      data: { //サーバーに送信するデータ
        'job_id': jobId //いいねされた投稿のidを送る
      },
    })
      .done(function (data) {
        let favoriteId = $('.favoriteId' + jobId)
        if (favoriteId.text() === 'favorite_border') {
          // console.log("お気に入りにしました");
          favoriteId.text('favorite');
        } else {
          // console.log("お気に入りから外しました");
          favoriteId.text('favorite_border');
        }
      })
      .fail(function () {
        console.log('fail');
      });
  });
});