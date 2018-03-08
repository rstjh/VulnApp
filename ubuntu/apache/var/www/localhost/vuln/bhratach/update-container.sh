#!/usr/bin/env bash
# Updates Ubuntu Apache container with latest Bhratach vulnerable
# website contents as rebuilding is too time consuming

docker cp * src_apache_1/var/www/localhost/vuln/bhratach