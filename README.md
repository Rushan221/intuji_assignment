# IntuJi Assignment

This repository contains the code for an assignment related to using the Google Calendar API to manage events.

## Features

- Connects to Google Calendar using Google OAuth
- Lists upcoming 10 events
- Add events
- Delete events

## Requirements

- PHP 8 or later
- Composer
- Google Cloud Platform project with Google Calendar API enabled ([Google Cloud Platform](https://cloud.google.com/))

## Setup

### Clone the repository:

```bash
git clone https://github.com/Rushan221/intuji_assignment.git
```

### Install Dependencies
```bash
composer install
```
### Configure Google OAuth:
- Create a project in Google Cloud Platform.
- Enable the Google Calendar API for your project.
- store downloaded credentials as 'credentials.json' in root

### Disclaimer
This code is provided for educational purposes only and represents a Minimum Viable Product (MVP) with the possibility of future development. It may not be production-ready. It's recommended to implement proper error handling, security measures, and user authentication for a real-world application.
