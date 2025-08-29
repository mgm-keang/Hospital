@extends('layouts.master') {{-- Extend the base admin dashboard layout --}}
@section('Page-Title', 'Doctor Page') {{-- Set the page title for the topbar --}}
{{-- Blade section for custom CSS styles --}}
@section('styles')
    <style>
        .doctors-container {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 50%, #c6e7fa 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .page-header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-left: 5px solid #4460ff;
        }

        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .page-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #3d5aff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .medical-icon {
            background: linear-gradient(135deg, #dcdfff 0%);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .create-btn {
            background: linear-gradient(135deg, #1133f5 0%, #98aafa 100%);
            color: white;
            padding: 14px 28px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .create-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
            color: white;
            text-decoration: none;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-top: 3px solid;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.total {
            border-top-color: #2196f3;
        }

        .stat-card.available {
            border-top-color: #4caf50;
        }

        .stat-card.busy {
            border-top-color: #ff9800;
        }

        .stat-card.off-duty {
            border-top-color: #f44336;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #0f1eec;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .filters-row {
            display: grid;
            grid-template-columns: 1fr 200px 200px 200px 120px;
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: 600;
            color: #515cff;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .filter-input,
        .filter-select {
            padding: 12px 16px;
            border: 2px solid #e8f5e9;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .filter-input:focus,
        .filter-select:focus {
            outline: none;
            border-color: #5378f1;
            box-shadow: 0 0 0 3px rgba(122, 122, 122, 0.1);
        }

        .filter-btn {
            background: #382af5;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            height: fit-content;
        }

        .filter-btn:hover {
            background: #b3a4eb;
            transform: translateY(-1px);
        }

        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .doctor-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .doctor-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #045cff, #0849fc);
        }

        .doctor-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .doctor-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fcfcfc;
            box-shadow: 0 4px 12px rgba(119, 190, 240, 0.575);
        }

        .doctor-info {
            flex: 1;
        }

        .doctor-name {
            font-size: 1.3rem;
            font-weight: 700;
            color: #071fff;
            margin-bottom: 5px;
        }

        .doctor-specialty {
            background: linear-gradient(135deg, #6872ff, #386dff);
            color: #ffffff;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }

        .doctor-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            font-size: 0.9rem;
        }

        .detail-icon {
            background: #f1f8e9;
            color: #4caf50;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .status-indicator {
            background-color: #a8a6a600;
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-available {
            background: #c8e6c9;
            color: #2e7d32;
        }

        .status-surgery {
            background: #ffe0b2;
            color: #e65100;
        }

        .status-off-duty {
            background: #ffcdd2;
            color: #c62828;
        }

        .doctor-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .action-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-view {
            background: #e3f2fd;
            color: #1565c0;
        }

        .btn-edit {
            background: #fff3e0;
            color: #e65100;
        }

        .btn-delete {
            background: #ffebee;
            color: #c62828;
        }

        .btn-schedule {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            text-decoration: none;
        }

        .pagination {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .pagination-info {
            color: #000000;
            font-weight: 500;
        }

        .pagination-controls {
            display: flex;
            gap: 5px;
        }

        .page-btn {
            padding: 10px 15px;
            border: 2px solid #e8f5e9;
            background: white;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            color: #7d91ff;
        }

        .page-btn:hover,
        .page-btn.active {
            background: #096bff;
            color: white;
            border-color: #ffffff;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .no-data {
            text-align: center;
            padding: 80px 20px;
            color: #666;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            margin: 20px 0;
        }

        .no-data-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #5a57ff;
        }

        @media (max-width: 1024px) {
            .filters-row {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .doctors-grid {
                grid-template-columns: 1fr;
            }

            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .page-title {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .page-title h1 {
                font-size: 2rem;
                justify-content: center;
            }

            .stats-cards {
                grid-template-columns: 1fr;
            }

            .doctor-details {
                grid-template-columns: 1fr;
            }

            .doctor-actions {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>

@endsection
{{-- Blade section for custom JS (optional) --}}
@section('scripts')
    <script>
        // Delete doctor function
        function deleteDoctor(doctorId) {
            if (confirm('Are you sure you want to remove this doctor from the system? This action cannot be undone.')) {
                // Submit the hidden form with dynamic doctorId
                const form = document.getElementById('delete-form');
                form.action = `/doctors/${doctorId}`;
                form.submit();
            }
        }

        // Auto-submit search with debounce
        let searchTimeout;
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // this.form.submit();
            }, 500);
        });

        // Status color coding
        document.addEventListener('DOMContentLoaded', function() {
            const statusCards = document.querySelectorAll('.status-indicator');
            statusCards.forEach(card => {
                const status = card.textContent.toLowerCase();
                if (status.includes('available')) {
                    card.style.boxShadow = '0 0 20px rgba(76, 175, 80, 0.3)';
                } else if (status.includes('surgery') || status.includes('busy')) {
                    card.style.boxShadow = '0 0 20px rgba(255, 152, 0, 0.3)';
                } else {
                    card.style.boxShadow = '0 0 20px rgb(253, 171, 158)';
                }
            });
        });

        function filterDoctors() {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            const cards = document.querySelectorAll('.doctor-card');

            cards.forEach(card => {
                const name = card.querySelector('.doctor-name').textContent.toLowerCase();
                const specialty = card.querySelector('.doctor-specialty').textContent.toLowerCase();
                const email = card.querySelector('.detail-item span').textContent.toLowerCase();

                if (name.includes(searchTerm) || specialty.includes(searchTerm) || email.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
@endsection

@section('mainContent')
    <div class="doctors-container">
        <div class="page-header">
            <div class="page-title">
                <h1>
                    <div class="medical-icon">🩺</div>
                    Medical Staff Directory
                </h1>
                <a href="{{ route('doctors.create') }}" class="create-btn">
                    <span>👨‍⚕️</span> Add New Doctor
                </a>
            </div>

            <div class="stats-cards">
                <div class="stat-card total">
                    <div class="stat-number">{{$doctors->count()}}</div>
                    <div class="stat-label">Total Doctors</div>
                </div>
                <div class="stat-card available">
                    <div class="stat-number">{{$doctors->where('status_id',1)->count()}}</div>
                    <div class="stat-label">Available</div>
                </div>
                <div class="stat-card busy">
                    <div class="stat-number">{{$doctors->where('status_id',2)->count()}}</div>
                    <div class="stat-label">In Surgery</div>
                </div>
                <div class="stat-card off-duty">
                    <div class="stat-number">{{$doctors->where('status_id',3)->count()}}</div>
                    <div class="stat-label">Off Duty</div>
                </div>
            </div>

            <form class="filters-row" method="GET" action="{{ route('doctors.index') }}">
                <div class="filter-group">
                    <label for="search">🔍 Search Doctors</label>
                    <input type="text" id="search" name="search" class="filter-input"
                        placeholder="Search by name, specialty, or license..." value="{{ request('search') }}">
                </div>

                <div class="filter-group">
                    <label for="specialty">🏥 Specialty</label>
                    <select id="specialty" name="specialty" class="filter-select">
                        <option value="">All Specialties</option>
                        <option value="cardiology" {{ request('specialty') == 'cardiology' ? 'selected' : '' }}>Cardiology
                        </option>
                        <option value="neurology" {{ request('specialty') == 'neurology' ? 'selected' : '' }}>Neurology
                        </option>
                        <option value="orthopedics" {{ request('specialty') == 'orthopedics' ? 'selected' : '' }}>
                            Orthopedics</option>
                        <option value="pediatrics" {{ request('specialty') == 'pediatrics' ? 'selected' : '' }}>Pediatrics
                        </option>
                        <option value="dermatology" {{ request('specialty') == 'dermatology' ? 'selected' : '' }}>
                            Dermatology</option>
                        <option value="general" {{ request('specialty') == 'general' ? 'selected' : '' }}>General Medicine
                        </option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="department">🏢 Department</label>
                    <select id="department" name="department" class="filter-select">
                        <option value="">All Departments</option>
                        <option value="emergency" {{ request('department') == 'emergency' ? 'selected' : '' }}>Emergency
                        </option>
                        <option value="surgery" {{ request('department') == 'surgery' ? 'selected' : '' }}>Surgery</option>
                        <option value="icu" {{ request('department') == 'icu' ? 'selected' : '' }}>ICU</option>
                        <option value="outpatient" {{ request('department') == 'outpatient' ? 'selected' : '' }}>Outpatient
                        </option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="status">⚡ Status</label>
                    <select id="status" name="status" class="filter-select">
                        <option value="">All Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available
                        </option>
                        <option value="busy" {{ request('status') == 'busy' ? 'selected' : '' }}>Busy</option>
                        <option value="off_duty" {{ request('status') == 'off_duty' ? 'selected' : '' }}>Off Duty</option>
                    </select>
                </div>

                <button type="submit" class="filter-btn">🔍 Filter</button>
            </form>
        </div>

        <div class="doctors-grid">
            @foreach ($doctors as $doctor)
                <div class="doctor-card">
                    <div class="status-indicator status-{{ $doctor->status->status_name }}">
                        {{ ucfirst(str_replace('_', ' ', $doctor->status->status_name)) }}
                    </div>
                    <div class="doctor-header">
                        <img src="{{ asset('storage/' . $doctor->image) }}" alt="{{ $doctor->name }}"
                            class="doctor-avatar">
                        <div class="doctor-info">
                            <div class="doctor-name">{{ $doctor->name }}</div>
                            {{-- <div class="doctor-specialty">{{ $doctor->status->status_name }}</div> --}}
                        </div>
                    </div>
                    <div class="doctor-details">
                        <div class="detail-item">
                            <div class="detail-icon">📧</div>
                            <span>{{ $doctor->email }}</span>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon">📱</div>
                            <span>{{ $doctor->phone_number ?? '-' }}</span>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon">🆔</div>
                            <span>{{ sprintf('%04d', $doctor->id) ?? '-' }}</span>
                        </div>
                        <div class="detail-item">
                            <div class="detail-icon">🌍</div>
                            <span>{{ $doctor->country->country_name ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="doctor-actions">
                        <a href="{{ route('doctors.show', $doctor->id) }}" class="action-btn btn-view">👁️ View</a>
                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="action-btn btn-edit">✏️ Edit</a>
                        <a href="#" class="action-btn btn-schedule">📅 Schedule</a>
                        <button class="action-btn btn-delete" onclick="deleteDoctor({{ $doctor->id }})">🗑️
                            Delete</button>
                        <form id="delete-form" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            <div class="pagination-info">
                Showing 1 to 12 of 24 doctors
            </div>
            <div class="pagination-controls">
                <a href="#" class="page-btn">‹ Previous</a>
                <a href="#" class="page-btn active">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">Next ›</a>
            </div>
        </div>
    </div>
@endsection
