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
        <div class="post-preview">
            <h2> Post Title </h2>
            <p> Written by: Usman </p>
            <button>Review post</button>
        </div>
    </div>
</x-app-layout>
