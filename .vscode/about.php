<?php
// Direct database connection (you can edit these values)
$host = 'localhost';      // usually 'localhost'
$db   = 'sdlrc';          // your database name
$user = 'root';           // your MySQL username
$pass = '';               // your MySQL password (blank if using XAMPP)
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch team member info
$stmt = $pdo->query("SELECT * FROM team_contributions ORDER BY member_name ASC");
$members = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SAN Team</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <a href="#about-main" class="visually-hidden">Skip to main content of this page</a>

    <header class="header" role="banner">
        <div class="logo-title">
            <img src="../images_index/website_logo.png" alt="SDLRC Logo" class="logo-icon">
            <h1>SDLRC</h1>
            <p class="slogan">Digital Careers for the Smart Future</p>
        </div>
        <nav aria-label="Primary">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="jobs.html">Jobs Available</a></li>
                <li><a href="apply.html">Apply Now</a></li>
                <li><a aria-current="page" href="about.php">About Us</a></li>
                <li><a href="https://www.swinburne.edu.au/student-login/" target="_blank" rel="noopener noreferrer">Log In</a></li>
            </ul>
        </nav>
    </header>

    <main id="about-main" class="about">
        <section class="team-title">
            <h1>Team Profile - SAN</h1>
        </section>

        <section class="team-section">
            <div class="left-column">
                <section class="team-info">
                    <h2>Class Schedule</h2>
                    <ul>
                        <li>Meeting Day : Friday via Discord or in class on Tuesday
                            <ul>
                                <li>Time: 2:30pm - 4:30pm for in class and anytime via Discord</li>
                            </ul>
                        </li>
                    </ul>
                </section>

                <!-- Dynamic contributions list -->
                <section class="contributions">
                    <h2>Member Contributions</h2>
                    <?php if (empty($members)): ?>
                        <p>No contributions found. Please add records to the <code>team_contributions</code> table.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($members as $m): ?>
                                <li>
                                    <strong><?= htmlspecialchars($m['member_name']) ?> (<?= htmlspecialchars($m['student_no']) ?>)</strong>
                                    <?php if (!empty($m['role_title'])): ?>
                                        — <?= htmlspecialchars($m['role_title']) ?>
                                    <?php endif; ?>
                                    <ul>
                                        <li><em>Project 1:</em> <?= nl2br(htmlspecialchars($m['project1'])) ?></li>
                                        <li><em>Project 2:</em> <?= nl2br(htmlspecialchars($m['project2'])) ?></li>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </section>

                <section class="languages">
                    <h2>First Languages</h2>
                    <dl>
                        <?php foreach ($members as $m): ?>
                            <dt><?= htmlspecialchars($m['member_name']) ?></dt>
                            <dd><?= htmlspecialchars($m['first_language'] ?? '-') ?></dd>
                        <?php endforeach; ?>
                    </dl>
                </section>
            </div>

            <div id="about-aside" class="right-column">
                <div class="facts-grid">
                    <details class="collapsible" open>
                        <summary><h2>Fun Facts</h2></summary>
                        <table>
                            <caption>Team Member Fun Facts:</caption>
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Dream Job</th>
                                    <th>Coding Snack</th>
                                    <th>Hometown</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($members as $m): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($m['member_name']) ?></td>
                                        <td><?= htmlspecialchars($m['dream_job'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($m['coding_snack'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($m['hometown'] ?? '-') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </details>
                </div>

                <div class="team-photo">
                    <figure>
                        <img src="../team-photo/team-photo.jpg" alt="Team SAN group photo" width="959" height="771">
                        <figcaption>Team SAN - Sarah, Amy, Nithya, and Sanvidu collaborating on web development projects</figcaption>
                    </figure>
                </div>
            </div>
        </section>
    </main>

    <footer role="contentinfo"
        style="border-top:1px solid #d8d8d8; padding:1rem; color:#555; display:flex; justify-content:space-between; text-align:center; align-items:center;">
        <span>© 2025 School of Digital Learning & Research</span>
        <a href="mailto:info@companyname.com" style="color:#0645ad; text-decoration:none;">Contact Us</a>
        <a href="https://github.com/amywamy/COS10026_Group3.git" style="color:#0645ad; text-decoration:none;">Company's GitHub repository</a>
        <a href="https://sarahagate101.atlassian.net/jira/software/projects/SCRUM/boards/1"
           style="color:#0645ad; text-decoration:none;">Jira page</a>
    </footer>
</body>
</html>
