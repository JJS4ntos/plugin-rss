$(document).ready(function(){
  /*$('#solicitar-acesso').click(function(){
    $.ajax({
      url: '{{ $url }}' + '/wp-json/acervo-api/solicitar-acesso',
      type: 'POST',
      dataType: 'json',
      data: {
        itemId: '{{ $_GET['id'] }}',
        userId: {{ get_current_user_id() }}
      },
      beforeSend: function( jqXHR, settings ) {
        $('#solicitar-acesso').html('Solicitando...');
      },
      complete: function() {
        alert('Solicitação enviada com sucesso! Aguarde a aprovação do administrador, você receberá um e-mail quando isto acontecer.');
        $('#solicitar-acesso').html('Acesso solicitado');
        $('#solicitar-acesso').attr('disabled', 'true');
      }
    });
  });*/

  $('#colecao').change(function() {
    if( $('#colecao').val() !== '' ) {
      $('#grupo').html('<option value="" selected>Carregando...<option>');
      $.ajax({
        url: 'http://localhost/AppGini/api/group.php?t=123' + '&colecaoId=' + $('#colecao').val(),
        type: 'GET',
        success: function( groups ) {
          var groups = JSON.parse(groups);
          $('#grupo').html('');
          $.each(groups, function(index, grupo) {
            $('#grupo').append($('<option>', {value: grupo.id, text: grupo.grupo}));
          });
        }
      });
    }
  });

  $('#grupo').change(function() {
    if( $('#grupo').val() !== '' ) {
      $('#serie').html('<option value="" selected>Carregando...<option>');
      $.ajax({
        url: 'http://localhost/AppGini/api/serie.php?t=123' + '&grupoId=' + $('#grupo').val(),
        type: 'GET',
        success: function( series ) {
          var series = JSON.parse(series);
          $('#serie').html('');
          $.each(series, function(index, serie) {
            $('#serie').append($('<option>', {value: serie.id, text: serie.serie}));
          });
        }
      });
    }
  });

  $('#favoritar').click(function(){
    $('#favoritar').html('Favoritando...');
    $('#favoritar').attr('disabled', 'true');
    $.ajax({
      url: root + '/wp-json/acervo-api/favoritar-item',
      type: 'POST',
      data: {
        itemId: $('#favoritar').attr('item'),
        userId: $('#favoritar').attr('user')
      },
      success: function(data){
        $('#favoritar').html(data);
      }
    });

  });

  $('#desfavoritar').click(function(){
    $('#desfavoritar').html('Removendo de favoritos...');
    $('#desfavoritar').attr('disabled', 'true');
    $.ajax({
      url: root + '/wp-json/acervo-api/desfavoritar-item',
      type: 'POST',
      data: {
        favoritoId: $('#desfavoritar').attr('favorito')
      },
      success: function(data){
        $('#desfavoritar').html(data);
      }
    });
  });

});
