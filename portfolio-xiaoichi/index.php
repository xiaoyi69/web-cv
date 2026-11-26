<?php 
session_start();
include "koneksi.php";

/** @var mysqli|false $koneksi */

$pesanSapaan = "";

// Langkah 4: Logika Pemrosesan Form Kontak (Create)
if (isset($_POST['kirim'])) {
    $nama_kontak  = trim($_POST['nama'] ?? '');
    $email_kontak = trim($_POST['email'] ?? '');
    $pesan_kontak = trim($_POST['pesan'] ?? '');

    if ($nama_kontak === "" || $email_kontak === "" || $pesan_kontak === "") {
        $pesanSapaan = "Mohon lengkapi seluruh field terlebih dahulu.";
    } elseif (!$koneksi) {
        $pesanSapaan = "Gagal terhubung ke database. Silakan coba beberapa saat lagi.";
    } else {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO pesan_kontak (nama, email, pesan) VALUES (?, ?, ?)");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $nama_kontak, $email_kontak, $pesan_kontak);
            if (mysqli_stmt_execute($stmt)) {
                $pesanSapaan = "Terima kasih, " . htmlspecialchars($nama_kontak) . "! Pesan Anda telah tersimpan.";
            } else {
                $pesanSapaan = "Terjadi kesalahan saat menyimpan pesan.";
            }
            mysqli_stmt_close($stmt);
        } else {
            $pesanSapaan = "Gagal menyiapkan query database.";
        }
    }
}

$personalInfo = [
    "name" => "Xiaoichi 小ー朱",
    "full_name" => "Alifia Xiaoichi Zahirah",
    "role" => "Multimedia Engineering Technology Student",
    "tagline" => "Building impactful products with modern technologies",
    "location" => "Surabaya, Indonesia",
    "email" => "xiaoichi1@gmail.com",
    "phone" => "+62 88991166296",
    "wechat" => "siokci69",
    "linkedin" => "https://www.linkedin.com/in/xiaoichi",
    "github" => "https://github.com/xiaoyi69",
    "about" => "A Founder, Multilingual Translator (Mandarin & English), Junior Developer, Musician, and Podcaster based in Surabaya. Have a proven track record of leading cross-disciplinary teams, managing digital content production, and bridging global communications. By seamlessly blending musical creativity and media production with programming logic, currently active in developing custom digital products while bringing adaptive, communicative, and innovative perspective to every project.",
];

$nama = $personalInfo["name"];
$nim = "5324600071";
$prodi = "Teknologi Rekayasa Multimedia";
$email = $personalInfo["email"];
$phone = $personalInfo["phone"];
$wechat = $personalInfo["wechat"];
$linkedin = $personalInfo["linkedin"];
$githubUrl = $personalInfo["github"];
$tagline = $personalInfo["tagline"];
$deskripsi = $personalInfo["about"];
$status_mahasiswa = true;

$projects = [
    [
        "id" => 1,
        "title" => "Visual Novel Interactive",
        "description" => "an interactive visual novel based on education and campus life simulation at Politeknik Elektronika Negeri Surabaya. You will play as Rian, a Multimedia Engineering Technology student who has to complete various college challenges, live coding mini-games, and explore the world of multimedia engineering.",
        "image" => "https://img.itch.zone/aW1nLzI5MjAxOTMyLnBuZw==/original/DLS7W2.png",
        "link" => "https://siokci.itch.io/return-value-success",
        "github" => "#",
        "technologies" => ["Ren'Py", "Python", "AI", "itch.io", "EduGames"],
        "featured" => true,
    ],
    [
        "id" => 2,
        "title" => "Echo-Komunikasi Tanpa Batas",
        "description" => "A communication assistance and cognitive accessibility platform. Users can create sentences from icon cards, convert voice to text, and summarize messages with Groq AI in Indonesian or English.",
        "image" => "https://echo-website-gilt.vercel.app/assets/screenshot-aac.png",
        "link" => "https://echo-website-gilt.vercel.app/",
        "github" => "#",
        "technologies" => ["Gradle", "Kotlin", "DSL", "Dart", "Flutter"],
        "featured" => true,
    ],
    [
        "id" => 3,
        "title" => "Podcast",
        "description" => "A Living Soul Tryna Vibin' Out with Podcast on Spotify",
        "image" => "https://img.jakpost.net/c/2020/06/02/2020_06_02_96694_1591085809._large.jpg",
        "link" => "https://open.spotify.com/show/4RvaGchbhuJT3mFvMdjfDV?si=18b21c9f90ce4e1f",
        "github" => "#",
        "technologies" => ["Spotify", "Podcast", "Audacity", "Content Scriptwriting"],
        "featured" => false,
    ],
    [
        "id" => 4,
        "title" => "CareSync",
        "description" => "Smart Healtcare App for Patient and Paramedics",
        "image" => "https://mmc.tirto.id/image/2020/07/10/istock-1214753465_ratio-16x9.jpg",
        "link" => "https://github.com/xiaoyi69/CareSync-GUI.git",
        "github" => "https://github.com/xiaoyi69/CareSync-GUI.git",
        "technologies" => ["HTML", "GUI", "git", "GitHub"],
        "featured" => true,
    ],
    [
        "id" => 5,
        "title" => "Color Palette Manager CLI",
        "description" => "Customized your own colors manager",
        "image" => "https://undsgn.com/wp-content/uploads/2018/04/Color-3.jpg",
        "link" => "https://github.com/xiaoyi69/Collor-Pallete-Manager-CLI.git",
        "github" => "https://github.com/xiaoyi69/Collor-Pallete-Manager-CLI.git",
        "technologies" => ["C/C++", "git", "GitHub", "CLI"],
        "featured" => true,
    ],
];

$educationList = [
    [
        "id" => 1,
        "institution" => "Electronic Engineering Polytechnic Institute of Surabaya",
        "degree" => "Bachelor of Applied Computer Science",
        "period" => "2025 - Present",
        "location" => "Surabaya, Indonesia",
        "description" => "Focus on the development of multimedia systems engineering, human-computer interaction (HCI), software programming, and interactive digital content production.",
        "achievements" => [
            "Current IP: 3,51",
        ],
    ],
];

$certificationsList = [
    [
        "id" => 1,
        "name" => "ABRSM Violin Grade 2",
        "issuer" => "The Associated Board of the Royal Schools of Music",
        "year" => "2021",
    ],
    [
        "id" => 2,
        "name" => "Piano Grade 1",
        "issuer" => "Ronald Wilson Music School",
        "year" => "2020",
    ],
];

function greeting(string $namaPengguna): string {
    return "Hello, I'm <br><span class=\"grad-dark\">" . htmlspecialchars($namaPengguna) . "</span>";
}

$year = date('Y'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($personalInfo["full_name"]) ?> | Portfolio</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="nav">
  <div class="wrap nav-in">
    <a href="#home" class="logo">&lt;<?= htmlspecialchars($nama) ?>/&gt;</a>
    <ul class="links">
      <li><a href="#about">About</a></li>
      <li><a href="#experience">Experience</a></li>
      <li><a href="#skills">Skills</a></li>
      <li><a href="#projects">Projects</a></li>
      <li><a href="#education">Education</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
    <div class="icons">
      <a href="<?= htmlspecialchars($githubUrl) ?>" target="_blank" rel="noopener noreferrer" title="GitHub" aria-label="GitHub">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M12 .5a11.5 11.5 0 0 0-3.64 22.41c.58.11.79-.25.79-.56v-2.17c-3.22.7-3.9-1.39-3.9-1.39-.53-1.34-1.29-1.7-1.29-1.7-1.05-.72.08-.71.08-.71 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.71 1.26 3.37.96.1-.75.4-1.26.73-1.55-2.57-.29-5.27-1.28-5.27-5.72 0-1.26.45-2.3 1.19-3.11-.12-.29-.52-1.47.11-3.07 0 0 .97-.31 3.18 1.19a11.1 11.1 0 0 1 5.79 0c2.21-1.5 3.18-1.19 3.18-1.19.63 1.6.23 2.78.11 3.07.74.81 1.19 1.85 1.19 3.11 0 4.45-2.71 5.42-5.29 5.71.41.36.78 1.07.78 2.15v3.19c0 .31.21.68.8.56A11.5 11.5 0 0 0 12 .5Z"/>
        </svg>
      </a>
      <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank" rel="noopener noreferrer" title="LinkedIn" aria-label="LinkedIn">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M6.94 8.5H3.56V19.5h3.38V8.5ZM5.25 3.5a1.96 1.96 0 1 0 0 3.92 1.96 1.96 0 0 0 0-3.92ZM20.44 13.02c0-2.77-1.48-4.06-3.45-4.06-1.59 0-2.3.88-2.7 1.49V8.5h-3.38c.04.96 0 11 0 11h3.38v-6.14c0-.33.02-.66.12-.89.27-.66.88-1.35 1.91-1.35 1.35 0 1.89 1.02 1.89 2.52V19.5h3.38v-6.48h-.36Z"/>
        </svg>
      </a>
      <a href="mailto:<?= htmlspecialchars($email) ?>" title="Email" aria-label="Email">✉</a>
      <a href="admin/login.php" target="_blank" rel="noopener noreferrer" title="Admin Login" style="font-size:0.75rem; font-weight:700; border:1px solid var(--bd); border-radius:8px; padding:2px 8px;">Admin</a>
      <button id="theme" title="Dark mode">☾</button>
    </div>
  </div>
</nav>

<header id="home" class="hero">
  <div class="blob b1"></div><div class="blob b2"></div>
  <div class="pill">● Available for opportunities</div>
  
  <h1><?= greeting($nama) ?></h1>
  
  <h2><?= htmlspecialchars($personalInfo["role"]) ?></h2>
  <p class="mut"><?= htmlspecialchars($tagline) ?></p>

  <div class="btns">
    <a href="#projects" class="btn primary">View My Work</a>
    <a href="#contact" class="btn">Get In Touch</a>
    <a href="#" class="btn">⬇ Resume</a>
  </div>
  <div class="stats">
    <div><b data-n="7">0</b><span>Years Experience</span></div>
    <div><b data-n="50">0</b><span>Projects Built</span></div>
    <div><b data-n="20">0</b><span>Happy Clients</span></div>
  </div>
  <div class="scroll">SCROLL<i></i></div>
</header>

<section id="about" class="wrap sec">
  <div class="head">
    <span class="tag">✦ ABOUT ME</span>
    <h3>Crafting Digital <em>Experiences</em></h3>
    <p class="mut">A little more about me and what drives my passion for development</p>
  </div>
  <div class="about">
    <div>
      <div class="photo">
        <img src="assets/img/profile.png" alt="<?= htmlspecialchars($personalInfo["full_name"]) ?>" class="avatar-img" style="width:100%; height:100%; object-fit:cover; border-radius:16px;">
        <span class="avail">● Available</span>
      </div>
      <h4><?= htmlspecialchars($personalInfo["full_name"]) ?></h4>
      <p class="role"><?= htmlspecialchars($prodi) ?></p>
      <p class="mut small">📍 <?= htmlspecialchars($personalInfo["location"]) ?> | NIM: <?= htmlspecialchars($nim) ?></p>
      
      <p class="mut small" style="margin-top: 6px;">
        Status: <b>
        <?php 
        if ($status_mahasiswa) {
            echo "Mahasiswa Aktif";
        } else {
            echo "Bukan Mahasiswa Aktif";
        }
        ?>
        </b>
      </p>

      <p class="mut"><?= htmlspecialchars($deskripsi) ?></p>
      <div class="icons sq">
        <a href="<?= htmlspecialchars($githubUrl) ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
          <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 .5a11.5 11.5 0 0 0-3.64 22.41c.58.11.79-.25.79-.56v-2.17c-3.22.7-3.9-1.39-3.9-1.39-.53-1.34-1.29-1.7-1.29-1.7-1.05-.72.08-.71.08-.71 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.71 1.26 3.37.96.1-.75.4-1.26.73-1.55-2.57-.29-5.27-1.28-5.27-5.72 0-1.26.45-2.3 1.19-3.11-.12-.29-.52-1.47.11-3.07 0 0 .97-.31 3.18 1.19a11.1 11.1 0 0 1 5.79 0c2.21-1.5 3.18-1.19 3.18-1.19.63 1.6.23 2.78.11 3.07.74.81 1.19 1.85 1.19 3.11 0 4.45-2.71 5.42-5.29 5.71.41.36.78 1.07.78 2.15v3.19c0 .31.21.68.8.56A11.5 11.5 0 0 0 12 .5Z"/>
          </svg>
        </a>
        <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M6.94 8.5H3.56V19.5h3.38V8.5ZM5.25 3.5a1.96 1.96 0 1 0 0 3.92 1.96 1.96 0 0 0 0-3.92ZM20.44 13.02c0-2.77-1.48-4.06-3.45-4.06-1.59 0-2.3.88-2.7 1.49V8.5h-3.38c.04.96 0 11 0 11h3.38v-6.14c0-.33.02-.66.12-.89.27-.66.88-1.35 1.91-1.35 1.35 0 1.89 1.02 1.89 2.52V19.5h3.38v-6.48h-.36Z"/>
          </svg>
        </a>
        <a href="mailto:<?= htmlspecialchars($email) ?>" aria-label="Email">✉</a>
      </div>
    </div>
    <div>
      <div class="grid2">
        <div class="card"><h5>⚡ Fast &amp; Scalable</h5><p class="mut small">Building high-performance applications that handle millions of users</p></div>
        <div class="card"><h5>🖌 Clean Design</h5><p class="mut small">Creating intuitive interfaces with pixel-perfect attention to detail</p></div>
        <div class="card"><h5>◈ Modern Stack</h5><p class="mut small">Using cutting-edge technologies and best practices</p></div>
        <div class="card"><h5>🚀 Ship Fast</h5><p class="mut small">Delivering production-ready code with CI/CD pipelines</p></div>
      </div>
      <div class="band">
        <div><b data-n="7" data-s="+">0</b><span>Years Exp.</span></div>
        <div><b data-n="50" data-s="+">0</b><span>Projects</span></div>
        <div><b data-n="20" data-s="+">0</b><span>Clients</span></div>
      </div>
    </div>
  </div>
</section>

<section id="experience" class="wrap sec">
  <div class="head">
    <span class="tag">✦ EXPERIENCE</span>
    <h3>Professional <em>Journey</em></h3>
    <p class="mut">With business and engineering — building impactful products</p>
  </div>
  <div class="exp">
    <div class="tabs v" id="expTabs"></div>
    <div class="card big" id="expBody"></div>
  </div>
</section>

<section id="skills" class="wrap sec">
  <div class="head">
    <span class="tag">✦ SKILLS</span>
    <h3>Technical <em>Arsenal</em></h3>
    <p class="mut">Multidisciplinary skills and technologies I utilize across various professional fields.</p>
  </div>

  <div class="tabs h" id="skillTabs"></div>
  <div class="grid4" id="skillGrid"></div>
  <div class="band">
    <div><b data-n="41" data-s="+">0</b><span>Total Skills</span></div>
    <div><b data-n="5" data-s="+">0</b><span>Core Disciplines</span></div>
    <div><b data-n="50" data-s="+">0</b><span>Global Delegates</span></div>
  </div>
</section>

<section id="projects" class="wrap sec">
  <div class="head">
    <span class="tag">✦ PROJECTS</span>
    <h3>Featured <em>Work</em></h3>
    <p class="mut">Projects that showcase my skills, creativity, and passion for building</p>
  </div>
  <div class="grid2 proj">
    <?php foreach ($projects as $index => $project): ?>
      <?php
        $title = htmlspecialchars($project['title']);
        $desc = htmlspecialchars($project['description']);
        $image = htmlspecialchars($project['image']);
        $link = htmlspecialchars($project['link'] ?? '#');
        $github = htmlspecialchars($project['github'] ?? '#');
        $techs = $project['technologies'] ?? [];
        $featured = !empty($project['featured']);
        $gradClass = 'g' . (($index % 4) + 1);
        $hasLink = ($link !== '' && $link !== '#');
      ?>
      <article class="pcard" <?= $hasLink ? 'onclick="window.open(\'' . $link . '\', \'_blank\', \'noopener,noreferrer\')" style="cursor:pointer;"' : '' ?>>
        <div class="pimg <?= $gradClass ?>" style="overflow:hidden;">
          <?php if ($image !== ''): ?>
            <img src="<?= $image ?>" alt="<?= $title ?>" style="width:100%; height:100%; object-fit:cover; display:block;">
          <?php endif; ?>
          <?php if ($featured): ?>
            <span class="feat">★ Featured</span>
          <?php endif; ?>
        </div>
        <div class="pbody">
          <h5>
            <?php if ($hasLink): ?>
              <a href="<?= $link ?>" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation();"><?= $title ?> ↗</a>
            <?php else: ?>
              <?= $title ?>
            <?php endif; ?>
          </h5>
          <p class="mut small"><?= $desc ?></p>
          <div class="chips">
            <?php
              $visibleTechs = array_slice($techs, 0, 3);
              $remainingCount = count($techs) - count($visibleTechs);
            ?>
            <?php foreach ($visibleTechs as $tech): ?>
              <span><?= htmlspecialchars($tech) ?></span>
            <?php endforeach; ?>
            <?php if ($remainingCount > 0): ?>
              <span>+<?= $remainingCount ?></span>
            <?php endif; ?>
          </div>
          <?php if ($hasLink || ($github !== '' && $github !== '#')): ?>
            <div class="chips" style="margin-top: 10px;">
              <?php if ($hasLink): ?>
                <a href="<?= $link ?>" target="_blank" rel="noopener noreferrer" class="chip" onclick="event.stopPropagation();">Open Project ↗</a>
              <?php endif; ?>
              <?php if ($github !== '' && $github !== '#' && $github !== $link): ?>
                <a href="<?= $github ?>" target="_blank" rel="noopener noreferrer" class="chip" onclick="event.stopPropagation();">GitHub ↗</a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
  <p class="center"><a class="btn" href="<?= htmlspecialchars($githubUrl) ?>" target="_blank" rel="noopener noreferrer">View More on GitHub</a></p>
</section>

<section id="education" class="wrap sec narrow">
  <div class="head">
    <span class="tag">✦ EDUCATION &amp; CERTS</span>
    <h3>Academic <em>Background</em></h3>
    <p class="mut">My educational journey and professional certifications</p>
  </div>
  <h6>🎓 EDUCATION</h6>
  <?php foreach ($educationList as $edu): ?>
    <div class="card big" style="margin-bottom: 14px;">
      <div class="row">
        <h5><?= htmlspecialchars($edu['institution']) ?></h5>
        <span class="chip-o"><?= htmlspecialchars($edu['period']) ?></span>
      </div>
      <p class="role"><?= htmlspecialchars($edu['degree']) ?></p>
      <p class="mut small"><?= htmlspecialchars($edu['location']) ?></p>
      <p class="mut small"><?= htmlspecialchars($edu['description']) ?></p>
      <?php foreach (($edu['achievements'] ?? []) as $ach): ?>
        <p class="mut small">✓ <?= htmlspecialchars($ach) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>
  <h6>🏅 CERTIFICATIONS</h6>
  <div class="grid2">
    <?php foreach ($certificationsList as $cert): ?>
      <div class="card cert">
        <i>🏆</i>
        <div>
          <h5><?= htmlspecialchars($cert['name']) ?></h5>
          <p class="mut small"><?= htmlspecialchars($cert['issuer']) ?></p>
          <span class="chip"><?= htmlspecialchars($cert['year']) ?></span>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section id="contact" class="wrap sec">
  <div class="head">
    <span class="tag">✦ CONTACT</span>
    <h3>Let's <em>Connect</em></h3>
    <p class="mut">Have a project in mind or want to chat? I'd love to hear from you.</p>
  </div>
  <div class="grid2 contact">
    <div>
      <div class="card tint">
        <h5>Get In Touch</h5>
        <p class="mut small">I'm always open to discussing new projects, creative ideas, or opportunities. Feel free to reach out through any channel below.</p>
        <ul class="info">
          <li>✉<div><small>Email</small><b><?= htmlspecialchars($email) ?></b></div></li>
          <li>📞<div><small>Phone</small><b><?= htmlspecialchars($phone) ?></b></div></li>
          <li>📍<div><small>Location</small><b><?= htmlspecialchars($personalInfo["location"]) ?></b></div></li>
          <li>💬<div><small>WeChat ID (微信ID)</small><b><?= htmlspecialchars($wechat) ?></b></div></li>
        </ul>
      </div>
      <div class="card">
        <small class="mut">FIND ME ONLINE</small>
        <div class="icons sq">
          <a href="<?= htmlspecialchars($githubUrl) ?>" target="_blank" rel="noopener noreferrer" aria-label="GitHub">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M12 .5a11.5 11.5 0 0 0-3.64 22.41c.58.11.79-.25.79-.56v-2.17c-3.22.7-3.9-1.39-3.9-1.39-.53-1.34-1.29-1.7-1.29-1.7-1.05-.72.08-.71.08-.71 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.71 1.26 3.37.96.1-.75.4-1.26.73-1.55-2.57-.29-5.27-1.28-5.27-5.72 0-1.26.45-2.3 1.19-3.11-.12-.29-.52-1.47.11-3.07 0 0 .97-.31 3.18 1.19a11.1 11.1 0 0 1 5.79 0c2.21-1.5 3.18-1.19 3.18-1.19.63 1.6.23 2.78.11 3.07.74.81 1.19 1.85 1.19 3.11 0 4.45-2.71 5.42-5.29 5.71.41.36.78 1.07.78 2.15v3.19c0 .31.21.68.8.56A11.5 11.5 0 0 0 12 .5Z"/>
            </svg>
          </a>
          <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
              <path d="M6.94 8.5H3.56V19.5h3.38V8.5ZM5.25 3.5a1.96 1.96 0 1 0 0 3.92 1.96 1.96 0 0 0 0-3.92ZM20.44 13.02c0-2.77-1.48-4.06-3.45-4.06-1.59 0-2.3.88-2.7 1.49V8.5h-3.38c.04.96 0 11 0 11h3.38v-6.14c0-.33.02-.66.12-.89.27-.66.88-1.35 1.91-1.35 1.35 0 1.89 1.02 1.89 2.52V19.5h3.38v-6.48h-.36Z"/>
            </svg>
          </a>
          <a href="mailto:<?= htmlspecialchars($email) ?>" aria-label="Email">✉</a>
        </div>
      </div>
    </div>
    <form class="card big" id="contactForm" method="post" action="#contact">
      <h5>Send a Message</h5>
      <label>YOUR NAME<input name="nama" placeholder="John Doe" required></label>
      <label>EMAIL ADDRESS<input name="email" type="email" placeholder="john@example.com" required></label>
      <label>MESSAGE<textarea name="pesan" rows="5" placeholder="Tell me about your project..." required></textarea></label>
      <button class="btn primary full" type="submit" name="kirim">Send Message</button>
      <p class="small" id="contactStatus" style="margin-top: 10px; color: var(--p);"><?= $pesanSapaan ?></p>
    </form>
  </div>
</section>

<footer>
  <div class="wrap foot">
    <div>
      <div class="logo">&lt;<?= htmlspecialchars($nama) ?>/&gt;</div>
      <p class="mut small"><?= htmlspecialchars($tagline) ?></p>
    </div>
    <div>
      <small>NAVIGATION</small>
      <a href="#about">About</a>
      <a href="#experience">Experience</a>
      <a href="#skills">Skills</a>
      <a href="#projects">Projects</a>
      <a href="#education">Education</a>
      <a href="#contact">Contact</a>
    </div>
    <div>
      <small>CONTACT</small>
      <a href="mailto:<?= htmlspecialchars($email) ?>">✉ <?= htmlspecialchars($email) ?></a>
      <span class="mut small"><?= htmlspecialchars($personalInfo["location"]) ?></span>
    </div>
  </div>
  <div class="wrap copy">
    <span>© <?= $year ?> <?= htmlspecialchars($personalInfo["full_name"]) ?>. All rights reserved.</span>
    <span>Built with HTML · CSS · JavaScript · PHP</span>
  </div>
</footer>

<script src="assets/js/script.js"></script>
</body>
</html>