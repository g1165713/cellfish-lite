#!/bin/bash
# Run xampp in docker

# The directory that the script currently is in
PROJDIR="$( cd "$( dirname "${BASH_SOURCE[0]}/" )" && cd .. && pwd )"

docker run -d --rm \
    --name xampp \
    -p 8000:80 \
    -v $PROJDIR:/opt/app \
    -v $PROJDIR/config/php.ini:/opt/lampp/etc/php.ini \
    -v $PROJDIR/config/httpd.conf:/opt/lampp/apache2/conf/httpd.conf \
    cellfish
