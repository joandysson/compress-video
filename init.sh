#!/bin/bash

RESET=$(tput sgr0)
GREEN=$(tput setaf 2)
RED=$(tput setaf 1)

printf '%sStarting confings...\n' "$GREEN";

if [[ -f  .env ]]; then
    printf '%s \nDo you want to replace .env?' "$RED";
    read -p '(Y/N): ' -n 1 -r
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        cp $PWD/.env.example $PWD/.env;
    fi
else
    cp $PWD/.env.example $PWD/.env;
fi

printf '%s \nEdit .env to continue \n' "$RED";

if ! command -v make &> /dev/null
then
    printf '%s \nYou need to intall makefile to continue, do you want to install?' "$RED";
    read -p '(Y/N): ' -n 1 -r
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        printf '%s \n' "$RESET"
        sudo apt update && sudo apt install make
    else
        exit 1
    fi
fi

read -p 'Build container? (Y/N): ' -n 1 -r
if [[ $REPLY =~ ^[Yy]$ ]]; then
    printf '%s \n' "$RESET"
    make build
fi

printf '%s \nRun container' "$RED";
read -p '(Y/N): ' -n 1 -r
if [[ $REPLY =~ ^[Yy]$ ]]; then
    printf '%s \n' "$RESET"
    make up
fi

printf '%s \n\nFineshed with success...' "$GREEN";
printf '%s \nServer: http://localhost:80/ \n \n' "$RESET";
