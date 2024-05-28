// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("#dataTable").DataTable({
    initComplete: function () {
      this.api()
        .columns([0, 1, 2, 3, 4, 5])
        .every(function () {
          var column = this;
          var header = $(column.header());
          var label = $("<label/>")
            .text(header.text())
            .appendTo(header.empty());
          var select = $(
            '<select class="form-control"><option value="">' +
              header.text() +
              "</option></select>"
          )
            .appendTo(label)
            .on("change", function () {
              var val = $.fn.dataTable.util.escapeRegex($(this).val());
              column.search(val ? "^" + val + "$" : "", true, false).draw();
            });

          column
            .data()
            .unique()
            .sort()
            .each(function (d, j) {
              select.append('<option value="' + d + '">' + d + "</option>");
            });
        });
    },
  });
});

// ==============================================

// {
//   initComplete: function () {
//     this.api()
//       .columns([0, 1, 2, 3, 4, 5])
//       .every(function () {
//         var column = this;
//         var select = $(
//           '<select class="form-control"><option value=""></option></select>'
//         )
//           .appendTo($(column.header()).empty())
//           .on("change", function () {
//             var val = $.fn.dataTable.util.escapeRegex($(this).val());
//             column.search(val ? "^" + val + "$" : "", true, false).draw();
//           });

//         column
//           .data()
//           .unique()
//           .sort()
//           .each(function (d, j) {
//             select.append('<option value="' + d + '">' + d + "</option>");
//           });
//       });
//   },
// }

// ==============================================
// {
//   initComplete: function () {
//     this.api()
//       .columns()
//       .every(function () {
//         var column = this;
//         var select = $(
//           '<select class="custom-select custom-select-sm form-control form-control-sm" aria-label="Default select example"><option value=""></option></select>'
//         )
//           .appendTo($(column.header()).empty())
//           .on("change", function () {
//             var val = $.fn.dataTable.util.escapeRegex($(this).val());

//             column.search(val ? "^" + val + "$" : "", true, false).draw();
//           });

//         column
//           .data()
//           .unique()
//           .sort()
//           .each(function (d, j) {
//             select.append('<option value="' + d + '">' + d + "</option>");
//           });
//       });
//   },
// }

// =========================

// {
//   initComplete: function () {
//     this.api()
//       .columns([0, 1, 2, 3, 4, 5])
//       .every(function () {
//         let column = this;

//         // Create select element
//         let select = document.createElement("select");
//         select.add(new Option(""));
//         column.header().replaceChildren(select);

//         // Apply listener for user change in value
//         select.addEventListener("change", function () {
//           column.search(select.value, { exact: true }).draw();
//         });

//         // Add list of options
//         column
//           .data()
//           .unique()
//           .sort()
//           .each(function (d, j) {
//             select.add(new Option(d));
//           });
//       });
//   },
// }
