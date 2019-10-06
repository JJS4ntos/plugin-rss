<h2>Configurações pré-definidas para o feed {{ $feed_name }}</h2>
<hr>
<form method="post">
  <div class="input-area">
    <label for="">Categoria</label>
    <select name="category_id" id="category_id" required>
			<option selected="selected" value="">Selecione a categoria</option>
      @foreach( $categories as $cat )
        <option value="{{ $cat->term_id }}" {{ $options['category'] == $cat->term_id? 'selected' : '' }}>{{ $cat->name }}</option>
      @endforeach
		</select>
  </div>
  <div class="input-area">
    <label for="author_id">Autor</label>
    <select name="author_id" id="author_id">
			<option selected="selected" value="">Selecione o autor</option>
      @foreach( $users as $user )
        <option value="{{ $user->ID }}" {{ $options['category'] == $cat->term_id? 'selected' : '' }}>{{ $user->user_email }}</option>
      @endforeach
		</select>
  </div>
  <div class="input-area">
    <label for="">Status</label>
    <select name="status" id="status">
			<option selected="selected" value="">Selecione o status</option>
      <option value="publish" {{ $options['status'] == 'publish'? 'selected' : '' }}>Publicado</option>
      <option value="pending" {{ $options['status'] == 'pending'? 'selected' : '' }}>Pendente</option>
      <option value="private" {{ $options['status'] == 'private'? 'selected' : '' }}>Privado</option>
      <option value="draft" {{ $options['status'] == 'draft'? 'selected' : '' }}>Rascunho</option>
		</select>
  </div>
  <div class="input-area">
    <label for="quantity">Quantidade</label>
    <input name="quantity" type="number" id="quantity" placeholder="Informe a quantidade de posts"
           value="{{ $options['quantity'] }}" class="regular-text">
  </div>
  <input type="hidden" name="period" value="">
  <input type="hidden" name="feed_slug" value="{{ $feed_slug }}">
  <div class="input-area">
    <button class="button button-primary" type="submit">Salvar configurações</button>
  </div>
</form>
