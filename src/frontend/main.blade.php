@extends('index')
@section('content')
  <h2>Faça importações ou configure importações periódicas</h2>
  <hr>
  <div class="errors-warning">
  </div>
  <p class="status-importation"></p>
  <button type="button" class="button button-primary button-hero" id="import_content">Importar conteúdos</button>
  <script type="text/javascript" defer>
    function addPostAGB(content) {
      $.ajax({
        url: '{{ get_rest_url(null, "rss-importer-wk-api/create-post") }}',
        type: 'POST',
        data: {
          title: content.title,
          content: content.description,
          guid: content.guid,
          feed: 'agb'
        },
        complete: function(data) {
          console.log(data);
          $('.errors-warning').html( $('.errors-warning').html() + data.responseText );
        }
      });
    }

    $(document).ready(function(){
      $('#import_content').click(function(){
        $('.status-importation').html(
          '<div><span class="spinner is-active"></span> Iniciando a importação...</div>'
        );
        $(this).html('Carregando...');
        $(this).attr('disabled', 'true');
        $.ajax({
          url: '{{ get_rest_url(null, "rss-importer-wk-api/sync") }}',
          type: 'POST',
          data: {request: 1}
        }).done(function(response){
          var r = JSON.parse(response);
          $('.status-importation').html(
            '<div><span class="dashicons dashicons-yes"></span> Dados obtidos</div>'+
            '<div><span class="spinner is-active"></span> Criando postagens...</div>'
          );
          if( r.agb !== null ) {
            for (var agb_post in r.agb.channel.item) {
              addPostAGB( r.agb.channel.item[agb_post]);
            }
          }
        })
      });
    });
  </script>
@endsection
