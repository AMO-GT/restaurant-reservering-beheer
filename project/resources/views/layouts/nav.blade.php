<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary);">
    <div class="container">
        <span class="navbar-brand">Restaurant</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kitchen.index') ? 'active' : '' }}" href="{{ route('kitchen.index') }}">
                        <i class="fas fa-utensils me-2"></i>Keuken
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('bar.index') ? 'active' : '' }}" href="{{ route('bar.index') }}">
                        <i class="fas fa-glass-cheers me-2"></i>Bar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kassa.index') || request()->routeIs('kassa.history') ? 'active' : '' }}" href="{{ route('kassa.index') }}">
                        <i class="fas fa-cash-register me-2"></i>Kassa
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav> 