@extends('components.template')

@section('title', 'Dashboard')

@section('content')
    <div class='row justify-content-center mt-3'>
        <div class="col-8">
            <div class="card border-primary">
                <div class="card-header">
                    <h3>Timeline</h3>
                </div>
                <div style="border: 1px solid" class="border-primary"></div>
                <form id="mainForm" class="card-body" method="POST" action="{{ route('new-message') }}">
                    @if($errors->any())
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-1">
                            <img src="{{ asset('storage/' . auth()->user()->image_path) }}" class="img-fluid" alt="" style="border-radius: 100%">
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <textarea name="content" class="form-control" id="exampleTextarea" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="actions mt-2" style="margin-right: 1em">
                            <label class="form-check-label" for="privateMessage">Private Message?</label>
                        </div>
                        <div class="actions mt-2">
                            <div class="form-check form-switch">
                                <input name="is_private" id="privateMessage" class="form-check-input" type="checkbox">
                            </div>
                        </div>
                        <div class="actions" id="usernameDiv" style="display:none;">
                            <div class="form-group">
                                <input name="receiver_username" type="text" class="form-control" id="usernameInput"  placeholder="Enter Github Username">
                            </div>
                        </div>
                        <div class="actions ms-auto">
                            <button type="submit" class="btn btn-primary mr-auto">Publish</button>
                        </div>
                    </div>
                </form>
                @foreach($messages as $message)
                    <div id="timelinePost">
                    <div style="border: 1px solid" class="border-primary"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <img src="{{ asset('storage/' . $message->user->image_path) }}" class="img-fluid" alt="" style="border-radius: 100%">
                            </div>
                            <div class="col">
                                <span class="{{ $message->is_private ? 'text-warning' : 'text-secondary' }}">{{ '@' . $message->user->github_username }} {{ $message->is_private ? ' <> ' . '@' . $message->receiver_username : '' }} </span> - <i> {{ $message->created_at->diffForHumans() }}</i>
                                <p>{{ $message->content }}</p>
                            </div>
                        </div>
                    </div>
                        <div style="border: 1px solid" class="border-primary"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let usernameField = $("#usernameInput")
        let usernameDiv = $("#usernameDiv")
        $(document).ready(function() {
            $("#privateMessage").on('change', function() {
                let input = $(this)
                let prop = input.prop('checked')

                if (prop) {
                    usernameDiv.show()
                } else {
                    usernameDiv.hide()
                }
            });
        });
    </script>
@endsection
