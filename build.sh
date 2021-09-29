cd ./main
docker build --tag arcadia-frontend:isc-2021 .
docker tag arcadia-frontend:isc-2021 interestingstorage/arcadia-frontend:isc-2021
docker push interestingstorage/arcadia-frontend:isc-2021

cd ../backend
docker build --tag arcadia-backend:isc-2021 .
docker tag arcadia-backend:isc-2021 interestingstorage/arcadia-backend:isc-2021
docker push interestingstorage/arcadia-backend:isc-2021

cd ../money-transfer
docker build --tag arcadia-money-transfer:isc-2021 .
docker tag arcadia-money-transfer:isc-2021 interestingstorage/arcadia-money-transfer:isc-2021
docker push interestingstorage/arcadia-money-transfer:isc-2021

cd ../refer-a-friend
docker build --tag arcadia-refer-a-friend:isc-2021 .
docker tag arcadia-refer-a-friend:isc-2021 interestingstorage/arcadia-refer-a-friend:isc-2021
docker push interestingstorage/arcadia-refer-a-friend:isc-2021

cd ../nginx-reverse-proxy
docker build --tag arcadia-reverse-proxy:isc-2021 .
docker tag arcadia-reverse-proxy:isc-2021 interestingstorage/arcadia-reverse-proxy:isc-2021
docker push interestingstorage/arcadia-reverse-proxy:isc-2021

cd ../mortgage-calculator
docker build --tag arcadia-mortgage-calculator:isc-2021 -f nginx.Dockerfile  .
docker tag arcadia-mortgage-calculator:isc-2021 interestingstorage/arcadia-mortgage-calculator:isc-2021
docker push interestingstorage/arcadia-mortgage-calculator:isc-2021

docker build --tag arcadia-phpfpm:isc-2021 -f phpfpm.Dockerfile .
docker tag arcadia-phpfpm:isc-2021 interestingstorage/arcadia-phpfpm:isc-2021
docker push interestingstorage/arcadia-phpfpm:isc-2021