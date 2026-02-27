@extends('admin.layout')

@section('content')

<style>

/* ===== PAGE WRAPPER ===== */
.dashboard-wrapper{
    padding:40px 30px;
    background:#f8fafc;
}

/* ===== HEADER ===== */
.dashboard-header{
    margin-bottom:35px;
}

.dashboard-title{
    font-size:30px;
    font-weight:700;
    color:#111827;
}

.dashboard-divider{
    height:2px;
    width:60px;
    background:#111827;
    margin-top:12px;
}

/* ===== GRID ===== */
.dashboard-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap:24px;
}

/* ===== CARD ===== */
.stat-card{
    background:#ffffff;
    border-radius:12px;
    padding:30px;
    border:1px solid #e5e7eb;
    display:flex;
    justify-content:space-between;
    align-items:center;
    transition:all .25s ease;
}

/* subtle hover */
.stat-card:hover{
    border-color:#d1d5db;
    box-shadow:0 8px 25px rgba(0,0,0,0.05);
}

/* LEFT CONTENT */
.stat-content{
    display:flex;
    flex-direction:column;
}

.stat-title{
    font-size:14px;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:.8px;
    color:#6b7280;
}

.stat-number{
    font-size:36px;
    font-weight:700;
    color:#111827;
    margin-top:10px;
}

/* RIGHT ICON */
.stat-icon{
    width:52px;
    height:52px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    background:#f3f4f6;
    color:#111827;
}

/* ===== OPTIONAL METRIC LINE ===== */
.stat-footer{
    margin-top:15px;
    font-size:13px;
    color:#6b7280;
}

.stat-positive{
    color:#059669;
    font-weight:600;
}

.stat-negative{
    color:#dc2626;
    font-weight:600;
}

</style>


<div class="dashboard-wrapper">

    <!-- ===== HEADER ===== -->
    <div class="dashboard-header">
        <div class="dashboard-title">Admin Dashboard</div>
        <div class="dashboard-divider"></div>
    </div>

    <!-- ===== CARDS ===== -->
    <div class="dashboard-grid">

        <!-- Enrollments -->
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-title">Total Enrollments</div>
                <div class="stat-number">0</div>
                
            </div>
            <div class="stat-icon">👥</div>
        </div>

        <!-- Courses -->
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-title">Active Courses</div>
                <div class="stat-number">0</div>
                
            </div>
            <div class="stat-icon">📚</div>
        </div>

        <!-- Course Inquiries -->
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-title">Course Inquiries</div>
                <div class="stat-number">0</div>
                
            </div>
            <div class="stat-icon">📩</div>
        </div>

        <!-- General Inquiries -->
        <div class="stat-card">
            <div class="stat-content">
                <div class="stat-title">General Inquiries</div>
                <div class="stat-number">0</div>
                
            </div>
            <div class="stat-icon">💬</div>
        </div>

    </div>

</div>

@endsection