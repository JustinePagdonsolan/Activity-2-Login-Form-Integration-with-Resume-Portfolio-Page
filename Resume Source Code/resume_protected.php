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
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Resume — <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></title>

<!-- Icons + Font -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --navy: #061633;
    --accent: #0f4c81;
    --accent-2: #0b5f9a;
    --card: #ffffff;
    --bg-soft: #eaf2fb;
    --text: #072033;
    --muted: #5f798c;
    --bubble-1: rgba(15,76,129,0.10);
    --bubble-2: rgba(11,95,154,0.08);
    --shadow: rgba(2,18,36,0.18);
    --left-text: rgba(255,255,255,0.98);
    --left-sub: rgba(210,235,255,0.9);
    --badge-bg: rgba(255,255,255,0.06);
}


* { box-sizing: border-box; }
html,body { height:100%; margin:0; font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, "Helvetica Neue", Arial; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale; background: linear-gradient(160deg,#071733 0%, #08243b 45%, #052033 100%); color:var(--text); }


body::before, body::after {
    content:"";
    position: fixed;
    pointer-events: none;
    filter: blur(36px);
    opacity: 0.55;
    z-index: 0;
}
body::before { width: 480px; height: 480px; left: -120px; top: -80px; background: radial-gradient(circle at 30% 30%, rgba(15,76,129,0.7), rgba(15,76,129,0.22) 40%, transparent 68%); transform: rotate(-14deg); }
body::after { width: 620px; height: 420px; right: -140px; bottom: -60px; background: radial-gradient(circle at 60% 40%, rgba(11,95,154,0.5), rgba(11,95,154,0.18) 45%, transparent 70%); transform: rotate(6deg); }


.background-pattern { position: fixed; inset: 0; z-index: 0; background-image: linear-gradient(135deg, rgba(255,255,255,0.012) 1px, transparent 1px); background-size: 20px 20px; }


.shell { max-width: 1100px; margin: 64px auto; padding: 20px; position: relative; z-index: 1; }


.logout { position: fixed; top: 18px; right: 28px; z-index: 1100; background: linear-gradient(180deg,var(--accent),var(--accent-2)); color:#fff; padding: 10px 20px; border-radius: 999px; text-decoration:none; font-weight:600; box-shadow: 0 10px 30px var(--shadow); transition: transform .12s ease; }
.logout:hover { transform: translateY(-3px); }


.resume-wrapper { display: grid; grid-template-columns: 360px 1fr; gap: 28px; align-items:start; }


.widget { border-radius: 18px; padding: 0; position: relative; overflow: visible; }


.left {
    background: linear-gradient(180deg, var(--accent), var(--accent-2));
    color: var(--left-text);
    padding: 28px 22px;
    border-radius: 18px;
    box-shadow: 0 18px 44px rgba(2,18,36,0.22);
    border: 1px solid rgba(255,255,255,0.03);
}


.profile-img { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 6px solid rgba(255,255,255,0.14); box-shadow: 0 12px 34px rgba(2,18,36,0.28); display:block; margin: 6px auto 12px; }


.left .name { font-family: "Georgia", serif; font-size:22px; font-weight:700; color:var(--left-text); text-align:center; margin-top:6px; text-shadow: 0 2px 8px rgba(0,0,0,0.25); }
.left .title { font-size:13px; text-transform:uppercase; color:var(--left-sub); letter-spacing:1px; text-align:center; margin-top:6px; }


.bio {
    margin-top:14px;
    background: rgba(255,255,255,0.03);
    padding: 12px 14px;
    border-radius: 12px;
    color: var(--left-sub);
    font-size: 14px;
    line-height: 1.6;
    text-align:center;
    box-shadow: inset 0 -6px 14px rgba(0,0,0,0.06);
}


.badges {
    display:flex; gap:10px; justify-content:center; margin-top:14px; flex-wrap:wrap;
}
.badge {
    background: var(--badge-bg);
    color: #fff;
    padding:8px 12px;
    border-radius: 999px;
    font-weight:600;
    font-size:13px;
    border: 1px solid rgba(255,255,255,0.04);
    box-shadow: 0 6px 18px rgba(0,0,0,0.14);
}


.contact-list { margin-top:16px; color: var(--left-sub); font-size:14px; line-height:1.8; text-align:left; padding: 0 10px; }
.contact-list a { color: rgba(225,240,255,0.98); text-decoration:none; display:flex; gap:10px; align-items:center; }
.contact-list a:hover { text-decoration:underline; color: #fff; }


.contact-list i { color: rgba(255,255,255,0.92); font-size:16px; width:20px; text-align:center; }


.mini {
    margin-top:16px;
    background: rgba(255,255,255,0.04);
    padding:10px 12px;
    border-radius:12px;
    color: var(--left-sub);
    font-size:14px;
    display:flex; align-items:center; gap:10px; justify-content:space-between;
    border: 1px solid rgba(255,255,255,0.03);
}


.right { background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(248,252,255,0.98)); padding: 28px 32px; border-radius: 18px; box-shadow: 0 18px 44px rgba(2,18,36,0.12); border: 1px solid rgba(5,24,48,0.02); }


.section-card { background: linear-gradient(180deg,#fff,#fbfdff); border-radius: 14px; padding: 18px 20px; margin-bottom: 18px; box-shadow: 0 8px 26px rgba(2,18,36,0.06); position: relative; overflow: visible; }
.section-card::before { content:""; position:absolute; right:-40px; top:-18px; width:120px; height:120px; background: radial-gradient(circle at 30% 30%, rgba(15,76,129,0.10), transparent 50%); border-radius:50px; transform: rotate(12deg); z-index:0; }
.section-card:nth-child(2)::before { left:-40px; right:auto; transform: rotate(-8deg); background: radial-gradient(circle at 30% 30%, rgba(11,95,154,0.08), transparent 50%); }


.h-emoji { display:flex; align-items:center; gap:12px; font-size:20px; margin:0 0 8px; color: var(--navy); font-weight:600; }
.h-emoji i { font-size:22px; color:var(--accent); }


.section-card p, .section-card li { font-size:16px; line-height:1.75; color: var(--text); text-align: justify; }
.two-grid { display:grid; grid-template-columns:1fr 1fr; gap:18px; }


.skill-list li { margin-bottom:10px; padding-left:22px; position:relative; }
.skill-list li:before { content:""; position:absolute; left:0; top:6px; width:10px; height:10px; background:var(--accent); border-radius:2px; }


.small { font-size:13px; color:var(--muted); text-align:center; margin-top:6px; }


.pdf-btn { position: fixed; bottom: 26px; right: 26px; z-index: 1100; background: #fff; color: var(--accent); padding: 12px 20px; border-radius: 999px; border: 2px solid var(--accent); font-weight:700; box-shadow: 0 12px 36px rgba(2,18,36,0.18); cursor:pointer; transition: transform .12s ease, background .12s ease, color .12s ease; }
.pdf-btn:hover { background: linear-gradient(180deg,var(--accent),var(--accent-2)); color:#fff; transform: translateY(-4px); }


@media (max-width: 920px) {
    .resume-wrapper { grid-template-columns: 1fr; gap:16px; }
    .left { order: 2; }
    .right { order: 1; }
    .profile-img { width:130px; height:130px; }
    .shell { margin: 28px auto; padding: 12px; }
}


a:focus, button:focus { outline: 3px solid rgba(15,76,129,0.14); outline-offset: 3px; }
</style>
</head>
<body>
    <div class="background-pattern" aria-hidden="true"></div>

  
    <a class="logout" href="logout.php"><i class="ri-logout-box-r-line" style="margin-right:8px;"></i>Log Out</a>

    <div class="shell">
        <div class="resume-wrapper">
           
            <aside class="widget left" aria-label="Profile">
                <img class="profile-img" src="formal.jpg.jpeg" alt="Profile photo" onerror="this.style.background='#dcdcdc'">

                <div class="name"><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></div>
                <div class="title"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></div>

             
                <div class="bio">
                    <strong style="display:block; margin-bottom:6px;">Quick Bio</strong>
                    <span style="font-size:14px; color:var(--left-sub);">BS Computer Science graduate focused on database administration, performance tuning, and data integrity. Calm under pressure and detail-oriented.</span>
                </div>

                <div class="badges" aria-hidden="true">
                    <div class="badge">SQL</div>
                    <div class="badge">MySQL</div>
                    <div class="badge">Postgres</div>
                    <div class="badge">AWS</div>
                </div>

                
                <div class="mini" style="margin-top:14px;">
                    <div style="display:flex; gap:10px; align-items:center;">
                        <i class="ri-timer-line" style="font-size:18px; color:rgba(255,255,255,0.95)"></i>
                        <div style="font-size:13px; color:var(--left-sub);">Available: Immediately</div>
                    </div>
                    <div style="font-weight:700; color:#fff; font-size:13px;">Entry</div>
                </div>

                <div class="mini" style="margin-top:10px;">
                    <div style="display:flex; gap:10px; align-items:center;">
                        <i class="ri-award-line" style="font-size:18px; color:rgba(255,255,255,0.95)"></i>
                        <div style="font-size:13px; color:var(--left-sub);">GPA: 1st Class</div>
                    </div>
                    <div style="font-weight:700; color:#fff; font-size:13px;">Honors</div>
                </div>

               
                <div style="margin-top:16px;">
                    <div class="sub-badge" style="background: rgba(255,255,255,0.06); color: #fff; display:inline-block; padding:6px 10px; border-radius:999px; font-weight:600; font-size:13px;">Contact</div>
                    <div class="contact-list" aria-label="Contact information">
                        <a href="mailto:justinepagdonsolan26@gmail.com"><i class="ri-mail-line"></i> justinepagdonsolan26@gmail.com</a>
                        <a href="tel:09933590860"><i class="ri-phone-line"></i> 09933590860</a>
                        <a href="#" title="Location"><i class="ri-map-pin-line"></i> Sto. Domingo, Bauan</a>
                    </div>
                </div>
            </aside>

           
            <main class="widget right" aria-label="Resume content">
                <!-- Career Objective -->
                <div class="section-card" role="region" aria-labelledby="obj">
                    <div class="h-emoji"><i class="ri-target-line"></i> 🎯 <strong style="font-weight:700; margin-left:6px;">Career Objective</strong></div>
                    <p id="obj"><?php echo htmlspecialchars($careerObjective, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>

                <!-- Education -->
                <div class="section-card" role="region" aria-labelledby="edu">
                    <div class="h-emoji"><i class="ri-graduation-cap-line"></i> 🎓 <strong style="font-weight:700; margin-left:6px;">Education</strong></div>
                    <p id="edu"><?php echo $education; ?></p>
                </div>

                <!-- Internship -->
                <div class="section-card" role="region" aria-labelledby="intern">
                    <div class="h-emoji"><i class="ri-briefcase-line"></i> 💼 <strong style="font-weight:700; margin-left:6px;">Internship Experience</strong></div>
                    <p id="intern"><?php echo $internship; ?></p>
                </div>

                <!-- Skills & References -->
                <div class="section-card" role="region" aria-labelledby="sandr">
                    <div class="h-emoji"><i class="ri-tools-line"></i> 🧰 <strong style="font-weight:700; margin-left:6px;">Skills & References</strong></div>

                    <div class="two-grid" id="sandr">
                        <div>
                            <div class="sub-badge" style="background: rgba(15,76,129,0.08); color: var(--accent);">Special Skills</div>
                            <ul class="skill-list" aria-describedby="sandr">
                                <?php foreach ($skills as $skill): ?>
                                    <li><?php echo htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div>
                            <div class="sub-badge" style="background: rgba(11,95,154,0.06); color: var(--accent-2);">References</div>
                            <ul class="references">
                                <?php foreach ($references as $ref): ?>
                                    <li><?php echo htmlspecialchars($ref, ENT_QUOTES, 'UTF-8'); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div style="text-align:center; margin-top:10px;" class="small">Last updated: <?php echo date('F j, Y'); ?></div>
            </main>
        </div>
    </div>

    <!-- Download as PDF (print dialog) -->
    <button class="pdf-btn" onclick="window.print();"><i class="ri-printer-line" style="margin-right:8px;"></i> Download as PDF</button>

</body>
</html>
