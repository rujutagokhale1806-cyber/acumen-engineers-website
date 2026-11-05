# Acumen Engineers Corporate Website
## Environment Assessment & Technical Implementation Plan

**Date:** November 2026  
**Client / Project:** Acumen Engineers  
**Target Platform:** WordPress (Custom Theme + Companion Plugin)  
**Development Environment:** Windows 11 / LocalWP / Antigravity  

---

## 1. Environment Assessment

### 1.1 Project Directory Structure (`C:\Projects\Acumen-Engineers-Website`)
- **Version Control:** Git repository initialized with a clean `.gitignore`.
- **Existing Directories:**
  - `assets/company-profile/` &rarr; Contains `Acumen Company profile.pdf` (4 pages, 2.08 MB).
  - `assets/logo/` &rarr; Prepared for SVG and PNG brand marks.
  - `assets/project-images/` &rarr; Prepared for project portfolio photography.
  - `backups/` &rarr; Reserved for database exports and deployment snapshots.
  - `documentation/` &rarr; Reserved for specifications, design system, and technical plans.
  - `packages/` &rarr; Destination for build artifacts (installable `.zip` files for theme and plugin).
  - `source/` &rarr; Development source code for `acumen-theme` and `acumen-core` plugin.

### 1.2 LocalWP WordPress Installation
- **Local Site Name:** `Acumen Engineers`
- **Site Status:** **RUNNING** (Verified with HTTP 200 responses)
- **Local Installation Path:** `C:\Users\admin\Local Sites\acumen-engineers\app\public`
- **Frontend URL:** [http://acumen-engineers.local](http://acumen-engineers.local)
- **Admin Dashboard URL:** [http://acumen-engineers.local/wp-admin/](http://acumen-engineers.local/wp-admin/)
- **Active Admin User:** `acumenadmin` (`rujuta.gokhale1806@gmail.com`)
- **WordPress Core:** 7.1.4 (Managed by LocalWP)
- **Active Theme:** Twenty Twenty-Five (Default)
- **Database:** MySQL 8.4.0 (Database: `local`, User: `root`, Password: `root`)
- **Web Server:** Nginx 1.26.1
- **Email Testing:** Mailpit running on port 10000

### 1.3 Development Toolchain Status
| Tool | Installed Location / Source | Version | Status |
| :--- | :--- | :--- | :--- |
| **PHP** | LocalWP Lightning Service | 8.2.29 | Ready & verified via LocalWP shell |
| **WP-CLI** | LocalWP Extra Resources | 2.12.0 | Ready & verified |
| **Composer** | LocalWP Extra Resources | 2.x | Ready |
| **Node.js** | System (`C:\Program Files\nodejs\node.exe`) | v24.20.0 | Ready for asset bundling / minification |
| **NPM** | System | Bundled | Ready |
| **Git** | System (`C:\Program Files\Git\cmd\git.exe`) | Active | Ready |

---

## 2. Analysis of the Company Profile

From `Acumen Company profile.pdf`, the company identity, credentials, and offerings are:

### 2.1 Identity & Brand Proposition
- **Full Legal/Trade Name:** Acumen Engineers
- **Core Specialization:** Industrial Turnkey Project Execution, Erection, Fabrication & Commissioning
- **Tagline / Motto:** *"Turnkey Project Solutions"* / *"We Add Values to your projects"*
- **Operational Promise:** **JUST-IN-TIME + QUALITY**
- **Brand Palette:** Deep Industrial Navy Blue, Safety Yellow / Warm Amber, Steel Slate Grey, Clean White.

### 2.2 Core Offerings (Services Architecture)
1. **Turnkey Project Management:**
   - Engineering support for erection & commissioning
   - Timeline & milestone management, bar chart preparation
   - Layout drawing preparation & foundation verification
   - Process plant validation services
2. **Heavy Equipment & Plant Erection:**
   - Boiler erection
   - Chimney erection
   - Heavy process equipment lifting, positioning & alignment
3. **Piping Engineering & Execution:**
   - Process piping & Utility piping
   - Clean Room piping (for pharma and food/beverage hygiene standards)
   - IBR (Indian Boiler Regulations) & Non-IBR piping
   - SS / MS ducting
4. **Cabling & Instrumentation:**
   - Power & control wiring
   - Cable tray laying & cable dressing
   - Process instrument cabling, terminations & loop checks
5. **Fabrication (SS & MS):**
   - Stainless Steel (SS) and Mild Steel (MS) tank & equipment fabrication
   - Industrial structural steel fabrication and erection
6. **Specialized Welding:**
   - Orbital welding (sanitary pharma-grade standards)
   - TIG (Tungsten Inert Gas) welding
   - ARC welding
7. **AMC / ARC Plant Maintenance:**
   - Annual Maintenance Contracts (AMC) and Annual Rate Contracts (ARC)
   - Preventive maintenance
   - Scheduled shutdown and breakdown maintenance
   - Annual plant operating contracts
8. **Thermal & Acoustic Insulation:**
   - Hot and cold insulation for equipment, vessels, and piping networks
9. **Supply of Engineering Goods:**
   - Sourcing and supply of industrial fittings, valves, and process equipment

### 2.3 Target Industrial Sectors
- Brewery & Distillery
- Food, Beverages & Dairies
- Pharmaceuticals & Healthcare
- Chemical & Paint Industries
- Water & Wastewater Treatment
- Sugar Factories
- Oil & Gas Plants
- Oil Refineries
- Surface Treatment Plants
- General Process & Heavy Manufacturing Industries

### 2.4 Infrastructure & Facilities
- **Engineering Project Office:** Nigdi, Pune, Maharashtra
- **Fabrication Workshop:** 6,000 sq. ft. dedicated fabrication shop in Pune
- **Machinery & Tools:** Set of rectifier welding machines, orbital welding equipment, rigging tools, chain blocks, alignment jigs
- **Workforce:** Qualified engineers, process supervisors, certified welders (Orbital/TIG/ARC), fitters, riggers, and electricians

### 2.5 Notable Clients Highlighted
- Cadbury India Ltd.
- Pepsico India
- United Breweries Ltd.
- HRS Process Systems
- Bio Pharmax Group
- Doshion Veolia Water Treatment
- Dynamic Products Ltd.
- Posco Maharashtra Steel
- Mother's Dairy, Doehler India, Tulya Beverages, Royal Foods, Tricom Food Processing, Alba Sales Corp (Saudi Arabia)

### 2.6 Locations & Contact Details
- **Corporate Office:** #7, Ground Floor, Sant Dnyaneshwar Sankul, Sector 28, P.C.N.T.D.A., Nigdi, Pune – 411 044, Maharashtra, INDIA
- **Registered Office:** Shreeram Niwas, Plot No. 124, Sr. No. 35/7, Dattawadi, Akurdi, Pune – 411 035, Maharashtra, INDIA
- **Phones:** +91 20 2765 8234 | Mobile: +91 9423 019 234 / +91 98509 57425
- **Email:** info@acumenengineers.in | **Web:** www.acumenengineers.in

---

## 3. Proposed Website Architecture & Sitemap

```
                        [ Acumen Engineers Home ]
                                    |
   +-------------+--------------+---+--------------+--------------+
   |             |              |                  |              |
[About Us]   [Services]     [Sectors]         [Projects /      [Contact &
   |             |              |              Clients]           RFQ]
   |             |              |                  |              |
   +-- Overview  +-- Turnkey    +-- Pharma         +-- Marquee    +-- Inquiry Form
   +-- Team      +-- Erection   +-- Food/Dairy         Clients    +-- Pune Office
   +-- Infra     +-- Piping     +-- Brewery        +-- Case           Map
   +-- Quality   +-- Cabling    +-- Chemical           Studies    +-- Direct
       Policy    +-- Fab/Weld   +-- Water/Oil                     Contacts
                 +-- AMC/ARC
                 +-- Insulation
```

### Page Breakdown:
1. **Home Page (`front-page.php`):**
   - High-impact hero section with core value proposition & Request a Quote CTA.
   - Quick Stat counters (6,000 sq. ft. shop, 25+ marquee clients, multi-industry experience).
   - Core Services highlights with quick links.
   - Target Sectors grid with icons.
   - Client Logo Wall / Testimonial carousel.
   - "Why Acumen?" (Safety, Quality, Just-In-Time execution).
   - PDF Company Profile one-click download callout.
2. **About Us Page (`page-about.php`):**
   - Founder & engineering team background.
   - Quality policy, safety guidelines, and code of conduct.
   - Detailed infrastructure section (workshop, machinery, personnel).
3. **Services Page & Service Details (`archive-acumen_service.php` / `single-acumen_service.php`):**
   - Dedicated service cards detailing turnkey project phases, technical specifications (e.g., IBR compliance, orbital welding standards).
4. **Sectors Page (`taxonomy-sector.php`):**
   - Tailored breakdowns showing how Acumen caters specifically to pharma vs. food & beverage vs. heavy chemical processing.
5. **Clients & Projects Showcase (`archive-acumen_project.php` / `single-acumen_project.php`):**
   - Client badge grid.
   - Categorized project portfolio with filterable tabs (Sector, Service Type).
6. **Infrastructure & Quality (`page-infrastructure.php`):**
   - 6,000 sq. ft. facility walkthrough, machinery inventory, quality registrations.
7. **Contact Us & RFQ (`page-contact.php`):**
   - RFQ (Request For Quotation) form with project type dropdown, specification notes.
   - Interactive Google Map / OpenStreetMap embed for Nigdi and Akurdi offices.
   - Direct call/email tap-to-connect buttons.

---

## 4. Technical Architecture: Theme & Companion Plugin Separation

In professional WordPress engineering, **presentation is kept separate from data/business logic**:

### 4.1 Custom Theme: `acumen-theme`
- **Location in Repo:** `source/acumen-theme/`
- **Role:** Pure presentation and user experience.
- **Key Files:**
  - `style.css` &rarr; Theme metadata, core CSS custom properties (color variables, typography scale).
  - `functions.php` &rarr; Theme setup, asset enqueuing, navigation menus, widget/theme supports.
  - `header.php` & `footer.php` &rarr; Semantic header with accessible navigation, corporate footer with quick links and legal info.
  - `index.php`, `front-page.php`, `page.php`, `single.php`, `archive.php` &rarr; Template hierarchy files.
  - `template-parts/` &rarr; Modular components (hero, service card, client logo grid, CTA banner, contact block).
  - `assets/css/` & `assets/js/` &rarr; Clean, lightweight, performant CSS and vanilla JavaScript (mobile menu, smooth scroll, filtering). Zero dependency on heavy builder bloat.

### 4.2 Companion Plugin: `acumen-core`
- **Location in Repo:** `source/acumen-core/`
- **Role:** Business logic, custom data models, form handling, and post types.
- **Key Features:**
  - **Custom Post Types (CPT):**
    - `acumen_project` &rarr; Engineering projects & case studies.
    - `acumen_service` &rarr; Structured service catalog.
    - `acumen_client` &rarr; Marquee clients and logos.
  - **Custom Taxonomies:**
    - `acumen_sector` &rarr; Industry sectors (Pharma, Brewery, Chemical, etc.).
    - `acumen_service_category` &rarr; Service grouping (Erection, Piping, Maintenance, etc.).
  - **RFQ / Contact Form Handler:**
    - Handles AJAX form submissions securely using WordPress Nonces.
    - Sanitizes and validates user input.
    - Sends structured notification emails to `info@acumenengineers.in` and confirmation emails to clients.
    - Logs inquiries in the WordPress database for administrative review.
  - **Custom Settings Page:**
    - Allows administrators to update office addresses, phone numbers, email addresses, and working hours from the WordPress admin menu without editing theme code.

### 4.3 Packaging & Distribution (`packages/`)
- Automated build/zip scripts will bundle `source/acumen-theme` into `packages/acumen-theme.zip` and `source/acumen-core` into `packages/acumen-core.zip`.
- These `.zip` files can be uploaded and activated directly in any WordPress installation through the standard WordPress dashboard (`Appearance > Themes` and `Plugins > Add New`).

---

## 5. Development Workflow & Live Sync

Because WordPress runs inside `C:\Users\admin\Local Sites\acumen-engineers\app\public\wp-content`, we will establish a reliable workflow:
1. Develop cleanly inside `C:\Projects\Acumen-Engineers-Website\source\`.
2. Use directory junction (symbolic link) or an automated sync script to link `source/acumen-theme` to `app/public/wp-content/themes/acumen-theme` and `source/acumen-core` to `app/public/wp-content/plugins/acumen-core`.
3. Edits made in the project repository are instantly live on `http://acumen-engineers.local` without manual copying.
4. Packaging scripts will build distributable ZIP archives in `packages/` for client handoff or remote server deployment.

---

## 6. Actionable Implementation Roadmap (Phase by Phase)

- **Phase 1: Brand Assets & Media Extraction**
  - Extract and vectorize the Acumen logo into clean SVG.
  - Extract photo assets from the company profile PDF for initial media library population.
  - Generate clean vector icons for the 9 core services and 10 industrial sectors.
- **Phase 2: Companion Plugin (`acumen-core`) Development**
  - Register CPTs (`acumen_project`, `acumen_client`, `acumen_service`).
  - Register taxonomies (`acumen_sector`, `acumen_service_cat`).
  - Implement the RFQ form endpoint with nonce verification.
  - Create the Acumen Settings panel in WP Admin for easy corporate data management.
- **Phase 3: Custom Theme (`acumen-theme`) Development**
  - Build semantic HTML5 responsive header with mobile navigation drawer.
  - Build the dynamic Front Page (`front-page.php`) matching corporate branding.
  - Build subpage templates (About, Services archive/single, Projects archive/single, Contact).
  - Implement accessible forms and Google Maps integration.
- **Phase 4: Content Ingestion & Seed Data**
  - Populate all 9 services, 10 sectors, and 25 clients from the company profile.
  - Set up primary menus, social links, footer widgets.
- **Phase 5: Packaging & Quality Assurance**
  - Code linting, PHP syntax validation, mobile responsiveness testing in Chrome.
  - Generate production ZIP packages in `packages/`.
  - Export full WordPress database and content backup into `backups/`.
