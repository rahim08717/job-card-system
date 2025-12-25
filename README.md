# Job Card & Vehicle Servicing Software

A dynamic Laravel-based web application for managing vehicle service job cards, customer details, and inspection reports. Built as an intern assessment task for **Ragory LTD**.

## 🚀 Features implemented

- **Dynamic Job Card Creation:**
  - Auto-generated Job IDs.
  - Add unlimited service/parts rows dynamically (using Alpine.js).
  - Auto-calculation of line totals and grand totals.

- **Vehicle Management:**
  - Tracks Brand, Model, Year, Engine No, Chassis No, Mileage, and Fuel Type.
  - Links vehicles to customers automatically via mobile number.

- **Inspection Checklist:**
  - Pre-service inspection with Radio Buttons (Good / Bad / NA).
  - Saves report as JSON data.

- **Status Tracking:**
  - Pending → In Progress → Completed → Delivered workflow.

- **Invoicing:**
  - Clean, printable invoice/job card view with all details.

## 🛠 Tech Stack

- **Backend:** Laravel 10+, PHP, MySQL
- **Frontend:** Blade Templates, Tailwind CSS
- **Scripting:** Alpine.js (for dynamic rows)

## ⚙️ Installation Guide

1. **Clone the Repository**
   ```bash
   git clone <your-repo-link>
