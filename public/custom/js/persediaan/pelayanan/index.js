let path = "dashboard/persediaan/pelayanan";
$(document).ready(function () {
  let url = new URL(window.location.href);
  let typeParam = url.searchParams.get("type");

  let ajaxUrl = `${baseUrl}/${path}-get?type=${typeParam}`;

  $("#data-persediaan-pelayanan").DataTable({
    processing: true,
    serverSide: true,
    ajax: ajaxUrl,
    columns: [
      { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false },
      { data: "nama", name: "nama" },
      { data: "nama_sediaan", name: "nama_sediaan" },
      { data: "satuan", name: "satuan" },
      { data: "stok", name: "stok" },
      { data: "expired_date", name: "expired_date" },
      { data: "expired_status", name: "expired_status" },
      { data: "expired_class", name: "expired_class", visible: false },
      {
        data: null,
        render: function (data) {
          let salt = "PiscokLumer";
          let hashids = new Hashids(salt);
          let hashId = hashids.encode(data.id, 54715);

          let stockButton = `<a class="pointer btn btn-success btn-sm stock" style="margin-left:4px;" data-id="${hashId}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-fw fa-pills"></i></a>`;

          return stockButton;
        },
      },
    ],
    createdRow: function (row, data, dataIndex) {
      $(row).find("td:eq(6)").addClass(data.expired_class);
    },
  });
});

$(document).on("click", ".stock", function (e) {
  e.preventDefault();
  let id = $(this).data("id");
  $("#stok-modal").modal("show");
  $('#stok-modal input[name="id"]').val(id);
});

$(document).on("click", ".out", function (e) {
  e.preventDefault();
  $("div.spanner").addClass("show");
  $("div.overlay").addClass("show");
  let stok = $('#stok-modal input[name="stok"]').val();
  let id = $('#stok-modal input[name="id"]').val();
  let form = new FormData();
  form.append("stok", stok);
  form.append("id", id);
  $.ajax({
    url: `${baseUrl}/${path}/stok`,
    method: "POST",
    data: form,
    cache: false,
    processData: false,
    contentType: false,
    dataType: "json",
    headers: {
      "X-CSRF-TOKEN": csrfToken,
    },
    success: function (data) {
      if (data.status == "true") {
        $("#stok-modal").modal("hide");
        Swal.fire({
          title: data.title,
          text: data.description,
          icon: data.icon,
          showConfirmButton: true,
        }).then(function () {
          location.reload();
        });
      } else {
        Swal.fire({
          title: data.title,
          text: data.description,
          icon: data.icon,
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
          },
        });
      }
    },
    complete: function () {
      $("div.spanner").removeClass("show");
      $("div.overlay").removeClass("show");
    },
  });

  return false;
});
