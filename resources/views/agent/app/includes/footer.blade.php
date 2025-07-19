<!-- Bottom Navigation -->
{{-- <nav class="bottom-nav">
    <div class="nav-item active" data-tab="home">
        <div>🏠</div>
        <small><a href="{{ route('agent.home') }}">Home</a></small>
    </div>
    <div class="nav-item" data-tab="buy">
        <div>🛒</div>
        <small><a href="{{ route('agent.buyLeads') }}">Buy</a></small>
    </div>
    <div class="nav-item" data-tab="myleads">
        <div>🔗</div>
        <small>My Leads</small>
    </div>
    <div class="nav-item" data-tab="account">
        <div>👤</div>
        <small>My Account</small>
    </div>
</nav> --}}


<!-- Bottom Navigation -->
<nav class="bottom-nav">
    <div class="nav-item {{ request()->routeIs('agent.home') ? 'active' : '' }}" data-tab="home">
        <a href="{{ route('agent.home') }}">
            <div>🏠</div>
            <small>Home</small>
        </a>
    </div>
    <div class="nav-item {{ request()->routeIs('agent.buyLeads') ? 'active' : '' }}" data-tab="buy">
        <a href="{{ route('agent.buyLeads') }}">
            <div>🛒</div>
            <small>Buy</small>
        </a>
    </div>
    <div class="nav-item {{ request()->routeIs('agent.myLeads') ? 'active' : '' }}" data-tab="myleads">
        <a href="{{ route('agent.myLeads') }}">
            <div>🔗</div>
            <small>My Leads</small>
        </a>
    </div>
    <div class="nav-item {{ request()->routeIs('agent.myAccount') ? 'active' : '' }}" data-tab="account">
        <a href="{{ route('agent.myAccount') }}">
            <div>👤</div>
            <small>My Account</small>
        </a>
    </div>
</nav>
