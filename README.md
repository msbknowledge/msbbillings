# 🚀 MsbBillings - Next-Generation Cloud POS & Enterprise Billing Suite

![MsbBillings Logo](msb/msbbillingslogo.png)

> **MsbBillings** is an enterprise-grade, high-performance Cloud Billing, Invoicing, and Point of Sale (POS) software platform built on an extensible **HMVC (Hierarchical Model-View-Controller)** architecture in PHP/CodeIgniter with modern **Smart School & AdminLTE** aesthetics.
> Designed for versatile multi-industry operations including Retail, Wholesale, Pharmacies & Chemists, ISP/Broadband providers, Cable TV (TRAI Compliant), Educational Institutions, and Recurring Subscription services.

---

## 📑 Table of Contents
1. [Architecture & Technology Stack](#-architecture--technology-stack)
2. [Directory Structure](#-directory-structure)
3. [Industry Modules & Feature Matrix](#-industry-modules--feature-matrix)
   - [1. Core Node Management (`modules/node`)](#1-core-node-management-modulesnode)
   - [2. Pharmacy & Healthcare (`modules/medical`, `medical_wholesale`)](#2-pharmacy--healthcare-modulesmedical-medical_wholesale)
   - [3. Wholesale & B2B Distribution (`modules/wholesale`)](#3-wholesale--b2b-distribution-moduleswholesale)
   - [4. Cable TV & Digital DTH (`modules/trai_lite`, `trai-cable`, `msb-cable`)](#4-cable-tv--digital-dth-modulestrai_lite-trai-cable-msb-cable)
   - [5. ISP & Broadband Management (`modules/msb-internet`, `internet`)](#5-isp--broadband-management-modulesmsb-internet-internet)
   - [6. Education & School Management (`modules/school`)](#6-education--school-management-modulesschool)
   - [7. Financial & Expense Ledger (`modules/expence_manager`)](#7-financial--expense-ledger-modulesexpence_manager)
   - [8. Subscription & Recurring Memberships (`modules/subscription`)](#8-subscription--recurring-memberships-modulessubscription)
   - [9. Payments & Notification Gateways (`modules/payment`, `email`)](#9-payments--notification-gateways-modulespayment-email)
4. [FastApp Core Framework Features](#-fastapp-core-framework-features)
5. [Smart School Modern UI Engine](#-smart-school-modern-ui-engine)
6. [Hardware & Peripheral Support](#-hardware--peripheral-support)
7. [Installation & Deployment](#-installation--deployment)

---

## 🛠 Architecture & Technology Stack

- **Backend Framework:** CodeIgniter 2.x/3.x with HMVC Modular Extensions.
- **Runtime Environment:** PHP 7.x / 8.x with Apache Web Server (`mod_rewrite` enabled).
- **Database Engine:** MySQL / MariaDB (InnoDB, utf8mb4 collation).
- **UI & Presentation Engine:** Smart School & AdminLTE 2.4.x, Twitter Bootstrap 3.3.7.
- **Frontend Interactivity:** jQuery 2.1.1 with modern event delegation (`$(document).on(...)`) and backward compatibility layers.
- **Iconography:** FontAwesome 4.7.0 with universal CSS compatibility shims for legacy Glyphicons.
- **Styling Architecture:** Vanilla CSS Design System with scoped variables, glassmorphism, responsive cards, and slate color palettes.

---

## 📂 Directory Structure

```text
c:\xampp\htdocs\software\
│
├── assets/                    # Smart School & AdminLTE assets
│   ├── backend/               # Core admin CSS, JS, Bootstrap, and Skins
│   │   ├── bootstrap/         # Bootstrap 3.3.7 CSS and JS
│   │   ├── dist/              # AdminLTE layout, fonts, and scripts
│   │   ├── plugins/           # DataTables, iCheck, jQuery-UI, Datepickers
│   │   └── theme.css          # Central MsbBillings Smart School Theme Rules
│   └── images/                # Application logos and visual assets
│
├── fastapp/                   # System Core Framework (Core HMVC Base)
│   ├── config/                # Database, routes, hooks, autoload config
│   ├── controllers/console/   # Core dashboard, user auth, options
│   ├── models/                # Base Active Record models and ORM helpers
│   └── views/
│       ├── console/common/    # Header, Footer, Breadcrumbs, Modals
│       ├── console/elements/  # Generic Table, Search Box, Add/Edit Forms
│       ├── console/user/      # Authentication & Login screens
│       └── index_tpl.php      # Public-facing Landing Page & Portal
│
├── js/                        # Console interactive JavaScript utilities
│   ├── fastapp.js             # Table generator, modal popups, live search, AJAX
│   └── chosen.jquery.min.js   # Advanced searchable dropdown engine
│
├── modules/                   # HMVC Modular Business Engines
│   ├── node/                  # Primary Cloud POS & Billing Module
│   ├── medical/               # Pharmacy, Chemist & Healthcare POS
│   ├── wholesale/             # B2B Wholesale Trading & Purchase Ledger
│   ├── trai_lite/             # TRAI Compliant Digital Cable TV
│   ├── msb-internet/          # Broadband & ISP Subscriber Management
│   ├── school/                # School Fees, Students & Course Inventory
│   ├── expence_manager/       # Company Expense Ledger & Petty Cash
│   ├── subscription/          # Recurring Billing & Membership Plans
│   ├── payment/               # Multi-channel Payment Gateway Integration
│   └── email/                 # Notification Engine & HTML Dispatcher
│
└── msb/                       # MsbBillings Brand Assets & Official Logos
    ├── msbbillingslogo.png    # Primary Brand Logo (White / Transparent)
    └── msblogo.png            # Alternate Corporate Badge
```

---

## 📦 Industry Modules & Feature Matrix

### 1. Core Node Management (`modules/node`)
*The primary backbone for retail billing, fast checkout, customer accounts, and collections.*

- **Customer Master Directory (`/console/customer`):**
  - Instant searchable directory of all registered clients.
  - Multi-parameter live search (Name, Mobile Number, Unique ID, Area/Address, Account Status).
  - Outstanding balance tracking with color-coded badges.
  - Bulk Customer Import via Excel/CSV spreadsheet upload.
  - Print Statement generation detailing customer debit/credit history.
- **Fastbill Quick POS (`/console/customer/fastbill/{id}`):**
  - Ultra-fast counter checkout interface optimized for minimum keystrokes.
  - Quick payment receipt generation with automatic balance reconciliation.
- **Invoicing Engine (`/console/invoice`):**
  - Automated tax invoice numbering.
  - Thermal receipt printing (80mm / 3-inch & 58mm / 2-inch format).
  - Bulk invoice selection, bulk printing, and PDF/HTML downloads.
- **Payment Collection Ledger (`/console/collection`):**
  - Real-time cashier collection recording.
  - Multi-mode support: Cash, UPI, Credit/Debit Card, Net Banking.
  - Instant print receipts on collection confirmation.
- **Renewal Management (`/console/customer/renewal`):**
  - Automated tracking of clients up for periodic renewal.
  - One-click bulk renewal processing.

---

### 2. Pharmacy & Healthcare (`modules/medical`, `medical_wholesale`)
*Tailored for Chemists, Retail Pharmacies, Medical Wholesalers, and Hospitals.*

- **Medicine & Generic Composition Master:**
  - Salt / Generic name indexing to assist pharmacists with alternative brand suggestions.
  - Manufacturer, Category, Rack/Shelf location tracking.
- **Batch & Expiry Date Lifecycle:**
  - Automated batch-wise stock entry during purchase invoice creation.
  - Expiry date monitoring with real-time early warning notifications.
  - Near-expiry stock return processing (`expiry_return.php`).
- **Doctor & Prescription Tracking:**
  - Doctor directory and prescription linking for schedule H & narcotic medications.
- **Unit Breakdown & Strip Dispensing:**
  - Supports selling full boxes, whole strips, or individual tablets/capsules.
- **GST & Profit/Loss Analytics:**
  - Automatic calculation of CGST, SGST, IGST per medicine tax slab.
  - Item-wise and batch-wise gross profit analysis (`profit_loss.php`).

---

### 3. Wholesale & B2B Distribution (`modules/wholesale`)
*Built for multi-category distributors, FMCG wholesalers, and manufacturing sales.*

- **B2B Purchase Procurement (`/console/purchase`):**
  - Supplier purchase order intake with Goods Received Note (GRN) matching.
  - Supplier payment tracking and outstanding vendor ledgers.
- **Product Inventory & Stock Valuation:**
  - Real-time physical inventory valuation.
  - Stock transfer, minimum threshold alerts, and re-order level indicators.
- **Wholesale Invoicing & Trade Schemes (`/console/sale`):**
  - Special volume-based tier discounts and trade schemes (`scheme.php`).
  - Credit limit management for wholesale buyers.
  - Credit Notes and Debit Notes management (`credit_note.php`).
- **Return Management:**
  - Vendor Purchase Returns (`return_purchase.php`) and Customer Sales Returns (`return_sale.php`).

---

### 4. Cable TV & Digital DTH (`modules/trai_lite`, `trai-cable`, `msb-cable`)
*Specially designed for Cable TV Operators (MSOs & LCOs) compliant with TRAI regulations.*

- **TRAI Tariff & Channel Pack Management:**
  - Bouquet, Broadcaster Packs, and A-la-carte channel packages.
  - Mandatory Network Capacity Fee (NCF) automated calculation.
- **STB & Smart Card Asset Inventory:**
  - Set-Top Box (STB) and Viewing Card (VC/Smart Card) serial tracking.
  - Device assignment, status tracking (Active, Suspended, Deactivated).
- **LCO Sub-Operator Billing:**
  - Multi-tier Local Cable Operator (LCO) sub-account management.
  - Commission sharing and bulk monthly recharge allocations.
- **Complaint Management:**
  - Signal disruption and service ticket logging with field technician assignment.

---

### 5. ISP & Broadband Management (`modules/msb-internet`, `internet`)
*Comprehensive solution for Internet Service Providers and Fiber Broadband operators.*

- **Subscriber Bandwidth Profiles:**
  - Plan speed allocation (Download/Upload Mbps, Fair Usage Policy limits).
  - Dynamic / Static IP address and MAC address registration.
- **Plan Validity & Automated Expiry:**
  - Real-time validity countdown per internet customer.
  - Instant renewal and plan upgrade workflows.
- **Payment Collection & Receipting:**
  - Online payment logging, cash counter receipts, and overdue collection registers.

---

### 6. Education & School Management (`modules/school`)
*Complete student fee billing, admission registry, and educational inventory.*

- **Student Directory & Enrollment (`/console/student`):**
  - Student roll number, class, section, batch, guardian contact, and photo.
- **Tuition & Institutional Fee Management:**
  - Multi-head fee structuring (Tuition, Transport, Examination, Lab, Library fees).
  - Automated monthly/quarterly fee installment invoice generation.
- **Fee Collection & Due Dockets:**
  - Instant collection receipts with remaining balance carryover.
  - Defaulter lists and automated reminders.
- **Course & Educational Inventory:**
  - Uniform, books, and study material distribution tracking.

---

### 7. Financial & Expense Ledger (`modules/expence_manager`)
*Internal business operational accounting and daily cash reconciliation.*

- **Expense Entry (`/console/transaction`):**
  - Fast logging of daily operational expenses (Rent, Electricity, Fuel, Staff Tea, Salaries, Hardware Repairs).
- **Categorization & Ledger Allocation:**
  - Customizable expense heads and categories.
  - Date-range expense reports for business profit audit.

---

### 8. Subscription & Recurring Memberships (`modules/subscription`)
*Automated recurring billing for gyms, service clubs, SaaS, and maintenance contracts.*

- **Membership Plan Engine:**
  - Weekly, Monthly, Quarterly, and Annual recurring cycles.
- **Automated Invoicing & Status Automation:**
  - Auto-generation of renewal invoices prior to membership expiration.
  - Automated suspension flags on non-payment.

---

### 9. Payments & Notification Gateways (`modules/payment`, `email`)
*Multi-channel payment reconciliation and automated communication.*

- **Payment Gateway Integration:**
  - Digital payment tracking and gateway reconciliation.
- **Automated Notification Dispatcher:**
  - HTML transactional receipts dispatched directly to customer email.
  - Monthly billing statement PDFs attached automatically.

---

## ⚡ FastApp Core Framework Features

- **HMVC Dynamic Routing:**
  - Modular directory organization where each business sector operates independently while sharing the core console layout.
- **Smart System Modals:**
  - Add, Edit, View, and Delete operations open in seamless AJAX Bootstrap modals (`#formAddEditModal`, `#myModal`) without page reloads.
  - Modals placed directly under `<body>` to prevent stacking context or backdrop trapping.
- **Universal AJAX Table Engine (`fastapp.js`):**
  - Live search filters that instantly filter table records without full page refresh.
  - Column drag-and-drop ordering.
  - Instant quick-edit fields directly from table rows.
  - Bulk Select All and Batch Delete actions with confirmation safety.
- **Defensive Error Handling:**
  - Backward compatibility shims for jQuery `.live()`, `.die()`, and `$.browser`.
  - Defensive execution wrappers for optional UI plugins (Chosen, Uploadify, CLEditor, iCheck).
  - Version-based cache-busting on all frontend scripts (`fastapp.js?v=...`, `theme.css?v=...`).

---

## 🎨 Smart School Modern UI Engine

- **Curated Color Tokens:**
  - Primary Accent: Brand Emerald Green (`#35aa47`).
  - Dark Elements & Headers: Slate-900 (`#0f172a`, `#1e293b`).
  - Background Neutral: Light Slate Canvas (`#f1f5f9`).
  - Text Content: Rich High-Contrast Slate (`#0f172a` for inputs, `#334155` for body).
- **Universal Iconography:**
  - Clean FontAwesome 4.7 icons across all action buttons:
    - 👁 **View:** Emerald Green button with `fa fa-eye`.
    - ✏ **Edit:** Sky Blue button with `fa fa-pencil`.
    - 🗑 **Delete:** Rose Red button with `fa fa-trash-o`.
    - 🖩 **Billing:** Amber button with `fa fa-calculator`.
    - 🖨 **Print:** Indigo button with `fa fa-print`.
    - 📥 **Download:** Royal Blue button with `fa fa-download`.
- **Responsive Layout:**
  - Collapsible compact sidebar with state persistence in `localStorage`.
  - Touch-friendly mobile drawer menu for handheld tablets and smartphones.

---

## 🖨 Hardware & Peripheral Support

- **Thermal Receipt Printers:**
  - Native support for 80mm (3-inch) and 58mm (2-inch) ESC/POS thermal printers.
  - Auto-cutter triggers and cash drawer kickout pulses.
- **Barcode & QR Scanners:**
  - USB / Wireless 1D & 2D barcode scanner compatibility with instant input focus.
- **Customer Displays:**
  - Compatible with secondary pole displays via serial/USB COM emulation.

---

## 🚀 Installation & Deployment

### 1. Prerequisites
- Apache 2.4+ Web Server
- PHP 7.4 or 8.x with `curl`, `mbstring`, `mysqli`, `gd`, and `json` extensions
- MySQL 5.7+ or MariaDB 10.3+

### 2. Apache VirtualHost Configuration
For optimal routing with sub-domains or local virtual hosts:

```apache
<VirtualHost *:80>
    ServerName neha.localhost
    DocumentRoot "C:/xampp/htdocs/software"
    <Directory "C:/xampp/htdocs/software">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### 3. Application Base URL
Configure `fastapp/config/config.php`:
```php
$config['base_url'] = 'http://neha.localhost/';
```

### 4. Database Setup
Configure `fastapp/config/database.php`:
```php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'simplebillings';
$db['default']['dbdriver'] = 'mysqli';
```

---

## 📄 License & Attribution
- **Software:** MsbBillings Cloud POS & Billing Suite.
- **Copyright:** © 2026 [MsbBillings](https://msbbiling.in). All Rights Reserved.
- **Support Helpline:** +91 89562 423934 | **Email:** admin@msbbillings.in
