# tretime

FORMAT: 1A
HOST: https://testserver.test/api

# difftime

Difftime is a simple API allowing to retrieve the difference betweeen two 24hour format time
# Example
## Get the time I have spent at work without checking the time sheet :)
###### https://testserver.test/api/?start=08:30&end=20:00
##Version: 
    Alpha 0.1

## Requests Collectio [/]

### Get the hour and minute difference [GET]

+ Response 200 (application/json)

        {
        "hour": "11",
        "minute": "30"
        }
