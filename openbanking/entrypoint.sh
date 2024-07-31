#!/bin/bash

while true
do
  openapi2postmanv2 -s ./api/openbanking.json -p -o collection.json -O folderStrategy=Tags,parametersResolution=Example,stackLimit=50,schemaFaker=true
    newman run collection.json --env-var "baseUrl=${BASE_URL}"
  sleep 1
done