cd ./main
docker build --tag arcadia-frontend:f5xc-plm-investments .
docker tag arcadia-frontend:f5xc-plm-investments interestingstorage/arcadia-frontend:f5xc-plm-investments
docker push interestingstorage/arcadia-frontend:f5xc-plm-investments

cd ../backend
docker build --tag arcadia-backend:f5xc-plm-investments .
docker tag arcadia-backend:f5xc-plm-investments interestingstorage/arcadia-backend:f5xc-plm-investments
docker push interestingstorage/arcadia-backend:f5xc-plm-investments

cd ../money-transfer
docker build --tag arcadia-money-transfer:f5xc-plm-investments .
docker tag arcadia-money-transfer:f5xc-plm-investments interestingstorage/arcadia-money-transfer:f5xc-plm-investments
docker push interestingstorage/arcadia-money-transfer:f5xc-plm-investments

# cd ../refer-a-friend
# docker build --tag arcadia-refer-a-friend:f5xc-plm .
# docker tag arcadia-refer-a-friend:f5xc-plm interestingstorage/arcadia-refer-a-friend:f5xc-plm
# docker push interestingstorage/arcadia-refer-a-friend:f5xc-plm

# cd ./nginx-reverse-proxy
# docker build --tag arcadia-reverse-proxy:f5xc-plm .
# docker tag arcadia-reverse-proxy:f5xc-plm interestingstorage/arcadia-reverse-proxy:f5xc-plm
# docker push interestingstorage/arcadia-reverse-proxy:f5xc-plm

# cd ../mortgage-calculator
# docker build --tag arcadia-mortgage-calculator:vk8s-isc-2021 -f nginx.Dockerfile  .
# docker tag arcadia-mortgage-calculator:vk8s-isc-2021 interestingstorage/arcadia-mortgage-calculator:vk8s-isc-2021
# docker push interestingstorage/arcadia-mortgage-calculator:vk8s-isc-2021

# docker build --tag arcadia-phpfpm:vk8s-isc-2021 -f phpfpm.Dockerfile .
# docker tag arcadia-phpfpm:vk8s-isc-2021 interestingstorage/arcadia-phpfpm:vk8s-isc-2021
# docker push interestingstorage/arcadia-phpfpm:vk8s-isc-2021

# cd ../openbanking
# docker build -f Dockerfile.openbanking --tag arcadia-openbanking:isc-2021 .
# docker tag arcadia-openbanking:isc-2021 interestingstorage/arcadia-openbanking:isc-2021
# docker push interestingstorage/arcadia-openbanking:isc-2021

# docker build -f Dockerfile.nuapay --tag arcadia-nua-api:isc-2021 .
# docker tag arcadia-nua-api:isc-2021 interestingstorage/arcadia-nua-api:isc-2021
# docker push interestingstorage/arcadia-nua-api:isc-2021

# postman tool for api
# docker build -f Dockerfile.postman --tag arcadia-nua-api:isc-2021-postman .
# docker tag arcadia-nua-api:isc-2021-postman interestingstorage/arcadia-nua-api:isc-2021-postman
# docker push interestingstorage/arcadia-nua-api:isc-2021-postman

# cd ../connectivity-test/test-tool
# docker build -f Dockerfile --tag arcadia-connectivity-tool:isc-2021 .
# docker tag arcadia-connectivity-tool:isc-2021 interestingstorage/arcadia-connectivity-tool:isc-2021
# docker push interestingstorage/arcadia-connectivity-tool:isc-2021