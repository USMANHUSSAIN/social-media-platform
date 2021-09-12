<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<nav class="navbar">
    <h1>{{ Auth::user()->name }}</h1>
    <div class="links">
        <a href="/">Home</a> | <a href="{{route('my-posts')}}">New Post</a> | <a href="{{route('friend-list')}}">Friend
            List</a>
    </div>
</nav>
