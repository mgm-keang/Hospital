<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Registration Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #4a90e2 0%, #2c5aa0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .registration-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            transform: scale(0.9);
            animation: slideIn 0.5s ease-out forwards;
        }

        @keyframes slideIn {
            to {
                transform: scale(1);
            }
        }

        .registration-header {
            text-align: center;
            margin-bottom: 5px;
        }

        .registration-header::before {
            content: '🏥';
            font-size: 3rem;
            display: block;
            margin-bottom: 5px;
        }

        .registration-header h1 {
            color: #2c5aa0;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .registration-header .subtitle {
            color: #4a90e2;
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 5px;
        }

        .registration-header p {
            color: #666;
            font-size: 0.9rem;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 5px;
        }

        .form-row1 {
            /* display: flex; */
            /* gap: 15px;
            margin-bottom: 5px; */
        }

        .form-group {
            margin-bottom: 5px;
            position: relative;
            flex: 1;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e1e1;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e1e1;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            cursor: pointer;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: #aaa;
            transition: opacity 0.3s ease;
        }

        .form-input:focus::placeholder {
            opacity: 0;
        }

        .form-label {
            position: absolute;
            left: 20px;
            top: 15px;
            color: #aaa;
            font-size: 1rem;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-input:focus+.form-label,
        .form-input:not(:placeholder-shown)+.form-label,
        .form-select:focus+.form-label,
        .form-select:not([value=""])+.form-label {
            top: -10px;
            left: 15px;
            font-size: 0.8rem;
            color: #4a90e2;
            background: white;
            padding: 0 5px;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #4a90e2;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            gap: 10px;
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            accent-color: #4a90e2;
        }

        .checkbox-label {
            color: #666;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .checkbox-label a {
            color: #4a90e2;
            text-decoration: none;
        }

        .checkbox-label a:hover {
            text-decoration: underline;
        }

        .register-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #4a90e2 0%, #2c5aa0 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .register-btn1 {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #4a90e2 0%, #2c5aa0 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            /* cursor: pointer;
            transition: all 0.3s ease;
            position: relative; */
            /* overflow: hidden; */
            margin-bottom: 50px;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(74, 144, 226, 0.3);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #2c5aa0;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.8rem;
            margin-top: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .error-message.show {
            opacity: 1;
        }

        .success-message {
            color: #27ae60;
            font-size: 0.8rem;
            margin-top: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .success-message.show {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .registration-container {
                padding: 30px 20px;
            }

            .registration-header h1 {
                font-size: 1.6rem;
            }
        }

        /* .register-btn2{
            padding: 20px;
            margin-bottom:10px;
            border: solid 1px;
        }
        /* .register-btn1{
            padding: 20px;
            margin-bottom:60px;
            border: solid 1px;
        } */
        .social-login-row {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 25px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .google-btn {
            background-color: #ffffff;
            color: #333;
            border: 1px solid #ddd;
        }

        .google-btn:hover {
            background-color: #f1f1f1;
        }

        .facebook-btn {
            background-color: #1877f2;
            color: #fff;
        }

        .facebook-btn:hover {
            background-color: #0d6efd;
        }

        .social-icon {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body>
    <div class="registration-container">
        <div class="registration-header">
            <h1>MedCare Portal</h1>
            <div class="subtitle">Patient Registration</div>
            <p style="margin-bottom:15px;">Create your account to access our healthcare services</p>
        </div>

        <form id="registrationForm" novalidate action="{{ route('user.store') }}" method="POST">
            @csrf

            <!-- Email -->
            <!-- User Name -->
            <div class="form-group">
                <input type="text" id="username" name="username" class="form-input" placeholder=" " required>
                <label for="username" class="form-label">User Name</label>
                <div class="error-message" id="user_nameError">Please enter your user name</div>
            </div>



            <!-- Phone & Role -->
            <div class="form-row">
                <div class="form-group">
                    <input type="tel" id="phone_number" name="phone_number" class="form-input" placeholder=" "
                        required>
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <div class="error-message" id="phoneError">Please enter a valid phone number</div>
                </div>

                <div class="form-group">
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Select Role</option>
                        <option value="doctor">Doctor</option>
                        <option value="admin">Admin</option>
                        <option value="patient">Patient</option>
                    </select>
                    <label for="role" class="form-label">Role</label>
                    <div class="error-message" id="roleError">Please select your role</div>
                </div>
            </div>

            <!-- Passwords -->
            <div class="form-row">
                <div class="form-group">
                    <input name="password" type="password" id="password" class="form-input" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                    <button type="button" class="password-toggle" id="passwordToggle">👁</button>
                    <div class="error-message" id="passwordError">Password must be at least 8 characters</div>
                </div>

                <div class="form-group">
                    <input name="password_confirmation" type="password" id="confirmPassword" class="form-input"
                        placeholder=" " required>
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <button type="button" class="password-toggle" id="confirmPasswordToggle">👁</button>
                    <div class="error-message" id="confirmPasswordError">Passwords do not match</div>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit" class="register-btn">Create Account</button>
        </form>
        <div class="form-row1 social-login-row">
            <a href="{{ url('/auth/google') }}" class="social-btn google-btn">
                <img src="{{ URL::asset('images/Google__G__logo.svg.png') }}" alt="" class="social-icon">
                Sign in with Google
            </a>
            <a href="{{ url('/auth/facebook') }}" class="social-btn facebook-btn">
                <img src="{{ URL::asset('images/Facebook_Logo_(2019).png.webp') }}" alt="" class="social-icon">
                Sign in with Facebook
            </a>
        </div>
        <div class="login-link">
            Already have an account? <a href="{{ route('loginForm') }}" id="loginLink">Sign in here</a>
        </div>
    </div>

    <script>
    const form = document.getElementById('registrationForm');
    const inputs = {
        username: document.getElementById('username'),
        phone_number: document.getElementById('phone_number'),
        role: document.getElementById('role'),
        password: document.getElementById('password'),
        confirmPassword: document.getElementById('confirmPassword'),
    };

    const errors = {
        username: document.getElementById('user_nameError'),
        phone_number: document.getElementById('phoneError'),
        role: document.getElementById('roleError'),
        password: document.getElementById('passwordError'),
        confirmPassword: document.getElementById('confirmPasswordError'),
    };

    // Password toggles
    document.getElementById('passwordToggle').addEventListener('click', function () {
        const type = inputs.password.type === 'password' ? 'text' : 'password';
        inputs.password.type = type;
        this.textContent = type === 'password' ? '👁' : '🙈';
    });

    document.getElementById('confirmPasswordToggle').addEventListener('click', function () {
        const type = inputs.confirmPassword.type === 'password' ? 'text' : 'password';
        inputs.confirmPassword.type = type;
        this.textContent = type === 'password' ? '👁' : '🙈';
    });

    function validatePhone(phone) {
        const re = /^[\+]?[1-9][\d]{0,15}$/;
        return re.test(phone.replace(/[\s\-\(\)]/g, ''));
    }

    function showError(field, show = true) {
        if (show) {
            errors[field].classList.add('show');
            inputs[field].style.borderColor = '#e74c3c';
        } else {
            errors[field].classList.remove('show');
            inputs[field].style.borderColor = '#e1e1e1';
        }
    }

    // Real-time validation
    inputs.username.addEventListener('blur', () => {
        showError('username', inputs.username.value.trim().length < 3);
    });

    inputs.phone_number.addEventListener('blur', () => {
        showError('phone_number', !validatePhone(inputs.phone_number.value));
    });

    inputs.role.addEventListener('blur', () => {
        showError('role', !inputs.role.value);
    });

    inputs.password.addEventListener('blur', () => {
        showError('password', inputs.password.value.length < 8);
    });

    inputs.confirmPassword.addEventListener('blur', () => {
        showError('confirmPassword', inputs.password.value !== inputs.confirmPassword.value);
    });

    Object.keys(inputs).forEach(key => {
        inputs[key].addEventListener('input', () => showError(key, false));
    });
</script>


</body>

</html>
