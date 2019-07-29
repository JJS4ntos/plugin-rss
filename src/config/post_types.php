<?php

  function register_posts() {
    register_post_type( 'solicitacao', array(
        'public'    => true,
        'label'     => __('Solicitações', 'textdomain'),
        'menu_icon' => 'dashicons-book',
      )
    );
    register_post_type( 'favorito', array(
        'public'    => true,
        'label'     => __('Favoritos', 'textdomain'),
        'menu_icon' => 'dashicons-book',
      )
    );
  }

  function after_solicitacao_saved($meta_id, $post_id, $meta_key='', $meta_value=''){
      // Stop if not the correct meta key
      if ( $meta_key != 'aprovado') {
          return false;
      }
      if( $meta_value == true ) {
        //$email = get_option('admin_email');
        $post = get_post($post_id);
        $user = get_user_by( 'ID', get_field('usuario', $post_id) );
        $url = get_bloginfo('url');
        $id = base64_encode( get_field('identificacao_item', $post_id) );
        wp_mail( $user->user_email, $post->post_title,
          "
            Olá, a sua solicitação de download foi autorizada. Para realizar o download basta acessar o endereço:
            {$url}/download/?item={$id}
            Lembre-se de estar logado na sua conta quando fizer isto.
          "
        );
      }

  }

  add_action( 'init', 'register_posts' );
  add_action( "updated_post_meta", 'after_solicitacao_saved', 10, 4 );
