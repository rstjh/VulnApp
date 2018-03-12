#!/bin/sh -e

if [ $# -eq 3 ]; then
    echo ">> Using params...$1 $2"
    export CTPC_ADDRESS=$1
    export CTPC_USER=$2
    export CTPC_PASSWORD=$3
elif [ ! -z ${CTPC_ADDRESS+x} ] && [ ! -z ${CTPC_USER+x} ] && [ ! -z ${CTPC_PASSWORD+x} ]; then
    echo ">> Using env variables...$CTPC_ADDRESS $CTPC_USER"
else
    echo "Using DEFAULT installation!..."
fi

echo ">> Starting mysql & apache..."
service mysql restart && service apache2 restart

echo ">> Starting connector..."
/opt/cyberlytic/bin/ctpc /opt/cyberlytic/config.toml

echo ">> Success!..."
tail -F /var/lib/cyberlytic/ctpc.log /var/log/apache2/access.log
