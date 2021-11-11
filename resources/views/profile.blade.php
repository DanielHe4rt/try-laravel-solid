@extends('components.template')

@section('title', 'Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <h2 class="text-center m-5"> User Profile</h2>
            <div class="card border-primary">
                <div class="card-header">
                    Information
                </div>
                <div class="card-body">
                    <div class="card-header card-header-icon card-header-rose">
                        <div class="card-avatar text-center">
                            <img id="profile-img" class="img-thumbnail img-profile border-primary" style="border: 1px solid; border-radius: 100%; max-width: 300px; max-height:300px;" src="{{ asset('storage/' . auth()->user()->image_path) }}"><br>
                            <label for="inputProfilePic" class="btn btn-primary mt-4 mb-2" style="top: -45px;">Trocar Avatar</label>
                        </div>
                        <input id="inputProfilePic" type="file" name="image" style="display: none;">
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">{{ __('Main Username') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}" >
                                <small id="emailHelp" class="form-text text-muted">Your main username on this social network</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">{{ __('E-mail') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->email }}">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">{{ __('Github Username') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->github_username ?? 'Not integrated' }}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">{{ __('Github ID') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->github_id ?? 'Not integrated' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">{{ __('Twitch Username') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->twitch_username ?? 'Not integrated' }}" disabled>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label class="bmd-label-floating">{{ __('Twitch ID') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ auth()->user()->twitch_id ?? 'Not integrated' }}" disabled>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('delete-account') }}">
                        @csrf
                        @method('DELETE')
                        <div class="d-grid gap-2 mt-5">
                            <button class="btn btn-danger">Delete Account :(</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $("#inputProfilePic").change(function(e) {
            let reader = new FileReader();
            let documentId = document.getElementById('inputProfilePic');
            let form = new FormData();
            form.append('image', documentId.files[0])
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{ route('update-avatar') }}',
                method: 'POST',
                data: form,
                processData: false,
                contentType: false,
                success: function (response) {
                    reader.onload = function (evt) {
                        $('#profile-img').attr('src', evt.target.result);
                    };
                    reader.readAsDataURL(documentId.files[0]);
                    // toastr.success(response.message);
                },
                error: function (response) {
                    console.log(response);
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        for (let i in errors) {
                            // toastr.error(errors[i]);
                        }
                        return false;
                    }
                    return false;
                }
            })
        })
    </script>

@endsection
