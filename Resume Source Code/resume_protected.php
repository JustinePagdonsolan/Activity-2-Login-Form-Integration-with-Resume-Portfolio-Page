<?php
session_start();

// If not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Resume data
$name = "JUSTINE PAGDONSOLAN";
$title = "DATABASE ADMINISTRATOR";
$contact = "Sto. Domingo, Bauan, Batangas | justinepagdonsolan26@gmail.com | 09933590860";

$careerObjective = "An enthusiastic and analytical BS in Computer Science graduate with a strong foundation in database
management, SQL, and data security. Committed to delivering efficient and reliable data solutions and seeking
an entry-level Database Administrator role to apply my technical abilities, critical thinking, and passion for data
integrity and performance optimization.";

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

$displayName    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$displayTitle   = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
$displayContact = htmlspecialchars($contact, ENT_QUOTES, 'UTF-8');
$loggedUser     = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resume - <?php echo $displayName; ?></title>
    <style>
        :root{
            --navy: #061633;
            --accent: #0f4c81;
            --card: #ffffff;
            --muted: #d3d6db;
            --text-dark: #061633;
            --soft-shadow: rgba(0,0,0,0.18);
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: "Segoe UI", "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(180deg, var(--navy) 0%, #052032 100%);
            color: var(--text-dark);
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
        }

        .container {
            max-width: 840px;
            margin: 48px auto;
            background: var(--card);
            border-radius: 10px;
            box-shadow: 0 16px 40px var(--soft-shadow);
            overflow: visible;
            position: relative;
            padding: 0 48px 48px 48px;
            box-sizing: border-box;
        }

        .head-band {
            background: linear-gradient(90deg,var(--accent), #0b5f9a);
            height: 120px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            position: relative;
        }

        .photo {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--card);
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            background: #eee;
            box-shadow: 0 10px 30px rgba(0,0,0,0.18);
        }

        .logout {
            position: absolute;
            top: 18px;
            right: 20px;
            background: rgba(255,255,255,0.08);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.12);
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            backdrop-filter: blur(2px);
        }
        .logout:hover {
            background: rgba(255,255,255,0.14);
        }

        .header {
            text-align: center;
            padding-top: 76px;
            margin-bottom: 4px;
        }
        .name {
            font-family: "Georgia", "Times New Roman", serif;
            font-size: 28px;
            color: #fff;
            font-weight: 700;
            margin: 8px 0 0 0;
            letter-spacing: 0.6px;
        }
        .title {
            font-size: 14px;
            color: rgba(255,255,255,0.92);
            margin: 6px 0 0 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .contact-pill {
            display:inline-block;
            margin: 8px auto 18px auto;
            padding: 8px 14px;
            background: #f6f8fb;
            color: #083049;
            border-radius: 22px;
            font-size: 13px;
            box-shadow: 0 6px 18px rgba(9,30,45,0.04);
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(6,22,51,0.04), rgba(6,22,51,0.12));
            margin: 18px 0 24px 0;
        }

        h3 {
            font-size: 13px;
            margin: 18px 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--accent);
            text-align: center;
        }

        .content p {
            font-size: 15px;
            color: #031426;
            line-height: 1.7;
            text-align: justify; /* ✅ justified text */
            margin: 6px 0 0 0;
        }

        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
            margin-top: 12px;
            justify-items: center;
        }
        .col {
            max-width: 360px;
        }

        ul.styled {
            list-style: none;
            padding: 0;
            margin: 6px 0 0 0;
        }
        ul.styled li {
            position: relative;
            padding-left: 28px;
            margin: 8px 0;
            text-align: justify; /* ✅ justified list text */
            color: #04263b;
            font-size: 14px;
            line-height: 1.6;
        }
        ul.styled li:before {
            content: "";
            width: 10px;
            height: 10px;
            background: linear-gradient(180deg, var(--accent), #0b5f9a);
            position: absolute;
            left: 0;
            top: 6px;
            border-radius: 2px;
            box-shadow: 0 2px 6px rgba(11,95,154,0.18);
        }

        .references li { font-size: 14px; color: #04263b; }

        .muted {
            font-size: 12px;
            color: #6b7b88;
            text-align: center;
            margin-top: 10px;
        }

        @media (max-width: 720px) {
            .container { margin: 28px 18px; padding: 0 22px 32px 22px; }
            .two-col { grid-template-columns: 1fr; gap: 18px; }
            .photo { width: 110px; height: 110px; top: 34px; }
            .name { font-size: 22px; color: #fff; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="head-band" aria-hidden="true">
            <a class="logout" href="logout.php">Logout</a>
            <img class="photo" src="formal.jpg.jpeg" alt="Profile photo" onerror="this.src=''; this.style.background='#dcdcdc'">
        </div>

        <div class="header" role="banner" aria-labelledby="resume-title">
            <div class="name" id="resume-title"><?php echo $displayName; ?></div>
            <div class="title"><?php echo $displayTitle; ?></div>
            <div class="contact-pill"><?php echo $displayContact; ?></div>
        </div>

        <div class="divider" role="separator" aria-hidden="true"></div>

        <div class="content" role="main">
            <h3>Career Objective</h3>
            <p><?php echo htmlspecialchars($careerObjective, ENT_QUOTES, 'UTF-8'); ?></p>

            <h3>Education</h3>
            <p><?php echo $education; ?></p>

            <h3>Internship Experience</h3>
            <p><?php echo $internship; ?></p>

            <h3>Skills & References</h3>
            <div class="two-col" role="group" aria-label="Skills and references">
                <div class="col" aria-labelledby="skills-heading">
                    <strong id="skills-heading" class="muted">Special Skills</strong>
                    <ul class="styled" aria-describedby="skills-heading">
                        <?php foreach ($skills as $skill): ?>
                            <li><?php echo htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col" aria-labelledby="refs-heading">
                    <strong id="refs-heading" class="muted">References</strong>
                    <ul class="styled references" aria-describedby="refs-heading">
                        <?php foreach ($references as $ref): ?>
                            <li><?php echo htmlspecialchars($ref, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="muted">Last updated: <?php echo date('F j, Y'); ?></div>
        </div>
    </div>
</body>
</html>
