@extends('layouts.master')
@section('Page-Title', 'Doctor Details')

@section('styles')
    <style>
        * {
            box-sizing: border-box;
        }

        .detail-container {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #d3e3fd 0%, #aadafa96 100%);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .detail-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 0;
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.12),
                0 8px 16px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 800px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            position: relative;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            padding: 40px 40px 120px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            background-size: 50px 50px;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-50px) translateY(-50px); }
        }

        .card-header h1 {
            font-size: 2.5rem;
            color: white;
            margin: 0;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 2;
        }

        .card-header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 10px 0 0;
            font-size: 1.1rem;
            position: relative;
            z-index: 2;
        }

        .profile-section {
            display: flex;
            justify-content: center;
            margin-top: -80px;
            position: relative;
            z-index: 3;
            margin-bottom: 40px;
        }

        .profile-image-container {
            position: relative;
            display: inline-block;
        }

        .profile-image {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 6px solid white;
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.15);
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .profile-image:hover {
            transform: scale(1.05);
        }

        .status-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #10B981;
            color: white;
            border-radius: 20px;
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 3px solid white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 0 40px 40px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .info-item {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .info-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 0 4px 4px 0;
        }

        .info-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }

        .info-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-value {
            font-size: 1.1rem;
            color: #1e293b;
            font-weight: 500;
            line-height: 1.4;
            word-wrap: break-word;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .actions {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transition: all 0.3s ease;
            transform: translate(-50%, -50%);
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
        }

        .btn-secondary {
            background: white;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .icon {
            width: 18px;
            height: 18px;
            fill: currentColor;
        }

        .country-flag {
            font-size: 1.5rem;
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            .detail-container {
                padding: 15px;
            }

            .card-header {
                padding: 30px 20px 100px;
            }

            .card-header h1 {
                font-size: 2rem;
            }

            .card-body {
                padding: 0 20px 30px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .info-item {
                padding: 20px;
            }

            .profile-image {
                width: 120px;
                height: 120px;
            }

            .profile-section {
                margin-top: -60px;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }
        }

        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        }
    </style>
@endsection

@section('mainContent')
    <div class="detail-container">
        <div class="detail-card">
            <!-- Card Header -->
            <div class="card-header">
                <h1>Doctor Profile</h1>
                <p>Comprehensive medical professional information</p>
            </div>

            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-image-container">
                    @if($doctor->image)
                        <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}" class="profile-image">
                    @else
                        <img src="https://via.placeholder.com/160x160/667eea/ffffff?text={{ strtoupper(substr($doctor->name, 0, 2)) }}" alt="{{ $doctor->name }}" class="profile-image">
                    @endif
                    <div class="status-badge">
                        {{ $doctor->status->status_name ?? 'Active' }}
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- Information Grid -->
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 1H5C3.89 1 3 1.89 3 3V21C3 22.1 3.89 23 5 23H19C20.1 23 21 22.1 21 21V9M19 9H14V4H19V9Z"/>
                            </svg>
                            Doctor ID
                        </div>
                        <div class="info-value">#{{ sprintf('%04d', $doctor->id) }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                            </svg>
                            Full Name
                        </div>
                        <div class="info-value">{{ $doctor->name }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
                            </svg>
                            Email Address
                        </div>
                        <div class="info-value">{{ $doctor->email }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/>
                            </svg>
                            Phone Number
                        </div>
                        <div class="info-value">{{ $doctor->phone_number ?? 'Not provided' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M12,2A3,3 0 0,1 15,5V11A3,3 0 0,1 12,14A3,3 0 0,1 9,11V5A3,3 0 0,1 12,2M19,11C19,14.53 16.39,17.44 13,17.93V21H11V17.93C7.61,17.44 5,14.53 5,11H7A5,5 0 0,0 12,16A5,5 0 0,0 17,11H19Z"/>
                            </svg>
                            Gender
                        </div>
                        <div class="info-value">{{ ucfirst($doctor->gender) }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22S19,14.25 19,9A7,7 0 0,0 12,2Z"/>
                            </svg>
                            Country
                        </div>
                        <div class="info-value">
                            <span class="country-flag">{{ $doctor->country->flag_emoji ?? '🌍' }}</span>
                            {{ $doctor->country->country_name ?? 'Not specified' }}
                        </div>
                    </div>

                    <div class="info-item full-width">
                        <div class="info-label">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M12,2C15.31,2 18,4.66 18,7.95C18,12.41 12,19 12,19S6,12.41 6,7.95C6,4.66 8.69,2 12,2M12,6A2,2 0 0,0 10,8A2,2 0 0,0 12,10A2,2 0 0,0 14,8A2,2 0 0,0 12,6Z"/>
                            </svg>
                            Address
                        </div>
                        <div class="info-value">{{ $doctor->address }}</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="actions">
                    <a href="{{ route('doctors.index') }}" class="btn btn-secondary">
                        <svg class="icon" viewBox="0 0 24 24">
                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                        </svg>
                        Back to List
                    </a>
                    
                    <a href="#" class="btn btn-primary" onclick="window.print(); return false;">
                        <svg class="icon" viewBox="0 0 24 24">
                            <path d="M18,3H6V7H18M19,12A1,1 0 0,1 18,11A1,1 0 0,1 19,10A1,1 0 0,1 20,11A1,1 0 0,1 19,12M16,19H8V14H16M19,8H5A3,3 0 0,0 2,11V17H6V21H18V17H22V11A3,3 0 0,0 19,8Z"/>
                        </svg>
                        Print Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add smooth loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.detail-card');
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease-out';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });

        // Add print styles
        const printStyles = `
            @media print {
                .detail-container { 
                    background: white; 
                    padding: 0; 
                }
                .detail-card { 
                    box-shadow: none; 
                    border: 1px solid #ddd; 
                }
                .actions { 
                    display: none; 
                }
                .card-header {
                    background: #f8f9fa !important;
                    color: #333 !important;
                }
                .card-header h1,
                .card-header p {
                    color: #333 !important;
                }
            }
        `;
        
        const styleSheet = document.createElement('style');
        styleSheet.textContent = printStyles;
        document.head.appendChild(styleSheet);
    </script>
@endsection