<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartFont = { family: "'Inter', sans-serif" };

        // --- Sparkline: Total Appointments (bar) ---
        new Chart(document.getElementById('sparkTotal').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['','','','','','',''],
                datasets: [{
                    data: {!! json_encode(array_slice(array_column($dailyAppointments, 'count'), -7)) !!},
                    backgroundColor: 'rgba(255,255,255,0.7)',
                    borderRadius: 3,
                    barPercentage: 0.7,
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { enabled: false } }, scales: { x: { display: false }, y: { display: false } } }
        });

        // --- Sparkline: Confirmed (line) ---
        new Chart(document.getElementById('sparkConfirmed').getContext('2d'), {
            type: 'line',
            data: {
                labels: ['','','','','','',''],
                datasets: [{
                    data: {!! json_encode(array_slice(array_column($dailyAppointments, 'count'), -7)) !!},
                    borderColor: '#fff',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.4,
                    pointRadius: 0,
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { enabled: false } }, scales: { x: { display: false }, y: { display: false } } }
        });

        // --- Sparkline: Confirmation Rate (doughnut) ---
        new Chart(document.getElementById('sparkRate').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Confirmed', 'Other'],
                datasets: [{
                    data: [{{ $confirmationRate }}, {{ 100 - $confirmationRate }}],
                    backgroundColor: ['rgba(255,255,255,0.9)', 'rgba(255,255,255,0.25)'],
                    borderWidth: 0,
                    cutout: '65%',
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { enabled: false } } }
        });

        // --- Sparkline: Pending Rate (line) ---
        new Chart(document.getElementById('sparkPending').getContext('2d'), {
            type: 'line',
            data: {
                labels: ['','','','','','',''],
                datasets: [{
                    data: {!! json_encode(array_slice(array_column($dailyAppointments, 'count'), -7)) !!},
                    borderColor: '#fff',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.4,
                    pointRadius: 0,
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { enabled: false } }, scales: { x: { display: false }, y: { display: false } } }
        });

        // --- Weekly Appointments (Bar + Line combo) ---
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_column($dailyAppointments, 'day')) !!},
                datasets: [
                    {
                        type: 'line',
                        label: 'Confirmed',
                        data: {!! json_encode(array_column($dailyAppointments, 'count')) !!},
                        borderColor: '#ff6384',
                        backgroundColor: '#ff6384',
                        borderWidth: 2.5,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#ff6384',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        fill: false,
                        tension: 0.3,
                        order: 1,
                    },
                    {
                        type: 'bar',
                        label: 'Total',
                        data: {!! json_encode(array_column($dailyAppointments, 'count')) !!},
                        backgroundColor: 'rgba(99, 132, 255, 0.75)',
                        borderRadius: 4,
                        barPercentage: 0.6,
                        order: 2,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { usePointStyle: true, padding: 20, font: chartFont } }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f0f0f0' }, ticks: { font: chartFont, stepSize: 1 } },
                    x: { grid: { display: false }, ticks: { font: chartFont } }
                }
            }
        });

        // --- Monthly Trends (Area chart) ---
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyData = {!! json_encode(array_column($monthlyAppointments, 'count')) !!};
        const monthlyLabels = {!! json_encode(array_column($monthlyAppointments, 'month')) !!};
        const maxVal = Math.max(...monthlyData, 10);
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [
                    {
                        label: 'Total Appointments',
                        data: monthlyData,
                        borderColor: '#ff6384',
                        backgroundColor: 'rgba(255, 99, 132, 0.15)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 0,
                    },
                    {
                        label: 'Confirmed',
                        data: monthlyData.map(v => Math.round(v * {{ $confirmationRate / 100 }})),
                        borderColor: '#6384ff',
                        backgroundColor: 'rgba(99, 132, 255, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 0,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { usePointStyle: true, padding: 20, font: chartFont } }
                },
                scales: {
                    y: { beginAtZero: true, max: Math.ceil(maxVal * 1.3), grid: { color: '#f0f0f0' }, ticks: { font: chartFont } },
                    x: { grid: { display: false }, ticks: { font: chartFont } }
                }
            }
        });

        // --- Top Services (horizontal bar) ---
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        const sLabels = {!! json_encode($serviceAppointments->map(fn($s) => $s->service ? $s->service->name : 'Unknown')->toArray()) !!};
        const sData = {!! json_encode($serviceAppointments->pluck('count')->toArray()) !!};
        const sColors = ['#6384ff', '#ff6384', '#7c3aed', '#f59e0b', '#10b981'];
        new Chart(serviceCtx, {
            type: 'bar',
            data: {
                labels: sLabels.length ? sLabels : ['No data'],
                datasets: [{
                    data: sData.length ? sData : [0],
                    backgroundColor: sColors,
                    borderRadius: 6,
                    barPercentage: 0.55,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { beginAtZero: true, grid: { color: '#f0f0f0' }, ticks: { stepSize: 1, font: chartFont } },
                    y: { grid: { display: false }, ticks: { font: chartFont } }
                }
            }
        });

        // --- Dashboard Modal Actions ---
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    let deleteId = null;

    // View button - open handle modal
    document.querySelectorAll('.dash-btn-view').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/admin/appointments/${id}/handle`, { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(apt => {
                    document.getElementById('dh-id').value = apt.id;
                    document.getElementById('dh-name').textContent = apt.name;
                    document.getElementById('dh-email').textContent = apt.email;
                    document.getElementById('dh-phone').textContent = apt.phone;
                    document.getElementById('dh-service').textContent = apt.service ? apt.service.name : '-';
                    document.getElementById('dh-doctor').textContent = apt.doctor ? apt.doctor.name : 'Any';
                    // Format date nicely
                    const d = new Date(apt.appointment_date);
                    const dateStr = d.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                    document.getElementById('dh-datetime').textContent = dateStr + ' ' + apt.appointment_time;
                    document.getElementById('dh-status').value = apt.status;
                    // Close any open parent modals first (Bootstrap doesn't support nested modals)
                    const openModals = document.querySelectorAll('.modal.show');
                    if (openModals.length > 0) {
                        openModals.forEach(m => {
                            const instance = bootstrap.Modal.getInstance(m);
                            if (instance) instance.hide();
                        });
                        // Wait for backdrop to fully disappear
                        setTimeout(() => {
                            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                            document.body.classList.remove('modal-open');
                            document.body.style.overflow = '';
                            document.body.style.paddingRight = '';
                            new bootstrap.Modal(document.getElementById('dashHandleModal')).show();
                        }, 400);
                    } else {
                        new bootstrap.Modal(document.getElementById('dashHandleModal')).show();
                    }
                })
                .catch(err => console.error('Error loading appointment:', err));
        });
    });

    // Update button click handler
    document.getElementById('dh-update-btn').addEventListener('click', function() {
        console.log('Update button clicked!');
        const id = document.getElementById('dh-id').value;
        const status = document.getElementById('dh-status').value;
        console.log('ID:', id, 'Status:', status);
        if (!id) { console.error('No ID found!'); return; }
        this.disabled = true;
        this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Updating...';
        fetch(`/admin/appointments/${id}/handle`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
            body: JSON.stringify({ status, admin_notes: '' })
        }).then(r => {
            console.log('Response status:', r.status);
            return r.json();
        }).then(data => {
            console.log('Response data:', data);
            if (data.success) {
                document.querySelectorAll(`#dash-status-${id}`).forEach(el => {
                    el.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                    const colors = { pending: 'warning', confirmed: 'success', completed: 'info', cancelled: 'danger' };
                    el.className = 'badge badge-light-' + (colors[status] || 'secondary');
                });
                bootstrap.Modal.getInstance(document.getElementById('dashHandleModal')).hide();
            }
        }).catch(err => console.error('Error updating appointment:', err))
        .finally(() => {
            this.disabled = false;
            this.innerHTML = '<i class="bi bi-check-circle me-1"></i> Update';
        });
    });
    console.log('Update handler attached successfully');

    // Delete button
    document.querySelectorAll('.dash-btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            deleteId = this.dataset.id;
            document.getElementById('dash-del-name').textContent = this.dataset.name;
            document.querySelectorAll('.modal.show').forEach(m => {
                const instance = bootstrap.Modal.getInstance(m);
                if (instance) instance.hide();
            });
            setTimeout(() => {
                document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
                new bootstrap.Modal(document.getElementById('dashDeleteModal')).show();
            }, 400);
        });
    });

    // Confirm delete
    document.getElementById('dash-confirm-delete').addEventListener('click', function() {
        if (!deleteId) return;
        fetch(`/admin/appointments/${deleteId}`, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
        }).then(r => r.json()).then(data => {
            if (data.success) {
                document.querySelectorAll(`#dash-apt-${deleteId}`).forEach(el => {
                    el.style.transition = 'opacity 0.3s';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 300);
                });
                bootstrap.Modal.getInstance(document.getElementById('dashDeleteModal')).hide();
            }
        }).catch(err => console.error('Error deleting appointment:', err));
    });
    });
    </script>
    @endpush

    <style>
        .adminify-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            transition: box-shadow 0.2s ease;
        }
        .adminify-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        }
        .gradient-card {
            border: none;
            border-radius: 12px;
            color: #fff;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            min-height: 150px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .gradient-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .gradient-blue {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-purple {
            background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%);
        }
        .gradient-pink {
            background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);
        }
        .gradient-indigo {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        }
        .gradient-card .sparkline-container {
            position: absolute;
            bottom: 10px;
            right: 15px;
            width: 100px;
            height: 60px;
        }
        .gradient-card .sparkline-container.doughnut-spark {
            width: 70px;
            height: 70px;
            bottom: 5px;
            right: 10px;
        }
        .stat-label {
            font-size: 0.85rem;
            opacity: 0.85;
            margin-bottom: 0.25rem;
        }
        .stat-icon {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255,255,255,0.18);
            color: #fff;
            position: relative;
        }
        .stat-icon i {
            font-size: 1.3rem;
        }
        .unread-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            min-width: 20px;
            height: 20px;
            line-height: 20px;
            padding: 0 6px;
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 999px;
            background: #ef4444;
            color: #fff;
        }
        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            line-height: 1.2;
        }
        .stat-sub {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-top: 0.25rem;
        }
        .chart-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem 0.75rem;
        }
        .chart-card-header h5 {
            font-weight: 700;
            margin: 0;
            font-size: 1.05rem;
            color: #334155;
        }
        .chart-card-body {
            padding: 0.5rem 1rem 1rem;
        }
        .list-row {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .list-row:last-child { border-bottom: none; }
        .list-row:hover { background: #f8fafc; border-radius: 8px; }
        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        .dot-green { background: #10b981; }
        .dot-orange { background: #f59e0b; }
        .dot-blue { background: #6366f1; }
        .dot-red { background: #ef4444; }
        .badge-soft {
            font-size: 0.7rem;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 600;
        }
        .badge-soft-success { background: #ecfdf5; color: #059669; }
        .badge-soft-warning { background: #fffbeb; color: #d97706; }
        .badge-soft-primary { background: #eef2ff; color: #4338ca; }
        .badge-soft-danger { background: #fef2f2; color: #dc2626; }
        .notification-card {
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }
    </style>

    {{-- Row 1: 4 Gradient Stat Cards --}}
    <div class="row g-4 mb-4">

        {{-- Total Appointments --}}
        <div class="col-xl-3 col-md-6">
            <div class="gradient-card gradient-blue" data-bs-toggle="modal" data-bs-target="#modalAllAppointments">
                <div class="stat-label">Total Appointments</div>
                <div class="stat-value">{{ $totalAppointments }}</div>
                <div class="stat-sub">Appointments Today</div>
                <div class="sparkline-container">
                    <canvas id="sparkTotal"></canvas>
                </div>
            </div>
        </div>

        {{-- Confirmed Appointments --}}
        <div class="col-xl-3 col-md-6">
            <div class="gradient-card gradient-purple" data-bs-toggle="modal" data-bs-target="#modalConfirmed">
                <div class="stat-label">Confirmed</div>
                <div class="stat-value">{{ number_format($confirmedAppointments) }}</div>
                <div class="stat-sub">New Orders Today</div>
                <div class="sparkline-container">
                    <canvas id="sparkConfirmed"></canvas>
                </div>
            </div>
        </div>

        {{-- Confirmation Rate --}}
        <div class="col-xl-3 col-md-6">
            <div class="gradient-card gradient-pink" data-bs-toggle="modal" data-bs-target="#modalConfirmationRate">
                <div class="stat-label">Daily Sales</div>
                <div class="stat-value">{{ $confirmationRate }}%</div>
                <div class="stat-sub">Sales Today</div>
                <div class="sparkline-container doughnut-spark">
                    <canvas id="sparkRate"></canvas>
                </div>
            </div>
        </div>

        {{-- Pending Appointments --}}
        <div class="col-xl-3 col-md-6">
            <div class="gradient-card gradient-indigo notification-card" data-bs-toggle="modal" data-bs-target="#notificationsModal">
                <div class="stat-label">Pending Appointments</div>
                <div class="stat-value">{{ $notificationCount }} new</div>
                <div class="stat-sub">Pending Appointments</div>
                <div class="sparkline-container">
                    <canvas id="sparkPending"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 2: Weekly Appointments + Monthly Trends --}}
    <div class="row g-4 mb-4">
        {{-- Weekly Appointments (Sales Report style) --}}
        <div class="col-lg-7">
            <div class="card adminify-card">
                <div class="chart-card-header">
                    <h5>Appointment Report</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light btn-icon" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </div>
                <div class="chart-card-body">
                    <div style="height: 300px;">
                        <canvas id="weeklyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Monthly Trends (User Stats style) --}}
        <div class="col-lg-5">
            <div class="card adminify-card">
                <div class="chart-card-header">
                    <h5>Appointment Stats</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light btn-icon" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </div>
                <div class="chart-card-body">
                    <div style="height: 300px;">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Row 3: Top Services + Recent Appointments + Upcoming --}}
    <div class="row g-4 mb-4">
        {{-- Top Services (Sales By Category) --}}
        <div class="col-lg-4">
            <div class="card adminify-card">
                <div class="chart-card-header">
                    <h5>Top Services</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light btn-icon" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </div>
                <div class="chart-card-body">
                    <div style="height: 260px;">
                        <canvas id="serviceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Appointments (Trending) --}}
        <div class="col-lg-4">
            <div class="card adminify-card">
                <div class="chart-card-header">
                    <h5>Recent Appointments</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light btn-icon" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body pt-0">
                    @forelse($recentAppointments as $apt)
                        <div class="list-row">
                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="font-size: 0.9rem;">{{ $apt->name }}</div>
                                <small class="text-muted">{{ $apt->service ? $apt->service->name : 'N/A' }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge-soft {{ $apt->status === 'confirmed' ? 'badge-soft-success' : ($apt->status === 'pending' ? 'badge-soft-warning' : 'badge-soft-primary') }}">
                                    {{ ucfirst($apt->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4 mb-0">No recent appointments</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Upcoming Appointments (To-Do List) --}}
        <div class="col-lg-4">
            <div class="card adminify-card">
                <div class="chart-card-header">
                    <h5>Upcoming Appointments</h5>
                    <span class="badge bg-light text-dark" style="font-size: 0.75rem; border-radius: 8px;">
                        <i class="bi bi-calendar3 me-1"></i> TODAY
                    </span>
                </div>
                <div class="card-body pt-0">
                    @forelse($upcomingAppointments as $apt)
                        <div class="list-row">
                            <span class="status-dot {{ $apt->status === 'confirmed' ? 'dot-green' : 'dot-orange' }}"></span>
                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="font-size: 0.9rem;">{{ $apt->name }}</div>
                                <small class="text-muted">{{ $apt->service ? $apt->service->name : 'N/A' }}</small>
                            </div>
                            <div class="text-end">
                                <small class="fw-semibold d-block">{{ $apt->appointment_date->format('M d') }}</small>
                                <small class="text-muted">{{ $apt->appointment_time }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4 mb-0">No upcoming appointments</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: All Appointments --}}
    <div class="modal fade" id="modalAllAppointments" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; border-radius: 12px 12px 0 0;">
                    <h5 class="modal-title fw-bold">All Appointments ({{ $totalAppointments }})</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-200 align-middle gs-0 gy-3 mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Patient</th>
                                    <th>Service</th>
                                    <th>Doctor</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4" style="min-width:140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($allAppointments as $apt)
                                <tr id="dash-apt-{{ $apt->id }}">
                                    <td class="ps-4">
                                        <div class="fw-semibold">{{ $apt->name }}</div>
                                        <small class="text-muted">{{ $apt->email }}</small>
                                    </td>
                                    <td>{{ $apt->service ? $apt->service->name : '-' }}</td>
                                    <td>{{ $apt->doctor ? $apt->doctor->name : 'Any' }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $apt->appointment_date->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ date('h:i A', strtotime($apt->appointment_time)) }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $sc = ['pending'=>'warning','confirmed'=>'success','cancelled'=>'danger','completed'=>'info'];
                                            $c = $sc[$apt->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-light-{{ $c }}" id="dash-status-{{ $apt->id }}">{{ ucfirst($apt->status) }}</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex gap-1 justify-content-end">
                                            <button type="button" class="btn btn-sm btn-light-primary dash-btn-view" data-id="{{ $apt->id }}">View</button>
                                            <button type="button" class="btn btn-sm btn-danger dash-btn-delete" data-id="{{ $apt->id }}" data-name="{{ $apt->name }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-5 text-muted">No appointments found</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Confirmed Appointments --}}
    <div class="modal fade" id="modalConfirmed" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #7c3aed 0%, #a78bfa 100%); color: #fff; border-radius: 12px 12px 0 0;">
                    <h5 class="modal-title fw-bold">Confirmed Appointments ({{ $confirmedAppointments }})</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-200 align-middle gs-0 gy-3 mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Patient</th>
                                    <th>Service</th>
                                    <th>Doctor</th>
                                    <th>Date & Time</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4" style="min-width:140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($confirmedList as $apt)
                                <tr id="dash-apt-{{ $apt->id }}">
                                    <td class="ps-4">
                                        <div class="fw-semibold">{{ $apt->name }}</div>
                                        <small class="text-muted">{{ $apt->email }}</small>
                                    </td>
                                    <td>{{ $apt->service ? $apt->service->name : '-' }}</td>
                                    <td>{{ $apt->doctor ? $apt->doctor->name : 'Any' }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $apt->appointment_date->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ date('h:i A', strtotime($apt->appointment_time)) }}</small>
                                    </td>
                                    <td><span class="badge badge-light-success" id="dash-status-{{ $apt->id }}">{{ ucfirst($apt->status) }}</span></td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex gap-1 justify-content-end">
                                            <button type="button" class="btn btn-sm btn-light-primary dash-btn-view" data-id="{{ $apt->id }}">View</button>
                                            <button type="button" class="btn btn-sm btn-danger dash-btn-delete" data-id="{{ $apt->id }}" data-name="{{ $apt->name }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center py-5 text-muted">No confirmed appointments</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Confirmation Rate Breakdown --}}
    <div class="modal fade" id="modalConfirmationRate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%); color: #fff; border-radius: 12px 12px 0 0;">
                    <h5 class="modal-title fw-bold">Confirmation Rate Breakdown</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="card bg-light p-4 text-center">
                                <div class="text-muted mb-1">Total Appointments</div>
                                <div class="fw-bold" style="font-size: 2rem; color: #667eea;">{{ $totalAppointments }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light p-4 text-center">
                                <div class="text-muted mb-1">Confirmed</div>
                                <div class="fw-bold" style="font-size: 2rem; color: #10b981;">{{ $confirmedAppointments }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light p-4 text-center">
                                <div class="text-muted mb-1">Confirmation Rate</div>
                                <div class="fw-bold" style="font-size: 2rem; color: #ec4899;">{{ $confirmationRate }}%</div>
                            </div>
                        </div>
                    </div>
                    <h6 class="fw-bold mb-3">Status Distribution</h6>
                    <div class="table-responsive">
                        <table class="table table-row-bordered align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Status</th>
                                    <th>Count</th>
                                    <th>Percentage</th>
                                    <th>Bar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statuses = [
                                        ['label' => 'Confirmed', 'count' => $confirmedAppointments, 'color' => 'success'],
                                        ['label' => 'Pending', 'count' => $pendingAppointments, 'color' => 'warning'],
                                        ['label' => 'Completed', 'count' => $completedAppointments, 'color' => 'info'],
                                        ['label' => 'Cancelled', 'count' => $cancelledAppointments, 'color' => 'danger'],
                                    ];
                                @endphp
                                @foreach($statuses as $s)
                                <tr>
                                    <td><span class="badge badge-light-{{ $s['color'] }}">{{ $s['label'] }}</span></td>
                                    <td class="fw-bold">{{ $s['count'] }}</td>
                                    <td>{{ $totalAppointments > 0 ? round(($s['count'] / $totalAppointments) * 100, 1) : 0 }}%</td>
                                    <td style="min-width: 150px;">
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-{{ $s['color'] }}" style="width: {{ $totalAppointments > 0 ? ($s['count'] / $totalAppointments) * 100 : 0 }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Pending Appointments --}}
    <div class="modal fade" id="notificationsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); color: #fff; border-radius: 12px 12px 0 0;">
                    <h5 class="modal-title fw-bold">Pending Appointments</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-flush">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Pending Appointments ({{ $pendingAppointments }})</h6>
                        </div>
                        <div class="card-body py-4">
                            @if($pendingList->count())
                                <div class="table-responsive">
                                    <table class="table table-row-bordered table-row-gray-200 align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Patient</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pendingList as $apt)
                                            <tr>
                                                <td>{{ $apt->name }}</td>
                                                <td>{{ $apt->appointment_date->format('M d, Y') }}</td>
                                                <td>{{ date('h:i A', strtotime($apt->appointment_time)) }}</td>
                                                <td><span class="badge badge-light-warning">{{ ucfirst($apt->status) }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-6 text-muted">No pending appointments</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Pending Appointments --}}
    <div class="modal fade" id="dashHandleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; border: none; padding: 1.5rem 2rem;">
                    <h5 class="modal-title fw-bold" style="font-size: 1.25rem;"><i class="bi bi-calendar-check me-2"></i>Handle Appointment</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    {{-- Appointment Info Card --}}
                    <div style="background: linear-gradient(135deg, #f8f9ff 0%, #f0f0ff 100%); padding: 2rem;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;"><i class="bi bi-person"></i></div>
                                    <div>
                                        <small class="text-muted d-block" style="font-size:0.75rem;">Patient Name</small>
                                        <strong id="dh-name" style="font-size:1rem;"></strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;"><i class="bi bi-envelope"></i></div>
                                    <div>
                                        <small class="text-muted d-block" style="font-size:0.75rem;">Email</small>
                                        <span id="dh-email" style="font-size:0.9rem;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;"><i class="bi bi-telephone"></i></div>
                                    <div>
                                        <small class="text-muted d-block" style="font-size:0.75rem;">Phone</small>
                                        <span id="dh-phone" style="font-size:0.9rem;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;"><i class="bi bi-scissors"></i></div>
                                    <div>
                                        <small class="text-muted d-block" style="font-size:0.75rem;">Service</small>
                                        <span id="dh-service" style="font-size:0.9rem;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;"><i class="bi bi-heart-pulse"></i></div>
                                    <div>
                                        <small class="text-muted d-block" style="font-size:0.75rem;">Doctor</small>
                                        <span id="dh-doctor" style="font-size:0.9rem;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px;height:40px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;"><i class="bi bi-clock"></i></div>
                                    <div>
                                        <small class="text-muted d-block" style="font-size:0.75rem;">Date & Time</small>
                                        <span id="dh-datetime" style="font-size:0.9rem;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Status Update Section --}}
                    <div class="p-4">
                        <input type="hidden" id="dh-id">
                        <div class="row align-items-end g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-bold mb-2" style="font-size:0.85rem;color:#666;">UPDATE STATUS</label>
                                <select class="form-select form-select-lg" id="dh-status" style="border-radius:10px;border:2px solid #e8e8e8;">
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-lg w-100" id="dh-update-btn" style="background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border:none;border-radius:10px;font-weight:600;">
                                    <i class="bi bi-check-circle me-1"></i> Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="dashDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="text-danger mb-3"><i class="bi bi-trash3" style="font-size: 3rem;"></i></div>
                    <h5 class="fw-bold mb-2">Delete Appointment?</h5>
                    <p class="text-muted mb-4">Are you sure you want to delete <strong id="dash-del-name"></strong>?</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="dash-confirm-delete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-default-layout>
