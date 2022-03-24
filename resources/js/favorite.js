
$(function () {
  let like = $('.favorite');
  let jobId;

  like.on('click', function () {
    let $this = $(this); //this=イベントの発火した要素を代入
    jobId = $this.data('job-id'); //data-review-idの値を取得
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
        // console.log(like.text());
        if (like.text() === 'favorite_border') {
          // console.log("お気に入りにしました");
          like.html('<span class="material-icons liked like-toggle" data-job-id="{{ $job->id }}">favorite</span >');
        } else {
          // console.log("お気に入りから外しました");
          like.html('<span class="material-icons untilLike like-toggle" data-job-id="{{ $job->id }}">favorite_border</span >');
        }
      })
      .fail(function () {
        console.log('fail');
      });
  });
});