# Oscord Code Academy Website

Oscord Code Academy is a PHP and MySQL based web system for an online programming academy. The website allows students to browse courses, view course details, register accounts, log in, enroll in courses, join group classes, watch course videos, view certificates, read FAQs, and manage their student profile.

## Main Features

* Student account registration and login
* Single-device login session system
* Course listing and course detail pages
* Free course preview video player
* Enrolled student video learning page
* Group class and batch enrollment system
* Student profile dashboard
* Profile photo and personal information update
* Password update feature
* Student reviews section
* Certificate, FAQ, diversity, impact, and workshop sections
* MySQL database integration

## Technologies Used

* PHP
* MySQL / MariaDB
* HTML
* CSS
* JavaScript
* Tailwind CSS CDN
* Font Awesome
* Chart.js
* Google Fonts

## Project Directory Structure

```text
oscord.io/
│
├── database/                         # Stores the project database file
│   └── oscord.sql                    # MySQL database backup file to import before running the website
│
├── image/                            # Stores website images, course images, certificate image, logo, and profile photos
│
├── video/                            # Stores course video files used by the course learning pages
│
├── includes/                         # Stores reusable backend files
│   ├── auth.php                      # Handles login checking, session token validation, single-device login, current user data, logout, and protected page access
│   └── connectdb.php                 # Connects the website to the MySQL database and sets UTF-8 character settings
│
├── index.php                         # Main home page; includes nav, welcome, diversity, FAQ, certificate, and footer sections
├── nav.php                           # Main responsive navigation bar for desktop and mobile screens
├── footer.php                        # Website footer with academy information, links, social icons, and copyright text
├── welcome.php                       # Home page hero/welcome section that introduces Oscord Code Academy and its learning system
│
├── courses.php                       # Displays all courses from the database with course images, categories, and course detail links
├── course_horizontal.php             # Shows selected premium courses in a horizontal scrolling card layout
├── specificCourse.php                # Shows one course detail page, modules, course description, free learning button, enrollment status, and continue-learning option
├── moduleFree.php                    # Free preview video page; shows course modules and allows only free videos to be played before enrollment
├── moduleNotFree.php                 # Protected course video player for approved/enrolled students; shows full course modules and lesson videos
│
├── batches.php                       # Displays available group class batches with batch number, schedule, status, seats, and enrollment button
├── specificGroupClass.php            # Protected video learning page for students approved in a specific group class batch
├── enrollCourse.php                  # Handles normal course enrollment with learning type selection, price calculation, terms agreement, and enrollment request submission
├── enrollGroupClass.php              # Handles group class enrollment for a selected batch after the student agrees to the terms and conditions
│
├── register.php                      # Student registration page with personal information fields, country list, password fields, and optional profile photo upload
├── register_action.php               # Processes registration form data, validates inputs, checks duplicate email, uploads profile photo, hashes password, and creates account/student records
├── login_modal.php                   # Login popup modal with email, password, remember-me checkbox, and register link
├── login_action.php                  # Processes login form, verifies password, blocks admin/instructor accounts from student login, and starts student session
├── logout.php                        # Logs out the current user by calling the logout function from auth.php
│
├── profile.php                       # Main student account dashboard; controls profile sections such as personal detail, courses, classes, and edit profile
├── profile-info.php                  # Displays student profile information, profile photo, member date, enrolled course count, class count, completed classes, and GPA
├── profile-courses.php               # Displays the student's enrolled courses with approval status, learning type, completion status, grade, and course access button
├── profile-classes.php               # Displays the student's enrolled group classes with batch number, schedule, approval status, class status, grade, and class access button
├── profile-edit.php                  # Allows students to edit personal information, upload/remove profile photo, and change password
│
├── studentReview.php                 # Full student reviews page that displays approved student reviews from the database
├── our_certificate.php               # Certificate section explaining the digital certificate of completion and showing the certificate image
├── our_diversity.php                 # Global diversity section with country distribution information and Chart.js student distribution chart
├── our_faq.php                       # Frequently Asked Questions section with search input and accordion-style answers
├── our_impact.php                    # Impact/statistics section showing courses offered, students enrolled, and instructors
├── our_review.php                    # Reusable student review section with scrolling review cards
└── our_student_workshop.php          # Student final project/workshop showcase section with project information and embedded video
```


The full README file includes the explanation of every file, database setup steps, local running instructions, and important deployment notes.
