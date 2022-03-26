$(function () {
  let addpic = $('.addPic');

  addpic.change(function () {
    let fd = new FormData();  //画像データ送信に必要なFromDataインスタンス作成
    fd.append('portfolio', $(this).prop('files')[0]); //取得した画像データを追加

    //ajax処理スタート
    $.ajax({
      headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },  //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
      url: '/addpicture',
      method: 'POST',
      data: fd,
      dataType: 'text',
      contentType: false,
      processData: false,
    })
      .done(function (data) {
        console.log("登録しました");
      })
      .fail(function () {
        console.log('fail');
      });
  });
});