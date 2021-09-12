<x-app-layout>
    <x-slot name="header">
        @include('navbar')
    </x-slot>

    <div class="content">

        <div>
            <form action="{{ route('post.create') }}" method="post">
                @csrf
                <textarea class="mt-3 w-full" placeholder="Write anything..." name="post_content"></textarea>
                <x-button class="mt-3 2xl:object-center">
                    {{ __('Submit') }}
                </x-button>
            </form>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <br>
        <br>

        @forelse($userPosts as $key => $userPost)
            <div class="post-preview">
                <h2> {{ $userPost->content  }} </h2>
                <p> Written by: {{ $userPost->user()->first()->name  }} </p>
                <form class="comment">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $userPost->id }}">
                    <x-input id="comment_{{ $userPost->id }}" class="block mt-3 w-full " type="text" placeholder="Comment here...." name="comment" autofocus />
                    <x-button class="mt-3 2xl:object-center">
                        {{ __('Add Comment') }}
                    </x-button>
                </form>
                @foreach($postComments as $comment)
                    @if($userPost->id == $comment->post_id)
                        <h1> {{ $comment->user()->first()->name }}: <span style="font-style: italic"> {{ $comment->content }}</span></h1>
                    @endif
                @endforeach
            </div>
        @empty
            <p>No Post to show</p>
        @endforelse
    </div>
</x-app-layout>

<script>

    $('.comment').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/comment/add',
            data: $(this).serialize(),
            success: function(msg) {
                location.reload();
            }
        });
    });

</script>
