    @extends('layouts.master')
    @section('Page-Title', 'Create Doctor')

    @section('styles')
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .registration-container {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                min-height: 100vh;
                display: flex;
                align-items: flex-start;
                justify-content: center;
                padding: 20px;
            }

            .form-container {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                padding: 40px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                width: 100%;
                border: 1px solid rgba(255, 255, 255, 0.2);
                max-width: 600px;
            }

            .form-header {
                text-align: center;
                margin-bottom: 30px;
            }

            .form-header h1 {
                color: #333;
                font-size: 2.5rem;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .form-header p {
                color: #666;
                font-size: 1.1rem;
            }

            .form-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group.full-width {
                grid-column: 1 / -1;
            }

            .form-group label {
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: #333;
                font-size: 0.9rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .form-group input,
            .form-group select,
            .form-group textarea {
                width: 100%;
                padding: 15px;
                border: 2px solid #e1e5e9;
                border-radius: 12px;
                font-size: 1rem;
                transition: all 0.3s ease;
                background: rgba(255, 255, 255, 0.8);
            }

            .form-group input:focus,
            .form-group select:focus,
            .form-group textarea:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
                transform: translateY(-2px);
            }

            .form-group textarea {
                resize: vertical;
                min-height: 100px;
            }

            .image-upload {
                position: relative;
                border: 2px dashed #e1e5e9;
                border-radius: 12px;
                padding: 20px;
                text-align: center;
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .image-upload:hover {
                border-color: #667eea;
                background: rgba(102, 126, 234, 0.05);
            }

            .image-upload input[type="file"] {
                position: absolute;
                opacity: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
                border: none;
                padding: 0;
            }

            .image-upload-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .upload-icon {
                width: 48px;
                height: 48px;
                background: #667eea;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.5rem;
            }

            .upload-text {
                color: #666;
                font-size: 0.9rem;
            }

            .submit-btn {
                width: 100%;
                padding: 18px;
                background: linear-gradient(135deg, #5f75f5 0%, #4768ff 100%);
                color: white;
                border: none;
                border-radius: 12px;
                font-size: 1.1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 1px;
            }

            .submit-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            }

            .submit-btn:active {
                transform: translateY(0);
            }

            .required {
                color: #e74c3c;
            }

            @media (max-width: 768px) {
                .form-grid {
                    grid-template-columns: 1fr;
                }

                .form-container {
                    padding: 30px 20px;
                    margin: 10px;
                }

                .form-header h1 {
                    font-size: 2rem;
                }
            }

            .success-message {
                display: none;
                background: #d4edda;
                color: #155724;
                padding: 15px;
                border-radius: 12px;
                margin-bottom: 20px;
                border: 1px solid #c3e6cb;
            }

            .toll {
                padding: 20px;
                display: flex;
                justify-content: flex-end;
            }

            .btn-back {
                background-color: #4768ff;
                color: #fff;
                border-radius: 10px;
                padding: 10px 30px;
                font-weight: 600;
                border: none;
                margin-bottom: 15px;
                text-decoration: none;
            }

            .btn-back:hover {
                background: #3751c9;
                color: #fff;
                text-decoration: none;
            }





</style>


        </style>
    @endsection

    @section('scripts')
        <script>
            // Optional: File upload feedback for the image input
            document.addEventListener('DOMContentLoaded', function() {
                const imgInput = document.getElementById('image');
                if (imgInput) {
                    imgInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (file) {
                            const uploadText = document.querySelector('.upload-text');
                            uploadText.innerHTML =
                                `<strong>Selected:</strong> ${file.name}<br><small>File size: ${(file.size / 1024 / 1024).toFixed(2)} MB</small>`;
                        }
                    });
                }
            });
        </script>
    @endsection

    @section('mainContent')
        <div class="toll">
            <a href="{{ route('doctors.index') }}" class="btn btn-back">
                ← Back
            </a>
        </div>
        <div class="registration-container">
            <div class="form-container">
                <div class="form-header">
                    <h1>Create Account</h1>
                    <p>Join us today and get started</p>
                </div>
                @if (!@empty(session('success')))
                    <div class="success">{{ session('success') }}</div>
                    <script>
                        let successElement = document.querySelector('.success');
                        successElement.style.opacity = 1;
                        successElement.style.transition = "all ease-in-out 2s";
                        setTimeout(() => {
                            successElement.style.opacity = 0;
                        }, 4000);
                        setTimeout(() => {
                            successElement.style.display = "none";
                        }, 6000);
                    </script>
                @endif
                <form id="registrationForm" enctype="multipart/form-data" action="{{ route('doctors.store') }}"
                    method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="tel" id="phone_number" name="phone_number" placeholder="+1 (555) 123-4567">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender <span class="required">*</span></label>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer_not_to_say">Prefer not to say</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="address">Address <span class="required">*</span></label>
                            <textarea id="address" name="address" required placeholder="Enter your full address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="country_id">Country <span class="required">*</span></label>
                            <select id="country_id" name="country_id" required>
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_id">Status <span class="required">*</span></label>
                            <select id="status_id" name="status_id" required>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="image">Profile Image</label>
                            <div class="image-upload" onclick="document.getElementById('image').click()">
                                <input type="file" id="image" name="image" accept="image/*">
                                <div class="image-upload-content">
                                    <div class="upload-icon">📸</div>
                                    <div class="upload-text">
                                        <strong>Click to upload</strong> or drag and drop<br>
                                        <small>PNG, JPG, GIF up to 2MB</small>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <div style="color:red;">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">Add New</button>
                </form>
            </div>
        </div>
    @endsection
