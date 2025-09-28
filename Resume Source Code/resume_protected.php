<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Resume data
$name = "JUSTINE PAGDONSOLAN";
$title = "DATABASE ADMINISTRATOR";
$contact = "Sto. Domingo, Bauan, Batangas | justinepagdonsolan26@gmail.com | 09933590860";

$careerObjective = "An enthusiastic and analytical BS in Computer Science graduate with a strong foundation in database management, SQL, and data security. Committed to delivering efficient and reliable data solutions and seeking an entry-level Database Administrator role to apply my technical abilities, critical thinking, and passion for data integrity and performance optimization.";

$education = "
<b>August 2021 - May 2025</b><br>
Bachelor of Science (B.S.) in Computer Science<br>
Batangas State University - Alangilan
";

$internship = "
<b>March 2026 - April 2026</b><br>
ICS ENTERPRISE CORPORATION - Laguna<br>
- Assisted in managing databases, performing data migrations, and optimizing queries.<br>
- Designed and implemented a relational database for E-Commerce Product and Order Management Database.<br>
- Monitored database performance and assisted in troubleshooting issues.<br>
- Collaborated with a team to improve data integrity and security measures.
";

$skills = [
    "Database Management Systems (DBMS): MySQL, PostgreSQL, Oracle, Microsoft SQL Server",
    "Data Modeling & Normalization",
    "Backup & Recovery Strategies",
    "Query Optimization & Performance Tuning",
    "Database Security & User Access Management",
    "Cloud Platforms: AWS RDS, Azure SQL, Google Cloud SQL"
];

$references = [
    "Mr. James R. Dela Cruz - IT Supervisor, Solutions Inc. | 0917 876 5432 | james.delacruz.it@gmail.com",
    "Engr. Carla M. Villanueva - DBMSA - Solutions Inc. | 0927 112 3344 | cmvillanueva.dbadmin@gmail.com",
    "Ms. Arlene P. Reyes - System Analyst, Solutions Inc. | 0915 667 8811 | arlene.reyes.sa@gmail.com"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Resume - <?php echo htmlspecialchars($name); ?></title>
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
<style>
    :root {
        --navy: #061633;
        --accent: #0f4c81;
        --light-blue: #e8f0fa;
        --card: #ffffff;
        --text-dark: #031426;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background: linear-gradient(135deg, #0a1b3d 0%, #0e2a52 50%, #0a1f42 100%);
        background-attachment: fixed;
        color: var(--text-dark);
    }

    /* Floating Logout Button */
    .logout {
        position: fixed;
        top: 20px;
        right: 30px;
        background: var(--accent);
        color: #fff;
        padding: 10px 22px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        letter-spacing: 0.5px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.25);
        transition: 0.2s ease-in-out;
        z-index: 1000;
    }
    .logout:hover {
        background: #0c3d6f;
        transform: translateY(-2px);
    }

    /* Main Container */
    .resume-wrapper {
        max-width: 1100px;
        margin: 100px auto;
        background: var(--card);
        border-radius: 16px;
        display: grid;
        grid-template-columns: 320px 1fr;
        box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        overflow: hidden;
    }

    /* Left Panel */
    .left-panel {
        background: linear-gradient(180deg, var(--accent) 0%, #0a3c75 100%);
        color: #fff;
        padding: 40px 30px;
        text-align: center;
    }
    .left-panel img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 4px solid #fff;
        object-fit: cover;
        margin-bottom: 20px;
    }
    .left-panel h1 {
        font-size: 24px;
        margin: 10px 0 5px;
    }
    .left-panel h2 {
        font-size: 15px;
        font-weight: 400;
        letter-spacing: 1px;
        margin: 0;
    }
    .contact {
        font-size: 14px;
        margin-top: 20px;
        line-height: 1.6;
    }

    /* Right Panel */
    .right-panel {
        padding: 50px 60px;
        background: var(--light-blue);
        position: relative;
    }

    .section {
        margin-bottom: 36px;
    }
    .section h3 {
        font-size: 20px;
        color: var(--accent);
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        border-bottom: 2px solid var(--accent);
        padding-bottom: 4px;
    }
    .section p {
        font-size: 15px;
        text-align: justify;
        line-height: 1.7;
    }
    .section ul {
        padding-left: 20px;
    }
    .section li {
        font-size: 15px;
        margin-bottom: 8px;
        text-align: justify;
    }

    /* Skills & References Split */
    .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    /* Download PDF Button */
    .pdf-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #fff;
        color: var(--accent);
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 600;
        border: 2px solid var(--accent);
        cursor: pointer;
        box-shadow: 0 6px 16px rgba(0,0,0,0.25);
        transition: 0.2s ease-in-out;
    }
    .pdf-btn:hover {
        background: var(--accent);
        color: #fff;
    }

    @media (max-width: 900px) {
        .resume-wrapper {
            grid-template-columns: 1fr;
        }
        .left-panel {
            padding: 30px;
        }
        .right-panel {
            padding: 30px;
        }
    }
</style>
</head>
<body>

    <!-- Logout Button -->
    <a class="logout" href="logout.php">Log Out</a>

    <div class="resume-wrapper">
        <!-- Left Panel -->
        <div class="left-panel">
            <img src="formal.jpg.jpeg" alt="Profile photo" onerror="this.style.background='#dcdcdc'">
            <h1><?php echo htmlspecialchars($name); ?></h1>
            <h2><?php echo htmlspecialchars($title); ?></h2>
            <div class="contact">
                <p><?php echo htmlspecialchars($contact); ?></p>
            </div>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <div class="section">
                <h3><i class="ri-target-line"></i> Career Objective</h3>
                <p><?php echo htmlspecialchars($careerObjective, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>

            <div class="section">
                <h3><i class="ri-graduation-cap-line"></i> Education</h3>
                <p><?php echo $education; ?></p>
            </div>

            <div class="section">
                <h3><i class="ri-briefcase-line"></i> Internship Experience</h3>
                <p><?php echo $internship; ?></p>
            </div>

            <div class="section two-col">
                <div>
                    <h3><i class="ri-tools-line"></i> Special Skills</h3>
                    <ul>
                        <?php foreach ($skills as $skill): ?>
                            <li><?php echo htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div>
                    <h3><i class="ri-contacts-line"></i> References</h3>
                    <ul>
                        <?php foreach ($references as $ref): ?>
                            <li><?php echo htmlspecialchars($ref, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="section" style="text-align:center; font-size: 13px; color:#555;">
                Last updated: <?php echo date('F j, Y'); ?>
            </div>
        </div>
    </div>

    <!-- Download PDF Button -->
    <button class="pdf-btn" onclick="window.print()"><i class="ri-printer-line"></i> Download as PDF</button>

</body>
</html>
