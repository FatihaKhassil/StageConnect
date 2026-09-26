<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo"></a></p>

<h1 align="center">StageConnect</h1>

<p align="center">
A web platform that streamlines and digitalizes internship management for students, companies, and academic administrators.
</p>

---

## About StageConnect

**StageConnect** is a modern web-based platform built to solve a very concrete problem
faced by higher education institutions in Morocco: internship management is still
largely manual, relying on personal contacts and email applications with no real
tracking. Existing platforms such as LinkedIn, Indeed, or Glassdoor are too generic —
they don't filter offers precisely enough by field of study, which often leaves a
computer science student sifting through mechanical engineering internships.

StageConnect centralizes the entire internship lifecycle — from publishing an offer to
tracking an application's outcome — through a single platform connecting three types
of users:

- **Students**, who can browse filtered internship offers and submit applications
- **Companies / Recruiters**, who can publish offers and manage incoming applications
- **Administrators**, who validate companies and offers before they go live

## Key Features

- Publication of internship offers by companies, with fields such as specialty,
  location, and duration to enable precise filtering
- Filtered offer search for students, matching their field of study
- Application submission and structured tracking (pending, accepted, rejected)
- Company/recruiter account validation by administrators
- Offer moderation and approval workflow
- Role-based interfaces for students, recruiters, and administrators
- Responsive, clean UI built with Bootstrap

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP, Laravel |
| Frontend | HTML, CSS, JavaScript, Blade templating engine |
| UI Framework | Bootstrap |
| Database | MySQL |
| Communication | HTTP requests / JSON between backend and frontend |
| Architecture | MVC (Model-View-Controller) |
| Tools | VS Code, XAMPP, Git/GitHub |

## Architecture

The application follows a classic **MVC architecture**:

- **Model** — Eloquent models handling data and business logic
- **View** — Blade templates rendering the UI
- **Controller** — Laravel controllers handling requests and orchestrating responses

Communication between backend and frontend relies on HTTP requests exchanging JSON
data, with Laravel middleware enforcing security and access control based on user
roles (student, recruiter, administrator).

## Actors

| Actor | Responsibilities |
|---|---|
| Student | Search and filter offers, submit applications, track application status |
| Company / Recruiter | Register, publish internship offers, manage received applications |
| Administrator | Validate companies and offers, oversee the platform |

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


---

## Author

This project was developed by **Fatiha KHASSIL** as part of a final-year project (PFA)
at **ENSIAS** (École Nationale Supérieure d'Informatique et d'Analyse des Systèmes),
Web and Mobile Engineering department, Data and Software Sciences track.

- Supervised by: **Pr. Radouane Mohamed**
- Examiner: **Pr. Abnane Ibtissam**
- Academic year: 2024–2025
