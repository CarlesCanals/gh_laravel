#!/bin/bash
# Wait for a service to be available before running the next command

host="$1"
shift
cmd="$@"

until nc -z -v -w30 $host 3306
do
  echo "Waiting for MySQL service at $host:3306"
  sleep 1
done

echo "$host is up - executing command"
exec $cmd
