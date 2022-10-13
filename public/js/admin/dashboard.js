function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle('active');
    document.getElementById("main").classList.toggle('active');
}

// $(function () {
//     const close = $('.close');
//     const edit = $('.edit');
    
//     const add = $('.add');
//     const modal = $('.modal-container');

//     edit.click(function () {
//         let data = $(this).data('token');
//         $.ajax({
//             type: "POST",
//             url: "/admin/user/get",
//             headers:{
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             data: {
//                 token: data
//             },
//             dataType: "json",
//             success: function (response) {
//                 console.log(response);
//                 alert('success')
//             },
//             error: function (response, responseText, error) {
//                 console.log(response);
//                 console.log(response.responseText);
//                 console.log(error);               
//             }
//         });
//         modal.toggleClass('active')
//     });

//     add.click(function () {
//         modal.toggleClass('active')
//     });

//     close.click(function () {
//         modal.toggleClass('active')
//     });

    
// });