@php
    $generalSetting = \App\Models\Setting::first();

@endphp
<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>{{ $generalSetting->title }} </title>
		<meta name="description" content="{{$generalSetting->description}}" />
		<meta name="keywords" content="{{$generalSetting->keywords}}"/>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="" />

		<meta property="og:site_name" content="Keenthemes | Metronic" />
		<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
		<link rel="shortcut icon" href="{{asset($generalSetting->favicon)}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('backend/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('backend/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					<a href="#" class="mb-12">
						<img alt="Logo" src="{{ asset($generalSetting->logo)}}" style="width: 350px; height: 300px;" />


					</a>
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                        @if ($errors->any())
    <div style="color: red;">
        <strong>Login failed:</strong> {{ $errors->first() }}
    </div>
@endif
                        @error('name')
    <div style="color: red;">{{ $message }}</div>
@enderror

@error('password')
    <div style="color: red;">{{ $message }}</div>
@enderror
						<!--begin::Form-->
						<form class="form w-100" novalidate="novalidate" method="POST" id="kt_sign_in_form" action="{{ route('login') }}">
                            @csrf
							<!--begin::Heading-->
							<div class="text-center mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Sign In </h1>

							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Label-->
								<label class="form-label fs-6 fw-bolder text-dark">username</label>
								<!--end::Label-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="text" name="username" autocomplete="off" />

                                <span class="text-danger">{{ $errors->first('username') }}</span>
								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-10">
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack mb-2">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>

									<!--end::Label-->

								</div>
								<!--end::Wrapper-->
								<!--begin::Input-->
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" />
                                <span class="text-danger"> {{ $errors->first('password') }}</span>

								<!--end::Input-->
							</div>
							<!--end::Input group-->
							<!--begin::Actions-->
							<div class="text-center">
								<!--begin::Submit button-->
								<button type="submit" id="" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Continue</span>

								</button>

							</div>
							<!--end::Actions-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>

			</div>

		</div>
		<!--end::Main-->
		<script></script>

		<script src="{{asset('backend/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('backend/assets/js/scripts.bundle.js')}}"></script>

		<script src="{{asset('backend/assets/js/custom/authentication/sign-in/general.js')}}"></script>

	</body>
	<!--end::Body-->
</html>