@extends('components.template')

@section('title', 'Dashboard')

@section('content')
    <div class='row justify-content-center'>
        <div class="col-8">
            <div class="card border-primary">
                <div class="card-header">
                    <h3>Timeline</h3>
                </div>
                <div style="border: 1px solid" class="border-primary"></div>
                <div id="mainForm" class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <img src="{{ asset('storage/' . auth()->user()->image_path) }}" class="img-fluid" alt="" style="border-radius: 100%">
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-4">
                        <div class="actions mt-2" style="margin-right: 1em">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Private Message?</label>
                        </div>
                        <div class="actions mt-2">
                            <div class="form-check form-switch">
                                <input id="privateMessage" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                        </div>
                        <div class="actions" id="usernameDiv" style="display:none;">
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" id="usernameInput"  placeholder="Enter Github Username">
                            </div>
                        </div>
                        <div class="actions ms-auto">
                            <button class="btn btn-primary mr-auto">Publish</button>
                        </div>
                    </div>
                </div>
                <div id="timelinePost">
                    <div style="border: 1px solid" class="border-primary"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1">
                                <img src="https://placehold.it/150x150" class="img-fluid" alt="" style="border-radius: 100%">
                            </div>
                            <div class="col">
                                <span class="text-secondary">@danielhe4rt</span> - <i> {{ date('H:i d/m/Y') }}</i>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet consectetur corporis deserunt, dolorum eius et incidunt magnam magni, molestiae nemo, nesciunt placeat quam repudiandae similique tenetur totam ut voluptas. Libero?</p>
                            </div>
                        </div>
                    </div>
                </div>
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
