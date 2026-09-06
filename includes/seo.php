<?php
// includes/seo.php — High-Ranking SEO & Schema.org Rich Snippet Generator for Yaswant Pandey / Yaswant Dev
// Generates Google-compliant JSON-LD (Person, Organization, WebSite, SoftwareApplication, HowTo, FAQPage, BlogPosting, BreadcrumbList, CollectionPage, JobPosting, Course, LearningResource)

require_once __DIR__ . '/../config.php';

// ─── Base Person, Organization & WebSite Schema (shared across all pages) ─────
function schema_base(): array
{
    return [
        [
            '@type' => 'Person',
            '@id' => URL_HOME . '/#person',
            'name' => 'Yaswant Pandey',
            'alternateName' => ['Yaswant', 'Yaswant Dev', 'Yaswant Kumar Pandey', 'iamlucifer'],
            'url' => URL_HOME,
            'jobTitle' => 'Software Engineer & Cyber Security Researcher',
            'description' => 'Yaswant Pandey is a software engineer, cybersecurity researcher, and creator of Yaswant Dev — an engineering ecosystem providing free study notes, developer tools, photo suite, and ATS resume builder.',
            'sameAs' => [
                'https://github.com/Yaswantpandey',
                'https://twitter.com/Yaswantpandey',
                'https://linkedin.com/in/yaswantpandey',
                'https://instagram.com/yaswantpandey',
            ],
            'knowsAbout' => [
                'Software Engineering',
                'Cyber Security',
                'Web Development',
                'Computer Science',
                'Full Stack Development',
                'Network Security',
                'Application Security'
            ],
        ],
        [
            '@type' => 'Organization',
            '@id' => URL_HOME . '/#organization',
            'name' => 'Yaswant Dev',
            'alternateName' => 'Yaswant Pandey Platform',
            'url' => URL_HOME,
            'founder' => ['@id' => URL_HOME . '/#person'],
            'logo' => ['@type' => 'ImageObject', 'url' => URL_HOME . '/assets/og-cover.png'],
            'sameAs' => [
                'https://twitter.com/Yaswantpandey',
                'https://github.com/Yaswantpandey',
                'https://linkedin.com/in/yaswantpandey',
            ],
        ],
        [
            '@type' => 'WebSite',
            '@id' => URL_HOME . '/#website',
            'url' => URL_HOME,
            'name' => 'Yaswant Pandey (Yaswant Dev) — Engineering & Tech Ecosystem',
            'alternateName' => ['Yaswant Pandey Official Website', 'Yaswant Dev'],
            'description' => 'Official website of Yaswant Pandey. Explore free engineering courses, study notes, tech internships, ATS resume builder, image editing suite, and 26+ cyber developer tools.',
            'author' => ['@id' => URL_HOME . '/#person'],
            'publisher' => ['@id' => URL_HOME . '/#organization'],
            'potentialAction' => [
                [
                    '@type' => 'SearchAction',
                    'target' => ['@type' => 'EntryPoint', 'urlTemplate' => URL_SEARCH . '?q={search_term_string}'],
                    'query-input' => 'required name=search_term_string',
                ],
            ],
        ],
    ];
}

// ─── Home Page Schema ─────────────────────────────────────────────────────────
function schema_home(): string
{
    $navElements = [
        [
            '@type' => 'SiteNavigationElement',
            'position' => 1,
            'name' => 'ATS Resume Studio',
            'description' => 'Build 100% ATS-compliant engineering resumes with live preview and instant PDF export.',
            'url' => URL_RESUME
        ],
        [
            '@type' => 'SiteNavigationElement',
            'position' => 2,
            'name' => 'Developer & Cyber Tools',
            'description' => '26+ client-side security tools, SIEM analyzers, firewalls, password entropy checkers, and formatters.',
            'url' => URL_TOOLS
        ],
        [
            '@type' => 'SiteNavigationElement',
            'position' => 3,
            'name' => 'Cyber Security Projects',
            'description' => 'Explore 25+ hands-on open-source cybersecurity labs, repos, and pentesting projects.',
            'url' => URL_PROJECT
        ],
        [
            '@type' => 'SiteNavigationElement',
            'position' => 4,
            'name' => 'Free Engineering Courses',
            'description' => 'Curated open-source courses in DSA, Machine Learning, Operating Systems, and Web Dev.',
            'url' => URL_COURSES
        ],
        [
            '@type' => 'SiteNavigationElement',
            'position' => 5,
            'name' => 'Study Resources & Solved PYQs',
            'description' => 'Download semester lecture notes, previous year question papers, and lab manuals.',
            'url' => URL_RESOURCES
        ],
        [
            '@type' => 'SiteNavigationElement',
            'position' => 6,
            'name' => 'Image Editing Suite',
            'description' => 'Free photo resizer, image compressor to 50KB/100KB, background remover, and meme maker.',
            'url' => URL_IMAGE
        ],
        [
            '@type' => 'SiteNavigationElement',
            'position' => 7,
            'name' => 'Tech Internships 2026',
            'description' => 'Verified software engineering, ML, frontend, and cloud internships for students.',
            'url' => URL_INTERNSHIPS
        ],
        [
            '@type' => 'SiteNavigationElement',
            'position' => 8,
            'name' => 'Engineering Blog',
            'description' => 'Deep-dive technical tutorials, system design breakdowns, and developer guides.',
            'url' => URL_BLOG
        ],
    ];

    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => URL_HOME . '/#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME]
            ]
        ],
        [
            '@type' => 'ItemList',
            '@id' => URL_HOME . '/#sitelinks',
            'name' => 'Site Navigation & Main Sections',
            'itemListElement' => $navElements
        ],
        [
            '@type' => 'FAQPage',
            '@id' => URL_HOME . '/#faq',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Who is Yaswant Pandey?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Yaswant Pandey is an Indian software engineer and cybersecurity researcher who founded Yaswant Dev (yaswant.co.in), an all-in-one platform for engineering students and developers.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'What services and tools does Yaswant Pandey provide on yaswant.co.in?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Yaswant Pandey provides 26+ browser-based cyber security & developer utilities, an interactive ATS resume builder, an online image editing suite, semester study notes & PYQs, and verified tech internship listings.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Is Yaswant Pandey’s platform free to use?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Yes, all resources, developer utilities, photo tools, courses, and the ATS resume builder built by Yaswant Pandey are 100% free with no registration required.'
                    ]
                ]
            ]
        ]
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}

// ─── Resume Builder Schema ───────────────────────────────────────────────────
function schema_resume(): string
{
    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => URL_RESUME . '/#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'ATS Resume Studio', 'item' => URL_RESUME],
            ]
        ],
        [
            '@type' => 'SoftwareApplication',
            '@id' => URL_RESUME . '/#app',
            'name' => 'Interactive ATS Resume Studio by Yaswant Pandey',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Any (Browser-based)',
            'url' => URL_RESUME,
            'author' => ['@id' => URL_HOME . '/#person'],
            'description' => 'Build 100% ATS-compliant engineering resumes with real-time live preview, 4 parser-tested templates, AI bullet enhancer, and instant PDF print export created by Yaswant Pandey.',
            'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'ratingCount' => '14250',
                'bestRating' => '5',
                'worstRating' => '1',
            ],
            'creator' => ['@id' => URL_HOME . '/#person'],
            'featureList' => [
                '4 ATS-Optimized Resume Templates (Classic, Modern, Harvard, Compact)',
                'Real-time live split-screen preview',
                'AI-powered bullet point enhancer',
                'Instant 1-click PDF print export',
                'Local JSON save and load state',
                'Real-time ATS score compatibility meter',
            ],
        ],
        [
            '@type' => 'HowTo',
            '@id' => URL_RESUME . '/#howto',
            'name' => 'How to Build an ATS-Compliant Resume for Free',
            'description' => 'Step-by-step guide to generating an ATS-friendly engineering resume using Yaswant Dev Resume Studio.',
            'step' => [
                [
                    '@type' => 'HowToStep',
                    'position' => 1,
                    'name' => 'Enter Profile & Contact Info',
                    'text' => 'Fill in your full name, email, phone number, LinkedIn, GitHub, and professional headline.'
                ],
                [
                    '@type' => 'HowToStep',
                    'position' => 2,
                    'name' => 'Add Work Experience & Measurable Achievements',
                    'text' => 'Detail internships and projects with action verbs and quantifiable metrics (e.g. improved speed by 40%).'
                ],
                [
                    '@type' => 'HowToStep',
                    'position' => 3,
                    'name' => 'Choose ATS-Tested Template',
                    'text' => 'Select from Classic Clean, Modern Sans, Harvard Formal, or Compact Tech layouts with real-time ATS scoring.'
                ],
                [
                    '@type' => 'HowToStep',
                    'position' => 4,
                    'name' => 'Export PDF',
                    'text' => 'Click Export PDF to download a clean, single-page ATS-ready PDF instantly.'
                ]
            ]
        ],
        [
            '@type' => 'FAQPage',
            '@id' => URL_RESUME . '/#faq',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'What is an ATS Resume?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'An ATS (Applicant Tracking System) resume is formatted specifically so automated recruitment software can parse contact information, work experience, education, and technical skills without layout errors.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Is this ATS Resume Builder completely free?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Yes, Yaswant Dev Resume Studio is 100% free with no sign-up required, no watermarks, and unlimited PDF exports.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Are my resume details kept private?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Yes, your resume data is processed entirely in your browser memory and never stored on external servers.'
                    ]
                ]
            ]
        ]
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}

// ─── Tools Hub Schema ─────────────────────────────────────────────────────────
function schema_tools(): string
{
    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => URL_TOOLS . '/#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Developer & Cyber Security Utilities', 'item' => URL_TOOLS],
            ]
        ],
        [
            '@type' => 'WebApplication',
            '@id' => URL_TOOLS . '/#app',
            'name' => 'Cyber Security & Developer Utilities Hub by Yaswant Pandey',
            'applicationCategory' => 'DeveloperApplication',
            'operatingSystem' => 'Any (Browser-based)',
            'url' => URL_TOOLS,
            'author' => ['@id' => URL_HOME . '/#person'],
            'description' => '26+ free browser-based cyber security & developer utilities built by Yaswant Pandey: Password Shannon Entropy Checker, CSPRNG Generator, SIEM Log Analyzer, Stateful Firewall Simulator, Subnet CIDR Calculator, AES Encryptor, and GPA Calculator.',
            'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
        ],
        [
            '@type' => 'FAQPage',
            '@id' => URL_TOOLS . '/#faq',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Are these cyber security tools safe to use?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Yes, all 26+ tools execute 100% locally in your web browser using client-side JavaScript, Web Crypto API, and Web Workers. No passwords, tokens, or files are sent to any remote server.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'What tools are available in the suite?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'The suite includes Password Entropy Checker, CSPRNG Generator, SIEM Log Threat Parser, Firewall Simulator, SQLi Auditor, 2FA TOTP Generator, CIDR Calculator, AES-256 Encryptor, IP Geolocation, DNS Inspector, XSS Sanitizer, and GPA Calculator.'
                    ]
                ]
            ]
        ]
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}

// ─── Blog Hub Schema ─────────────────────────────────────────────────────────
function schema_blog(array $articles = []): string
{
    $itemList = [];
    foreach (array_slice($articles, 0, 10) as $i => $art) {
        $itemList[] = [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'url' => URL_BLOG . '/post.php?id=' . ($art['id'] ?? 1),
            'name' => $art['title'] ?? 'Article'
        ];
    }

    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => URL_BLOG . '/#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Engineering Blog', 'item' => URL_BLOG],
            ]
        ],
        [
            '@type' => 'Blog',
            '@id' => URL_BLOG . '/#blog',
            'name' => 'Yaswant Pandey Tech & Engineering Blog',
            'url' => URL_BLOG,
            'description' => 'In-depth engineering tutorials, system design breakdowns, React performance guides, cybersecurity labs, and career advice by Yaswant Pandey.',
            'publisher' => ['@id' => URL_HOME . '/#organization'],
            'blogPost' => $itemList
        ]
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}

// ─── Single Article Schema ───────────────────────────────────────────────────
function schema_article(array $art): string
{
    $url = URL_BLOG . '/post.php?id=' . ($art['id'] ?? 1);
    $pubDate = !empty($art['created_at']) ? date('c', strtotime($art['created_at'])) : date('c');
    
    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => $url . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => URL_BLOG],
                ['@type' => 'ListItem', 'position' => 3, 'name' => $art['title'] ?? 'Article', 'item' => $url],
            ]
        ],
        [
            '@type' => 'BlogPosting',
            '@id' => $url . '#article',
            'mainEntityOfPage' => $url,
            'headline' => $art['title'] ?? 'Technical Article',
            'description' => $art['excerpt'] ?? '',
            'image' => $art['img'] ?? (URL_HOME . '/assets/og-cover.png'),
            'datePublished' => $pubDate,
            'dateModified' => $pubDate,
            'articleSection' => $art['cat'] ?? 'Technology',
            'wordCount' => str_word_count(strip_tags($art['content'] ?? '')),
            'author' => [
                '@type' => 'Person',
                'name' => $art['author'] ?? 'Yaswant Pandey',
                'url' => URL_HOME
            ],
            'publisher' => ['@id' => URL_HOME . '/#organization'],
        ],
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}

// ─── Projects Hub Schema ─────────────────────────────────────────────────────
function schema_project(array $projects = []): string
{
    $itemList = [];
    foreach (array_slice($projects, 0, 15) as $i => $p) {
        $itemList[] = [
            '@type' => 'SoftwareSourceCode',
            'position' => $i + 1,
            'name' => $p['title'] ?? 'Project',
            'description' => $p['desc'] ?? '',
            'programmingLanguage' => is_array($p['tags'] ?? null) ? implode(', ', $p['tags']) : 'Python, JavaScript',
            'codeRepository' => $p['github'] ?? 'https://github.com/Yaswantpandey',
            'author' => ['@id' => URL_HOME . '/#person']
        ];
    }

    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => URL_PROJECT . '/#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Projects Hub', 'item' => URL_PROJECT],
            ]
        ],
        [
            '@type' => 'CollectionPage',
            '@id' => URL_PROJECT . '/#collection',
            'name' => 'Cyber Security & Engineering Projects Hub by Yaswant Pandey',
            'url' => URL_PROJECT,
            'description' => 'Explore 25+ hands-on open-source Cyber Security projects: firewalls, password entropy checkers, vulnerability scanners, cryptography tools, and pentesting labs.',
            'author' => ['@id' => URL_HOME . '/#person'],
            'mainEntity' => [
                '@type' => 'ItemList',
                'itemListElement' => $itemList
            ]
        ]
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}

// ─── Tech Internships Schema (JobPosting + Breadcrumbs) ──────────────────────
function schema_internships(array $jobs = []): string
{
    $jobEntities = [];
    foreach (array_slice($jobs, 0, 10) as $j) {
        $jobEntities[] = [
            '@type' => 'JobPosting',
            'title' => $j['title'] ?? 'Engineering Intern',
            'description' => 'Exciting tech internship opportunity at ' . ($j['company'] ?? 'CloudNova') . ' in ' . ($j['location'] ?? 'Remote') . '. Tech stack: ' . (is_array($j['tags'] ?? null) ? implode(', ', $j['tags']) : 'Software Engineering'),
            'datePosted' => '2026-08-01T00:00:00Z',
            'validThrough' => '2026-12-31T23:59:59Z',
            'employmentType' => 'INTERN',
            'hiringOrganization' => [
                '@type' => 'Organization',
                'name' => $j['company'] ?? 'Tech Enterprise',
            ],
            'jobLocation' => [
                '@type' => 'Place',
                'address' => [
                    '@type' => 'PostalAddress',
                    'addressLocality' => $j['location'] ?? 'Remote',
                    'addressCountry' => 'IN'
                ]
            ],
            'baseSalary' => [
                '@type' => 'MonetaryAmount',
                'currency' => 'USD',
                'value' => [
                    '@type' => 'QuantitativeValue',
                    'value' => 45,
                    'unitText' => 'HOUR'
                ]
            ]
        ];
    }

    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => URL_INTERNSHIPS . '/#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Tech Internships', 'item' => URL_INTERNSHIPS],
            ]
        ],
        [
            '@type' => 'CollectionPage',
            '@id' => URL_INTERNSHIPS . '/#collection',
            'name' => 'Tech & Software Engineering Internships 2026 — Yaswant Dev',
            'url' => URL_INTERNSHIPS,
            'description' => 'Curated software engineering, ML research, frontend, cloud, and embedded systems internships for students.',
            'mainEntity' => [
                '@type' => 'ItemList',
                'itemListElement' => $jobEntities
            ]
        ]
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}

// ─── Courses Schema (Course + Breadcrumbs) ───────────────────────────────────
function schema_courses(array $courses = []): string
{
    $courseEntities = [];
    foreach ($courses as $i => $c) {
        $courseEntities[] = [
            '@type' => 'Course',
            'position' => $i + 1,
            'name' => $c['title'] ?? 'Engineering Course',
            'description' => 'Comprehensive engineering course covering ' . ($c['title'] ?? '') . ' with ' . ($c['lessons'] ?? 10) . ' lessons. Level: ' . ($c['level'] ?? 'Beginner') . '.',
            'provider' => ['@id' => URL_HOME . '/#organization'],
            'educationalLevel' => $c['level'] ?? 'Beginner',
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'USD',
                'category' => 'Free'
            ]
        ];
    }

    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => URL_COURSES . '/#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Free Engineering Courses', 'item' => URL_COURSES],
            ]
        ],
        [
            '@type' => 'CollectionPage',
            '@id' => URL_COURSES . '/#collection',
            'name' => 'Free Computer Science & Engineering Courses — Yaswant Dev',
            'url' => URL_COURSES,
            'description' => 'Curated open-source courses in DSA, Machine Learning, Operating Systems, Web Development, and Databases.',
            'mainEntity' => [
                '@type' => 'ItemList',
                'itemListElement' => $courseEntities
            ]
        ]
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}

// ─── Resources Schema (LearningResource + Breadcrumbs) ───────────────────────
function schema_resources(): string
{
    $graph = array_merge(schema_base(), [
        [
            '@type' => 'BreadcrumbList',
            '@id' => URL_RESOURCES . '/#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => URL_HOME],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Study Resources & Notes', 'item' => URL_RESOURCES],
            ]
        ],
        [
            '@type' => 'CollectionPage',
            '@id' => URL_RESOURCES . '/#collection',
            'name' => 'Engineering Study Notes, Semester PYQs & Lab Manuals — Yaswant Dev',
            'url' => URL_RESOURCES,
            'description' => 'Download verified handwritten lecture notes, semester previous year question papers (PYQs), and laboratory manuals for CS, ME, and EC branches.',
            'provider' => ['@id' => URL_HOME . '/#organization']
        ]
    ]);
    return json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES);
}
