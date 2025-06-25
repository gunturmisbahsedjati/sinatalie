/**
 * Main
 */

'use strict';
$(window).on('load', function () {
  if ($('.cover').length) {
    $('.cover').parallax({
      imageSrc: $('.cover').data('image'),
      zIndex: '1'
    });
  }
  $("#preloader").animate({
    'opacity': '0'
  }, 600, function () {
    setTimeout(function () {
      $("#preloader").css("visibility", "hidden").fadeOut();
    }, 300);
  });
});


$('#formAuthentication').submit(function (e) {
  e.preventDefault();
  var valid = true;
  var username = $("#username").val();
  var password = $("#password").val();
  const btnLogin = document.querySelector('.btn-login');
  const btnLoading = document.querySelector('.btn-loading');
  // console.log('oke');
  $.ajax({
    url: "inc/checklogin",
    type: "POST",
    data: { 'username': username, 'password': password },
    success: function (data) {
      // console.log(data);
      if (data == 0) {
        btnLogin.classList.toggle('d-none');
        btnLoading.classList.toggle('d-none');
        Swal.fire({
          title: 'Username dan Password \n tidak sesuai',
          text: "Cek kembali username dan password anda !",
          confirmButtonColor: '#696cff',
          confirmButtonText: 'Ok',
          allowOutsideClick: false
        }).then((result) => {
          if (result.isConfirmed) {
            btnLogin.classList.toggle('d-none');
            btnLoading.classList.toggle('d-none');

          }
        });

      } else if (data !== 1) {
        btnLogin.classList.toggle('d-none');
        btnLoading.classList.toggle('d-none');
        var username = $("#username").val();
        $.ajax({
          url: "inc/redirect",
          type: "POST",
          data: { 'username': username, 'password': password },
          dataType: "text",
          success: function (data) {
            Swal.fire({
              title: "Login Sukses",
              icon: "success",
              timer: 1500,
              showConfirmButton: false
            }).then(function () {
              if (true) {
                window.location = "./";
              }
            });

          }
        });
      } else {
        console.log("invalid");
      }
    }
  });
  //
});

var myLoadingPage
function loadingPage() {
  myLoadingPage = setTimeout(showPage, 100);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  // document.getElementById("loader").style.display = "block";
  document.getElementById("content").style.display = "block";
}


var _validFileExtensions = [".jpg"];
function ValidateSingleInputJPG(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensions.length; j++) {
        var sCurExtension = _validFileExtensions[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus JPG !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};

var _validFileExtensionpdf = ["pdf", "PDF", "Pdf"];
function ValidateSingleInputpdf(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensionpdf.length; j++) {
        var sCurExtension = _validFileExtensionpdf[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus pdf !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
      }
    }
  }
  return true;
};

function ValidateSize(file) {
  var FileSize = file.files[0].size;
  if (FileSize > 1000000) {
    Swal.fire({
      icon: 'error',
      title: 'Ukuran file maks 1MB',
      showConfirmButton: true,
      timer: 5000
    });
    file.value = "";
    return false;
  } else {

  }
}

function ValidateSizePengajuan(file) {
  var FileSize = file.files[0].size;
  if (FileSize > 2097152) {
    Swal.fire({
      icon: 'error',
      title: 'Ukuran file maks 2MB',
      showConfirmButton: true,
      timer: 5000
    });
    file.value = "";
    return false;
  } else {

  }
}

var _validFileExtensionsExcel = [".xls", ".xlsx"];

function ValidateSingleInputExcel(oInput) {
  if (oInput.type == "file") {
    var sFileName = oInput.value;
    if (sFileName.length > 0) {
      var blnValid = false;
      for (var j = 0; j < _validFileExtensionsExcel.length; j++) {
        var sCurExtension = _validFileExtensionsExcel[j];
        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
          blnValid = true;
          break;

        }
      }

      if (!blnValid) {
        Swal.fire({
          icon: 'error',
          title: 'File format harus Excel !',
          showConfirmButton: true,
          timer: 5000
        });
        oInput.value = "";
        return false;
        $('.cekButton').attr('disabled', true);
      } else {
        $('.cekButton').removeAttr('disabled');
      }
    }
  }
  return true;
};
$(".custom-file-input").on("change", function () {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function checkTime(i) {
  if (i < 10) { i = "0" + i };  // add zero in front of numbers < 10
  return i;
}

if (document.getElementById('clock-dashboard')) {
  function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('clock-dashboard').innerHTML = h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);

  }
  startTime();
}
if (document.getElementById('header-dashboard')) {
  function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('header-dashboard').innerHTML = h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
    // console.log(h);
  }

  startTime();
}

// if (document.getElementById('account-file-input')) {
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const deactivateAcc = document.querySelector('#formAccountDeactivation');

    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;

      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
  })();
});
// }


//sidebar
$(document).ready(function () {
  $('#commingSoon').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-dialog-centered modal-md');
    document.getElementById("load-comingsoon").style.display = "block";
    document.getElementById("comingsoon").style.display = "none";
    $.ajax({
      url: 'dashboard/page/comingSoonPage',
      success: function (data) {
        document.getElementById("load-comingsoon").style.display = "none";
        document.getElementById("comingsoon").style.display = "block";
        $('.comingsoon').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

//global datatable
$('#global_table').DataTable({
  // scrollCollapse: true,
  // scrollY: 475,
  // scroller: true,
  'paging': true,
  'lengthChange': true,
  'searching': true,
  'ordering': true,
  'info': true,
  'autoWidth': true
});
function seprator(input) {
  let nums = input.value.replace(/,/g, '');
  if (!nums || nums.endsWith('.')) return;
  input.value = parseFloat(nums).toLocaleString();
}

setTimeout(function () {
  $('#tabel_transport_semua_peserta').DataTable({
    scrollCollapse: true,
    scrollY: 650,
    scrollX: true,
    scroller: true,
    'paging': false,
    'lengthChange': false,
    'searching': true,
    'ordering': false,
    'info': false,
    'autoWidth': true,
    columnDefs: [
      { targets: [1], width: '165px' },
      { targets: [2], width: '165px' },
      { targets: [3], width: '130px' },
      { targets: [4], width: '130px' },
      { targets: [5], width: '130px' },
      { targets: [6], width: '130px' },
      { targets: [7], width: '130px' },
      { targets: [8], width: '130px' },
      { targets: [9], width: '130px' },
      { targets: [10], width: '130px' }
    ],
    fixedColumns: {
      left: 1
    }
  });
  $(document).ready(function () {
    $('#tabel_transport_semua_peserta_hotel').DataTable({
      scrollCollapse: true,
      scrollY: 650,
      scrollX: true,
      scroller: true,
      'paging': false,
      'lengthChange': false,
      'searching': true,
      'ordering': false,
      'info': false,
      'autoWidth': true,
      columnDefs: [
        { targets: [1], width: '165px' },
        { targets: [2], width: '165px' },
        { targets: [3], width: '130px' },
        { targets: [4], width: '130px' },
        { targets: [5], width: '130px' },
        { targets: [6], width: '130px' },
        { targets: [7], width: '130px' },
        { targets: [8], width: '130px' },
        { targets: [9], width: '130px' },
        { targets: [10], width: '130px' }
      ],
      fixedColumns: {
        left: 1
      }
    })
  });
}, 1000);

//akun belanja
// if (document.getElementById('data_akun_belanja')) {
//   $('#shopping_table').DataTable({
//     'paging': true,
//     'lengthChange': false,
//     'searching': false,
//     'ordering': true,
//     'info': true,
//     'autoWidth': true,
//     "processing": true,
//     "serverSide": true,
//     "ajax": {
//       'url': 'dashboard/modul/manajemen/kepulauan/query-sekolah-kepulauan?type=all_data',
//       "dataType": "json",
//       "type": "POST"
//     },
//     "columns": [
//       { "data": "no" },
//       { "data": "npsn" },
//       { "data": "jenjang_sek" },
//       { "data": "nama_sek" },
//       { "data": "kec_sek" },
//       { "data": "kabkota_sek" },
//       { "data": "aksi" },
//     ]
//   });
// }
if (document.getElementById('shopping_table')) {
  $('#shopping_table').DataTable({
    'paging': false,
    'lengthChange': false,
    'searching': false,
    'ordering': true,
    'info': true,
    'autoWidth': true
  });

  $(document).ready(function () {
    $('#addShopping').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-add-shopping").style.display = "block";
      document.getElementById("add-shopping").style.display = "none";
      $.ajax({
        url: 'dashboard/page/master/akun_belanja/tambah-akun-belanja.php',
        success: function (data) {
          document.getElementById("load-add-shopping").style.display = "none";
          document.getElementById("add-shopping").style.display = "block";
          $('.add-shopping').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });

  $(document).ready(function () {
    $('#editShopping').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-edit-shopping").style.display = "block";
      document.getElementById("edit-shopping").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      const token = $(e.relatedTarget).data('token');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/master/akun_belanja/edit-akun-belanja.php',
        data: { 'id': id, 'token': token },
        success: function (data) {
          document.getElementById("load-edit-shopping").style.display = "none";
          document.getElementById("edit-shopping").style.display = "block";
          $('.edit-shopping').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    });
  });

  $(document).ready(function () {
    $('#delShopping').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-del-shopping").style.display = "block";
      document.getElementById("del-shopping").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      const token = $(e.relatedTarget).data('token');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/master/akun_belanja/hapus-akun-belanja.php',
        data: { 'id': id, 'token': token },
        success: function (data) {
          document.getElementById("load-del-shopping").style.display = "none";
          document.getElementById("del-shopping").style.display = "block";
          $('.del-shopping').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    });
  });

}

if (document.getElementById('data_akun_manajemen')) {
  $('#account_table').DataTable({
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true
  });

  $(document).ready(function () {
    $('#addAccount').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-add-account").style.display = "block";
      document.getElementById("add-account").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      const token = $(e.relatedTarget).data('token');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/master/akun_manajemen/tambah-akun.php',
        data: { 'id': id, 'token': token },
        success: function (data) {
          document.getElementById("load-add-account").style.display = "none";
          document.getElementById("add-account").style.display = "block";
          $('.add-account').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    });
  });

  $(document).ready(function () {
    $('#delAccount').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-del-account").style.display = "block";
      document.getElementById("del-account").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/master/akun_manajemen/hapus-akun.php',
        data: { 'id': id },
        success: function (data) {
          document.getElementById("load-del-account").style.display = "none";
          document.getElementById("del-account").style.display = "block";
          $('.del-account').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    });
  });

}

if (document.getElementById('data_mapping_wilayah')) {
  $('#mapping_region_table').DataTable({
    'paging': false,
    'lengthChange': false,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true
  });

  $(document).ready(function () {
    $('#sinkronMapping').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-sinkron-mapping").style.display = "block";
      document.getElementById("sinkron-mapping").style.display = "none";
      $.ajax({
        type: 'post',
        url: 'dashboard/page/master/mapping_kabkota/sinkron-mapping-wil',
        success: function (data) {
          document.getElementById("load-sinkron-mapping").style.display = "none";
          document.getElementById("sinkron-mapping").style.display = "block";
          $('.sinkron-mapping').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });
  $(document).ready(function () {
    $('#updateMapping').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-update-mapping").style.display = "block";
      document.getElementById("update-mapping").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/master/mapping_kabkota/edit-mapping',
        data: 'id=' + id,
        success: function (data) {
          document.getElementById("load-update-mapping").style.display = "none";
          document.getElementById("update-mapping").style.display = "block";
          $('.update-mapping').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });
}


//perjadin Hotel
$(document).ready(function () {
  $('#choosePeriodHotel').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-choose-period-hotel").style.display = "block";
    document.getElementById("choose-period-hotel").style.display = "none";
    $.ajax({
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/pilih_tahun_perjadin_hotel',
      success: function (data) {
        document.getElementById("load-choose-period-hotel").style.display = "none";
        document.getElementById("choose-period-hotel").style.display = "block";
        $('.choose-period-hotel').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

if (document.getElementById('dokumen_perjadin_hotel')) {

  $('#perjadin_hotel_table').DataTable({
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true
  });

  $(document).ready(function () {
    $('#addDocumentHotel').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
      document.getElementById("load-add-document-hotel").style.display = "block";
      document.getElementById("add-document-hotel").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/tambah-perjadin-hotel',
        data: { 'id': id },
        success: function (data) {
          document.getElementById("load-add-document-hotel").style.display = "none";
          document.getElementById("add-document-hotel").style.display = "block";
          $('.add-document-hotel').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });

  $(document).ready(function () {
    $('#delDocumentHotel').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-del-document-hotel").style.display = "block";
      document.getElementById("del-document-hotel").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/hapus-perjadin-hotel',
        data: { 'id': id },
        success: function (data) {
          document.getElementById("load-del-document-hotel").style.display = "none";
          document.getElementById("del-document-hotel").style.display = "block";
          $('.del-document-hotel').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });

  $(document).ready(function () {
    $('#changeStatus').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-change-status").style.display = "block";
      document.getElementById("change-status").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      const status = $(e.relatedTarget).data('status');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/setting-status',
        data: { 'id': id, 'status': status },
        success: function (data) {
          document.getElementById("load-change-status").style.display = "none";
          document.getElementById("change-status").style.display = "block";
          $('.change-status').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });

}

$(document).ready(function () {
  $('#importParticipant').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-import-participant").style.display = "block";
    document.getElementById("import-participant").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/import-excel-peserta',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-import-participant").style.display = "none";
        document.getElementById("import-participant").style.display = "block";
        $('.import-participant').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#delAllParticipant').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-all-participant").style.display = "block";
    document.getElementById("del-all-participant").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/hapus-semua-peserta',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-all-participant").style.display = "none";
        document.getElementById("del-all-participant").style.display = "block";
        $('.del-all-participant').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#delParticipant').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-participant").style.display = "block";
    document.getElementById("del-participant").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/hapus-peserta',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-del-participant").style.display = "none";
        document.getElementById("del-participant").style.display = "block";
        $('.del-participant').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#takeDailyCosts').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-take-daily-costs").style.display = "block";
    document.getElementById("take-daily-costs").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/ambil-data-uang-harian-peserta',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-take-daily-costs").style.display = "none";
        document.getElementById("take-daily-costs").style.display = "block";
        $('.take-daily-costs').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#inputTransportParticipant').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-input-transport-participant").style.display = "block";
    document.getElementById("input-transport-participant").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/input-transport-peserta',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-input-transport-participant").style.display = "none";
        document.getElementById("input-transport-participant").style.display = "block";
        $('.input-transport-participant').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#inputTransportAllParticipant').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-fullscreen');
    document.getElementById("load-input-transport-all-participant").style.display = "block";
    document.getElementById("input-transport-all-participant").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/input-semua-transport-peserta',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-input-transport-all-participant").style.display = "none";
        document.getElementById("input-transport-all-participant").style.display = "block";
        $('.input-transport-all-participant').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#addFinancialOfficer').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-financial-officer").style.display = "block";
    document.getElementById("add-financial-officer").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const type = $(e.relatedTarget).data('type');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/tambah-petugas-keuangan-perjadin-hotel',
      data: { 'id': id, 'type': type },
      success: function (data) {
        document.getElementById("load-add-financial-officer").style.display = "none";
        document.getElementById("add-financial-officer").style.display = "block";
        $('.add-financial-officer').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#setReceiptHotel').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-xl');
    document.getElementById("load-set-receipt-hotel").style.display = "block";
    document.getElementById("set-receipt-hotel").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const type = $(e.relatedTarget).data('type');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/pengaturan-cetak-kuitansi',
      data: { 'id': id, 'type': type },
      success: function (data) {
        document.getElementById("load-set-receipt-hotel").style.display = "none";
        document.getElementById("set-receipt-hotel").style.display = "block";
        $('.set-receipt-hotel').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#setFinancialReceiptHotel').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-set-financial-receipt-hotel").style.display = "block";
    document.getElementById("set-financial-receipt-hotel").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const type = $(e.relatedTarget).data('type');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/pengaturan-keuangan-kuitansi',
      data: { 'id': id, 'type': type },
      success: function (data) {
        document.getElementById("load-set-financial-receipt-hotel").style.display = "none";
        document.getElementById("set-financial-receipt-hotel").style.display = "block";
        $('.set-financial-receipt-hotel').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

if (document.getElementById('inputTransportPeserta')) {
  var buttonCek = document.getElementById('inputTransportPeserta');
  buttonCek.onclick = () => {
    Swal.fire({
      title: "Konfirmasi Form",
      text: "Apakah Anda Yakin Data telah benar ?",
      icon: "warning",
      allowOutsideClick: false,
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yakin",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.isConfirmed) {
        $('#formTransportParticipant').submit();
      }
    });
  };
}
if (document.getElementById("tgl_mulai_peserta")) {
  var input = document.getElementsByName('tgl_mulai[]');
  for (var i = 0; i < input.length; i++) {
    var a = input[i];
    $(a).datepicker({
      uiLibrary: 'bootstrap5',
      format: 'dd-mm-yyyy',
      showRightIcon: false
    })
  }
}

if (document.getElementById("tgl_selesai_peserta")) {
  var input = document.getElementsByName('tgl_selesai[]');
  for (var i = 0; i < input.length; i++) {
    var a = input[i];
    $(a).datepicker({
      uiLibrary: 'bootstrap5',
      format: 'dd-mm-yyyy',
      showRightIcon: false
    })
  }
}

$(document).ready(function () {
  $('#addDirectorExternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-director-external").style.display = "block";
    document.getElementById("add-director-external").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/tambah-pengarah-eksternal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-director-external").style.display = "none";
        document.getElementById("add-director-external").style.display = "block";
        $('.add-director-external').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editDirectorExternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-director-external").style.display = "block";
    document.getElementById("edit-director-external").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/edit-pengarah-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-edit-director-external").style.display = "none";
        document.getElementById("edit-director-external").style.display = "block";
        $('.edit-director-external').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#inputTransportDirector').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-input-transport-director").style.display = "block";
    document.getElementById("input-transport-director").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/input-transport-pengarah-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-input-transport-director").style.display = "none";
        document.getElementById("input-transport-director").style.display = "block";
        $('.input-transport-director').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#addDirectorInternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-director-internal").style.display = "block";
    document.getElementById("add-director-internal").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/tambah-pengarah-internal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-director-internal").style.display = "none";
        document.getElementById("add-director-internal").style.display = "block";
        $('.add-director-internal').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#delDirector').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-director").style.display = "block";
    document.getElementById("del-director").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/hapus-pengarah',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-del-director").style.display = "none";
        document.getElementById("del-director").style.display = "block";
        $('.del-director').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});


$(document).ready(function () {
  $('#addInformantExternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-informant-external").style.display = "block";
    document.getElementById("add-informant-external").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/tambah-narsum-eksternal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-informant-external").style.display = "none";
        document.getElementById("add-informant-external").style.display = "block";
        $('.add-informant-external').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#addInformantInternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-informant-internal").style.display = "block";
    document.getElementById("add-informant-internal").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/tambah-narsum-internal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-informant-internal").style.display = "none";
        document.getElementById("add-informant-internal").style.display = "block";
        $('.add-informant-internal').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#delInformant').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-informant").style.display = "block";
    document.getElementById("del-informant").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/hapus-narsum',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-del-informant").style.display = "none";
        document.getElementById("del-informant").style.display = "block";
        $('.del-informant').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editInformantExternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-informant-external").style.display = "block";
    document.getElementById("edit-informant-external").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/edit-narsum-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-edit-informant-external").style.display = "none";
        document.getElementById("edit-informant-external").style.display = "block";
        $('.edit-informant-external').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#inputTransportInformant').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-input-transport-informant").style.display = "block";
    document.getElementById("input-transport-informant").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/input-transport-narsum-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-input-transport-informant").style.display = "none";
        document.getElementById("input-transport-informant").style.display = "block";
        $('.input-transport-informant').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#addCommitteeExternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-committee-external").style.display = "block";
    document.getElementById("add-committee-external").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/tambah-panitia-eksternal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-committee-external").style.display = "none";
        document.getElementById("add-committee-external").style.display = "block";
        $('.add-committee-external').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#addCommitteeInternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-committee-internal").style.display = "block";
    document.getElementById("add-committee-internal").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/tambah-panitia-internal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-committee-internal").style.display = "none";
        document.getElementById("add-committee-internal").style.display = "block";
        $('.add-committee-internal').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#delCommittee').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-committee").style.display = "block";
    document.getElementById("del-committee").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/hapus-panitia',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-del-committee").style.display = "none";
        document.getElementById("del-committee").style.display = "block";
        $('.del-committee').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editCommitteeExternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-committee-external").style.display = "block";
    document.getElementById("edit-committee-external").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/edit-panitia-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-edit-committee-external").style.display = "none";
        document.getElementById("edit-committee-external").style.display = "block";
        $('.edit-committee-external').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#attendanceCommittee').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-attendance-committee").style.display = "block";
    document.getElementById("attendance-committee").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_hotel/page_detail_perjadin_hotel/edit-kehadiran-panitia',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-attendance-committee").style.display = "none";
        document.getElementById("attendance-committee").style.display = "block";
        $('.attendance-committee').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});


// perjadin luring
$(document).ready(function () {
  $('#choosePeriodOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm');
    document.getElementById("load-choose-period-office").style.display = "block";
    document.getElementById("choose-period-office").style.display = "none";
    $.ajax({
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/pilih_tahun_perjadin_kantor',
      success: function (data) {
        document.getElementById("load-choose-period-office").style.display = "none";
        document.getElementById("choose-period-office").style.display = "block";
        $('.choose-period-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

if (document.getElementById('dokumen_perjadin_kantor')) {

  $('#perjadin_kantor_table').DataTable({
    'paging': true,
    'lengthChange': true,
    'searching': true,
    'ordering': true,
    'info': true,
    'autoWidth': true
  });

  $(document).ready(function () {
    $('#addDocumentOffice').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
      document.getElementById("load-add-document-office").style.display = "block";
      document.getElementById("add-document-office").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/tambah-perjadin-kantor',
        data: { 'id': id },
        success: function (data) {
          document.getElementById("load-add-document-office").style.display = "none";
          document.getElementById("add-document-office").style.display = "block";
          $('.add-document-office').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });

  $(document).ready(function () {
    $('#delDocumentOffice').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-del-document-office").style.display = "block";
      document.getElementById("del-document-office").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/hapus-perjadin-kantor',
        data: { 'id': id },
        success: function (data) {
          document.getElementById("load-del-document-office").style.display = "none";
          document.getElementById("del-document-office").style.display = "block";
          $('.del-document-office').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });

  $(document).ready(function () {
    $('#changeStatusOffice').on('show.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
      document.getElementById("load-change-status-office").style.display = "block";
      document.getElementById("change-status-office").style.display = "none";
      const id = $(e.relatedTarget).data('id');
      const status = $(e.relatedTarget).data('status');
      $.ajax({
        type: 'post',
        url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/setting-status',
        data: { 'id': id, 'status': status },
        success: function (data) {
          document.getElementById("load-change-status-office").style.display = "none";
          document.getElementById("change-status-office").style.display = "block";
          $('.change-status-office').html(data);
        }
      });
    });
    $('.modal').on('hide.bs.modal', function (e) {
      $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    });
  });

}

$(document).ready(function () {
  $('#importParticipantOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-import-participant-office").style.display = "block";
    document.getElementById("import-participant-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/import-excel-peserta',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-import-participant-office").style.display = "none";
        document.getElementById("import-participant-office").style.display = "block";
        $('.import-participant-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#delAllParticipantOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-all-participant-office").style.display = "block";
    document.getElementById("del-all-participant-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/hapus-semua-peserta',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-del-all-participant-office").style.display = "none";
        document.getElementById("del-all-participant-office").style.display = "block";
        $('.del-all-participant-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#delParticipantOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-participant-office").style.display = "block";
    document.getElementById("del-participant-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/hapus-peserta',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-del-participant-office").style.display = "none";
        document.getElementById("del-participant-office").style.display = "block";
        $('.del-participant-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

// $(document).ready(function () {
//   $('#takeDailyCosts').on('show.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
//     document.getElementById("load-take-daily-costs").style.display = "block";
//     document.getElementById("take-daily-costs").style.display = "none";
//     const id = $(e.relatedTarget).data('id');
//     $.ajax({
//       type: 'post',
//       url: 'dashboard/page/transaksi/perjadin_kegiatan_luring/page_detail_perjadin_luring/ambil-data-uang-harian-peserta',
//       data: { 'id': id },
//       success: function (data) {
//         document.getElementById("load-take-daily-costs").style.display = "none";
//         document.getElementById("take-daily-costs").style.display = "block";
//         $('.take-daily-costs').html(data);
//       }
//     });
//   });
//   $('.modal').on('hide.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
//   });
// });

$(document).ready(function () {
  $('#inputTransportParticipantOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-input-transport-participant-office").style.display = "block";
    document.getElementById("input-transport-participant-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/input-transport-peserta',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-input-transport-participant-office").style.display = "none";
        document.getElementById("input-transport-participant-office").style.display = "block";
        $('.input-transport-participant-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

// $(document).ready(function () {
//   $('#inputTransportAllParticipant').on('show.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog modal-fullscreen');
//     document.getElementById("load-input-transport-all-participant").style.display = "block";
//     document.getElementById("input-transport-all-participant").style.display = "none";
//     const id = $(e.relatedTarget).data('id');
//     const token = $(e.relatedTarget).data('token');
//     $.ajax({
//       type: 'post',
//       url: 'dashboard/page/transaksi/perjadin_kegiatan_luring/page_detail_perjadin_luring/input-semua-transport-peserta',
//       data: { 'id': id, 'token': token },
//       success: function (data) {
//         document.getElementById("load-input-transport-all-participant").style.display = "none";
//         document.getElementById("input-transport-all-participant").style.display = "block";
//         $('.input-transport-all-participant').html(data);
//       }
//     });
//   });
//   $('.modal').on('hide.bs.modal', function (e) {
//     $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
//   });
// });

$(document).ready(function () {
  $('#addFinancialOfficeClerk').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-financial-office-clerk").style.display = "block";
    document.getElementById("add-financial-office-clerk").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const type = $(e.relatedTarget).data('type');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/tambah-petugas-keuangan-perjadin-kantor',
      data: { 'id': id, 'type': type },
      success: function (data) {
        document.getElementById("load-add-financial-office-clerk").style.display = "none";
        document.getElementById("add-financial-office-clerk").style.display = "block";
        $('.add-financial-office-clerk').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#setReceiptOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-xl');
    document.getElementById("load-set-receipt-office").style.display = "block";
    document.getElementById("set-receipt-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const type = $(e.relatedTarget).data('type');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/pengaturan-cetak-kuitansi',
      data: { 'id': id, 'type': type },
      success: function (data) {
        document.getElementById("load-set-receipt-office").style.display = "none";
        document.getElementById("set-receipt-office").style.display = "block";
        $('.set-receipt-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#setFinancialReceiptOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-set-financial-receipt-office").style.display = "block";
    document.getElementById("set-financial-receipt-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const type = $(e.relatedTarget).data('type');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/pengaturan-keuangan-kuitansi',
      data: { 'id': id, 'type': type },
      success: function (data) {
        document.getElementById("load-set-financial-receipt-office").style.display = "none";
        document.getElementById("set-financial-receipt-office").style.display = "block";
        $('.set-financial-receipt-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

if (document.getElementById('inputTransportPesertaKantor')) {
  var buttonCek = document.getElementById('inputTransportPesertaKantor');
  buttonCek.onclick = () => {
    Swal.fire({
      title: "Konfirmasi Form",
      text: "Apakah Anda Yakin Data telah benar ?",
      icon: "warning",
      allowOutsideClick: false,
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yakin",
      cancelButtonText: "Batal"
    }).then((result) => {
      if (result.isConfirmed) {
        $('#formTransportParticipantOffice').submit();
      }
    });
  };
}
// if (document.getElementById("tgl_mulai_peserta")) {
//   var input = document.getElementsByName('tgl_mulai[]');
//   for (var i = 0; i < input.length; i++) {
//     var a = input[i];
//     $(a).datepicker({
//       uiLibrary: 'bootstrap5',
//       format: 'dd-mm-yyyy',
//       showRightIcon: false
//     })
//   }
// }

// if (document.getElementById("tgl_selesai_peserta")) {
//   var input = document.getElementsByName('tgl_selesai[]');
//   for (var i = 0; i < input.length; i++) {
//     var a = input[i];
//     $(a).datepicker({
//       uiLibrary: 'bootstrap5',
//       format: 'dd-mm-yyyy',
//       showRightIcon: false
//     })
//   }
// }

$(document).ready(function () {
  $('#addDirectorExternalOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-director-external-office").style.display = "block";
    document.getElementById("add-director-external-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/tambah-pengarah-eksternal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-director-external-office").style.display = "none";
        document.getElementById("add-director-external-office").style.display = "block";
        $('.add-director-external-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editDirectorExternalOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-director-external-office").style.display = "block";
    document.getElementById("edit-director-external-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/edit-pengarah-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-edit-director-external-office").style.display = "none";
        document.getElementById("edit-director-external-office").style.display = "block";
        $('.edit-director-external-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#inputTransportDirectorOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-input-transport-director-office").style.display = "block";
    document.getElementById("input-transport-director-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/input-transport-pengarah-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-input-transport-director-office").style.display = "none";
        document.getElementById("input-transport-director-office").style.display = "block";
        $('.input-transport-director-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#addDirectorInternalOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-director-internal-office").style.display = "block";
    document.getElementById("add-director-internal-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/tambah-pengarah-internal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-director-internal-office").style.display = "none";
        document.getElementById("add-director-internal-office").style.display = "block";
        $('.add-director-internal-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#delDirectorOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-director-office").style.display = "block";
    document.getElementById("del-director-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/hapus-pengarah',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-del-director-office").style.display = "none";
        document.getElementById("del-director-office").style.display = "block";
        $('.del-director-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});


$(document).ready(function () {
  $('#addInformantExternalOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-informant-external-office").style.display = "block";
    document.getElementById("add-informant-external-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/tambah-narsum-eksternal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-informant-external-office").style.display = "none";
        document.getElementById("add-informant-external-office").style.display = "block";
        $('.add-informant-external-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#addInformantInternalOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-informant-internal-office").style.display = "block";
    document.getElementById("add-informant-internal-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/tambah-narsum-internal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-informant-internal-office").style.display = "none";
        document.getElementById("add-informant-internal-office").style.display = "block";
        $('.add-informant-internal-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#delInformantOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-informant-office").style.display = "block";
    document.getElementById("del-informant-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/hapus-narsum',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-del-informant-office").style.display = "none";
        document.getElementById("del-informant-office").style.display = "block";
        $('.del-informant-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editInformantExternalOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-informant-external-office").style.display = "block";
    document.getElementById("edit-informant-external-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/edit-narsum-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-edit-informant-external-office").style.display = "none";
        document.getElementById("edit-informant-external-office").style.display = "block";
        $('.edit-informant-external-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#inputTransportInformantOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-lg');
    document.getElementById("load-input-transport-informant-office").style.display = "block";
    document.getElementById("input-transport-informant-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/input-transport-narsum-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-input-transport-informant-office").style.display = "none";
        document.getElementById("input-transport-informant-office").style.display = "block";
        $('.input-transport-informant-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});

$(document).ready(function () {
  $('#addCommitteeExternalOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-committee-external-office").style.display = "block";
    document.getElementById("add-committee-external-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/tambah-panitia-eksternal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-committee-external-office").style.display = "none";
        document.getElementById("add-committee-external-office").style.display = "block";
        $('.add-committee-external-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#addCommitteeInternalOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-add-committee-internal-office").style.display = "block";
    document.getElementById("add-committee-internal-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/tambah-panitia-internal',
      data: { 'id': id },
      success: function (data) {
        document.getElementById("load-add-committee-internal-office").style.display = "none";
        document.getElementById("add-committee-internal-office").style.display = "block";
        $('.add-committee-internal-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#delCommitteeOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-del-committee-office").style.display = "block";
    document.getElementById("del-committee-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/hapus-panitia',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-del-committee-office").style.display = "none";
        document.getElementById("del-committee-office").style.display = "block";
        $('.del-committee-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#editCommitteeExternal').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-edit-committee-external").style.display = "block";
    document.getElementById("edit-committee-external").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_luring/page_detail_perjadin_luring/edit-panitia-eksternal',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-edit-committee-external").style.display = "none";
        document.getElementById("edit-committee-external").style.display = "block";
        $('.edit-committee-external').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});
$(document).ready(function () {
  $('#attendanceCommitteeOffice').on('show.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
    document.getElementById("load-attendance-committee-office").style.display = "block";
    document.getElementById("attendance-committee-office").style.display = "none";
    const id = $(e.relatedTarget).data('id');
    const token = $(e.relatedTarget).data('token');
    $.ajax({
      type: 'post',
      url: 'dashboard/page/transaksi/perjadin_kegiatan_kantor/page_detail_perjadin_kantor/edit-kehadiran-panitia',
      data: { 'id': id, 'token': token },
      success: function (data) {
        document.getElementById("load-attendance-committee-office").style.display = "none";
        document.getElementById("attendance-committee-office").style.display = "block";
        $('.attendance-committee-office').html(data);
      }
    });
  });
  $('.modal').on('hide.bs.modal', function (e) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog modal-md');
  });
});