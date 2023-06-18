// upload image information
function onFileSelected(event) {
  var selectedFile = event.target.files[0];
  var reader = new FileReader();

  var imgtag = document.getElementById("imageUpload");
  imgtag.title = selectedFile.name;

  reader.onload = function(event) {
    imgtag.src = event.target.result;
  };
  reader.readAsDataURL(selectedFile);
}

// select2 image icon
$(document).ready(function() {
  $('#id-phone').select2({
    dropdownParent: $('#add-phone'),
    templateResult: formatState,
    templateSelection: formatState
  });

  $('#id-link').select2({
    dropdownParent: $('#add-link'),
    templateResult: formatState,
    templateSelection: formatState
  });

  $('#id-bank').select2({
    dropdownParent: $('#add-bank'),
    templateResult: formatState,
    templateSelection: formatState
  });

  function formatState(state) {
    if (!state.id) {
        return state.text;
  }
  var imageUrl = $(state.element).data('thumbnail');
  var $state = $('<span><img src="' + imageUrl + '"  style="width: 20px; height: 20px;" /> ' + state.text + '</span>');
  return $state;
  }
});

// Format input code Login
$(document).ready(function() {
  $('#login-code-input').on('input', function(e) {
    var key = e.originalEvent.inputType;
    if (key === 'deleteContentBackward' || key === 'deleteContentForward') {
        return;
    }
    
    var loginCode = $(this).val();
    var formattedCode = loginCode.replace(/[^0-9a-zA-Z]/g, '');

    if (formattedCode.length > 1) {
      formattedCode = formattedCode.replace(/(.{1})/g, '$1-');
    }

    $(this).val(formattedCode.substr(0, 11).toUpperCase());
  }); 
});

// show thông tin icon card trang information
$('.show-preview').on('click', function(e){
  e.preventDefault();
  const content = $(this).data("content"); 
  const type = $(this).data("type"); 
  
  if(type=='bank'){
      $('.infor_name').html('Số tài khoản ngân hàng');
  }
  if(type=='sdt'){
      $('.infor_name').html('Số điện thoại');
  }
  if(type=='link'){
      $('.infor_name').html('Đường dẫn');
  }
  
  $('.icon-content').val(content);
  $('#show_icon_preview').modal('show');
})
