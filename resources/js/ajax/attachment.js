$(function () {
    $('#js-attachment-delete').on('click', function() {
        alert("Hello jQuery app.js!!");
    });
});
//     let attachment_delete = $('.js-attachment-delete');
//     let attachment_name;

//     attachment_delete.on('click', function () {
//         let $this = $(this);
//         attachment_name = $("#js-attachment-delete-input").val();
//         $.ajax({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 },
//                 url: '/ajax/attachment',  //routeの記述
//                 type: 'POST', //受け取り方法の記述（GETもある）
//                 data: {
//                     'attachment_name': attachment_name //コントローラーに渡すパラメーター
//                 },
//         })
//         // Ajaxリクエストが成功した場合
//         .done(function (data) {
//             //lovedクラスを追加
//             $this.toggleClass('loved');

//             //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
//             $this.next('.likesCount').html(data.postLikesCount);

//         })
//         // Ajaxリクエストが失敗した場合
//         .fail(function (data, xhr, err) {
//             //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
//             //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。
//             console.log('エラー');
//             console.log(err);
//             console.log(xhr);
//         });

//         return false;
//     });
// });
