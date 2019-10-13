@extends('index')
@section('content')
  <h2>Faça importações ou configure importações periódicas</h2>
  <hr>
  <div class="errors-warning">
    <p>Aguardando inicio da importação...</p>
  </div>
  <p class="status-importation"></p>
  <button type="button" class="button button-primary button-hero" id="import_content">Importar conteúdos</button>
  <script type="text/javascript" defer>
    var total_items = 0;
    function addPost(content, feed) {
      if( content.title.length > 0 && content.description === undefined ) {
        if( content['content:encoded'] !== undefined ) {
          content.description = content['content:encoded'];
        } else {
          $('.errors-warning').html($('.errors-warning').html() +
            '<div class="notice notice-error is-dismissible"><p>"<b>' + content.title + '</b>" não foi inserido, pois já existe.</p></div>'
          );
          return;
        }
      }
      $.ajax({
        url: '{{ get_rest_url(null, "rss-importer-wk-api/create-post") }}',
        type: 'POST',
        data: {
          title: content.title,
          content: content.description,
          guid: content.guid,
          pubDate: content.pubDate,
          feed: feed
        },
        complete: function(data) {
          total_items -= 1;
          if(data.responseText !== null) {
            $('.errors-warning').html( $('.errors-warning').html() + data.responseText );
          }
          if( total_items === 0 ) {
            $('.status-importation').html(
              '<div><span class="dashicons dashicons-yes"></span> Dados obtidos</div>' +
              '<div><span class="dashicons dashicons-yes"></span> Convertido para o formato do site</div>' +
              '<div><span class="dashicons dashicons-yes"></span> Postagens criadas com sucesso!</div>'
            );
            $('#import_content').removeAttr('disabled');
            $('#import_content').html('Carregar RSS novamente');
          }
        }
      });
    }

    $(document).ready(function(){
      $('#import_content').click(function(){
        $(this).html('Carregando...');
          $(this).attr('disabled', 'true');
        $.ajax({
          url: '{{ get_rest_url(null, "rss-importer-wk-api/quantities") }}',
          type: 'GET',
        }).done(function(quantities){
          quantities = JSON.parse(quantities);
          $('.status-importation').html(
            '<div><span class="spinner is-active"></span> Iniciando a importação...</div>'
          );

          $.ajax({
            url: '{{ get_rest_url(null, "rss-importer-wk-api/sync") }}',
            type: 'POST',
            data: {request: 1}
          }).done(function(response){
            $('.status-importation').html(
              '<div><span class="dashicons dashicons-yes"></span> Dados obtidos</div>'+
              '<div><span class="spinner is-active"></span> Convertendo para o formato do site...</div>'
            );
            var agb = [], arp = [], investing = [];
            
            if(response.arp.length > 0) {
              arp = JSON.parse(response.arp);
            }
            
            if(response.agb.length > 0) {
              agb = JSON.parse(response.agb);
            }
            
            if(response.investing.length > 0) {
              investing = JSON.parse(response.investing);
            }

            total_items = investing.length + agb.length + arp.length;
            
            $('.status-importation').html(
              '<div><span class="dashicons dashicons-yes"></span> Dados obtidos</div>' +
              '<div><span class="dashicons dashicons-yes"></span> Convertido para o formato do site</div>' +
              '<div><span class="spinner is-active"></span> Criando postagens...</div>'
            );
            for( item in agb ) {
              if(quantities.quantity_agb > 0) {
                addPost(agb[item], 'agb');
                quantities.quantity_agb -= 1;
              }
            }
            /*for( item in arp ) {
              if(periods.period_arp > 0) {
                addPost(arp[item], 'arp');
                periods.period_arp -= 1;
              }
            }
            for( item in investing ) {
              if(periods.period_investing > 0) {
                addPost(investing[item], 'investing');
                periods.period_investing -= 1;
              }
            }*/
          });
        });
        
      });
    });
  </script>
@endsection
