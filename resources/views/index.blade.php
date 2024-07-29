<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- this is the js for the icons -->
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

	<!-- sweetalert2 js -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/index_style.css', 'resources/js/index.js'])
	<title>Sign in & Sign up Form</title>
</head>

<body>
	<div class="container">
		<div class="forms-container">
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

					<select id="user_college" class="input-field @error('user_college') is-invalid @enderror" name="user_college" value="{{ old('user_college') }}" required autofocus>
						<option disabled selected>Select College</option>
					</select>

					<select id="user_course" class="input-field @error('user_course') is-invalid @enderror" name="user_course" value="{{ old('user_course') }}" required autofocus>
						<option disabled selected>Select Program</option>
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

	{{-- <script>
		document.addEventListener("DOMContentLoaded", function() {
			var collegeSelect = document.querySelector('select[name="user_college"]');
			var programSelect = document.querySelector('select[name="user_course"]');
			var programs = {
				"COLLEGE OF EDUCATION": ["BEEd", "BECEd", "BSNEd", "BSEd-Math", "BSEd-Science", "BSEd-Values Ed", "BSEd-English", "BSEd-Filipino", "BTLEd-IA", "BTLEd-HE", "BTLEd-ICT", "BTVTEd-Draft", "BTVTEd-Auto", "BTVTEd-Food", "BTVTEd-Elec", "BTVTEd-Elex", "BTVTEd-GFD", "BTVTEd-WF"],
				"COLLEGE OF ENGINEERING": ["BSCE", "BSCPE", "BSECE", "BSEE", "BSIE", "BSME"],
				"COLLEGE OF TECHNOLOGY": ["BSMx", "BSGD", "BSTechM", "BIT Automotive Technology", "BIT Civil Technology", "BIT Cosmetology", "BIT Drafting Technology", "BIT Electrical Technology", "BIT Electronics Technology", "BIT Food Preparation and Services Technology", "BIT Furniture and Cabinet Making", "BIT Garments Technology", "BIT Interior Design Technology", "BIT Machine Shop Technology", "BIT Power Plant Technology", "BIT Refrigeration and Air-conditioning Technology", "BIT Welding and Fabrication Technology"],
				"COLLEGE OF MANAGEMENT AND ENTREPRENEURSHIP": ["BPA", "BSHM", "BSBA-MM", "BSTM"],
				"COLLEGE OF COMPUTER INFORMATION AND COMMUNICATIONS TECHNOLOGY": ["BSIT", "BSIS", "BIT-CT"],
				"COLLEGE OF ARTS AND SCIENCES": ["BAEL-ECP", "BAEL-ELSD", "BAL–LCS", "BAL–LAP", "BS MATH", "BS STAT", "BSDevCom", "BAF", "BS PSYCH", "Bachelor of Science in Nursing"]
			};

			collegeSelect.addEventListener('change', function() {
				var selectedCollege = this.value;
				programSelect.innerHTML = '<option value="" disabled selected>Select Program</option>'; // Clear previous options
				if (selectedCollege in programs) {
					programs[selectedCollege].forEach(function(program) {
						var option = document.createElement('option');
						option.textContent = program;
						option.value = program;
						programSelect.appendChild(option);
					});
				}
			});
		});
	</script> --}}

	<!-- //Depending on the userPOsition the input feilds for userCollege and userProgram will be hidden -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var positionSelect = document.querySelector('select[name="user_type"]');
			var programSelect = document.querySelector('select[name="user_course"]');
			var collegeSelect = document.querySelector('select[name="user_college"]');

			// Function to hide/show program and college select fields
			function toggleFields() {
				if (positionSelect.value === '2') {
					programSelect.style.display = 'none';
					collegeSelect.style.display = 'block'; // Show college for Dean
				} else if (positionSelect.value === '1') {
					programSelect.style.display = 'none';
					collegeSelect.style.display = 'none'; // Hide both college and program for Admin
				} else {
					programSelect.style.display = 'block';
					collegeSelect.style.display = 'block'; // Show both college and program for other positions
				}
			}

			// Initial toggle based on the default value
			toggleFields();

			// Event listener for userPosition change
			positionSelect.addEventListener('change', toggleFields);
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var positionSelect = document.querySelector('select[name="user_type"]');
			var programSelect = document.querySelector('select[name="user_course"]');
			var collegeSelect = document.querySelector('select[name="user_college"]');

			// Function to hide/show program and college select fields
			function toggleFields() {
				if (positionSelect.value === '3') {
					programSelect.required = true;
					collegeSelect.required = true;
				} else if (positionSelect.value === '2') {
					programSelect.required = false;
					collegeSelect.required = true;
				} else if (positionSelect.value === '1') {
					programSelect.required = false;
					collegeSelect.required = false;
				} else {
					// For other positions, make both fields required
					programSelect.required = true;
					collegeSelect.required = true;
				}
			}

			// Initial toggle based on the default value
			toggleFields();

			// Event listener for userPosition change
			positionSelect.addEventListener('change', toggleFields);
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
			const college = document.querySelector('select[name="user_college"]').value;
			const program = document.querySelector('select[name="user_course"]').value;
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

		// Show success message if it exists
		/* <?php if (isset($_SESSION['success']) && $_SESSION['success']) : ?>
			Swal.fire({
				icon: 'success',
				title: 'Pending for approval',
				showConfirmButton: false,
				timer: 1500
			});
			<?php unset($_SESSION['success']); ?>
		<?php endif; ?> */

		// Show error messages if they exist
		/* <?php if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) : ?>
			const errorMessage = <?php echo json_encode(implode('<br>', $_SESSION['errors'])); ?>;
			Swal.fire({
				icon: 'error',
				html: errorMessage // Use html property to support line breaks
			});
			<?php unset($_SESSION['errors']); ?>
		<?php endif; ?> */
	</script>

</body>

</html>