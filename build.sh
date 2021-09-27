cd ./main
docker build --tag arcadia-frontend:v1 .
docker tag arcadia-frontend:v1 interestingstorage/arcadia-frontend:v1
docker push interestingstorage/arcadia-frontend:v1

cd ../backend
docker build --tag arcadia-backend:v1 .
docker tag arcadia-backend:v1 interestingstorage/arcadia-backend:v1
docker push interestingstorage/arcadia-backend:v1

cd ../money-transfer
docker build --tag arcadia-money-transfer:v1 .
docker tag arcadia-money-transfer:v1 interestingstorage/arcadia-money-transfer:v1
docker push interestingstorage/arcadia-money-transfer:v1

cd ../refer-a-friend
docker build --tag arcadia-refer-a-friend:v1 .
docker tag arcadia-refer-a-friend:v1 interestingstorage/arcadia-refer-a-friend:v1
docker push interestingstorage/arcadia-refer-a-friend:v1

cd ../nginx-reverse-proxy
docker build --tag arcadia-reverse-proxy:v1 .
docker tag arcadia-reverse-proxy:v1 interestingstorage/arcadia-reverse-proxy:v1
docker push interestingstorage/arcadia-reverse-proxy:v1