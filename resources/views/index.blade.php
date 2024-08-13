<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- this is the js for the icons -->
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

	<!-- sweetalert2 js -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css','resources/css/index_style.css', 'resources/js/app.js', 'resources/js/index.js',])
	<title>Sign in & Sign up Form</title>
</head>

<body>
	<div class="container">
		<div class="forms-container">
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="mb-0">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="signin-signup">
				<!-- Sign IN form -->
				<form method="POST" class="sign-in-form" action="{{ route('login') }}" id="signin-form">
                    @csrf
					<img src="{{ Vite::asset('resources/img/login_logo.png') }}" alt="" width="300">
					<h2 class="title">Sign in</h2>

					<div class="input-field">
						<i class="fas fa-envelope"></i>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
					</div>

					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
					</div>

                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

					<input type="submit" value="Login" class="btn solid" name="login" />

				</form>

				<!-- Sign UP form -->
				<form class="sign-up-form" method="POST" action="{{ route('register') }}" id="signup-form">
                    @csrf
					<h2 class="title">Sign up</h2>

					<div class="input-field">
						<i class="fas fa-user"></i>
						<input id="employee_id" type="text" class="form-control @error('employee_id') is-invalid @enderror" placeholder="Employee ID" name="employee_id" value="{{ old('employee_id') }}" required autocomplete="employee_id" autofocus>
					</div>

					<div class="input-field">
						<i class="fas fa-user"></i>
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
					</div>

					<div class="input-field">
						<i class="fas fa-user"></i>
                        <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Middle Name" name="middle_name" value="{{ old('middle_name') }}" required autocomplete="middle_name" autofocus>

					</div>

					<div class="input-field">
						<i class="fas fa-user"></i>
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
					</div>

					<div class="input-field">
						<i class="fas fa-envelope"></i>
                        <input id="reg_email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="reg_email" value="{{ old('reg_email') }}" required autocomplete="email">
					</div>


					<select id="user_type" class="input-field @error('user_type') is-invalid @enderror" name="user_type" value="{{ old('user_type') }}" required autofocus>
						<option disabled selected>Select School Position</option>
						<option value="1">Admin</option>
						<option value="2">Dean</option>
						<option value="3">Chairperson</option>
					</select>

					<select id="college_id" class="input-field @error('college_id') is-invalid @enderror" name="college_id" value="{{ old('college_id') }}" required autofocus>
						<option disabled selected>Select a College</option>
					</select>

					<select id="course_id" class="input-field @error('course_id') is-invalid @enderror" name="course_id" value="{{ old('course_id') }}" required autofocus disabled>
						<option disabled selected>Select a Course</option>
					</select>

					<div class="input-field">
						<i class="fas fa-lock"></i>
                        <input id="reg_password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="reg_password" required autocomplete="new-password">
					</div>

					<div class="input-field">
						<i class="fas fa-lock"></i>
                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
					</div>

					<input type="submit" class="btn" value="Sign up" name="submit" id="submit-form" onclick="return validateSignUpForm(event)" />
				</form>
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>New here ?</h3>
					<p>
						Click the button below and join Schedulemate!
					</p>
					<button class="btn transparent" id="sign-up-btn">
						Sign up
					</button>
				</div>
				<img src="https://i.ibb.co/6HXL6q1/Privacy-policy-rafiki.png" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>One of us ?</h3>
					<p>
						Welcome back to Schedulemate! Click the button below
					</p>
					<button class="btn transparent" id="sign-in-btn">
						Sign in
					</button>
				</div>
				<img src="https://i.ibb.co/nP8H853/Mobile-login-rafiki.png" class="image" alt="" />
			</div>
		</div>
	</div>

	<!-- //Depending on the userPOsition the input feilds for userCollege and userProgram will be hidden -->
	<script type="module">
		$(document).ready(function() {
			var $positionSelect = $('#user_type');
			var $programSelect = $('#course_id');
			var $collegeSelect = $('#college_id');
	
			// Function to hide/show program and college select fields
			function toggleFields() {
				if ($positionSelect.val() === '2') {
					$programSelect.hide();
					$collegeSelect.show(); // Show college for Dean
				} else if ($positionSelect.val() === '1') {
					$programSelect.hide();
					$collegeSelect.hide(); // Hide both college and program for Admin
				} else {
					$programSelect.show();
					$collegeSelect.show(); // Show both college and program for other positions
				}
			}
	
			// Initial toggle based on the default value
			toggleFields();
	
			// Event listener for userPosition change
			$positionSelect.change(toggleFields);
		});
	</script>

	<script type="module">
		$(document).ready(function() {
			var $positionSelect = $('select[name="user_type"]');
			var $programSelect = $('select[name="course_id"]');
			var $collegeSelect = $('select[name="college_id"]');

			// Function to hide/show program and college select fields
			function toggleFields() {
				if ($positionSelect.val() === '3') {
					$programSelect.prop('required', true);
					$collegeSelect.prop('required', true);
				} else if ($positionSelect.val() === '2') {
					$programSelect.prop('required', false);
					$collegeSelect.prop('required', true);
				} else if ($positionSelect.val() === '1') {
					$programSelect.prop('required', false);
					$collegeSelect.prop('required', false);
				} else {
					// For other positions, make both fields required
					$programSelect.prop('required', true);
					$collegeSelect.prop('required', true);
				}
			}

			// Initial toggle based on the default value
			toggleFields();

			// Event listener for userPosition change
			$positionSelect.change(toggleFields);
		});
	</script>

	{{-- Select 2 Option --}}
	<script type="module">
		/* $(document).ready(function () {
			$('#user_college').select2({
				minimumResultsForSearch: Infinity,
				ajax: {
					url: 'college/collegeList',
					dataType: 'json',
					processResults: function (data) {
					return {
						results: data.map(function (college) {
								return {
									id: college.id,
									text: college.full_name
								};
							})
						};
					}
				}
			});
		}); */
	</script>

	<script type="module">
		$(document).ready(function () {
			$.ajax({
				url: '/college/collegeList/',
				type: 'GET',
				success: function(response) {
					var $select = $('#college_id');
					$select.empty(); // Clear existing options
					$select.append('<option value="" disabled selected>Select a College</option>'); // Add default option
					$.each(response, function(index, college) {
						$select.append($('<option>', {
							value: college.id,
							text: college.full_name
						}));
					});
				}
			});

			$('#college_id').on('change', function() {
                var selectedValue = $(this).val();
                var selectedText = $(this).find("option:selected").text();

				if (selectedValue == 0) {
                    $('#course_id').prop('disabled', true);
                } else {
                    $('#course_id').prop('disabled', false);
					$.ajax({
					url: '/course/courseList',
					type: 'GET',
					success: function(response) {
							var $select = $('#course_id');
							var college_id = $('#college_id').val();
							$select.empty(); // Clear existing options
							$select.append('<option value="" disabled selected>Select a Course</option>'); // Add default option
							$.each(response, function(index, college) {
								if (selectedValue == college.college_id) {
									$select.append($('<option>', {
									value: college.id,
									text: college.full_name
									}));
								}
							});
						}
					});
				}

				$('#course_id').on('change', function() {
					var selectedValue = $(this).val();
					var selectedText = $(this).find("option:selected").text();
				});
            });
		});
	</script>

	<script type="module">
		$(document).ready(function () {
			
		});
	</script>

	<!-- IF there is an error when signing UP the data inputted will remain -->
	<script>
		document.getElementById('signup-form').addEventListener('submit', function(event) {
			// Call the validation function
			validateSignUpForm(event);
		});

		// Form validation function
		function validateSignUpForm(event) {
			const employeeID = document.querySelector('input[name="employee_id"]').value.trim();
			const firstName = document.querySelector('input[name="first_name"]').value.trim();
			const middleName = document.querySelector('input[name="middle_name"]').value.trim();
			const lastName = document.querySelector('input[name="last_name"]').value.trim();
			const email = document.querySelector('input[name="reg_email"]').value.trim();
			const position = document.querySelector('select[name="user_type"]').value;
			const college = document.querySelector('select[name="college_id"]').value;
			const program = document.querySelector('select[name="course_id"]').value;
			const password = document.querySelector('input[name="reg_password"]').value.trim();
			const passwordConfirm = document.querySelector('input[name="password_confirmation"]').value.trim();

			let errors = [];

			if (!employeeID) {
				errors.push('Employee ID is required.');
			}

			if (!firstName) {
				errors.push('First Name is required.');
			}

			if (!middleName) {
				errors.push('Middle Name is required.');
			}

			if (!lastName) {
				errors.push('Last Name is required.');
			}

			if (!email) {
				errors.push('Email is required.');
			} else if (!validateEmail(email)) {
				errors.push('Please enter a valid email address.');
			}

			if (!position) {
				errors.push('Position is required.');
			}
			if (position == '2' || position == '3') {
				if (!college) {
					errors.push('College is required.');
				}
				if (position == '3') {
					if (!program) {
						errors.push('Program is required.');
					}
				}
			}

			if (!password) {
				errors.push('Password is required.');
			} else if (password.length < 6) {
				errors.push('Password must be at least 6 characters long.');
			}

			if (password !== passwordConfirm) {
				errors.push('Passwords do not match.');
			}

			if (errors.length > 0) {
				event.preventDefault(); // Prevent form submission

				// Combine all error messages into one string
				const errorMessage = errors.join('<br>');

				// Display errors using SweetAlert2 toast
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 5000,
					timerProgressBar: true,
					didOpen: (toast) => {
						toast.addEventListener('mouseenter', Swal.stopTimer);
						toast.addEventListener('mouseleave', Swal.resumeTimer);
					}
				});

				Toast.fire({
					icon: 'error',
					html: errorMessage // Use html property to support line breaks
				});
			}
		}

		// Email validation function
		function validateEmail(email) {
			const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			return re.test(email);
		}

	</script>

</body>

</html>