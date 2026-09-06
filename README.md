# 🚀 Yaswant Dev — Engineering & Developer Ecosystem

[![Website](https://img.shields.io/badge/Live%20Website-yaswant.co.in-10b981?style=for-the-badge&logo=googlechrome&logoColor=white)](https://yaswant.co.in)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777bb4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v3.0-38bdf8?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Platform](https://img.shields.io/badge/Platform-Hostinger%20Cloud-673ab7?style=for-the-badge&logo=hostinger&logoColor=white)](https://hostinger.com)
[![License](https://img.shields.io/badge/License-MIT-emerald?style=for-the-badge)](LICENSE)

> **Official repository of [yaswant.co.in](https://yaswant.co.in)** — A high-performance, mobile-first, zero-knowledge developer & engineering platform built by **Yaswant Pandey**. Explore 26+ browser-based cyber security & dev tools, an interactive ATS resume studio, private image utilities, engineering coursework notes & solved PYQs, tech internships, and hands-on cyber labs.

---

## 🌐 Ecosystem Architecture & Live Subdomains

The platform operates on a single unified codebase with dynamic subdomain routing (`config.php`), providing specialized subdomains while maintaining centralized session and asset handling:

| Subdomain | Description | Key Capabilities |
| :--- | :--- | :--- |
| **[yaswant.co.in](https://yaswant.co.in)** | **Main Ecosystem Portal** | Central hub, global search, platform statistics, and quick navigation. |
| **[tools.yaswant.co.in](https://tools.yaswant.co.in)** | **Cyber & Developer Suite** | 26+ zero-knowledge browser utilities (SIEM, YARA, SQLi, 2FA, CIDR, REST). |
| **[resume.yaswant.co.in](https://resume.yaswant.co.in)** | **ATS Resume Studio** | 4 Harvard-standard ATS templates, real-time live preview, 1-click PDF export. |
| **[image.yaswant.co.in](https://image.yaswant.co.in)** | **Image Processing Suite** | Precision photo resizer, smart KB compressor (20KB/50KB/100KB), background remover. |
| **[resource.yaswant.co.in](https://resource.yaswant.co.in)** | **Academic Resource Vault** | Curated semester notes, solved PYQs, lab manuals, and formula cheat sheets. |
| **[course.yaswant.co.in](https://course.yaswant.co.in)** | **Engineering Courses** | Full engineering tracks (Data Analytics, Cyber Security, Full-Stack Dev). |
| **[internship.yaswant.co.in](https://internship.yaswant.co.in)** | **Tech Internships 2026** | Verified 2026 internship listings, salary insights, and application trackers. |
| **[blog.yaswant.co.in](https://blog.yaswant.co.in)** | **Engineering Blog** | Deep-dive articles on security vulnerabilities, systems architecture, and dev tips. |

---

## 🛠️ Key Highlights & Core Features

### 🛡️ 1. Cyber Security & Developer Utilities (26+ Online Tools)
Every tool operates **100% client-side** using WebCrypto and browser APIs for complete zero-knowledge privacy:
- **Authentication & Cryptography**: Shannon Entropy Password Analyzer, CSPRNG Passphrase Generator, 2FA TOTP (RFC 6238) Generator, AES-256-GCM Web Encryptor, Cryptographic Hash (SHA-256/512), JWT Token Inspector.
- **Network & Threat Defense**: Syslog SIEM & Auth Log Analyzer, Stateful Firewall Simulator, Network Packet Sniffer (PCAP hex streams), YARA Malware Rule Scanner, IPv4 CIDR Subnet Calculator, DNS & Email Policy (SPF/DMARC) Inspector, Browser TCP Port Scanner.
- **Code & API Auditing**: SQL Injection Detector & PDO Prepared Statement Converter, XSS Payload Sanitizer, HTTP Security Headers Auditor, REST API & Webhook Tester, JSON Validator & Linter, Code Beautifier.
- **Productivity**: PDF Editor, Merger & Watermark Suite, UUID v4 Generator, Base64/Hex Encoder, Engineering SGPA/CGPA Calculator.

### 📄 2. Interactive ATS Resume Studio
- **4 Recruiter-Tested Templates**: Classic Engineering, Modern Tech, Harvard Formal, and Compact Minimal.
- **Real-Time Live Preview**: Instant visual sync with form inputs.
- **ATS Compliance Checker**: Automatic checks for section headings, standard fonts, and machine-parseable formats.
- **1-Click PDF Generation**: Clean print CSS with no third-party branding or tracking.

### 🖼️ 3. Private Online Image Suite
- **Smart Compressor**: Reduce JPG, PNG, and WebP sizes by up to 85% with target KB controls (e.g. passport forms requiring `< 50KB` or `< 100KB`).
- **Precision Resizer**: Resize by exact pixels, percentages, mm, cm, inches, or DPI.
- **AI Background Remover & Meme Generator**: Transparent PNG exports and instant social media templates.

### 📱 4. Native Mobile App-Like UX
- **Material 3 Bottom Navigation Bar**: Fixed at the bottom on mobile viewports with Material Symbols, active indicator glow pills, and tactile touch scaling.
- **Slide-up Ecosystem Hub Drawer**: 1-thumb access to all sub-portals, universal search, and quick utilities.
- **Modern Touch Ergonomics**: iOS safe-area inset compliance, overscroll isolation, and responsive clamp-based typography.

---

## 💻 Tech Stack & Architecture

- **Backend**: PHP 8.2+ (Fast, stateless server rendering with modular architecture).
- **Frontend**: HTML5, Vanilla CSS3 / TailwindCSS, Vanilla JavaScript (Zero external heavyweight JS framework overhead).
- **Typography & Icons**: Geist, Inter, JetBrains Mono, Google Material Symbols Outlined.
- **Security & Privacy**: Strict CSP headers, CSRF tokens, zero data harvesting on client-side tools.
- **Database**: MySQL / MariaDB (Prepared statements with PDO).
- **Hosting & Infrastructure**: Hostinger Cloud, LiteSpeed Web Server, SSL/TLS, DNS-level subdomain clustering.

---

## 📂 Project Structure

```text
public_html/
├── index.php                      # Homepage (Ecosystem Hub & Hero)
├── config.php                     # Central Subdomain Routing & DB Config
├── includes/
│   ├── layout.php                 # Global Head, Topbar, Sidebar, Footer & Mobile Bottom Nav
│   ├── data.php                   # Data layer & cached resource helpers
│   ├── db.php                     # PDO Database connection handler
│   └── seo.php                    # Dynamic JSON-LD Schema & Canonical tag generator
├── tools/                         # 26+ Cyber Security & Developer utilities
│   ├── index.php                  # Interactive Tools Directory
│   ├── 01-password-strength-checker.php
│   ├── 03-syslog-siem-log-analyzer.php
│   ├── 08-stateful-firewall-simulator.php
│   ├── 10-2fa-totp-authenticator-generator.php
│   └── ... (26+ standalone utilities)
├── resume/                        # ATS Resume Studio
│   └── index.php                  # Interactive resume editor & live preview
├── image/                         # Online Image Editing Suite
│   ├── index.php                  # Image Suite Portal
│   ├── compress.php               # Smart image compressor
│   ├── resize.php                 # Precision image resizer
│   └── remove-bg.php              # Transparent background remover
├── resource/                      # Study notes, PYQs & lab manuals
├── course/                        # Engineering courses & curricula
├── internship/                    # Tech internships directory & tracker
├── blog/                          # Engineering blog & technical write-ups
├── project/                       # 25+ Cyber Security hands-on projects
├── api/                           # Backend JSON endpoints (Search, Newsletter, Admin)
├── manifest.json                  # PWA Web App Manifest
├── sitemap.xml                    # Canonical search engine sitemap
└── .htaccess                      # LiteSpeed/Apache routing, caching & security rules
```

---

## ⚡ Local Development Setup

### Prerequisites
- PHP 8.1 or higher (PHP 8.2+ recommended)
- MySQL / MariaDB (optional, for admin & analytics)
- Apache / Nginx / WAMP / XAMPP or PHP Built-in Server

### Quick Start
1. **Clone the repository**:
   ```bash
   git clone https://github.com/yaswantpandey/yaswant-dev.git
   cd yaswant-dev
   ```

2. **Run with PHP Built-in Server**:
   ```bash
   php -S 127.0.0.1:8000
   ```

3. **Open in your browser**:
   ```text
   http://127.0.0.1:8000
   ```
   *(In local development mode, `config.php` automatically falls back to path-based routing so all tools and pages work seamlessly without subdomains).*

---

## 🚀 CI/CD Automated Deployment to Hostinger

This repository is equipped with an automated **GitHub Actions Workflow** ([.github/workflows/deploy.yml](.github/workflows/deploy.yml)) that automatically checks code syntax and deploys all updates directly to **Hostinger** upon every `git push` to `main`.

### Setting up GitHub Secrets (One-time)
In your GitHub repository, go to **Settings &rarr; Secrets and variables &rarr; Actions &rarr; New repository secret** and add:

| Secret Name | Description | Example / Value |
| :--- | :--- | :--- |
| `FTP_SERVER` | Hostinger FTP Host / Server IP | `82.25.125.43` or `ftp.yaswant.co.in` |
| `FTP_USERNAME` | Hostinger FTP Account Username | `u865909543.yaswant.co.in` |
| `FTP_PASSWORD` | Hostinger FTP Password | *(Your FTP password)* |
| `FTP_SERVER_DIR` *(optional)* | Remote directory (default is `public_html/`) | `public_html/` |

### How It Works
1. When you push to `main` (`git push origin main`), GitHub Actions triggers automatically.
2. It verifies all PHP files with `php -l` to ensure zero syntax errors.
3. It performs an intelligent incremental sync using `SamKirkland/FTP-Deploy-Action`, uploading only new or modified files directly to Hostinger in seconds without downtime.
4. You can also trigger manual deployments from the **Actions** tab on GitHub by clicking **Run workflow**.

---

## 👨‍💻 Author & Connect

**Yaswant Pandey** *(Lucifer Developer)*  
Full-Stack Software Engineer & Cyber Security Enthusiast

- **Website**: [yaswant.co.in](https://yaswant.co.in)
- **GitHub**: [@Yaswantpandey](https://github.com/Yaswantpandey)
- **LinkedIn**: [Yaswant Pandey](https://www.linkedin.com/in/ecotechservices/)
- **Twitter / X**: [@YaswantP86897](https://x.com/YaswantP86897)

---

## 📄 License

This project is licensed under the [MIT License](LICENSE) &mdash; feel free to explore, learn from, and adapt for your own engineering workflows.
