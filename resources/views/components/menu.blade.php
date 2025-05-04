<nav class="nav flex-column">
    @foreach($list AS $row)
        <a class="nav-link" href="">
            {{ $row['label'] }}
        </a>
    @endforeach
</nav>
   
