<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Генерация паролей</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<div class="container">
    <div class="password-box">
        <h1>Генератор паролей</h1>

        <form action="{{ route('generate') }}" method="POST">
            @csrf

            <p>
                Количество символов (4-40):
                <input type="number" name="quantity" min="4" max="40" value="{{ old('quantity', 8) }}" required>
                @error('quantity')<span class="error">{{ $message }}</span>@enderror
            </p>

            <p>
                Цифры:
                <select name="complexity">
                    <option value="1" {{ old('complexity') == 1 ? 'selected' : '' }}>Нет</option>
                    <option value="2" {{ old('complexity') == 2 ? 'selected' : '' }}>Да</option>
                </select>
                @error('complexity')<span class="error">{{ $message }}</span>@enderror
            </p>

            <p>
                Спецсимволы:
                Да <input type="radio" name="special" value="1" {{ old('special') == 1 ? 'checked' : '' }}>
                Нет <input type="radio" name="special" value="2" {{ old('special') == 2 || old('special') === null ? 'checked' : '' }}>
                @error('special')<span class="error">{{ $message }}</span>@enderror
            </p>

            <input type="submit" value="Создать пароль">
        </form>

        @if(session('password'))
            <div class="result-box">
                <span id="password">{{ session('password') }}</span>
                <button class="copy-btn" onclick="copyPassword()">Скопировать</button>
            </div>
        @endif

    </div>
</div>

<footer>
    © 2025 Projects of Oleg Vlasov 2025
</footer>

<script>
    function copyPassword() {
        const passwordText = document.getElementById('password').textContent;
        navigator.clipboard.writeText(passwordText).then(() => {
            alert('Пароль скопирован!');
        }).catch(err => {
            alert('Ошибка копирования');
        });
    }
</script>

</body>
</html>
