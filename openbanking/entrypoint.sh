#!/bin/bash

while true
do
	openapi2postmanv2 -s ./api/openbanking.json -p -o collection.json -O folderStrategy=Tags,requestParametersResolution=Example,optimizeConversion=false,stackLimit=50
    newman run collection.json --env-var "baseUrl=${BASE_URL}"
	sleep 1
done