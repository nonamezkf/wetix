<nav class="nav flex-column">
    @foreach($list AS $row)
        <a class="nav-link @if($row['label'] == $active ) active @endif" href="{{ route($row['route']) }}">
            <i class="icon-menu {{ $row['icon'] }}"></i>
            {{ $row['label'] }}
        </a>
    @endforeach
</nav>
   
