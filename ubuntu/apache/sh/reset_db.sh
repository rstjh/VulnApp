#!/bin/bash
if [ "$EUID" -ne 0 ]
	then echo "Please run as root (sudo)"
        exit
fi
if [ $# -eq 0 ]
  then
    echo "Defaulting to working directory /zipContents"
    echo "If location of db_dump is not /zipContents, please specify by supplying a parameter"
    echo "Usage: cyberlyticResetDB <parent directory of db_dump>"
fi

WORKING_DIR=${1:-/zipContents}
echo "> Stopping cyberlytic service"
service cyberlytic stop
echo "> Reseting state of mongoDB"
mongo CyberlyticCTP --eval "db.dropDatabase()"; mongorestore $WORKING_DIR/db_dump
if [ $? -eq 0 ]; then
    echo "> Success"
else
    echo "> Failure. Usage: cyberlyticResetDB <parent directory of db_dump>"
fi
echo "> Starting cyberlytic service"
service cyberlytic restart
echo "> Finished!"
