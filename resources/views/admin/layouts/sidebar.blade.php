<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ url()->current() === route('admin') ? 'active' : '' }}"
                   href="{{ route('admin') }}">
                    <i class="fas fa-chart-line"></i>
                    Рабочий стол
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ url()->current() === route('admin.posts.index') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
                    <i class="fas fa-book"></i>
                    Статьи
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ url()->current() === route('admin.news.index') ? 'active' : '' }}" href="{{ route('admin.news.index') }}">
                    <i class="far fa-newspaper"></i>
                    Новости
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ url()->current() === route('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                    <i class="fas fa-users"></i>
                    Пользователи
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ url()->current() === route('admin.callbacks') ? 'active' : '' }}" href="{{ route('admin.callbacks') }}">
                    <i class="fas fa-comment-dots"></i>
                    Заявки
                </a>
            </li>
        </ul>
    </div>
</nav>
