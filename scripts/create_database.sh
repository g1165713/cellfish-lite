#!/bin/sh

PROJDIR="$( cd "$( dirname "${BASH_SOURCE[0]}/" )" && cd .. && pwd )"

rm $PROJDIR/data.sqlite3
cat $PROJDIR/config/schema.sql | sqlite3 $PROJDIR/data.sqlite3
