let path = "dashboard/persediaan/gudang";
$(document).ready(function () {
  let url = new URL(window.location.href);
  let typeParam = url.searchParams.get("type");

  let ajaxUrl = `${baseUrl}/${path}-get?type=${typeParam}`;

  $("#data-persediaan-gudang-rutin").DataTable({
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
      {
        data: "expired_status",
        name: "expired_status",
        orderable: false,
        searchable: false,
      },
      {
        data: null,
        render: function (data) {
          let salt = "PiscokLumer";
          let hashids = new Hashids(salt);
          let hashId = hashids.encode(data.id, 54715);

          let editButton = `<a class="pointer btn btn-primary btn-sm edit" style="margin-left:4px;"  data-id="${hashId}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-fw fa-pen"></i></a>`;

          let stockButton = `<a class="pointer btn btn-success btn-sm stock" style="margin-left:4px;" data-id="${hashId}" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fas fa-fw fa-pills"></i></a>`;

          let deleteButton = `<a class="pointer btn btn-danger btn-sm delete" style="margin-left:4px;" data-identity="${hashId}" data-url="${path}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-fw fa-trash "></i></a>`;

          return editButton + stockButton + deleteButton;
        },
      },
    ],
    createdRow: function (row, data, dataIndex) {
      $(row).find("td:eq(6)").addClass(data.expired_class);
    },
  });
});

// CRUD
$(document).on("click", ".create", function (e) {
  e.preventDefault();
  $("#add-modal").modal("show");
});
$(document).on("click", ".add", function (e) {
  $("div.spanner").addClass("show");
  $("div.overlay").addClass("show");

  let name = $('#add-modal input[name="name"]').val();
  let stok = $('#add-modal input[name="stok"]').val();
  let satuan = $('#add-modal input[name="satuan"]').val();
  let nama_sediaan = $('#add-modal input[name="nama_sediaan"]').val();
  let expired_date = $('#add-modal input[name="expired_date"]').val();

  let form = new FormData();
  form.append("name", name);
  form.append("stok", stok);
  form.append("satuan", satuan);
  form.append("nama_sediaan", nama_sediaan);
  form.append("expired_date", expired_date);
  form.append("kategori", "rutin");
  $.ajax({
    url: `${baseUrl}/${path}`,
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
        $("#add-modal").modal("hide");
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

$(document).on("click", ".edit", function (e) {
  e.preventDefault();
  let id = $(this).data("id");
  $.ajax({
    url: `${baseUrl}/${path}/${id}/edit`,
    method: "GET",
    success: function (response) {
      if (response.status === "true") {
        let data = response.data;
        console.log(data.name);
        $('#change-modal input[name="name"]').val(data.name);
        $('#change-modal input[name="satuan"]').val(data.satuan);
        $('#change-modal input[name="stok"]').val(data.stok);
        $('#change-modal input[name="nama_sediaan"]').val(data.nama_sediaan);
        $('#change-modal input[name="expired_date"]').val(data.expired_date);

        $('#change-modal input[name="id"]').val(data.id);

        $("#change-modal").modal("show");
      } else {
        Swal.fire("Galat", "Kesalahan saat mengambil data.", "error");
      }
    },
    error: function () {
      Swal.fire("Galat", "Kesalahan saat mengambil data.", "error");
    },
  });
});
$(document).on("click", ".update", function (e) {
  e.preventDefault();
  $("div.spanner").addClass("show");
  $("div.overlay").addClass("show");
  let name = $('#change-modal input[name="name"]').val();
  let id = $('#change-modal input[name="id"]').val();
  let satuan = $('#change-modal input[name="satuan"]').val();
  let stok = $('#change-modal input[name="stok"]').val();
  let nama_sediaan = $('#change-modal input[name="nama_sediaan"]').val();
  let expired_date = $('#change-modal input[name="expired_date"]').val();
  let form = new FormData();
  form.append("name", name);
  form.append("stok", stok);
  form.append("satuan", satuan);
  form.append("nama_sediaan", nama_sediaan);
  form.append("expired_date", expired_date);
  form.append("kategori", "rutin");
  form.append("_method", "PUT");
  $.ajax({
    url: `${baseUrl}/${path}/${id}`,
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
        $("#change-modal").modal("hide");
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
