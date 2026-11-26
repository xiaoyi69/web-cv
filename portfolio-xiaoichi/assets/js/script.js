// Data
const experiences = [
  {
    co: 'Xiaoming Group',
    per: '2021 - Present',
    role: 'Founder',
    loc: 'Surabaya, Indonesia',
    desc: 'Established and lead a multidisciplinary company focused on education, professional development, consulting, and business solutions.',
    ach: [
      'Building and integrating educational, consulting, and business services efficiently.',
      'Leading cross-disciplinary teams in designing professional training modules and business strategies that impact client growth.',
      'Optimizing operational systems and internal data management to speed up consulting service response times by up to 40%'
    ],
    tech: ['Business Strategy', 'Project Management', 'EduTech', 'Consulting', 'Team Leadership', 'Operational Efficiency']
  },
  {
    co: 'Ni Xiang Tour & Travel',
    per: '2023 - 2025',
    role: 'Translator Mandarin, English',
    loc: 'Java-Bali, Indonesia',
    desc: 'Providing professional Mandarin and English translation services to help with communication, business trips, and cultural tours along the route from Java to Bali.',
    ach: [
      'Being the main interpreter for 50+ international business and tourist delegates, ensuring cultural and technical information is delivered accurately without any language barriers.',
      'Helping coordinate logistics and travel operations across Java-Bali, boosting client satisfaction rates up to 95%.',
      'Preparing and translating travel guide materials and documents into Mandarin and English to standardize agency services.'
    ],
    tech: ['Mandarin Translation', 'English Translation', 'Public Speaking', 'Public Relations', 'Tour Coordination', 'Cross-Cultural Communication']
  },
  {
    co: 'Progammer',
    per: '2025 - Present',
    role: 'App & Web Developer',
    loc: 'Surabaya, Indonesia',
    desc: 'Developed custom app and web solutions for diverse client projects.',
    ach: [
      'Delivered 20+ client projects on time and within budget',
      'Implemented responsive designs improving mobile traffic by 35%',
      'Created reusable component library adopted across the team'
    ],
    tech: ['HTML', 'C/C++', 'PHP', 'MySQL', 'Tailwind CSS', 'Node.js', 'Python']
  },
  {
    co: 'Musician',
    per: '2019 - Present',
    role: 'Violinist, Pianist, Guitarist, Guzhengist',
    loc: 'Surabaya, Indonesia',
    desc: 'Providing professional music performance services and multi-instrument arrangements for various formal events, cultural shows, and studio recording sessions.',
    ach: [
      'Performed as a soloist and accompanist at 30+ major events, including community concerts, weddings, TV, and cross-route cultural festivals',
      'Blended modern instruments with traditional Chinese instruments to create unique original music arrangements.',
      'Built an independent reputation with consistently strong stage performances, receiving 100% positive reviews from clients for professionalism.'
    ],
    tech: ['Violin', 'Piano', 'Guzheng', 'Guitar', 'Music Arrangement', 'Stage Performance']
  },
  {
    co: 'Podcaster',
    per: '2020 - Present',
    role: 'Host',
    loc: 'Surabaya, Indonesia',
    desc: 'Producing and hosting digital podcast program that focuses on various discussions, youth trends, and in-depth interviews with interesting guests.',
    ach: [
      'Successfully produced and distributed 2 podcast episodes on Spotify and participated in live radio broadcasts.',
      'Built audience engagement organically, reaching thousands of total listeners (streams) through consistent, informative content.',
      'Managed the entire podcast production cycle independently, from scriptwriting and interview techniques to audio editing.'
    ],
    tech: ['Scriptwriting', 'Audio Editing', 'Interviewing Skills', 'Content Strategy', 'Digital Distribution']
  }
];

const skills = {
  Programming: [['HTML5/CSS3', 90], ['JavaScript', 80], ['TypeScript', 75], ['C/C++', 75], ['Python', 80], ['PHP', 80], ['MySQL', 80], ['Node.js', 75], ['Tailwind CSS', 85]],
  Management: [['Business Strategy', 85], ['Project Management', 85], ['Team Leadership', 88], ['Operational Efficiency', 82], ['Consulting', 80], ['EduTech', 85]],
  Communication: [['Mandarin', 88], ['English', 90], ['Podcast Hosting', 85], ['Hospitality', 85], ['Content Scriptwriting', 85], ['Public Speaking', 82], ['Public Relations', 82]],
  'Music & Arts': [['Violin', 80], ['Piano', 78], ['Guzheng (古筝)', 80], ['Guitar', 75], ['Music Arrangement', 80], ['Stage Performance', 85]],
  Deployment: [['Git', 82], ['GitHub', 85], ['Vercel Deployment', 80], ['Linux CLI', 75], ['Localhost Setup', 85]],
  Tools: [['VS Code', 95], ['Figma', 80], ['Postman', 85], ['XAMPP', 85], ['Vite', 85], ['Audacity', 80], ["Ren'Py Engine", 90], ['Git Bash', 80]]
};

const $ = s => document.querySelector(s);

// Experience tabs
const et = $('#expTabs'), eb = $('#expBody');
function showExp(i) {
  const e = experiences[i];
  [...et.children].forEach((b, j) => b.classList.toggle('on', i === j));
  eb.innerHTML = `<div class="row"><h5 class="xl">${e.role}</h5><span class="chip-o">${e.per}</span></div>
  <p class="role">${e.sub || e.co} · <span class="mut">${e.loc}</span></p><p class="mut small">${e.desc}</p>
  ${e.ach.length ? `<small class="k">KEY ACHIEVEMENTS</small><ul class="ach">${e.ach.map(a => `<li>✓ ${a}</li>`).join('')}</ul>` : ''}
  <small class="k">TECHNOLOGIES</small><div class="chips">${e.tech.map(t => `<span>${t}</span>`).join('')}</div>`;
}
experiences.forEach((e, i) => {
  const b = document.createElement('button');
  b.innerHTML = `<b>${e.co}</b><small>${e.per}</small>`;
  b.onclick = () => showExp(i);
  et.appendChild(b);
});
showExp(experiences.length - 1);

// Skill tabs
const st = $('#skillTabs'), sg = $('#skillGrid');
function showSkill(cat) {
  [...st.children].forEach(b => b.classList.toggle('on', b.dataset.c === cat));
  sg.innerHTML = skills[cat].map(([n, p]) => `<div class="card"><span class="x">✖</span><b>${n}</b><div class="bar"><i style="width:0" data-w="${p}"></i></div><small class="pc">${p}%</small></div>`).join('');
  requestAnimationFrame(() => setTimeout(() => sg.querySelectorAll('i').forEach(i => i.style.width = i.dataset.w + '%'), 30));
}
Object.keys(skills).forEach(c => {
  const b = document.createElement('button');
  b.textContent = c;
  b.dataset.c = c;
  b.onclick = () => showSkill(c);
  st.appendChild(b);
});
showSkill('Tools');

// Counters
const io = new IntersectionObserver(es => es.forEach(e => {
  if (!e.isIntersecting) return;
  io.unobserve(e.target);
  const el = e.target, n = +el.dataset.n, s = el.dataset.s || '+';
  let c = 0;
  const t = setInterval(() => {
    c += Math.max(1, Math.ceil(n / 40));
    if (c >= n) { c = n; clearInterval(t); }
    el.textContent = c + s;
  }, 30);
}));
document.querySelectorAll('[data-n]').forEach(el => io.observe(el));

// Reveal on scroll
const rv = new IntersectionObserver(es => es.forEach(e => e.isIntersecting && e.target.classList.add('show')), { threshold: .1 });
document.querySelectorAll('.sec .head,.card,.pcard').forEach(el => { el.classList.add('rv'); rv.observe(el); });

// Active nav link
const secs = [...document.querySelectorAll('section[id]')], links = [...document.querySelectorAll('.links a')];
addEventListener('scroll', () => {
  let cur = '';
  secs.forEach(s => { if (scrollY >= s.offsetTop - 120) cur = s.id; });
  links.forEach(a => a.classList.toggle('on', a.getAttribute('href') === '#' + cur));
});

// Dark mode
const root = document.documentElement;
try { if (localStorage.theme === 'dark') root.dataset.theme = 'dark'; } catch (e) {}
$('#theme').onclick = () => {
  const d = root.dataset.theme === 'dark';
  root.dataset.theme = d ? 'light' : 'dark';
  try { localStorage.theme = root.dataset.theme; } catch (e) {}
};

// Contact form (tanpa reload & tanpa lompat scroll)
const contactForm = $('#contactForm');
const contactStatus = $('#contactStatus');

if (contactForm && contactStatus) {
  contactForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const submitBtn = contactForm.querySelector('button[type="submit"]');
    const formData = new FormData(contactForm);
    formData.append('kirim', '1');

    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.textContent = 'Sending...';
    }
    contactStatus.textContent = 'Mengirim...';
    contactStatus.style.color = 'var(--p)';

    try {
      const targetUrl = window.location.pathname + window.location.search;
      const res = await fetch(targetUrl, { method: 'POST', body: formData });
      const htmlText = await res.text();

      const doc = new DOMParser().parseFromString(htmlText, 'text/html');
      const updatedStatus = doc.querySelector('#contactStatus');
      const msg = updatedStatus ? updatedStatus.textContent.trim() : 'Pesan terkirim.';

      contactStatus.textContent = msg;
      if (msg.toLowerCase().includes('terima kasih')) {
        contactStatus.style.color = '#16a34a';
        contactForm.reset();
      } else if (msg.toLowerCase().includes('gagal') || msg.toLowerCase().includes('kesalahan') || msg.toLowerCase().includes('mohon')) {
        contactStatus.style.color = '#dc2626';
      } else {
        contactStatus.style.color = 'var(--p)';
      }
    } catch (err) {
      contactStatus.textContent = 'Gagal mengirim pesan. Silakan coba beberapa saat lagi.';
      contactStatus.style.color = '#dc2626';
    } finally {
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Send Message';
      }
    }
  });
}