FROM alpine:latest
RUN apk add --no-cache sqlite
COPY restaurant.db /dbdata/restaurant.db
COPY check-db.sh /check-db.sh
RUN chmod +x /check-db.sh
CMD ["/check-db.sh"]