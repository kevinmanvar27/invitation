#!/bin/bash

# Compile Tailwind CSS
echo "Compiling Tailwind CSS..."
npx -p tailwindcss npx tailwindcss -i ./resources/css/app.css -o ./public/css/app.css --minify

# Check if compilation was successful
if [ $? -eq 0 ]; then
    echo "Tailwind CSS compiled successfully!"
    echo "File size: $(ls -lh public/css/app.css | awk '{print $5}')"
else
    echo "Error compiling Tailwind CSS!"
    exit 1
fi