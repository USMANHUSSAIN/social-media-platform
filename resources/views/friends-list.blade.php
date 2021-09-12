<x-app-layout>
    <x-slot name="header">
        @include('navbar')
    </x-slot>

    <div class="content">

        <table class="table-fixed border-solid border-4 border-light-blue-500">
            <thead>
            <tr>
                <th class="w-1/12 ...">Friends</th>
            </tr>
            </thead>
            <tbody>
            @foreach($friends as $friend)
                <tr>
                    <td>
                        <div class="post-preview">
                            <h6><b>{{ $friend->name }}</b> ({{$friend->email}})</h6>
                            <form action="{{ route('unfriend-request-send') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $friend->id }}">
                                <x-button class="ml-3">
                                    {{ __('Unfriend') }}
                                </x-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <table class="table-fixed border-solid border-4 border-light-blue-500">
            <thead>
            <tr>
                <th class="w-1/12 ...">Users</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="post-preview">
                            <h6><b>{{ $user->name }}</b> ({{$user->email}})</h6>
                            <form action="{{ route('friend-request-send') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <x-button class="ml-3">
                                    {{ __('Send Friend Request') }}
                                </x-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <table class="table-fixed border-solid border-4 border-light-blue-500">
            <thead>
            <tr>
                <th class="w-1/12 ...">Request Received</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requestReceived as $request)
                <tr>
                    <td>
                        <div class="post-preview">
                            <h6><b>{{ $request->name }}</b> ({{$request->email}})</h6>
                            <form action="{{ route('accept-request-send') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $request->id }}">
                                <x-button class="ml-3">
                                    {{ __('Accept Request') }}
                                </x-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <table class="table-fixed border-solid border-4 border-light-blue-500">
            <thead>
            <tr>
                <th class="w-1/12 ...">Request Sent</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requestSent as $request)
                <tr>
                    <td>
                        <div class="post-preview">
                            <h6><b>{{ $request->name }}</b> ({{$request->email}})</h6>
                            <form action="{{ route('remove-request-send') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $request->id }}">
                                <x-button class="ml-3">
                                    {{ __('Remove Request') }}
                                </x-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
