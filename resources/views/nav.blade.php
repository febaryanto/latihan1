<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><b>Partai Laravel Perjuangan</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bstarget="#navbarNav" aria-controls="navbarNav" aria-expanded="false" arialabel="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="{{route('user.index')}}">Kelola Pengguna</a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('frm-logout').submit();" class="nav-link active">Keluar </a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>