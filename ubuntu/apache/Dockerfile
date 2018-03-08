FROM ubuntu:14.04

RUN apt-get -qq update && apt-get -y install curl

ADD sh /opt/cyberlytic/bin
ADD var /var
ADD etc /etc
ADD installer/linux/apache.tar.gz /tmp/installer

RUN /opt/cyberlytic/bin/install-bhratach.sh && \
    /opt/cyberlytic/bin/install-connector.sh "http://ctp" "admin@ctp" "admin"

EXPOSE 8080
CMD ["/opt/cyberlytic/bin/run.sh"]
