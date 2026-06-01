# SORTIR.IN — Smart Waste Sorting System

IoT-based smart waste sorting platform that automatically classifies 
waste into organic, inorganic, and metal categories in real-time using 
ESP32 microcontrollers and material detection sensors.

## Tech Stack
- **IoT**: ESP32, Arduino (C++), Material Detection Sensors
- **Backend**: Laravel (REST API)
- **Frontend**: Vue.js
- **Database**: MySQL
- **Deployment**: VPS (Live)

## Features
- Real-time waste classification (organic / inorganic / metal)
- REST API endpoint for IoT sensor data ingestion
- Web monitoring dashboard for operators
- Waste capacity tracking & sorting history
- Automated sensor error alerts via cloud-connected API

## System Architecture

## API Endpoints
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | /api/sensor/data | Receive sensor data from ESP32 |
| GET | /api/sensor/dashboard | Fetch monitoring dashboard data |

## Deployment
Live on VPS — physical prototype completed.