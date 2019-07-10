<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">My Task List</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
    <div class="collapse navbar-collapse pl-4" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ (Request::is('/')  ? 'active' : '') }}">
                <a class="nav-link" href="/">Tasks</a>
            </li>
        <li class="nav-item">
                <a class="nav-link {{ (Request::is('tags')  ? 'active' : '') }}" href="/tags">Tags </a>
            </li>
        </ul>
    </div>
</nav>