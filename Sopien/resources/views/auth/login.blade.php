@extends('layouts.app')

@section('content')
<!-- Start All Pages -->
<div class="all-page-title page-breadcrumb mb-5">
		<div class="container text-center">
			<div class="row">
				<div class="col-lg-12">
					<h1>Log-in</h1>
				</div>
			</div>
		</div>
</div>
	<!-- End All Pages -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if(Session::get('register'))
            <div class="alert alert-success" role="alert">
                {{Session::get('register')}}
            </div>
            @endif
            
            
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">                                
                                <button  class="btn btn-common" id="submit" type="submit">
                                    {{ __('Login') }}
                                </button>
                                
                                <a href="login/google" class="btn btn-common">Login with Google</a>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-common" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                   
                </div>
                @if(Session::get('deactivated'))
                <div class="alert alert-success" role="alert">
                     {{Session::get('deactivated')}}
                 </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection
