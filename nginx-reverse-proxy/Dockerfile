FROM nginx:1.27.0-alpine

ENV RESOLVER=127.0.0.11

ENV MAIN_APP=frontend.internal:8080
ENV BACKEND=backend.internal:8080
ENV MONEY_TRANSFER=money-transfer.internal:8080
ENV REFER_A_FRIEND=refer-a-friend.internal:8080
ENV MORTGAGE=mortgage-calculator.internal:8080
ENV OPEN_BANKING=openbanking.internal:8080

COPY default.conf.template /etc/nginx/templates/
