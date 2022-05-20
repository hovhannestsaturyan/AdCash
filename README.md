## Installation

```

. git clone https://github.com/hovhannestsaturyan/AdCash.git  

. cd AdCash

. make install 

``` 


## Environment
To up all containers, run the command:

```
# Make command
make up

# Full command
docker-compose up -d
```
To stop all services only:

```
# Make command
make stop

# Full command
docker-compose stop
```
To shut down all containers, run the command:
```
# Make command
make down

# Full command
docker-compose down
```

## Basic usage
Base url is [ http://localhost:8080.]
Open http://localhost:8080 url in your browser.
<br>
<b>If you see the 502 error page, just wait a bit when ```yarn install && yarn dev``` process will be finished (Check the status with the command ```docker-compose logs client```) </b>
<br>
There is also available [http://localhost:8081](http://localhost:8081) url which is handled by Laravel.