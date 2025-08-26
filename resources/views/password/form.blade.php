
    <title>
        Генерация пароля
    </title>

<form action="{{ route('generate') }}" method="POST">

    @csrf
    <p>Введите количество символов(от 4 до 40) <input type="text" name="quantity" min="4" max="40" value="{{ old('quantity', 4) }}" required>
        @error('quantity')
        <span style="color:red;">{{ $message }}</span>
        @enderror</p>
    <p>Выберите сложность пароля
    <select name="complexity">
        <option value="1" {{ old('complexity') == 1 ? 'selected' : '' }}>Простой</option>
        <option value="2" {{ old('complexity') == 2 ? 'selected' : '' }}>Сложный</option>
    </select>
        @error('complexity')
        <span style="color:red;">{{ $message }}</span>
        @enderror</p>
    <p>Добавить специальные символы
    Да <input type="radio" name="special" value="1" {{ old('special') == 1 ? 'checked' : '' }}>
        Нет <input type="radio" name="special" value="2" {{ old('special') == 2 ? 'checked' : '' }}>
        @error('special')
        <span style="color:red;">{{ $message }}</span>
        @enderror</p>
    <input type="submit" value="Создать пароль">
</form>

    @if(session('password'))
        <h1>{{session('password')}}</h1>
    @endif

