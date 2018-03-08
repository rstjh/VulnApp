#!/bin/sh -e

echo ">> Installing connector...$1 $2"
cd /tmp/installer && \
   ./install.sh "$@"

echo ">> Installation success!"
