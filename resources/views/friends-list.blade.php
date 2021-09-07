<x-app-layout>
    <x-slot name="header">
        <nav class="navbar">
            <h1>{{ Auth::user()->name }}</h1>
            <div class="links">
                <a href="/">Home</a> | <a href="{{route('post.create')}}">New Post</a> | <a href="{{route('friend-list')}}">Friend List</a>
            </div>
        </nav>
    </x-slot>
    <div class="content">
        @foreach($friendsInfo as $friend)
            <div class="post-preview">
                <h2> {{ $friend->name }} </h2>
                <p> {{ $friend->email  }} </p>
                <input type="button" value="Unfriend" />
            </div>
        @endforeach

            @foreach($users as $user)
                <div class="post-preview">
                    <h2> {{ $user->name }} </h2>
                    <p> {{ $user->email  }} </p>
                    <input type="button" value="Send Friend Request" />
                </div>
            @endforeach
    </div>

</x-app-layout>
