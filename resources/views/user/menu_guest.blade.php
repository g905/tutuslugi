<div class="user-cabinet-menu">

    <ul>
        <li class="@if(Route::current()->getName() == 'user.login') active @endif"><a href="{{ route('user.login') }}/"><i>

                </i>Войти</a></li>
        <li class="@if(Route::current()->getName() == 'user.registration') active @endif"><a href="{{ route('user.registration') }}/"><i>

                </i>Регистрация</a></li>
    </ul>
</div>
