# HydroBento Precision Design System

Status: Active Template Specification  
Version: 2.0.0  
Reference Implementation: `../laundry/.stitch` & [Live Tracking Demonstration](https://laundry.karuhundeveloper.com/pesanan/LDR-20260917-00000007?signature=967845d46045777b37186c180206b2b567a2404ee7fe0f2b3ea3f8cacc47699d)  
Last Updated: 2026-09-18  

---

## 0. Design Philosophy & Aesthetic Core

The **HydroBento Precision System** is an industrial, high-precision, tactical interface architecture engineered specifically for Laravel 13, Livewire 4, and Flux UI.

Moving decisively away from generic SaaS templates and diffuse skeuomorphic gradients, this design system borrows directly from surgical telemetry, industrial hardware instrumentation, and cutting-edge productivity tools.

### Core Principles

1. **Modular Bento Grid Architecture**: Content is compartmentalized into structured, purposeful rectangular units alternating between high-density operational telemetry and expansive interactive surfaces.
2. **Asymmetric Ratios**: Avoids monotonous symmetric cards. Uses asymmetric column groupings (`7:5`, `8:4`, or `3:3:6`) to create natural focal hierarchy.
3. **Tactile Crispness over Blurry Shadows**: Diffuse drop shadows are eliminated in favor of hairline 1px architectural borders (`#e2e8ed` on light / `#222c3d` on dark), crisp perimeter containment, and hard-edge micro-tactile offset accents.
4. **Dominant Inverted Hero Surfaces**: Key dashboard cards invert the canvas entirely using Deep Navy Slate (`#161c28` / `#080e1a`) punctuated by high-luminescence Electric Mint (`#00e29d`) metrics and status traces.
5. **Technical Typography Pairing**:
   - **Space Grotesk**: Sharp aperture cuts, mathematical geometry, and tabular weight for KPI readouts, headlines, and telemetry badges.
   - **Hanken Grotesk**: Clean, ergonomic legibility for multi-line body text, form controls, and descriptive narratives.
6. **Pure Canvas Integrity**: Eliminates background gradient clutter (`background-image: none !important;`) across both light (`#f8f9fb`) and dark (`#080e1a`) modes.

---

## 1. Design Tokens & Foundations

### 1.1 Color Tokens

| Semantic Token | Light Mode Hex | Dark Mode Hex | Tailwind / CSS Variable | Primary Semantic Role |
| :--- | :--- | :--- | :--- | :--- |
| **Canvas** | `#f8f9fb` | `#080e1a` | `--color-canvas` / `bg-canvas` | Base application viewport surface (no gradients) |
| **Surface** | `#ffffff` | `#121824` | `--color-surface` / `bg-surface` | Primary bento card, modal, and drawer backgrounds |
| **Surface Sub** | `#edf5fa` | `#182234` | `--color-surface-blue` | Soft operational grouping, secondary tiles, code blocks |
| **Border / Line** | `#e2e8ed` | `#222c3d` | `--color-line` / `border-line` | Hairline 1px perimeter boundaries and dividers |
| **Border Hover** | `#cbd5e1` | `#334155` | `--color-line-hover` | Interactive border hover feedback |
| **Ink Primary** | `#161c28` | `#f8f9fb` | `--color-ink-950` / `text-ink-950` | Primary headings, KPI figures, dominant labels |
| **Ink Secondary** | `#626d7b` | `#94a3b8` | `--color-ink-700` / `text-ink-700` | Secondary descriptions, column headers |
| **Ink Muted** | `#7e8493` | `#64748b` | `--color-ink-500` / `text-ink-500` | Timestamps, micro-captions, placeholder text |
| **Deep Navy (Brand)** | `#161c28` | `#080e1a` | `--color-brand-700` / `bg-brand-700` | Dominant inverted cards, sidebar background, primary CTAs |
| **Cobalt Teal** | `#1e667f` | `#38bdf8` | `--color-brand-600` / `text-brand-600` | Supporting structural accents, active tabs, secondary containers |
| **Electric Mint** | `#00e29d` | `#00e29d` | `--color-mint-accent` / `bg-mint-accent` | Live telemetry, active stage indicators, focus rings, pulse dots |
| **Status Warning** | `#e98a15` | `#f59e0b` | `--color-amber-500` | In-progress tasks, pending reviews, non-critical alerts |
| **Status Danger** | `#d92d20` | `#ef4444` | `--color-red-600` | Critical exceptions, destructive actions, failed jobs |

### 1.2 Typography Hierarchy

Fonts are imported via bunny.net in `resources/views/components/layouts/partials/head.blade.php`:

```html
<link href="https://fonts.bunny.net/css?family=hanken-grotesk:400,500,600,700|space-grotesk:500,600,700&display=swap" rel="stylesheet" />
```

| Scale | Family | Size | Weight | Tracking | Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Display Hero** | Space Grotesk | `2.5rem` - `3.5rem` (40–56px) | 700 (Bold) | `-0.03em` | Dominant hero telemetry figures and landing titles |
| **Headline Lg** | Space Grotesk | `1.75rem` - `2rem` (28–32px) | 600 (SemiBold) | `-0.02em` | Page headers and primary modal titles |
| **Headline Md** | Space Grotesk | `1.25rem` - `1.5rem` (20–24px) | 600 (SemiBold) | `-0.01em` | Section headers and bento card titles |
| **Headline Sm** | Space Grotesk | `1.125rem` (18px) | 600 (SemiBold) | `normal` | Sub-card headings and table category headers |
| **Metric Large** | Space Grotesk | `2.25rem` - `2.75rem` (36–44px) | 700 (Bold) | `-0.03em` | Primary KPI metrics (`tabular-nums`) |
| **Metric Medium** | Space Grotesk | `1.5rem` (24px) | 600 (SemiBold) | `-0.01em` | Secondary KPI values (`tabular-nums`) |
| **Body Lg** | Hanken Grotesk | `1rem` (16px) | 400 / 500 | `normal` | Lead paragraphs and detailed narrative summaries |
| **Body Md** | Hanken Grotesk | `0.875rem` (14px) | 400 / 500 | `normal` | Standard UI text, table cells, form inputs |
| **Body Sm** | Hanken Grotesk | `0.75rem` (12px) | 400 / 500 | `normal` | Micro-data, helper notes, status explanations |
| **Label Caps** | Space Grotesk | `0.6875rem` (11px) | 700 (Bold) | `0.08em` | Instrumentation tags, category pills, telemetry labels (`uppercase`) |

### 1.3 Geometry & Radii Rules

- **Bento Enclosures & Cards**: `1.5rem` (`rounded-3xl` / 24px). Creates uniform soft-rectangular chambers.
- **Form Inputs & Selectors**: `0.875rem` (`rounded-xl` / 14px) with Canvas `#f8f9fb` / `#080e1a` inset fill.
- **Interactive Action Buttons & Filter Tabs**: `9999px` (`rounded-full` / Pill Shape). Provides deliberate ergonomic contrast against rectangular bento borders.
- **Telemetry Chips & Badges**: `0.5rem` (`rounded-lg` / 8px) or `rounded-full` depending on role.

---

## 2. Bento Architecture & Grid Ratios

The HydroBento grid establishes clear visual rhythm through structured spatial grouping:

```
+---------------------------------------------------------------------------------------------------+
| TOP TELEMETRY SYNC BAR (Live status, branch indicator, real-time pulse)                           |
+-------------------------------------------------------------+-------------------------------------+
| DOMINANT INVERTED HERO CARD (col-span-7)                    | PRIMARY OPERATIONAL METRIC (col-span-5)
| - Deep Navy Slate (#161c28)                                 | - Soft Surface Blue (#edf5fa)       |
| - High-contrast Electric Mint Telemetry                     | - Active transaction counters       |
| - Segmented Linear Progress Gauge                           | - Pill CTA button                   |
+------------------------------------+------------------------+-------------------------------------+
| SUB-METRIC TILE A (col-span-4)     | SUB-METRIC TILE B (col-span-4) | SUB-METRIC TILE C (col-span-4)   |
| - White Surface / Dark Slate Surface | - Hairline border 1px        | - Space Grotesk KPI Value    |
+------------------------------------+--------------------------------+-----------------------------+
| HORIZONTAL EXPRESS GATEWAY (Full-width operational launchpad)                                     |
| - Action Pills (Quick Order, Batch Sync, Export Manifest, Print Labels)                           |
+-------------------------------------------------------------+-------------------------------------+
| SPECIALIZED MODULE A (col-span-8)                           | SPECIALIZED MODULE B (col-span-4)   |
| - Livewire Data Table / Activity Feed                       | - System Health & Storage Telemetry |
+-------------------------------------------------------------+-------------------------------------+
```

### Grid Breakpoint Strategy

- **Desktop (`>= 1024px`)**: 12-column grid with `1.5rem` (24px) gutters. Cards span `7:5`, `8:4`, or `4:4:4`.
- **Tablet (`768px – 1023px`)**: 6-column grid with `3:3` or `4:2` configurations.
- **Mobile (`< 768px`)**: 1-column stack. Key metrics collapse into 2-column compact chips (`grid-cols-2`), retaining full touch ergonomics.

---

## 3. Component Design Recipes

### 3.1 Inverted Hero Bento Card
```html
<div class="relative overflow-hidden rounded-3xl bg-[#161c28] p-6 lg:p-8 text-white border border-[#222c3d] shadow-sm">
    <div class="flex items-center justify-between gap-4 border-b border-white/10 pb-5">
        <span class="font-label-caps text-[#00e29d] tracking-widest uppercase">SYSTEM TELEMETRY</span>
        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#00e29d]/10 px-3 py-1 text-xs font-semibold text-[#00e29d]">
            <span class="h-2 w-2 rounded-full bg-[#00e29d] animate-pulse"></span>
            LIVE
        </span>
    </div>
    <div class="mt-6 flex flex-col md:flex-row md:items-baseline justify-between gap-4">
        <div>
            <div class="font-display text-4xl lg:text-5xl font-bold tracking-tight text-white">99.98%</div>
            <p class="mt-1 font-sans text-sm text-[#7e8493]">Real-time operational efficiency index</p>
        </div>
        <button class="rounded-full bg-[#00e29d] px-6 py-2.5 text-xs font-bold uppercase tracking-wider text-[#161c28] hover:bg-[#00c98b] transition-all">
            Execute Diagnostic
        </button>
    </div>
</div>
```

### 3.2 Pill Buttons (Global Flux Enforcement)
Buttons are globally styled as pills via `resources/css/app.css`:
```css
[data-flux-button] {
    border-radius: 9999px !important;
    font-weight: 600;
    transition: all 0.15s ease-in-out;
}
```
- **Primary Action**: Solid `#161c28` (light) / `#ffffff` (dark) with crisp contrast.
- **Telemetry / Accent Action**: Solid Electric Mint `#00e29d` with `#161c28` bold text.
- **Secondary / Ghost Action**: Transparent or canvas fill with 1px `#e2e8ed` border.

### 3.3 Segmented Progress Gauge
Instead of circular loaders, use multi-segment linear step gauges:
```html
<div class="grid grid-cols-5 gap-2">
    <div class="h-2 rounded-full bg-[#00e29d]"></div>
    <div class="h-2 rounded-full bg-[#00e29d]"></div>
    <div class="h-2 rounded-full bg-[#00e29d]"></div>
    <div class="h-2 rounded-full bg-[#1e667f]/30"></div>
    <div class="h-2 rounded-full bg-white/10"></div>
</div>
```

---

## 4. Light vs. Dark Mode Contrast Matrix

All elements maintain WCAG 2.2 AA (≥ 4.5:1 for normal text, ≥ 3:1 for large display metrics):

| UI Element | Light Mode Pair | Light Contrast | Dark Mode Pair | Dark Contrast |
| :--- | :--- | :--- | :--- | :--- |
| **Body Text on Canvas** | `#161c28` on `#f8f9fb` | **15.6 : 1** (AAA) | `#f8f9fb` on `#080e1a` | **17.8 : 1** (AAA) |
| **Muted Text on Canvas** | `#626d7b` on `#f8f9fb` | **5.4 : 1** (AA) | `#94a3b8` on `#080e1a` | **7.9 : 1** (AAA) |
| **Card Surface on Canvas** | `#ffffff` on `#f8f9fb` | Line-bordered `#e2e8ed` | `#121824` on `#080e1a` | Line-bordered `#222c3d` |
| **Inverted Hero Card Text** | `#ffffff` on `#161c28` | **16.2 : 1** (AAA) | `#ffffff` on `#080e1a` | **19.5 : 1** (AAA) |
| **Electric Mint on Navy** | `#00e29d` on `#161c28` | **10.8 : 1** (AAA) | `#00e29d` on `#080e1a` | **12.4 : 1** (AAA) |
| **Sidebar Active State** | `#00e29d` on `#161c28` | **10.8 : 1** (AAA) | `#00e29d` on `#121824` | **9.6 : 1** (AAA) |

---

## 5. Development Checklist for New Pages

When scaffolding or designing new pages in this application:

- [ ] **Import Fonts**: Ensure `Space Grotesk` and `Hanken Grotesk` are loaded.
- [ ] **No Background Gradients**: Verify the view does not override `body` background with diffuse multi-color gradients.
- [ ] **Bento Radii**: Apply `rounded-3xl` (`1.5rem`) to top-level card containers.
- [ ] **Hairline Borders**: Apply `border border-line` or `border border-neutral-200 dark:border-neutral-800`.
- [ ] **Typography Classes**:
  - Use `font-display` (`Space Grotesk`) for page titles, card headers, and KPI numbers.
  - Use `font-sans` (`Hanken Grotesk`) for paragraphs, descriptions, and table rows.
  - Use `font-label-caps` (`uppercase text-[11px] font-bold tracking-widest`) for metric headers and category tags.
- [ ] **Pill Actions**: Buttons and interactive filters must use `rounded-full`.
- [ ] **Inverted Hero**: At least one primary focal point should use the inverted Deep Navy Slate `#161c28` treatment with Electric Mint accents.
