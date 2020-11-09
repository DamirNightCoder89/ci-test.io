$(document).ready(function(){
  
    $(".phone").mask("+7 (999) 999-9999");
 
 

 
  });

  function addField () {
    var telnum = parseInt($('#add_field_area').find('div.add:last').attr('id').slice(3))+1;
    $('div#add_field_area').append('<div id="add'+telnum+'" class="add"><input type="text" width="120" class="form-control phone-control phone" name="phone[]" id="val" onblur="writeFieldsVlues();" placeholder="+7 (999) 999-99-99" value=""/><div class="deletebutton" onclick="deleteField('+telnum+');"> X</div></div>');
    $(".phone").mask("+7 (999) 999-99-99");
  }
  
  function deleteField (id) {
    $('div#add'+id).remove();
    writeFieldsVlues();
  }
  
  function writeFieldsVlues () {
    var str = [];
    var tel = '';
    for(var i = 0; i<$("input#val").length; i++) {
      tel = $($("input#val")[i]).val();
      if (tel !== '') {
        str.push($($("input#val")[i]).val());
      }
     }
    $("input#values").val(str.join("|"));
  }