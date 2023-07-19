# Dev_Solutions Task

### Requirements:

- docker
- docker-compose

### Seeded data:

- [Please view the seeded data guide](SEEDED.md)

### Postman collection:

- 

### Installation:

1.  Clone this repository
2.  `cd docker`
3.  `sh app_install.sh`


### Usage:

- ##### Start the app:

1.  `cd docker`
2.  - `sh app_start.sh`

    - starts nginx web server: http://localhost:8000
    - starts mysql server: (port 3306)

- ##### Stop the app:

1.  `cd docker`
2.  `sh app_stop.sh`

- ##### Executing commands inside the app container:

1.  `cd docker`
2.  `sh attach_terminal.sh`
