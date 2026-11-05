# Phase 2 Completion Report: Companion Plugin (acumen-core) Implementation

**Date:** November 3, 2026  
**Status:** Successfully Completed & Verified (Updated with Admin Table Optimization)  
**Project:** Acumen Engineers Corporate WordPress Website  
**Plugin:** `acumen-core` (Version 1.0.0)  
**Location:** `source/acumen-core/` (Linked via NTFS Junction to `Local Sites/.../wp-content/plugins/acumen-core`)  

---

## 1. Summary of Completed Deliverables

### 1.1 Custom Post Types & Taxonomies
- **Custom Post Types Registered:**
  - `acumen_service`: Services management with Dashicon `dashicons-hammer`, archive slug `/services/`, supports title, editor, thumbnail, excerpt, page-attributes.
  - `acumen_industry`: Industries management with Dashicon `dashicons-building`, archive slug `/industries/`, supports title, editor, thumbnail, excerpt.
  - `acumen_client`: Clients management with Dashicon `dashicons-groups`, archive slug `/clients/`, supports title, thumbnail, order.
  - `acumen_project`: Projects & Case Studies with Dashicon `dashicons-portfolio`, archive slug `/projects/`, supports title, editor, thumbnail, excerpt.
  - `acumen_gallery`: Visual Project Gallery with Dashicon `dashicons-format-gallery`, archive slug `/gallery/`, supports title, thumbnail.
- **Custom Taxonomies Registered:**
  - `acumen_service_cat`: Hierarchical categories for Services and Projects.
  - `acumen_sector`: Hierarchical industrial sectors for Clients, Projects, and Industries.
  - `acumen_gallery_cat`: Hierarchical categories for Gallery items.

### 1.2 Custom Meta Boxes & Admin Columns
- **Service Details:** Service Icon class/SVG, Key Highlights (bulleted lines), Technical Deliverables/Specifications.
- **Industry Details:** Industry Icon, Compliance Standards & Engineering Specifications (e.g. IBR, cGMP, ASME Sec IX).
- **Client Details:** Client Location / Region (e.g. Pune, India or Saudi Arabia), Website URL, Featured Ticker checkbox.
- **Project Details:** Client Name, Plant / Site Location, Execution Year / Status, Project Scope summary.
- **Gallery Details:** Photo Caption, Plant Facility / Location.
- **Enhanced Admin Columns:** Thumbnail previews, icons, locations, year badges, and featured toggles added directly into the WP Admin list tables.

### 1.3 Enquiry & RFQ Management System
- **Custom Database Table:** `wp_acumen_enquiries` created with indexed columns (`id`, `full_name`, `email`, `phone`, `company_name`, `service_requested`, `message`, `ip_address`, `status`, `created_at`).
- **Frontend AJAX RFQ Endpoint:** `acumen_submit_rfq` with Nonce verification (`check_ajax_referer`), strict input sanitization, error validation, and user feedback.
- **Admin Inbox Interface:** Dedicated admin screen under **Acumen Settings &rarr; Enquiries**:
  - Filter tabs by status (`All`, `New`, `Contacted`, `Closed`).
  - Quick action buttons to transition status or delete inquiries.
  - Formatted message reader with client phone and email click-to-contact links.
  - One-click **Export to CSV** functionality.

### 1.4 Centralized Settings Panel
- Integrated into WordPress via the Settings API under **Acumen Settings**:
  - **Company Information:** Legal name, Tagline, Corporate Office (Nigdi), Registered Office (Akurdi), Landline, Mobile numbers, Official Email, Profile PDF URL, Facility Size (6,000 Sq. Ft.).
  - **WhatsApp Configuration:** Toggle button on/off, WhatsApp number with country code (`919423019234`), pre-filled greeting message, screen position selector (`bottom-right` / `bottom-left`).
  - **Email Notification Settings:** Recipient emails (comma-separated), sender display name, auto-responder toggle.

### 1.5 Seven Custom Elementor Free Widgets
Registered under a custom **"Acumen Engineers"** widget category:
1. `Acumen_Widget_Services` (`acumen_services_grid`): Dynamic services grid with column and count controls.
2. `Acumen_Widget_Industries` (`acumen_industries_grid`): Target industry sectors with compliance tags.
3. `Acumen_Widget_Clients` (`acumen_clients_showcase`): Clients carousel or static grid layout.
4. `Acumen_Widget_Projects` (`acumen_projects_showcase`): Projects portfolio with filterable cards.
5. `Acumen_Widget_Stats` (`acumen_stats_counter`): High-impact animated counter cards.
6. `Acumen_Widget_RFQ_Form` (`acumen_rfq_form_widget`): Interactive AJAX quote inquiry form.
7. `Acumen_Widget_WhatsApp` (`acumen_whatsapp_button`): WhatsApp CTA button.

### 1.6 Shortcodes (Non-Elementor Fallback)
Every Elementor widget has a 1:1 matching shortcode:
`[acumen_services]`, `[acumen_industries]`, `[acumen_clients]`, `[acumen_projects]`, `[acumen_stats]`, `[acumen_rfq_form]`, `[acumen_whatsapp]`.

---

## 2. Admin Table Layout Optimization (Correction Applied)

### 2.1 Issue Diagnosis
- The default WordPress table class `fixed` forced `table-layout: fixed` across fixed-width columns (`ID`, `Date`, `Status`, `Client`, `Contact`, `Company`, `Service`, `Actions`), which consumed over 1,050px.
- Consequently, on standard display viewports or when the WordPress sidebar was expanded, the remaining un-sized `Project Scope / Message` column collapsed down to under 20px, causing text to wrap vertically one or two characters per line.

### 2.2 Corrections Applied
1. **Responsive Table Container:**
   - Wrapped the table in `.acumen-table-container` with `overflow-x: auto; -webkit-overflow-scrolling: touch;`.
   - Applied `min-width: 1200px` to the table, guaranteeing that columns maintain their proportions and readability regardless of browser window or sidebar width.
2. **Column Proportioning & Minimums:**
   - `col-id`: `width: 55px; min-width: 55px;`
   - `col-date`: `width: 135px; min-width: 135px;`
   - `col-status`: `width: 100px; min-width: 100px;`
   - `col-client`: `width: 150px; min-width: 140px;`
   - `col-contact`: `width: 180px; min-width: 170px; word-break: break-word;`
   - `col-company`: `width: 140px; min-width: 130px;`
   - `col-service`: `width: 160px; min-width: 150px;`
   - **`col-message` (Project Scope):** `width: 340px; min-width: 300px;`
   - `col-actions`: `width: 140px; min-width: 130px; text-align: right;`
3. **Optimized Message Box:**
   - Formatted message text with `word-break: break-word`, `white-space: pre-line`, `min-width: 280px`, and smooth vertical scroll `max-height: 120px`.
4. **Dedicated Admin CSS:**
   - Created `assets/css/acumen-admin.css` and hooked into `admin_enqueue_scripts` targeting `acumen-enquiries`.

---

## 3. Test Execution & Verification Results

| Test Category | Test Case | Method | Result |
| :--- | :--- | :--- | :--- |
| **PHP Syntax** | Lint every PHP file in `source/acumen-core/` | `php -l` | **PASS** (Zero syntax errors across all files) |
| **Plugin Lifecycle** | Activate & Deactivate plugin | WP-CLI `wp plugin activate/deactivate` | **PASS** (Clean activation, rewrite rules flush) |
| **Post Types** | Check registration of 5 CPTs | WP-CLI `post_type_exists()` | **PASS** (All 5 CPTs active) |
| **Taxonomies** | Check registration of 3 Taxonomies | WP-CLI `taxonomy_exists()` | **PASS** (All 3 Taxonomies active) |
| **Database Table** | Verify `wp_acumen_enquiries` schema | MySQL `SHOW TABLES LIKE 'wp_acumen_enquiries'` | **PASS** (Table exists with primary & status indexes) |
| **CRUD Operations** | Insert, update meta, read, delete on CPTs | `wp_insert_post()`, `update_post_meta()` | **PASS** (Verified clean creation and deletion) |
| **Enquiry Pipeline** | Insert lead and update status | Database insert & status transition | **PASS** (Status updated from `new` to `contacted`) |
| **Table Layout** | Check container, column widths & message min-width | CLI render test `scripts/test-enquiry-table-render.php` | **PASS** (Verified `min-width:1200px`, `col-message` 340px, `overflow-x:auto`) |
| **Shortcodes** | Render `[acumen_stats]`, `[acumen_whatsapp]`, `[acumen_rfq_form]` | `do_shortcode()` | **PASS** (Rendered complete HTML output) |
| **Elementor Widgets** | Check widget registration in Elementor Free | `Plugin::$instance->widgets_manager` | **PASS** (All 7 widgets registered under Acumen category) |
| **Email Delivery** | Dispatch admin alert & client auto-responder | `wp_mail()` & Mailpit API (Port 10000) | **PASS** (Both messages received in Mailpit) |
| **HTTP Health** | Test frontend and admin URLs | PowerShell `Invoke-WebRequest` | **PASS** (HTTP 200 OK on both endpoints) |
| **PHP Error Logs** | Check error log for exceptions or notices | LocalWP `php/error.log` | **PASS** (Zero fatal errors or plugin notices) |

---

## 4. Inventory of Plugin Files

```
source/acumen-core/
├── acumen-core.php
├── includes/
│   ├── class-database.php
│   ├── class-post-types.php
│   ├── class-taxonomies.php
│   ├── class-meta-boxes.php
│   ├── class-admin-columns.php
│   ├── class-settings.php
│   ├── class-enquiry-handler.php
│   ├── class-enquiry-table.php
│   ├── class-shortcodes.php
│   ├── class-whatsapp.php
│   └── elementor/
│       ├── class-elementor-addon.php
│       └── widgets/
│           ├── class-widget-services.php
│           ├── class-widget-industries.php
│           ├── class-widget-clients.php
│           ├── class-widget-projects.php
│           ├── class-widget-stats.php
│           ├── class-widget-rfq-form.php
│           └── class-widget-whatsapp.php
└── assets/
    ├── css/
    │   ├── acumen-admin.css     <-- Dedicated admin styles for table & settings
    │   └── acumen-enquiry.css   <-- Frontend component & form styles
    ├── js/
    │   └── acumen-enquiry.js
    └── icons/
        ├── services/  (9 SVG icons)
        └── sectors/   (10 SVG icons)
```
