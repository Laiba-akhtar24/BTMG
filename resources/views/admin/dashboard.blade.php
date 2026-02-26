@extends('admin.layout')

@section('content')

<style>

/* ===== HEADER ===== */
.dashboard-header{
    margin-bottom:35px;
    padding-bottom:15px;
    border-bottom:1px solid #e9ecef;
}

.dashboard-title{
    font-size:32px;
    font-weight:800;
    color:#1f2937;
    letter-spacing:.5px;
}

.dashboard-subtitle{
    color:#6b7280;
    margin-top:6px;
    font-size:15px;
}


/* ===== GRID ===== */
.dashboard-grid{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap:26px;
}


/* ===== CARD ===== */
.stat-card{
    background:#ffffff;
    padding:26px;
    border-radius:18px;
    border:3px solid #833e13;
    box-shadow:0 10px 28px rgba(0,0,0,0.06);
    display:flex;
    justify-content:space-between;
    align-items:center;
    transition:all .35s ease;
    position:relative;
}

/* hover effect */
.stat-card:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 45px rgba(0,0,0,0.12);
    color:#fff;
}

/* TEXT */
.stat-title{
    font-size:15px;
    font-weight:600;
    opacity:.9;
}

.stat-number{
    font-size:40px;
    font-weight:800;
    margin-top:6px;
}


/* ICON */
.stat-icon{
    width:64px;
    height:64px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    color:#fff;
    transition:.35s;
}

.stat-card:hover .stat-icon{
    background:rgba(255,255,255,.2);
    transform:scale(1.1);
}


/* ===== PROFESSIONAL HOVER COLORS ===== */

.enroll-icon{ background:#2563eb; }
.course-icon{ background:#059669; }
.inquiry-icon{ background:#d97706; }
.general-icon{ background:#7c3aed; }

.enroll:hover{ background:#3c4f7a; }
.course:hover{ background:#1f8162; }
.inquiry:hover{ background:#8b510e; }
.general:hover{ background:#8865c4; }

</style>


<!-- ===== HEADER ===== -->

<div class="dashboard-header">
    <div class="dashboard-title">Admin Dashboard</div>
    
</div>


<!-- ===== CARDS ===== -->

<div class="dashboard-grid">

    <!-- Enrollments -->
    <div class="stat-card enroll">
        <div>
            <div class="stat-title">Total Enrollments</div>
            <div class="stat-number">0</div>
        </div>
        <div class="stat-icon enroll-icon">👥</div>
    </div>

    <!-- Courses -->
    <div class="stat-card course">
        <div>
            <div class="stat-title">Active Courses</div>
            <div class="stat-number">0</div>
        </div>
        <div class="stat-icon course-icon">📚</div>
    </div>

    <!-- Course Inquiries -->
    <div class="stat-card inquiry">
        <div>
            <div class="stat-title">Course Inquiries</div>
            <div class="stat-number">0</div>
        </div>
        <div class="stat-icon inquiry-icon">📩</div>
    </div>

    <!-- General Inquiries -->
    <div class="stat-card general">
        <div>
            <div class="stat-title">General Inquiries</div>
            <div class="stat-number">0</div>
        </div>
        <div class="stat-icon general-icon">💬</div>
    </div>

</div>

@endsection