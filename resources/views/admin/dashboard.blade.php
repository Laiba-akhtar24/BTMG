@extends('admin.layout')

@section('content')

<style>
/* ===== PAGE WRAPPER ===== */
.dashboard-wrapper {
    padding: 50px 40px;
    background: #f4f6f8;
    font-family: 'Inter', sans-serif;
}

/* ===== HEADER ===== */
.dashboard-header {
    margin-bottom: 40px;
}

.dashboard-title {
    font-size: 34px;
    font-weight: 700;
    color: #111827;
}

.dashboard-divider {
    width: 70px;
    height: 3px;
    margin-top: 10px;
    background: #111827;
    border-radius: 2px;
}

/* ===== GRID ===== */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
}

/* ===== CARD ===== */
.stat-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 28px;
    border-radius: 12px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.stat-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transform: translateY(-3px);
}

/* LEFT CONTENT */
.stat-content {
    display: flex;
    flex-direction: column;
}

.stat-title {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #6b7280;
}

.stat-number {
    font-size: 32px;
    font-weight: 700;
    color: #111827;
    margin-top: 6px;
}

/* ICONS */
.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f3f4f6;
    color: #374151;
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon {
    background: #e5e7eb;
}

/* SVG ICON SIZE */
.stat-icon svg {
    width: 24px;
    height: 24px;
}
</style>

<div class="dashboard-wrapper">

    <div class="dashboard-header">
        <div class="dashboard-title">Admin Dashboard</div>
        <div class="dashboard-divider"></div>
    </div>

    <div class="dashboard-grid">

        <!-- Total Enrollments -->
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-title">Total Enrollments</div>
                <div class="stat-number">0</div>
            </div>
            <div class="stat-icon">
                <!-- Users icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>

        <!-- Active Courses -->
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-title">Active Courses</div>
                <div class="stat-number">0</div>
            </div>
            <div class="stat-icon">
                <!-- Book icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20l9-5-9-5-9 5 9 5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 12V4l9 5-9 5-9-5 9-5z"/>
                </svg>
            </div>
        </div>

        <!-- Course Inquiries -->
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-title">Course Inquiries</div>
                <div class="stat-number">0</div>
            </div>
            <div class="stat-icon">
                <!-- Mail icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>

        <!-- General Inquiries -->
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-title">General Inquiries</div>
                <div class="stat-number">0</div>
            </div>
            <div class="stat-icon">
                <!-- Chat icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 5-5 9-9 9s-9-4-9-9 5-9 9-9 9 4 9 9z"/>
                </svg>
            </div>
        </div>

    </div>

</div>

@endsection