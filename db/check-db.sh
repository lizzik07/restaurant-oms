#!/bin/sh
echo "Checking database..."
result=$(sqlite3 /dbdata/restaurant.db "SELECT EXISTS (SELECT * FROM sqlite_master WHERE type='table' AND name='menu');")
if [ "$result" -eq 1 ]; then
  echo "DB is OK"; exit 0
else
  echo "DB is FAILED"; exit 1
fi