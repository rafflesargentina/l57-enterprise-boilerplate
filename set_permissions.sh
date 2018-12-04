#!/bin/bash

/usr/bin/find ./storage -type d -exec chmod 775 {} \;
/usr/bin/find ./bootstrap/cache -type d -exec chmod 775 {} \;
