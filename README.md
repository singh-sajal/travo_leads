# ✈️ TravoLeads – Travel Lead Management System

**TravoLeads** is a Laravel-based CRM designed to help travel agencies manage and track customer inquiries, follow-ups, quotations, and conversions in one place. It offers an intuitive UI, smart lead categorization, and powerful filtering to boost your agency's productivity.

---

## 🚀 Demo

🌐 Live Preview: [click here](https://travoleads.ilikasofttech.com/)

🧪 Local: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔧 Tech Stack

- **Backend:** Laravel 9, PHP 8+
- **Frontend:** Blade, Bootstrap 5, jQuery
- **Database:** SQLite
- **Authentication:** Laravel , PHP(core)
- **Icons:** FontAwesome / Bootstrap Icons
- **Version Control:** Git, GitHub

---

## 🧩 Key Features

- 📥 **Lead Submission** with contact, travel date, destination & notes  
- 🔁 **Follow-Up System** with status tracking (Pending, In Process, Converted, Lost)  
- 📅 **Calendar Reminders** for important follow-up dates  
- 📊 **Admin Dashboard** with lead analytics and visual stats  
- 🏷️ **Lead Tags & Sources** (e.g., Google Ads, WhatsApp, Walk-in)  
- 🔍 **Search & Filter** by status, agent, destination, and follow-up date  
- 🔒 **Role-Based Access** (Admin & Agents)  
- 📎 **File Uploads** for quotes, IDs, and documents  
- 🔔 **Planned Notifications** for upcoming follow-ups

---

## 🧪 Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/singh-sajal/travo_leads
cd travoleads
```

###  2. Install dependencies
```bash
composer install
```

### 3. Set up environment
#### Copy the example environment file and generate an application key:
```bash
cp .env.example .env
php artisan key:generate
```

#### Update your .env file with database credentials:

```env
DB_DATABASE=travo_leads_db
DB_USERNAME=root
DB_PASSWORD=
```

### Migrate & Seed

```bash
php artisan migrate --seed
```

### Serve the Web Application

```bash
php artisan serve
```

Visit the application 👉 [http://127.0.0.1:8000](http://127.0.0.1:8000) 
