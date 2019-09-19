<li class="nav-item">
    <a class="nav-link {{ Request::is('/admin/insiders*') ? 'active' : '' }}" href="#navbar-insiders" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
        <i class="ni ni-single-copy-04 text-primary"></i>
        <span class="nav-link-text">Insiders</span>
    </a>
    <div class="collapse {{ Request::is('/admin/insiders*') ? 'show' : '' }}" id="navbar-insiders">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="/admin/insiders/create" class="nav-link">Add</a>
            </li>
            <li class="nav-item">
                <a href="/admin/insiders" class="nav-link">Manage</a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('/admin/criminals*') ? 'active' : '' }}" href="#navbar-criminals" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
        <i class="ni ni-single-copy-04 text-primary"></i>
        <span class="nav-link-text">Criminals</span>
    </a>
    <div class="collapse {{ Request::is('/admin/criminals*') ? 'show' : '' }}" id="navbar-criminals">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="/admin/criminals/create" class="nav-link">Add</a>
            </li>
            <li class="nav-item">
                <a href="/admin/criminals" class="nav-link">Manage</a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link {{ Request::is('/news-feed*') ? 'active' : '' }}" href="#navbar-news-feed" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
        <i class="ni ni-single-copy-04 text-primary"></i>
        <span class="nav-link-text">News</span>
    </a>
    <div class="collapse {{ Request::is('/news-feed*') ? 'show' : '' }}" id="navbar-news-feed">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="/news-feed/create" class="nav-link">Publish</a>
            </li>
            <li class="nav-item">
                <a href="/news-feed" class="nav-link">Manage</a>
            </li>
        </ul>
    </div>
</li>

