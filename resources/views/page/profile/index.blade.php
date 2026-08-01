@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>

            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ Auth::user()->name }}</h2>
                <p class="section-lead">
                    Ubah Informasi Mengenai Diri Kamu!
                </p>

                <div class="row mt-sm-4">

                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" action="{{ route('profile.update', Auth::user()->id) }}"
                                enctype="multipart/form-data" class="needs-validation" novalidate="">
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="old_image" value="{{ $profile->poto }}">
                                        <div class="form-group col-md-12 col-12">
                                            <img alt="image" id="showImage"
                                                src="{{ !empty(Auth::user()->poto) ? asset('upload/profile/' . Auth::user()->poto) : asset('upload/avatar-1.png') }}"
                                                alt="Profile Picture" class="rounded-circle profile-widget-picture"
                                                width="100">

                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Take Foto</label>
                                            <input type="file" class="form-control" id="image" name="poto"
                                                value="{{ $profile->poto }}">

                                        </div>
                                        <div class="form-group col-md-12 col-12">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $profile->name }}" required="">
                                            {{-- <div class="invalid-feedback">
                                                {{ $profile->nama }}
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $profile->email }}" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the email
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                value="{{ $profile->password }}" required="">
                                            <div class="invalid-feedback">
                                                Please fill in the password
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(

                function(e) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#showImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
        });
    </script>
@endsection
