# Acumen Engineers Corporate WordPress Website
## Final Technical Architecture & Implementation Blueprint (v2 - Elementor Free Compatible)

**Project:** Acumen Engineers Corporate Website  
**CMS:** WordPress 7.1.4 (LocalWP on Windows)  
**PHP Version:** 8.2.29  
**Visual Builder:** Elementor Free (Optional / Fully Supported, Zero Pro Dependency)  
**Workspace:** `C:\Projects\Acumen-Engineers-Website`  
**Site URL:** `http://acumen-engineers.local` | **Admin:** `http://acumen-engineers.local/wp-admin/`  

---

## 1. Architectural Foundations & Mandatory Principles

1. **Separation of Presentation, Data, and Visual Building:**
   - **Theme (`acumen-theme`):** Governs visual design tokens, responsive typography, header/footer chrome, Elementor canvas/full-width support, and automatic fallback templates.
   - **Companion Plugin (`acumen-core`):** Governs data schema (Custom Post Types, Taxonomies, Meta Boxes), admin settings, WhatsApp config, Enquiry management, **and custom Elementor Free widgets + WordPress shortcodes**.
   - **Single Source of Truth:** All content (services, sectors, clients, projects, phone numbers, addresses) resides in the WordPress database. Elementor pages pull this dynamic data via custom Acumen widgets or shortcodes; no duplicate copy-pasting is required.
2. **Dual-Mode Rendering & Graceful Fallback:**
   - **When Elementor is Active:** Pages can be designed, arranged, and styled visually using Elementor Free drag-and-drop.
   - **When Elementor is Deactivated:** The theme automatically detects the state and seamlessly renders rich native PHP fallback templates (Hero, Stats, Services Grid, Sectors, Clients, RFQ form). The website never breaks, goes blank, or loses functionality.
3. **Strict Elementor Free Compatibility:**
   - 100% compatible with **Elementor Free** (from the WordPress.org plugin repository).
   - Zero dependency on Elementor Pro.
4. **100% Database-Driven Admin Management:**
   - Non-technical administrators manage Services, Industries, Clients, Projects, Gallery, Enquiries, WhatsApp, and Office contacts entirely from the WordPress Admin menu.
   - Any update made in the WP Admin instantly updates on both Elementor-built pages and theme fallback templates.
5. **Independent Packaging:**
   - Both `acumen-theme.zip` and `acumen-core.zip` will be independently packaged into the `packages/` directory for standard WordPress zip uploads.

---

## 2. Elementor Free Synergy & Zero-Duplication Architecture

To avoid duplication between Elementor and the theme, `acumen-core` bridges the database with Elementor:

### 2.1 Custom Elementor Free Widgets in `acumen-core`
Registered in a dedicated **"Acumen Engineers"** widget category in the Elementor panel:
1. **Acumen Services Grid Widget:** Select columns, categories, and icon styles; dynamically pulls the 9 services from `acumen_service`.
2. **Acumen Industries / Sectors Grid Widget:** Displays target sectors with compliance badges.
3. **Acumen Clients Carousel / Wall Widget:** Displays the 25 marquee clients with filterable categories.
4. **Acumen Projects Showcase Widget:** Displays case studies with project specs and modal details.
5. **Acumen Stats Counter Widget:** Displays animated counters (6,000 sq ft facility, 25+ clients, years of engineering expertise).
6. **Acumen RFQ / Enquiry Form Widget:** Embeds the interactive AJAX quote form with real-time feedback.
7. **Acumen WhatsApp CTA Widget:** Embeds customizable WhatsApp direct-chat button.

### 2.2 Shortcode Equivalents for Non-Elementor / Classic Use
Every Elementor widget has a matching shortcode:
- `[acumen_services count="9" columns="3"]`
- `[acumen_industries columns="4"]`
- `[acumen_clients layout="carousel"]`
- `[acumen_projects filter="true"]`
- `[acumen_stats]`
- `[acumen_rfq_form]`
- `[acumen_whatsapp]`

---

## 3. Backend Administration Requirements

1. **Services Management (`acumen_service`):**
   - Manage the 9 turnkey service verticals with icons, deliverable checklists, technical standards, and media.
2. **Industries Management (`acumen_industry`):**
   - Manage the 10 target sectors (Pharma, Dairy, Brewery, Chemical, etc.) with compliance attributes (e.g., IBR, cGMP).
3. **Clients Management (`acumen_client`):**
   - Manage the 25 marquee client logos, sector affiliations, and priority display order.
4. **Projects Management (`acumen_project`):**
   - Showcase case studies, execution scope, client names, and gallery images.
5. **Project Gallery (`acumen_gallery`):**
   - Visual media organized by tags (Erection, Piping, SS/MS Fabrication, Plant Machinery).
6. **Enquiry & Lead Management (`wp_acumen_enquiries`):**
   - Dedicated Admin Inbox with status tracking (New, Contacted, Closed), search, and CSV export.
7. **Company Information Settings:**
   - Centralized fields for Corporate Office (Nigdi), Registered Office (Akurdi), phone numbers, email, and brochure PDF.
8. **WhatsApp Configuration:**
   - WhatsApp number, customizable pre-filled message, and floating button toggle.
9. **Email Notifications:**
   - Notification recipients, subject templates, auto-responder toggle (tested via Mailpit).

---

## 4. Frontend & Page Template Strategy

| Page | URL Slug | Elementor Free Editable? | Fallback Behavior when Elementor Deactivated |
| :--- | :--- | :--- | :--- |
| **Homepage** | `/` | Yes (Drag-and-drop Acumen widgets) | Renders native dynamic Hero, Stats, Services, Sectors, Clients ticker, and RFQ banner |
| **About Us** | `/about-us/` | Yes | Renders native company story, founders, quality & safety policy, and values |
| **Services** | `/services/` | Yes | Renders grid of all 9 services with icons and specifications |
| **Industries** | `/industries/` | Yes | Renders 10 sector cards with technical compliance notes |
| **Infrastructure** | `/infrastructure/` | Yes | Renders 6,000 sq ft workshop details, machinery list, and credentials |
| **Clients** | `/clients/` | Yes | Renders full client roster with sector filtering |
| **Gallery** | `/gallery/` | Yes | Renders interactive image grid with responsive JavaScript lightbox |
| **Contact Us** | `/contact-us/` | Yes | Renders office contact cards, interactive RFQ form, and Google Maps embed |

---

## 5. Development Phases & Roadmap

- **Phase 1: Environment Linkage, Asset Preparation & Elementor Setup**
  - Create directory junctions linking `source/` to LocalWP's `wp-content/themes` and `wp-content/plugins`.
  - Install and activate **Elementor Free** on the local WordPress installation.
  - Extract and vectorize the Acumen logo (SVG/PNG) and extract PDF photography into `assets/`.
- **Phase 2: Companion Plugin (`acumen-core`) Implementation**
  - Register all CPTs, taxonomies, and custom meta boxes.
  - Create the `wp_acumen_enquiries` table and build the WP Admin Leads Inbox.
  - Build the Acumen Settings panel (Company info, WhatsApp config, Email notifications).
  - Register the custom **"Acumen Engineers"** Elementor widget category and build the 7 custom Elementor Free widgets.
  - Register shortcode handlers as non-Elementor fallbacks.
- **Phase 3: Custom Theme (`acumen-theme`) Implementation**
  - Configure `add_theme_support('elementor')`, `wp_head()`, `wp_footer()`, and Elementor full-width templates.
  - Build clean corporate CSS design system (Navy `#0A192F`, Steel Blue `#1E3A8A`, Safety Amber `#F59E0B`).
  - Build smart templates (`front-page.php`, `template-about.php`, etc.) with dual-mode Elementor + fallback support.
- **Phase 4: Content Seeding & Page Setup**
  - Seed the 9 services, 10 sectors, 25 clients, and initial projects/gallery images from the company profile.
  - Populate company contact details, WhatsApp config, and email settings.
  - Create and configure primary navigation menus and set the static front page.
- **Phase 5: Packaging, QA & Fallback Verification**
  - Generate standalone ZIP packages (`packages/acumen-theme.zip` and `packages/acumen-core.zip`).
  - **Fallback Test:** Deactivate Elementor and verify all pages render flawlessly via native fallback templates.
  - **Elementor Test:** Verify drag-and-drop editing using custom Acumen widgets in Elementor Free.
  - Verify AJAX enquiry submissions and email delivery in Mailpit.

---

## 6. Approval

No code will be written until you review and confirm this updated architecture.
