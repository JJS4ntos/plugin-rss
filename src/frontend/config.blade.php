@extends('index')
@section('content')
<form method="POST" class="form-config">
    <h2>Importação periódica automática</h2>
    @if( $enabled == '1' )
        <div class="notice notice-success inline">
            <p>
                A importação está programada para a próxima {{ $period }} horas.
            </p>
        </div>
    @endif
    <div>
        <label for="period">Hora da importação</label>
        <input type="time" name="period" id="period" value="{{ $period }}" required>
    </div>
    <div>
        <input type="checkbox" name="enable_period" id="enable-auto-import" value="1" {{ $enabled == '1' ? 'checked':'' }}><label for="enable-auto-import">Ativar auto importações diárias</label>
    </div>
    <button type="submit" class="button">Salvar alterações</button>
</form>
@endsection
