<x-app-layout>
    <x-slot name="header">
        <nav class="navbar">
            <h1>{{ Auth::user()->name }}</h1>
            <div class="links">
                <a href="/">Home</a> | <a href="">Admin Stats</a>
            </div>
        </nav>
    </x-slot>
    <div class="content">
        <div class="post-preview">
            <h2> User's List </h2>
            <ul>
            <li> User 1 </li>
            <li> User 2 </li>
            <li> User 3 </li>
            <li> User 4 </li>
            <li> User 5 </li>
            </ul>
            <button>Review Details</button>
        </div>
    </div>
</x-app-layout>
