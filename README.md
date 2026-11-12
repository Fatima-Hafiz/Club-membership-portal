# Club Membership Registration Portal

##  Project Overview
A responsive web-based portal designed for AJMD College clubs. This system replaces traditional paper forms and WhatsApp applications with a fully digital online registration process, including status tracking and member ID generation.

##  Technologies Used
* **Frontend:** HTML5, CSS3, JavaScript
* **Backend:** PHP
* **Database:** MySQL
* **Server:** XAMPP (Apache)

##  Key Features
* **Online Registration:** Students can apply to join clubs digitally.
* **Application Tracking:** Students can check the status of their application (Pending, Approved, Rejected).
* **Printable Member ID:** Approved students can print a digital ID card directly from the portal.
* **Admin Dashboard:** Secure admin login (using hashed passwords) to review, approve, or reject applications.
* **Security:** Implemented server-side validation to prevent duplicate applications and secure database queries.

##  How to Run Locally
1. Install **XAMPP** and start the Apache and MySQL services.
2. Clone this repository or download the files.
3. Move the project folder to the `htdocs` directory inside your XAMPP installation.
4. Open **phpMyAdmin** (http://localhost/phpmyadmin).
5. Create a new database named `club_portal` and import the provided `.sql` file.
6. Open your browser and go to `http://localhost/your-project-folder-name`.
