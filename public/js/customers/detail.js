// mengatur tingging iframe
const height = $(window).height() * 0.92;
$('iframe').css('height', height + 'px');

// menghapus data customer
function deleteCust(code) {
  $('input[name="_method"]').val('DELETE')
  let formData = $('#customer-detail').serialize()
  $.ajax({
    url: `/customer/${code}`,
    method: 'POST',
    data: formData,
    success: function (data) {
      parent.closeModal();
    },
    error: function (error) {
      console.log(error);
    }
  })
}

// menampilkan modal tambah kontak
function addContactModal() {
  $('#modal-add-contact').modal('show')
}

// menutup modal ketika mengklik tombol close
$('#close').on('click', function () {
  $('#modal-add-contact').modal('hide')
})

// tambah baris email
function addRowEmail() {
  let newIndex = $('.row-email').last().data('rowemail') + 1

  $(`.row-email`).last().after(
    `
        <div class="row mt-3 row-email" id="row-email-${newIndex}" data-rowemail="${newIndex}">
          <div class="col">
            <input type="text" class="form-control" placeholder="Email" name="email[]">
          </div>
          <div class="col-3">
            <span class="badge bg-success add-btn mt-2" onclick="addRowEmail(${newIndex})">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                <path
                  d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                <path
                  d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
              </svg>
            </span>

            <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail(${newIndex})">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                <path
                  d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                <path
                  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
              </svg>
            </span>
          </div>
        </div>
        `
  )
}

// menghapus input email
function deleteRowEmail(index) {
  $(`#row-email-${index}`).remove()
}

// tambah baris nomor telpon
function addRowPhone() {
  let newIndex = $('.row-phone').last().data('rowphone') + 1

  $('.row-phone').last().after(
    `
        <div class="row mt-3 row-phone" id="row-phone-${newIndex}" data-rowphone="${newIndex}">
        <div class="col">
          <input type="text" class="form-control" placeholder="Nomor telpon" name="phone[]">
        </div>
        <div class="col-3">
          <span class="badge bg-success add-btn mt-2" onclick="addRowPhone()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
          </span>

          <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone(${newIndex})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-x-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
          </span>
        </div>
      </div>
        `
  )
}

// menghapus baris input nomor telpon
function deleteRowPhone(index) {
  $(`#row-phone-${index}`).remove()
}

// menyimpan data kontak
function addContact() {
  let formData = $('#new-contact').serialize()

  console.log(formData);
  $.ajax({
    url: `/customer/contact/create`,
    method: 'POST',
    data: formData,
    success: function (data) {
      console.log(data);
    },
    error: function (error) {
      console.log(error);
    }
  })
}