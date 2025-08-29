    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hospital Login Form</title>
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

            .login-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
                padding: 40px;
                width: 100%;
                max-width: 400px;
                transform: scale(0.9);
                animation: slideIn 0.5s ease-out forwards;
            }

            @keyframes slideIn {
                to {
                    transform: scale(1);
                }
            }

            .login-header {
                text-align: center;
                margin-bottom: 30px;
            }

            .login-header::before {
                content: '🏥';
                font-size: 3rem;
                display: block;
                margin-bottom: 15px;
            }

            .login-header h1 {
                color: #2c5aa0;
                font-size: 2rem;
                font-weight: 600;
                margin-bottom: 5px;
            }

            .login-header .subtitle {
                color: #4a90e2;
                font-size: 1.1rem;
                font-weight: 500;
                margin-bottom: 5px;
            }

            .login-header p {
                color: #666;
                font-size: 0.9rem;
            }

            .form-group {
                margin-bottom: 25px;
                position: relative;
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

            .form-input:focus {
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
            .form-input:not(:placeholder-shown)+.form-label {
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

            .forgot-password {
                text-align: right;
                margin-bottom: 30px;
            }

            .forgot-password a {
                color: #4a90e2;
                text-decoration: none;
                font-size: 0.9rem;
                transition: color 0.3s ease;
            }

            .forgot-password a:hover {
                color: #2c5aa0;
                text-decoration: underline;
            }

            .login-btn {
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

            .login-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(74, 144, 226, 0.3);
            }

            .login-btn:active {
                transform: translateY(0);
            }

            .login-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            .login-btn:hover::before {
                left: 100%;
            }

            .signup-link {
                text-align: center;
                margin-top: 25px;
                color: #666;
                font-size: 0.9rem;
            }

            .signup-link a {
                color: #4a90e2;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s ease;
            }

            .signup-link a:hover {
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

            @media (max-width: 480px) {
                .login-container {
                    padding: 30px 20px;
                }

                .login-header h1 {
                    font-size: 1.6rem;
                }
            }
        </style>
    </head>

    <body>
        <div class="login-container">
            <div class="login-header">
                <h1>MedCare Portal</h1>
                <div class="subtitle">Healthcare Management System</div>
                <p>Please sign in to access your medical dashboard</p>
            </div>

            <form id="loginForm" novalidate action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-input" placeholder=" " required>
                    <label for="username" class="form-label">User Name</label>
                    <div class="error-message" id="usernameError">Please enter your username</div>
                </div>

                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-input" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                    <button type="button" class="password-toggle" id="passwordToggle">👁</button>
                    <div class="error-message" id="passwordError">Password must be at least 6 characters</div>
                </div>

                <div class="forgot-password">
                    <a href="#" id="forgotPassword">Forgot your password?</a>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="signup-link">
                Don't have an account? <a href="{{ route('register.form') }}">Create one</a>
            </div>
        </div>

        <script>
        const form = document.getElementById('loginForm');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('passwordToggle');
        const usernameError = document.getElementById('usernameError');
        const passwordError = document.getElementById('passwordError');

        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁' : '🙈';
        });

        usernameInput.addEventListener('blur', function() {
            if (this.value.trim().length < 3) {
                usernameError.classList.add('show');
                this.style.borderColor = '#e74c3c';
            } else {
                usernameError.classList.remove('show');
                this.style.borderColor = '#e1e1e1';
            }
        });

        passwordInput.addEventListener('blur', function() {
            if (this.value.length < 6) {
                passwordError.classList.add('show');
                this.style.borderColor = '#e74c3c';
            } else {
                passwordError.classList.remove('show');
                this.style.borderColor = '#e1e1e1';
            }
        });

        document.getElementById('forgotPassword').addEventListener('click', function(e) {
            e.preventDefault();
            alert('Password reset functionality would be implemented here.');
        });

        usernameInput.addEventListener('input', function() {
            if (this.value) {
                usernameError.classList.remove('show');
                this.style.borderColor = '#e1e1e1';
            }
        });

        passwordInput.addEventListener('input', function() {
            if (this.value) {
                passwordError.classList.remove('show');
                this.style.borderColor = '#e1e1e1';
            }
        });
    </script>

    </body>

    </html>
